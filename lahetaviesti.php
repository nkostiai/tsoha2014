<?php

require_once 'libs/models/viesti.php';
require_once 'libs/models/aihe.php';
require_once 'libs/common.php';
$kayttaja = $_SESSION['kirjautunut'];

if (isset($_GET['aihe'])) {
    $aihe = (int) $_GET['aihe'];
}

$sisalto = str_replace(array("\n", "\r", "\r\n"), "", $_POST['viesti']);
$otsikko = str_replace(array("\n", "\r", "\r\n"), "", $_POST['otsikko']);
$uusiviesti = new Viesti($aihe, null, $sisalto, $kayttaja->getkayttajaid(), $otsikko);
if (!$uusiviesti->onkoKelvollinen()) {
    $uusiviesti->lisaaKantaan($kayttaja);
    $_SESSION['ilmoitus'] = "Viesti lisätty onnistuneesti.";
    header('Location: aihe.php?aihe=' . $aihe);
} else {
    $_SESSION['varoitus'] = "Viestin otsikko tai sisältö eivät saa olla tyhjiä. Viesti saa olla enintään 4000 merkkiä pitkä ja otsikko saa olla enintään 300 merkkiä pitkä.";
    $_SESSION['viesti'] = $uusiviesti;
    header('Location: uusiviesti.php?aihe=' . $aihe);
}