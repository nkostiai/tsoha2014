<?php

require_once(dirname(dirname(__FILE__)) . '/tietokantayhteys.php');

class Viesti {

    private $ViestiID;
    private $AiheID;
    private $aloitusviesti;
    private $kirjoitusaika;
    private $viimeisinmuokkaus;
    private $viestin_sisalto;
    private $kirjoittaja;
    private $otsikko;
    private $virheet;

    public function __construct($AiheID, $viimeisinmuokkaus, $viestin_sisalto, $kirjoittaja, $otsikko) {
        $this->AiheID = $AiheID;
        $this->viimeisinmuokkaus = $viimeisinmuokkaus;
        $this->viestin_sisalto = $viestin_sisalto;
        $this->kirjoittaja = $kirjoittaja;
        $this->otsikko = $otsikko;
        $this->virheet = array();
    }

    /* Tähän gettereitä ja settereitä */

    public static function getViestiListaus($aihe) {

        $yhteys = getTietokantayhteys();
        $sql = "SELECT viesti.viestiid, viesti.aiheid, to_char(viesti.kirjoitusaika, 'DD-MM-YY  HH24:MI:SS') AS kirjoitusaika, viesti.viimeisin_muokkaus, viesti.viestin_sisalto, kayttaja.nimi AS kirjoittaja, viesti.otsikko FROM viesti, kayttaja WHERE viesti.kirjoittaja = kayttaja.kayttajaid AND viesti.aiheid = $aihe ORDER by kirjoitusaika";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();
        $tulokset = array();


        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $viesti = new Viesti($tulos->aiheid, $tulos->viimeisin_muokkaus, $tulos->viestin_sisalto, $tulos->kirjoittaja, $tulos->otsikko);
            $viesti->setViestiID($tulos->viestiid);
            $viesti->setKirjoitusAika($tulos->kirjoitusaika);
            $tulokset[] = $viesti;
        }
        return $tulokset;
    }

    public static function lukumaara() {
        $sql = "SELECT COUNT(*) FROM viesti";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

    public function getViestiID() {
        return $this->ViestiID;
    }

    public function setViestiID($uusiID) {
        if (!is_numeric($uusiID)) {
            $this->virheet['pituus'] = "Viestin ID tulee olla numero";
        } else if ($uusiID <= 0) {
            $this->virheet['pituus'] = "Viestin ID tulee olla positiivinen";
        } else {
            unset($this->virheet['pituus']);
            $this->ViestiID = $uusiID;
        }
    }

    public function getAiheID() {
        return $this->AiheID;
    }

    public function setAiheID($uusiID) {
        if (!is_numeric($uusiID)) {
            $this->virheet['aihe'] = "Aiheen ID tulee olla numero";
        } else if ($uusiID <= 0) {
            $this->virheet['aihe'] = "Aiheen ID tulee olla positiivinen";
        } else if (Aihe::etsi($uusiID) === null) {
            $this->virheet['aihe'] = "Aihetta ei löytynyt tietokannasta";
        } else {
            unset($this->virheet['aihe']);
            $this->AiheID = $uusiID;
        }
    }

    public function getKirjoitusAika() {
        return $this->kirjoitusaika;
    }

    public function setKirjoitusAika($kirjoitusaika) {
        $this->kirjoitusaika = $kirjoitusaika;
    }

    public function getViimeisinMuokkaus() {
        return $this->viimeisinmuokkaus;
    }

    public function setViimeisinMuokkaus($muokkausdate) {
        $this->viimeisinmuokkaus = $muokkausdate;
    }

    public function getViestinSisalto() {
        return $this->viestin_sisalto;
    }

    public function setViestinSisalto($sisalto) {
        $this->viestin_sisalto = $sisalto;
        if (trim($this->getViestinSisalto()) == '') {
            $this->virheet['viesti'] = "Viesti ei saa olla tyhjä";
        } else {
            unset($this->virheet['viesti']);
        }
    }

    public function getKirjoittaja() {
        return $this->kirjoittaja;
    }

    public function setKirjoittaja($kirjoittaja) {
        $this->kirjoittaja = $kirjoittaja;
    }

    public function getOtsikko() {
        return $this->otsikko;
    }

    public function setOtsikko($otsikko) {
        $this->otsikko = $otsikko;
        if (trim($this->getOtsikko()) == '') {
            $this->virheet['viesti'] = "Otsikko ei saa olla tyhjä";
        } else {
            unset($this->virheet['viesti']);
        }
    }

    public function lisaaKantaan($kayttaja) {
        $sql = "INSERT INTO viesti(aiheid, kirjoitusaika, viestin_sisalto, kirjoittaja, otsikko) VALUES(?,?,?,?,?) RETURNING viestiid";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getAiheID(), "now", $this->getViestinSisalto(), $this->getKirjoittaja(), $this->getOtsikko()));
        if ($ok) {
            $this->setViestiID($kysely->fetchColumn());
            $this->asetaLuetuksi($kayttaja);
        }
        return $ok;
    }

    public function muokkaaKantaan() {
        $sql = "UPDATE viesti SET otsikko = ?, viestin_sisalto = ?, viimeisin_muokkaus = ? WHERE viestiid = ? RETURNING viimeisin_muokkaus";
        $kysely = getTietokantayhteys()->prepare($sql);
        $muokkaus = $kysely->execute(array($this->getOtsikko(), $this->getViestinSisalto(), "now", $this->getViestiID()));
        $this->setViimeisinMuokkaus($muokkaus);
    }

    public function poistaKannasta() {
        $sql = "DELETE FROM viesti WHERE viestiid = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getViestiID()));
        $sql = "SELECT COUNT(*) FROM viesti WHERE aiheid = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getAiheID()));
        $tulos = $kysely->fetchColumn();
        if (!($tulos > 0)) {
            $sql = "DELETE FROM aihe WHERE aiheid = ?";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($this->getAiheID()));
        }
    }

    public function onkoKelvollinen() {
        return (trim($this->getViestinSisalto()) == '' || trim($this->getOtsikko()) == '');
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public function asetaLuetuksi($kayttaja) {
        $sql = "INSERT INTO luetut(kayttajaid, viestiid) VALUES (?, ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja->getKayttajaID(), $this->getViestiID()));
    }

    public function onkoLukenut($kayttaja) {
        $sql = "SELECT COUNT(*) AS CNT FROM luetut WHERE kayttajaid = ? AND viestiid = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja->getKayttajaID(), $this->getViestiID()));
        $tulos = $kysely->fetchColumn();
        if ($tulos > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function haeViestiIDlla($id) {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT * FROM viesti WHERE viestiid = $id";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $viesti = new Viesti($tulos->aiheid, $tulos->kirjoitusaika, $tulos->viestin_sisalto, $tulos->kirjoittaja, $tulos->otsikko);
            $viesti->setViestiID($id);
            $tulokset[] = $viesti;
        }

        if (empty($tulokset)) {
            return null;
        } else {
            return $tulokset;
        }
    }

}
