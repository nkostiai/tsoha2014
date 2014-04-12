<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<form class="form-group" role="form" 

      <?php if ($data->action === "new"): ?>
          action="lahetaviesti.php?aihe=<?php echo $data->aihe; ?>" 
      <?php elseif ($data->action === "modify"): ?>
          action="viestinmuokkaus.php"
      <?php elseif ($data->action === "newthread"): ?>
          action="aiheenluonti.php?kategoria=<?php echo $data->kategoriaid?>";
  <?php endif
      ?>
      method="POST">

      <div class="control-group center-block">
<?php if ($data->action === "newthread") { ?>
            <label class="control-label" for="textarea">Aiheen otsikko:</label>
            <div class="controls center-block">                     
                <input type="text" id="aiheenotsikko" name="aiheenotsikko" class="input-block-level" placeholder="Viestin otsikko">
            </div>
<?php } ?>
        <label class="control-label" for="textarea">Viestin otsikko:</label>
        <div class="controls center-block">                     
            <input type="text" id="otsikko" name="otsikko" class="input-block-level" placeholder="Viestin otsikko" <?php if (isset($_SESSION['viesti'])) { ?>
                       value="<?php echo $_SESSION['viesti']->getOtsikko(); ?>" <?php } ?> >
        </div>
        <label class="control-label" for="textarea">Kirjoita viesti:</label>
        <div class="controls center-block">                     
            <textarea rows="10" cols="80" id="viesti" name="viesti" class="input-block-level" placeholder="Kirjoita viesti"><?php
                if (isset($_SESSION['viesti'])) {
                    echo $_SESSION['viesti']->getViestinSisalto();
                }
                ?></textarea>
        </div>
        <?php
        unset($_SESSION['viesti']);
        if ($data->action === "modify") {
            echo "<label class=\"checkbox\">
                     <input id=\"delete\" name=\"delete\" type=\"checkbox\" value=\"delete\"> Poista viesti
                  </label>";
        }
        ?>
    </div><br>
    <button class="btn btn-primary btn-sm" type="submit">
        Lähetä viesti
    </button>
</form>

<br>
