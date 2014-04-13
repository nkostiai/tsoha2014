<?php

require_once 'libs/models/kayttaja.php';
require_once 'libs/models/viesti.php';
require_once 'libs/common.php';

$kayttajanimi = $_POST['nimimerkki'];
$salasana = $_POST['salasana'];
$salasana2 = $_POST['salasana2'];
$email = $_POST['sahkopostiosoite'];
$uusiKayttaja = new Kayttaja($kayttajanimi, $salasana, $email, isset($_POST['admin']), isset($_POST['ban']));
$kayttajanumero = $_GET['kayttaja'];
if (isset($_POST['delete'])) {
    if (!($_SESSION['kirjautunut']->getKayttajaID() === $kayttajanumero)) {

        Viesti::poistaKayttajanViestit($kayttajanumero);
        Kayttaja::poistaKayttajaByID($kayttajanumero);
        $_SESSION['ilmoitus'] = "Kayttaja poistettiin onnistuneesti.";
        header('Location: adminpanel.php');
    }
}
if (!($salasana == $salasana2)) {
    $_SESSION['varoitus'] = "Salasanasi eivät olleet samoja.";
    $_SESSION['kayttajaform'] = $uusiKayttaja;
    header('Location: muokkaakayttajaa.php?kayttaja=' . $kayttajanumero);
} elseif (!$uusiKayttaja->onkoKelvollinen()) {
    $uusiKayttaja->muokkaaKantaan($kayttajanumero);
    $_SESSION['ilmoitus'] = "Muutokset onnistuivat.";
    header('Location: adminpanel.php');
} else {
    $_SESSION['varoitus'] = "Mikään kentistä ei saa olla tyhjä.";
    $_SESSION['kayttajaform'] = $uusiKayttaja;
    header('Location: muokkaakayttajaa.php?kayttaja=' . $kayttajanumero);
}