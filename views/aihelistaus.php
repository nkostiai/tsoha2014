<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<?php if (isset($_SESSION['kirjautunut'])): ?>
<a href="uusiaihe.php?kategoria=<?php echo $data->kategoria; ?>">
    <button type="button" class="btn btn-default btn-sm">
        Uusi aihe
    </button>
</a><br><br>
<?php endif ?>
<ul class="list-group">
    <?php foreach ($data->aiheet as $aihe): ?>
    <li class="list-group-item"><a href="aihe.php?aihe=<?php echo $aihe->getid(); ?>"><?php echo $aihe->getNimi(); ?></a><span class="badge">Uusia viestejä</span></li>
    
        <?php endforeach ?>
</ul>
<?php if (isset($_SESSION['kirjautunut'])): ?>
<a href="uusiaihe.php?kategoria=<?php echo $data->kategoria; ?>">
    <button type="button" class="btn btn-default btn-sm">
        Uusi aihe
    </button>
</a><br><br>
<?php endif ?>