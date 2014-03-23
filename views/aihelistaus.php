<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<ul class="list-group">
    <?php foreach ($data->aiheet as $aihe): ?>
        <li class="list-group-item"><a href="aihe.php"><?php echo $aihe->getNimi(); ?></a></li>
        <?php endforeach ?>
</ul>