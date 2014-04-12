<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<form class="form-inline" role="form" 

      <?php if ($data->action === "new"): ?>
          action="uusikayttaja.php" 
      <?php elseif ($data->action === "modify"): ?>
          action="kayttajanmuokkaus.php?kayttaja=<?php echo $data->kayttaja; ?>"
      <?php endif
      ?>
      method="POST">

    <div class="control-group center-block">
        <label class="control-label" for="textarea">Kayttajanimi:</label>
        <div class="controls center-block">                     
            <input type="text" id="nimimerkki" name="nimimerkki" class="input-block-level" placeholder="Käyttäjänimi" <?php if (isset($_SESSION['kayttajaform'])) { ?>
                       value="<?php echo $_SESSION['kayttajaform']->getnimi(); ?>" <?php } ?> >
        </div>
        <label class="control-label" for="textarea">Salasana:</label>
        <div class="controls center-block">                     
            <input type="password" id="salasana" name="salasana" class="input-block-level" placeholder="Salasana"<?php if (isset($_SESSION['kayttajaform'])) { ?>
                       value="<?php echo $_SESSION['kayttajaform']->getsalasana(); ?>" <?php } ?>  >
        </div>
        <label class="control-label" for="textarea">Salasana uudestaan:</label>
        <div class="controls center-block">                     
            <input type="password" id="salasana2" name="salasana2" class="input-block-level" placeholder="Salasana uudestaan"<?php if (isset($_SESSION['kayttajaform'])) { ?>
                       value="<?php echo $_SESSION['kayttajaform']->getsalasana(); ?>" <?php } ?>  >
        </div>
        <label class="control-label" for="textarea">Sähköpostiosoite:</label>
        <div class="controls center-block">                     
            <input type="text" id="sähköposti" name="sahkopostiosoite" class="input-block-level" placeholder="Sähköposti" <?php if (isset($_SESSION['kayttajaform'])) { ?>
                       value="<?php echo $_SESSION['kayttajaform']->getSahkoposti(); ?>" <?php } ?> >
        </div>
        <br>
        <?php if ($data->action === "modify") { ?>
            <?php if (!($_SESSION['kirjautunut']->getkayttajaId() === ($_SESSION['kayttajaform']->getkayttajaid()))) { ?>
                <label class="checkbox">
                    <input id="admin" name="admin" type="checkbox" value="admin" <?php
                    if ($_SESSION['kayttajaform']->getAdmin()) {
                        echo "checked";
                    }
                    ?>> Admin
                </label><br>
            <?php } else { ?>
                <label class="checkbox">
                    <input id="admin" name="admin" type="hidden" value="checked" >
                </label><br>
            <?php } ?>
            <label class="checkbox">
                <input id="ban" name="ban" type="checkbox" value="ban" <?php
                if ($_SESSION['kayttajaform']->getporttikielto()) {
                    echo "checked";
                }
                ?>> Porttikielto
            </label><br><br>
            <?php if (!($_SESSION['kirjautunut']->getkayttajaId() === ($_SESSION['kayttajaform']->getkayttajaid()))) { ?>
                <label class="checkbox">
                    <input id="delete" name="delete" type="checkbox" value="delete"> Poista käyttäjä
                </label><br>
            <?php
            }
        }
        unset($_SESSION['kayttajaform']);
        ?>
        <br>

        <button class="btn btn-primary btn-sm" type="submit">
            Lähetä
        </button>
    </div><br>
</form>

<br>