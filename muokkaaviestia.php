<?php
require_once 'libs/models/viesti.php';
require_once 'libs/models/aihe.php';
require_once 'libs/common.php';

if (!isset($_SESSION['kirjautunut'])) {
    header('Location: index.php');
}
else{
if (isset($_GET['viesti'])) {
    $viestinumero = (int) $_GET['viesti'];
}

$muokattavaviesti = Viesti::haeViestiIDlla($viestinumero);
$_SESSION['muokattava'] = $muokattavaviesti[0];
$_SESSION['viesti'] = $_SESSION['muokattava'];
$linkit = array("Etusivu" => "index.php", "Kategoria" => "kategoria.php", "Aihe" => "aihe.php");
naytaNakyma('viestiform.php', array(
    "linkit" => $linkit,
    "action" => "modify"
));



}