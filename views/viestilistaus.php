<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<a href="uusiviesti.php?aihe=<?php echo $data->aihe; ?>">
    <button type="button" class="btn btn-default btn-sm">
        Uusi viesti
    </button>
</a> <br><br>
<div class="well">
    <?php foreach ($data->viestit as $viesti): ?>
        <div class = "panel panel-default">
            <div class = "panel-heading">
                <h6 class = "pull-right">
                    <?php echo $viesti->getKirjoittaja(); ?>

                </h6>
                <h3 class = "panel-title"><?php echo $viesti->getOtsikko(); ?></h3>
            </div>
            <div class = "panel-body">
                <?php echo $viesti->getViestinSisalto(); ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<a href="uusiviesti.php?aihe=<?php echo $data->aihe; ?>">
    <button type="button" class="btn btn-default btn-sm">
        Uusi viesti
    </button>
</a>
