<?php 
ob_start(); 
?>

<div class="row">
    <div class="col-6">
        <img src="<?= URL ?>public/images/livres/<?= $livre->getImage(); ?>">
    </div>
    <div class="col-6">
        <p>Titre : <?= $livre->getTitle(); ?></p>
        <p>Nombre de pages : <?= $livre->getNumbersOfPages(); ?></p>
    </div>
</div>

<?php
$content = ob_get_clean();
$titre = $livre->getTitle();
require "template.php";
?>