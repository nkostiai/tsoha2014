<?php

require_once 'libs/kayttaja.php';
$lista = Kayttaja::getKayttajaLista();
echo "ID  TUNNUS   SALASANA<br>";

foreach ($lista as $tulos) {
    echo $tulos->getId();
    echo "  ";
    echo $tulos->getTunnus();
    echo "  ";
    echo $tulos->getSalasana();
    echo "<br>";
}
