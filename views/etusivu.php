<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<div class="list-group">

    <?php foreach ($data->kategoriat as $kategorioita): ?>
        <a href="kategoria.php?kategoria=<?php echo $kategorioita->getId(); ?>" class="list-group-item">
            <?php if ($data->uudetviestit[$kategorioita->getId() - 1] > 0) { ?><span class="badge">Uusia viestejä</span><?php } ?>
            <h4 class="list-group-item-heading"><?php echo $kategorioita->getNimi(); ?></h4> 
            <p class="list-group-item-text"><?php echo $kategorioita->getKuvaus(); ?></p>
        </a>
    <?php endforeach; ?>
</div>