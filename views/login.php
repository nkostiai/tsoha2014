<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<!-- sisalto -->
<form class="form-signin" role="form" action="kirjautuminen.php" method="POST">
    <h2 class="form-signin-heading">Kirjaudu sisään</h2>
    <input type="text" name="username" class="form-control" value="<?php echo $data->kayttaja; ?>" placeholder="Tunnus" required autofocus>
    <input type="password" name="password" class="form-control" placeholder="Salasana" required>
    <label class="checkbox">
        <input type="checkbox" value="remember-me"> Muista minut
    </label>
    <button class="btn btn-primary btn-block btn-sm" type="submit">Kirjaudu sisään</button>
</form>

