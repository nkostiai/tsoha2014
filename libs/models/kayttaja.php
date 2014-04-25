<?php

require_once(dirname(dirname(__FILE__)) . '/tietokantayhteys.php');

class Kayttaja {

    private $KayttajaID;
    private $nimi;
    private $salasana;
    private $adminstatus;

    public function __construct($nimi, $salasana, $adminstatus) {
        $this->nimi = $nimi;
        $this->salasana = $salasana;
        $this->adminstatus = $adminstatus;
    }

    /* Tähän gettereitä ja settereitä */

    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        $sql = "SELECT * FROM kayttaja WHERE nimi = ? AND salasana = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos === null) {
            return null;
        } else {
            $kayttaja = new Kayttaja($tulos->nimi, $tulos->salasana, $tulos->adminstatus);
            $kayttaja->setKayttajaID($tulos->kayttajaid);

            return $kayttaja;
        }
    }

    public function loytyyKannasta() {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT nimi FROM Kayttaja";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            if ($this->getNimi() === $tulos->nimi) {
                return true;
            }
        }
        return false;
    }

    public function onkoKelvollinen() {
        return (trim($this->getnimi()) == '' || trim($this->getSalasana()) == '' || strlen($this->getSalasana()) > 36 || strlen($this->getNimi()) > 20);
    }

    public static function getKayttajaListaus() {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT * FROM Kayttaja ORDER BY kayttajaid";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kayttaja = new Kayttaja($tulos->nimi, $tulos->salasana, $tulos->adminstatus);
            $kayttaja->setKayttajaID($tulos->kayttajaid);
            $tulokset[] = $kayttaja;
        }
        return $tulokset;
    }

    public static function getKayttajaById($id) {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT * FROM Kayttaja WHERE kayttajaid = ?";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($id));
        $tulos = $kysely->fetch(PDO::FETCH_OBJ);
        $kayttaja = new Kayttaja($tulos->nimi, $tulos->salasana, $tulos->adminstatus);
        $kayttaja->setKayttajaID($tulos->kayttajaid);
        return $kayttaja;
    }

    public static function poistaKayttajaByID($id) {
        $yhteys = getTietokantayhteys();
        $sql = "DELETE FROM Kayttaja WHERE kayttajaid = ?";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($id));
    }

    public function muokkaaKantaan($kayttaja) {
        $sql = "UPDATE kayttaja SET nimi = ?, salasana = ?, adminstatus = ? WHERE kayttajaid = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getNimi(), $this->getSalasana(), $this->getAdmin(), $kayttaja));
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO kayttaja(nimi, salasana, adminstatus) VALUES(?,?,?) RETURNING kayttajaid";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getNimi(), $this->getSalasana(), $this->getAdmin()));
        if ($ok) {
            $this->setKayttajaID($kysely->fetchColumn());
        }
        return $ok;
    }

    public function getKayttajaID() {
        return $this->KayttajaID;
    }

    public function setKayttajaID($uusiID) {
        $this->KayttajaID = $uusiID;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function setNimi($uusiNimi) {
        $this->nimi = $uusiNimi;
    }

    public function getAdmin() {
        if ($this->adminstatus) {
            return 1;
        } else {
            return 0;
        }
    }

    public function setAdmin($adminboolean) {
        $this->adminstatus = $adminboolean;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function setSalasana($uusiSalasana) {
        $this->salasana = $uusiSalasana;
    }

}
