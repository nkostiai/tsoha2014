<?php
require_once(dirname(dirname(__FILE__)) . '/tietokantayhteys.php');
class Aihe {
  
  private $AiheID;
  private $KategoriaID;
  private $nimi;
  

  public function __construct($aiheID, $kategoriaID, $nimi) {
    $this->AiheID = $aiheID;
    $this->kategoriaID = $kategoriaID;
    $this->nimi = $nimi;
  }

  /* Tähän gettereitä ja settereitä */

  
  public function getNimi(){
      return $this->nimi;
  }
  
  public function getId(){
      return $this->AiheID;
  }
  
  public function setNimi($uusinimi){
      $this->nimi = $uusinimi;
  }
  
  public function setID($uusiID){
      $this->AiheID = $uusiID;
  }
  
  public function getKategoria(){
      return $this->kategoriaID;
  }
  
  public static function getAiheListaus() {
        $yhteys = getTietokantayhteys();
        $sql = "SELECT * FROM aihe";
        $kysely = $yhteys->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $aihe = new Aihe($tulos->AiheID, $tulos->KategoriaID, $tulos->nimi);
            $tulokset[] = $aihe;
        }
        return $tulokset;
    }
  
  public function setKategoria($uusikategoria){
      $this->KategoriaID = $uusinimi;
  }
  
}