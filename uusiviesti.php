<?php
require_once 'libs/models/viesti.php';
require_once 'libs/models/aihe.php';
require_once 'libs/common.php';
if (!isset($_SESSION['kirjautunut'])) {
    header('Location: index.php');
}
else{
if (isset($_GET['aihe'])) {
    $aihe = (int) $_GET['aihe'];
}
$linkit = array("Etusivu" => "index.php", "Kategoria" => "kategoria.php", "Aihe" => "aihe.php");
naytaNakyma('viestiform.php', array(
    "linkit" => $linkit,
    "aihe" => $aihe   
));



}