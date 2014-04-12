<?php

require_once 'libs/common.php';
require_once 'libs/models/viesti.php';
$kayttajat = Kayttaja::getKayttajaListaus();

$linkit = array("Etusivu" => "index.php");

naytaNakyma('kayttajalistaus.php', array(
  "kayttajat" => $kayttajat,
  "linkit" => $linkit,
));
