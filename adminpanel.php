<?php

require_once 'libs/common.php';
require_once 'libs/models/viesti.php';
if (!isset($_SESSION['kirjautunut']) || $_SESSION['kirjautunut']->getAdmin() === FALSE) {
    header('Location: index.php');
} else {
    $kayttajat = Kayttaja::getKayttajaListaus();

    $linkit = array("Etusivu" => "index.php");

    naytaNakyma('kayttajalistaus.php', array(
        "kayttajat" => $kayttajat,
        "linkit" => $linkit,
    ));
}