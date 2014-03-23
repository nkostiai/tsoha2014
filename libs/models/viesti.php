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

    public function __construct($ViestiID, $AiheID, $aloitusviesti, $kirjoitusaika, $viimeisinmuokkaus, $viestin_sisalto, $kirjoittaja, $otsikko) {
        $this->ViestiID = ViestiID;
        $this->AiheID = $AiheID;
        $this->aloitusivesti = $aloitusviesti;
        $this->kirjoitusika = $kirjoitusaika;
        $this->viimeisinmuokkaus = $viimeisinmuokkaus;
        $this->viestin_sisalto = $viestin_sisalto;
        $this->kirjoittaja = $kirjoittaja;
        $this->otsikko = $otsikko;
    }

    /* Tähän gettereitä ja settereitä */

    public static function getViestiListaus() {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT viesti.viestiid, viesti.aiheid, viesti.aloitusviesti, viesti.kirjoitusaika, viesti.viimeisin_muokkaus, viesti.viestin_sisalto, kayttaja.nimi AS kirjoittaja, viesti.otsikko FROM viesti, kayttaja WHERE viesti.kirjoittaja = kayttaja.kayttajaid ORDER BY kirjoitusaika";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $viesti = new Viesti($tulos->ViestiID, $tulos->AiheID, $tulos->aloitusviesti, $tulos->kirjoitusaika, $tulos->viimeisinmuokkaus, $tulos->viestin_sisalto, $tulos->kirjoittaja, $tulos->otsikko);
            $tulokset[] = $viesti;
        }
        return $tulokset;
    }

    public function getViestiID() {
        return $this->ViestiID;
    }

    public function setViestiID($uusiID) {
        $this->ViestiID = $uusiID;
    }

    public function getAiheID() {
        return $this->AiheID;
    }

    public function setAiheID($uusiID) {
        $this->AiheID = $uusiID;
    }

    public function getOnkoAloitusviesti() {
        return $this->aloitusviesti;
    }

    public function setAloitusViesti($aloitusboolean) {
        $this->aloitusviesti = $aloitusboolean;
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
        $this->viestinsisalto = $sisalto;
    }

    public function getKirjoittaja() {
        return $this->kirjoittaja;
    }

    public function setKirjoittaja($kirjoittaja) {
        $this->kirjoittaja = $kirjoittaja;
    }
    
    public function getOtsikko(){
        return $this->otsikko;
    }

}
