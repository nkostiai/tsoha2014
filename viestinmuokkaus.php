<?php 
require_once 'libs/models/viesti.php';
require_once 'libs/common.php';
$kayttaja = $_SESSION['kirjautunut'];
$muokattava = $_SESSION['muokattava'];

if (isset($_GET['aihe'])) {
    $aihe = (int) $_GET['aihe'];
}

$sisalto = $_POST['viesti'];
$otsikko = $_POST['otsikko'];
$uusiviesti = $_SESSION['muokattava'];
unset($_SESSION['muokattava']);
$uusiviesti->setOtsikko($otsikko);
$uusiviesti->setviestinsisalto($sisalto);
if(!$uusiviesti->onkoKelvollinen()){
    $uusiviesti->muokkaaKantaan();
    $_SESSION['ilmoitus'] = "Viesti muokattu onnistuneesti. ";
    header('Location: index.php');
}
else{
    $_SESSION['ilmoitus'] = "Viestissä oli virheitä.";
    header('Location: index.php');
}