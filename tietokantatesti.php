<?php

$yhteys = new PDO("pgsql:");
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "select * from kayttaja";
$kysely = $yhteys->prepare($sql);
$kysely->execute();

$tulokset = array();
foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos){
    
    $final = $tulos->nimi.=" ";
    $final = $final.=$tulos->kayttajaid.=" ";
    $final = $final.=$tulos->sahkoposti;
    echo $final;
    
    echo "<br>";
//    $kayttaja = new Kayttaja();
//    $kayttaja->setId($tulos->id);
//    $kayttaja->setTunnus($tulos->tunnus);
}