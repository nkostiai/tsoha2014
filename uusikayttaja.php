<?php

require_once 'libs/models/kayttaja.php';
require_once 'libs/common.php';

$kayttajanimi = $_POST['nimimerkki'];
$salasana = $_POST['salasana'];
$salasana2 = $_POST['salasana2'];
$uusiKayttaja = new Kayttaja($kayttajanimi, $salasana, isset($_POST['admin']));

if (!($salasana == $salasana2)) {
    $_SESSION['varoitus'] = "Salasanasi eivät olleet samoja.";
    $_SESSION['kayttajaform'] = $uusikayttajai;
    header('Location: signup.php');
} elseif ($uusiKayttaja->loytyyKannasta()) {
    $_SESSION['varoitus'] = "Käyttäjänimi on jo viety.";
    $_SESSION['kayttajaform'] = $uusikayttajai;
    header('Location: signup.php');
} elseif (!$uusiKayttaja->onkoKelvollinen()) {
    $uusiKayttaja->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Rekisteröityminen onnistui! Nyt voi kirjautua tunnuksillasi.";
    header('Location: index.php');
} else {
    $_SESSION['varoitus'] = "Mikään kentistä ei saa olla tyhjä. Salasanan maksimipituus on 36 merkkiä ja käyttäjänimen maksimipituus 20 merkkiä.";
    $_SESSION['kayttajaform'] = $uusikayttajai;
    header('Location: signup.php');
}