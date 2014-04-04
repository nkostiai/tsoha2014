<?php
require_once 'models/kayttaja.php';
session_start();
if (!empty($_SESSION['ilmoitus'])):
    ?>
    <div class="alert alert-danger" >
    <?php echo $_SESSION['ilmoitus']; ?>
    </div>
    <?php
    // Samalla kun viesti näytetään, se poistetaan istunnosta,
    // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
    unset($_SESSION['ilmoitus']);
endif;

function naytaNakyma($sivu, $data = array()) {
$data = (object)$data;
require 'views/pohja.php';
exit();
}

function onKirjautunut(){
if(isset($_SESSION['kirjautunut'])){
return true;
}
}