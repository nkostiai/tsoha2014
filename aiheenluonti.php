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
$uusiAihe->lisaaKantaan();
$aiheid = $uusiAihe->getId();

$uusiviesti = new Viesti($aiheid, null, $sisalto, $kayttaja->getkayttajaid(), $otsikko);
if(!$uusiviesti->onkoKelvollinen()){
    $uusiviesti->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Viesti lisätty onnistuneesti.";
    header('Location: index.php');
}
else{
    $_SESSION['ilmoitus'] = "Viestissä oli virheitä.";
    header('Location: index.php');
}
