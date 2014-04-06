
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
            <?php if($kayttaja->getAdmin()==1): ?>
              <li class = "active pull-right"><a href="admin.php"><?php echo "Adminpanel "; ?></a></li>   
            <?php endif ?>


        <?php } else {
            ?>
            <li class = "active pull-right"><a href = "kirjautuminen.php">Kirjaudu sisään</a></li> <?php }
        ?>

    </ol>
</div>