<?php

require_once 'libs/models/kayttaja.php';
$lista = Kayttaja::getKayttajaListaus();
echo "ID  TUNNUS   SALASANA<br>";

foreach ($lista as $tulos) {
    echo $tulos->getNimi();
    echo "  ";
    echo $tulos->getKayttajaID();
    echo "  ";
    echo $tulos->getSalasana();
    echo "<br>";
}
