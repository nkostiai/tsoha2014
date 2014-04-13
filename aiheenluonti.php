<?php 
require_once 'libs/models/viesti.php';
require_once 'libs/models/aihe.php';
require_once 'libs/common.php';
$kayttaja = $_SESSION['kirjautunut'];

if (isset($_GET['kategoria'])) {
    $kategoria = (int) $_GET['kategoria'];
}

$aiheotsikko = $_POST['aiheenotsikko'];
$sisalto = $_POST['viesti'];
$otsikko = $_POST['otsikko'];
$aiheid = 0;
$uusiAihe = new Aihe($kategoria, $aiheotsikko);
$uusiviesti = new Viesti($aiheid, null, $sisalto, $kayttaja->getkayttajaid(), $otsikko);

if(!($uusiAihe->onkoValidi())){
    $_SESSION['aihe'] = $uusiAihe;
    $_SESSION['viesti'] = $uusiviesti;
    $_SESSION['varoitus'] = "Aiheen otsikko ei saa olla tyhjä, eikä se saa ylittää 300 merkkiä.";
    header('Location: uusiaihe.php?kategoria='.$kategoria);
}
else if(!$uusiviesti->onkoKelvollinen()){
    $uusiAihe->lisaaKantaan();
    $uusiviesti->setAiheID($uusiAihe->getId());
    echo $uusiAihe->getId();
    $uusiviesti->lisaaKantaan($kayttaja);
    $_SESSION['ilmoitus'] = "Viesti lisätty onnistuneesti.";
    header('Location: index.php');
}
else{
    $_SESSION['varoitus'] = "Otsikko tai viesti eivät saa olla tyhjiä. Viesti ei saa ylittää 4000 merkkiä ja otsikko ei saa ylittää 300 merkkiä.";
    $_SESSION['aihe'] = $uusiAihe;
    $_SESSION['viesti'] = $uusiviesti;
    header('Location: uusiaihe.php?kategoria='.$kategoria);
}
