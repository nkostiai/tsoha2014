<!-- navigaatio -->
<?php require 'breadcrumbs.php'; ?>

<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
    <div class="panel panel-default">
<table class="table table-striped table-bordered">
    <tr><th>Kayttajanumero</th><th>Nimimerkki</th><th>Salasana</th><th>Sähköpostiosoite</th><th>Admin</th><th>Porttikiellossa</th><th>Muokkaa</th></tr>
    
    <!-- Default panel contents -->
        <?php foreach ($data->kayttajat as $kayttaja): 
        echo "<tr><td>".$kayttaja->getkayttajaid()."</td>"
                . "<td>".htmlspecialchars($kayttaja->getNimi())."</td>"
                . "<td>".htmlspecialchars($kayttaja->getSalasana())."</td>"
                . "<td>".htmlspecialchars($kayttaja->getSahkoposti())."</td>"
                . "<td>".$kayttaja->getAdmin()."</td>"
                . "<td>".$kayttaja->getporttikielto()."</td>"
                . "<td><a href=muokkaakayttajaa.php?kayttaja=".$kayttaja->getkayttajaid().">Muokkaa</a></td></tr>";
         endforeach; ?>
</table>
    </div>






