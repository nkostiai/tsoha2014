<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<form class="form-inline" role="form" action="lahetaviesti.php?aihe=<?php echo $data->aihe; ?>" method="POST">

        <div class="control-group center-block">

            <label class="control-label" for="textarea">Otsikko:</label>
            <div class="controls center-block">                     
                <input type="text" id="email" name="otsikko" class="input-block-level" placeholder="Viestin otsikko">

            </div>
            <label class="control-label" for="textarea">Kirjoita viesti:</label>
            <div class="controls center-block">                     
                <textarea rows="10" cols="80" id="description" name="viesti" class="input-block-level" placeholder="Kirjoita viesti"></textarea>
            </div>

        </div><br>
        <button class="btn btn-primary btn-block btn-sm" type="submit">
            Lähetä viesti
        </button>
    </form>

    <br>
