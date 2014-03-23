<?php

require_once 'libs/common.php';
require_once 'libs/models/kategoria.php';

$kategoriat = Kategoria::getKategoriaListaus();
$linkit = array("Etusivu" => "index.php");

naytaNakyma('etusivu.php', array(
  "kategoriat" => $kategoriat,
  "linkit" => $linkit,
));

