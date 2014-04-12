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

$uusiAihe = new Aihe($kategoria, $aiheotsikko);
if($uusiAihe->onkoValidi()){
    $uusiAihe->lisaaKantaan();
    $aiheid = $uusiAihe->getId();
}
else{
    $_SESSION['varoitus'] = "Aiheen otsikko ei saa olla tyhjä.";
    header('Location: uusiaihe.php?kategoria='.$kategoria);
}


$uusiviesti = new Viesti($aiheid, null, $sisalto, $kayttaja->getkayttajaid(), $otsikko);
if(!$uusiviesti->onkoKelvollinen()){
    $uusiviesti->lisaaKantaan($kayttaja);
    $_SESSION['ilmoitus'] = "Viesti lisätty onnistuneesti.";
    header('Location: index.php');
}
else{
    $_SESSION['varoitus'] = "Otsikko tai viesti eivät saa olla tyhjiä.";
    $_SESSION['viesti'] = $uusiviesti;
    header('Location: uusiaihe.php?kategoria='.$kategoria);
}
