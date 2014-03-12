<?php
require 'tietokantayhteys.php';
class Kayttaja {
  
  private $id;
  private $tunnus;
  private $password;
  private $yhteys;
  

  public function __construct($id, $tunnus, $salasana) {
    $this->id = $id;
    $this->tunnus = $tunnus;
    $this->salasana = $salasana;
    $this->yhteys = getTietokantayhteys();
  }

  /* Tähän gettereitä ja settereitä */
  
  
}