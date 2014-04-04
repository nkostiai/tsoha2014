<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<?php if (isset($_SESSION['kirjautunut'])): ?>
<a href="uusiviesti.php?aihe=<?php echo $data->aihe; ?>">
    <button type="button" class="btn btn-default btn-sm">
        Uusi viesti
    </button>
</a> <br><br>
<?php endif ?>
<div class="well">
    <?php foreach ($data->viestit as $viesti): ?>
        <div class = "panel panel-default">
            <div class = "panel-heading">
                <h6 class = "pull-right">
                    <?php
                    echo "Kirjoitettu: ".$viesti->getKirjoitusaika();
                    echo " - Kirjoittaja: ".htmlspecialchars($viesti->getKirjoittaja());
                    if (isset($_SESSION['kirjautunut']) && $_SESSION['kirjautunut']->getNimi() === $viesti->getKirjoittaja()) {
                        ?> - <a href="muokkaaviestia.php?viesti=<?php echo $viesti->getViestiID(); ?>">Muokkaa</a><?php
                    }
                    
                    ?>
                        
                </h6>
                <h3 class = "panel-title"><?php echo htmlspecialchars($viesti->getOtsikko()); ?></h3>
            </div>
            <div class = "panel-body">
                <?php echo htmlspecialchars($viesti->getViestinSisalto()); ?>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php if (isset($_SESSION['kirjautunut'])): ?>
<a href="uusiviesti.php?aihe=<?php echo $data->aihe; ?>">
    <button type="button" class="btn btn-default btn-sm">
        Uusi viesti
    </button>
</a> <br><br>
<?php endif ?>
