<div class="header">
    <ol class="breadcrumb">
        <?php foreach ($data->linkit as $linkkinimi => $linkkiurl): ?>
            <li class="disabled"><a href="<?php echo $linkkiurl; ?>"><?php echo $linkkinimi; ?></a></li>
        <?php endforeach; ?> 
            <li class="active pull-right"><a href ="kirjautuminen.php">Log In</a></li>
    </ol>
</div>