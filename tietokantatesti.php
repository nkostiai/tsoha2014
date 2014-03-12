<?php

$yhteys = new PDO("pgsql:");
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "select * from kayttaja";
$kysely = $yhteys->prepare($sql);
$kysely->execute();

$assosiaatiotaulu = $kysely->fetchAll();
echo $assosiaatiotaulu[0]['nimi'];
