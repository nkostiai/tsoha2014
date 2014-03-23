<?php
require_once(dirname(dirname(__FILE__)).'/tietokantayhteys.php');

class Kayttaja {
  
  private $KayttajaID;
  private $nimi;
  private $salasana;
  private $sahkoposti;
  private $adminstatus;
  private $porttikielto;
  

  public function __construct($KayttajaID, $nimi, $salasana, $sahkoposti, $adminstatus, $porttikielto) {
    $this->KayttajaID = $KayttajaID;
    $this->nimi = $nimi;
    $this->salasana = $salasana;
    $this->sahkoposti = $sahkoposti;
    $this->adminstatus = $adminstatus;
    $this->porttikielto = $porttikielto;
    
  }

  /* Tähän gettereitä ja settereitä */
   public static function etsiKayttajaTunnuksilla($kayttaja, $salasana){
      $sql = "SELECT kayttajaid, nimi, salasana FROM kayttaja WHERE nimi = ? AND salasana = ? LIMIT 1";
      $kysely = getTietokantayhteys()->prepare($sql);
      $kysely->execute(array($kayttaja, $salasana));
      
      $tulos = $kysely->fetchObject();
      if($tulos === null){
          return null;
      }
      else{
          $kayttaja = new Kayttaja($tulos->kayttajaid, $tulos->nimi, $tulos->salasana, $tulos->sahkoposti, $tulos->adminstatus, $tulos->porttikielto);
          
          return $kayttaja;
      }
  }
  
  public function getKayttajaID(){
      return $this->KayttajaID;  
  }
  
  public function setKayttajaID($uusiID){
      $this->KayttajaID = $uusiID;
  }
  
  public function getNimi(){
      return $this->nimi;  
  }
  
  public function setNimi($uusiNimi){
      $this->nimi = $uusiNimi;
  }
  
  public function getSahkoposti(){
      return $this->sahkoposti;  
  }
  
  public function setSahkoposti($uusiSahkoposti){
      $this->sahkoposti = $uusiSahkoposti;
  }
  
  public function getAdmin(){
      return $this->adminstatus;  
  }
  
  public function setAdmin($adminboolean){
      $this->adminstatus = $adminboolean;
  }
  
  public function getSalasana(){
      return $this->salasana;  
  }
  
  public function setSalasana($uusiSalasana){
      $this->salasana = $uusiSalasana;
  }
  
  public function getPorttikielto(){
      return $this->porttikielto;  
  }
  
  public function setPorttikielto($banboolean){
      $this->porttikielto = $banboolean;
  }
  
}