<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<form class="form-inline" role="form" 
      <?php if($data->action === "new"){ ?>
      
      action="lahetaviesti.php?aihe=<?php echo $data->aihe; ?>" <?php }
      else{ ?>
      action="viestinmuokkaus.php"<?php } ?>
      method="POST">

    <div class="control-group center-block">

        <label class="control-label" for="textarea">Otsikko:</label>
        <div class="controls center-block">                     
            <input type="text" id="otsikko" name="otsikko" class="input-block-level" placeholder="Viestin otsikko" <?php if (isset($data->viesti)) { ?>
                       value="<?php echo $data->viesti->getOtsikko(); ?>" <?php }?> >
        </div>
        <label class="control-label" for="textarea">Kirjoita viesti:</label>
        <div class="controls center-block">                     
            <textarea rows="10" cols="80" id="viesti" name="viesti" class="input-block-level" placeholder="Kirjoita viesti"><?php if(isset($data->viesti)){ echo $data->viesti->getviestinsisalto(); } ?></textarea>
        </div>

    </div><br>
    <button class="btn btn-primary btn-block btn-sm" type="submit">
        Lähetä viesti
    </button>
</form>

<br>
