<?php

require_once(dirname(dirname(__FILE__)) . '/tietokantayhteys.php');

class Kategoria {

    private $kategoriaID;
    private $nimi;
    private $kuvaus;

    public function __construct($kategoriaID, $nimi, $kuvaus) {
        $this->kategoriaID = $kategoriaID;
        $this->nimi = $nimi;
        $this->kuvaus = $kuvaus;
    }

    /* Tähän gettereitä ja settereitä */

    public static function getKategoriaListaus() {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT * FROM kategoria";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kategoria = new Kategoria($tulos->kategoriaid, $tulos->nimi, $tulos->kuvaus);
            $tulokset[] = $kategoria;
        }
        return $tulokset;
    }

    public static function getKategorianNimi($kategoriaid) {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT nimi FROM kategoria WHERE kategoriaid = $kategoriaid";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();
        return $kysely->fetch();
    }

    public function onkoUusiaViesteja($kayttaja) {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT count(*) FROM viesti, aihe WHERE viesti.aiheid = aihe.aiheid AND aihe.kategoriaid = ? AND viesti.viestiid NOT IN (SELECT viesti.viestiid FROM luetut, viesti WHERE luetut.kayttajaid = ? AND luetut.viestiid = viesti.viestiid)";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($this->getId(), $kayttaja->getKayttajaID()));
        return $kysely->fetchColumn();
    }

    public function getNimiById($kategoriaid) {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT nimi FROM kategoria where kategoriaid = ?";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($kategoriaid));
        return $kysely->fetchColumn();
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getId() {
        return $this->kategoriaID;
    }

    public function setNimi($uusinimi) {
        $this->nimi = $uusinimi;
    }

    public function setID($uusiID) {
        $this->kategoriaID = $uusiID;
    }

    public function getKuvaus() {
        return $this->kuvaus;
    }

}
