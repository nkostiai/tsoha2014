
<div class="header">
    <ol class="breadcrumb">
        <?php foreach ($data->linkit as $linkkinimi => $linkkiurl): ?>
            <li class="disabled"><a href="<?php echo $linkkiurl; ?>"><?php echo $linkkinimi; ?></a></li>
        <?php endforeach; ?> 
        <?php
        if (isset($_SESSION['kirjautunut'])) {

            $kayttaja = $_SESSION['kirjautunut'];
            ?><li class = "active pull-right"><a href="logout.php"><?php echo "Kirjaudu ulos: " . $kayttaja->getNimi(); ?></a>
            </li> 
            <?php if ($kayttaja->getAdmin() == 1): ?>
                <li class = "active pull-right"><a href="adminpanel.php"><?php echo "Adminpanel "; ?></a></li>   
            <?php endif ?>


        <?php } else {
            ?>
            <li class = "active pull-right"><a href ="signup.php">Rekisteröidy</a></li>
            <li class = "active pull-right"><a href = "kirjautuminen.php">Kirjaudu sisään</a></li>
        <?php }
        ?>

    </ol>
</div>

<?php if (!empty($_SESSION['ilmoitus'])):
    ?>
    <div class="alert alert-success" >
        <?php echo $_SESSION['ilmoitus']; ?>
    </div>
    <?php
    // Samalla kun viesti näytetään, se poistetaan istunnosta,
    // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
    unset($_SESSION['ilmoitus']);
endif;
if (!empty($_SESSION['varoitus'])):
    ?>
    <div class="alert alert-danger" >
        <?php echo $_SESSION['varoitus']; ?>
    </div>
    <?php
    // Samalla kun viesti näytetään, se poistetaan istunnosta,
    // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
    unset($_SESSION['varoitus']);
endif;