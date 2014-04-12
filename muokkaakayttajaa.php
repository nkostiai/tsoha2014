<?php

require_once 'libs/models/viesti.php';
require_once 'libs/models/aihe.php';
require_once 'libs/common.php';

if (!isset($_SESSION['kirjautunut']) || $_SESSION['kirjautunut']->getAdmin() === FALSE) {
    header('Location: index.php');
} else {
    $_SESSION['kayttajaform'] = Kayttaja::getKayttajaById($_GET['kayttaja']);
    $linkit = array("Etusivu" => "index.php");
    naytaNakyma('kayttajaform.php', array(
        "linkit" => $linkit,
        "action" => "modify",
        "kayttaja" => $_GET['kayttaja']
    ));
}