<?php

require_once(dirname(dirname(__FILE__)) . '/tietokantayhteys.php');

class Aihe {

    private $AiheID;
    private $KategoriaID;
    private $nimi;

    public function __construct($kategoriaID, $nimi) {
        $this->kategoriaID = $kategoriaID;
        $this->nimi = $nimi;
    }

    /* Tähän gettereitä ja settereitä */

    public function getNimi() {
        return $this->nimi;
    }

    public function getId() {
        return $this->AiheID;
    }

    public function setNimi($uusinimi) {
        $this->nimi = $uusinimi;
    }

    public function setID($uusiID) {
        $this->AiheID = $uusiID;
    }

    public function getKategoria() {
        return $this->kategoriaID;
    }

    public static function getAiheListaus($kategoria) {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT * FROM aihe WHERE kategoriaId = $kategoria";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $aihe = new Aihe($tulos->kategoriaid, $tulos->nimi);
            $aihe->setID($tulos->aiheid);
            $tulokset[] = $aihe;
        }
        return $tulokset;
    }

    public static function etsi($id) {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT * FROM aihe WHERE kategoriaId = $id";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $aihe = new Aihe($tulos->kategoriaid, $tulos->nimi);
            $aihe->setID($tulos->aiheid);
            $tulokset[] = $aihe;
        }
        
        if (empty($tulokset)) {
            return null;
        } else {
            return $tulokset;
        }
    }
    
    public function lisaaKantaan() {
        $sql = "INSERT INTO aihe(kategoriaid, nimi) VALUES(?,?) RETURNING aiheid";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getKategoria(), $this->getNimi()));
        if ($ok) {
            $this->setID($kysely->fetchColumn());
        }
        return $ok;
    }

    public function setKategoria($uusikategoria) {
        $this->KategoriaID = $uusinimi;
    }

}
