<?php

require_once 'libs/common.php';
if (isset($_SESSION['kirjautunut'])) {
    header('Location: index.php');
} else {
    $linkit = array("Etusivu" => "index.php");
    naytaNakyma('kayttajaform.php', array(
        "linkit" => $linkit,
        "action" => "new"
    ));
}