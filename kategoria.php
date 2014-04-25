<?php

$kategoria = 1;
if (isset($_GET['kategoria'])) {
    $kategoria = (int) $_GET['kategoria'];

    //Sivunumero ei saa olla pienempi kuin yksi
    if ($kategoria < 1)
        $kategoria = 1;
}

require_once 'libs/common.php';
require_once 'libs/models/aihe.php';
require_once 'libs/models/kategoria.php';

$aiheet = Aihe::getAiheListaus($kategoria);
$kategoriannimi = Kategoria::getKategorianNimi($kategoria);

$uudetViestit = array();
if (isset($_SESSION['kirjautunut'])) {
    $kayttaja = $_SESSION['kirjautunut'];
    foreach ($aiheet as $aihe) {
        if ($aihe->onkoUusiaViesteja($kayttaja)) {
            $uudetViestit[$aihe->getId()] = 1;
        } else {
            $uudetViestit[$aihe->getId()] = 0;
        }
    }
}

$linkit = array("Etusivu" => "index.php", "$kategoriannimi[0]" => "kategoria.php?kategoria=$kategoria");

naytaNakyma('aihelistaus.php', array(
    "aiheet" => $aiheet,
    "linkit" => $linkit,
    "kategoria" => $kategoria,
    "uudetviestit" => $uudetViestit,
));
