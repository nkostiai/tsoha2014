<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->

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