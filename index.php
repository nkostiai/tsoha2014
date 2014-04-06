<?php

require_once 'libs/common.php';
require_once 'libs/models/kategoria.php';

$kategoriat = Kategoria::getKategoriaListaus();
$linkit = array("Etusivu" => "index.php");
$uudetViestit = array();

if (isset($_SESSION['kirjautunut'])) {
    $kayttaja = $_SESSION['kirjautunut'];
    foreach ($kategoriat as $kategoria) {
        if ($kategoria->onkoUusiaViesteja($kayttaja)) {
            $uudetViestit[] = 1;
        } else {
            $uudetViestit[] = 0;
        }
    }
}

naytaNakyma('etusivu.php', array(
    "kategoriat" => $kategoriat,
    "linkit" => $linkit,
    "uudetviestit" => $uudetViestit,
));

