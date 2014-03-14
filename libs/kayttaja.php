<?php
require 'tietokantayhteys.php';
class Kayttaja {
  
  private $id;
  private $tunnus;
  private $password;
  

  public function __construct($id, $tunnus, $salasana) {
    $this->id = $id;
    $this->tunnus = $tunnus;
    $this->salasana = $salasana;
  }

  /* Tähän gettereitä ja settereitä */
  public static function getKayttajaLista(){

      $yhteys = getTietokantayhteys();

      $sql = "SELECT * FROM kayttaja";

      $kysely = $yhteys->prepare($sql);
 
      $kysely->execute();
 
      
      $tulokset = array();
      foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos){
 
          $kayttaja = new Kayttaja($tulos->kayttajaid, $tulos->nimi, $tulos->salasana);
          $tulokset[] = $kayttaja;
      }
      return $tulokset;
  }
  
  public function getTunnus(){
      return $this->tunnus;
  }
  
  public function getId(){
      return $this->id;
  }
  
  public function getSalasana(){
      return $this->salasana;
  }
  
}