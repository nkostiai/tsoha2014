<?php

require_once 'libs/common.php';
require_once 'libs/models/aihe.php';

$aiheet = Aihe::getAiheListaus();
$linkit = array("Etusivu" => "index.php", "Kategoria" => "kategoria.php");

naytaNakyma('aihelistaus.php', array(
  "aiheet" => $aiheet,
  "linkit" => $linkit,
));
