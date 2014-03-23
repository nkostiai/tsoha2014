<?php

require_once 'libs/common.php';
require_once 'libs/models/kayttaja.php';


if (empty($_POST["username"]) || empty($_POST["password"])) {
    /* Käytetään omassa kirjastotiedostossa määriteltyä näkymännäyttöfunktioita */
    $linkit = array("Etusivu" => "index.php");
    naytaNakyma('login.php', array(
        "linkit" => $linkit,
    ));
    exit(); // Lopetetaan suoritus tähän. Kutsun voi sijoittaa myös naytaNakyma-funktioon, niin sitä ei tarvitse toistaa joka paikassa
}

$kayttaja = $_POST["username"];
$salasana = $_POST["password"];

/* Tarkistetaan onko parametrina saatu oikeat tunnukset */
echo $kayttaja;
echo $salasana;
$kirjautuja = Kayttaja::etsiKayttajaTunnuksilla($kayttaja, $salasana);
if ($kirjautuja->getNimi() === $kayttaja && $kirjautuja->getSalasana() === $salasana) {
    $_SESSION['kirjautunut'] = $kirjautuja;
    /* Jos tunnus on oikea, ohjataan käyttäjä sopivalla HTTP-otsakkeella kissalistaan. */
    header('Location: index.php');
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen. */
    naytaNakyma('login.php', array('kayttaja' => $kayttaja, 'virhe' => "Antamasi tunnus tai salasana on väärä"));
}