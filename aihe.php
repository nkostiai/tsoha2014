<?php

$aihe = 1;
if(isset($_GET['aihe'])){
    $aihe = (int)$_GET['aihe'];
    
    if($aihe < 1) $aihe = 1;
}

$montakoviestiasivulla = 10;
require_once 'libs/common.php';
require_once 'libs/models/viesti.php';


$viestit = Viesti::getViestiListaus($aihe);


$linkit = array("Etusivu" => "index.php", "Kategoria" => "kategoria.php", "Aihe" => "aihe.php");

naytaNakyma('viestilistaus.php', array(
  "viestit" => $viestit,
  "linkit" => $linkit,
  "aihe" => $aihe,
));
