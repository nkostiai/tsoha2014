<?php

require_once 'libs/common.php';
require_once 'libs/models/viesti.php';

$viestit = Viesti::getViestiListaus();

$linkit = array("Etusivu" => "index.php", "Kategoria" => "kategoria.php", "Aihe" => "aihe.php");

naytaNakyma('viestilistaus.php', array(
  "viestit" => $viestit,
  "linkit" => $linkit,
));
