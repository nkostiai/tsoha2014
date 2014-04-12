<?php 
require_once 'libs/models/viesti.php';
require_once 'libs/common.php';
$kayttaja = $_SESSION['kirjautunut'];
$muokattava = $_SESSION['muokattava'];

$sisalto = $_POST['viesti'];
$otsikko = $_POST['otsikko'];
$uusiviesti = $_SESSION['muokattava'];
unset($_SESSION['muokattava']);

if (isset($_POST['delete'])){
    //poistetaan viesti.
    $uusiviesti->poistaKannasta();
    $_SESSION['ilmoitus'] = "Viesti poistettu onnistuneesti. ";
    header('Location: index.php');
}

else{
    //muokataan viesti
$uusiviesti->setOtsikko($otsikko);
$uusiviesti->setviestinsisalto($sisalto);
if(!$uusiviesti->onkoKelvollinen()){
    $uusiviesti->muokkaaKantaan();
    $_SESSION['ilmoitus'] = "Viesti muokattu onnistuneesti. ";
    header('Location: index.php');
}
else{
    $_SESSION['varoitus'] = "Viestissä oli virheitä.";
    header('Location: index.php');
}
}