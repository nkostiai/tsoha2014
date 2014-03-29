<?php 
require_once 'libs/models/viesti.php';
require_once 'libs/models/aihe.php';
require_once 'libs/common.php';
$kayttaja = $_SESSION['kirjautunut'];

if (isset($_GET['aihe'])) {
    $aihe = (int) $_GET['aihe'];
}

$sisalto = $_POST['viesti'];
$otsikko = $_POST['otsikko'];
$uusiviesti = new Viesti($aihe, null, $sisalto, $kayttaja->getkayttajaid(), $otsikko);
if($uusiviesti->onkoKelvollinen()){
    $uusiviesti->lisaaKantaan();
    $_SESSION['ilmoitus'] = "Viesti lisätty onnistuneesti.";
    header('Location: index.php');
}
else{
    $_SESSION['ilmoitus'] = "Viestissä oli virheitä.";
    header('Location: index.php');
}