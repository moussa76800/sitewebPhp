<?php

require_once "Livre.class.php";
$livre1= new Livre(1,"Algorithmes selon H2PROG","H2PROG",300,48,"algo.png");
$livre2= new Livre(2,"La France d'avant","Robert Paul",300,30,"france.png");
$livre3= new Livre(3,"Je progresse en informatique",158,60,"jeprogresseeninformatique.png");
$livre4= new Livre(4,"JS Client VS JS Serveur",249,56,"JS.png");
$livre5= new Livre(5,"Le virus informatique d'Asie",300,35,"virus.png");

$livres= [$livre1,$livre2,$livre3,$livre4,$livre5];


ob_start(); 
?>

<table class="table text-center">
    <tr class="table-dark">
        <th>Image</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Nombre de pages</th>
        <th>Prix</th>
        <th colspan="2">Actions</th>
    </tr>

    <?php for ($i=0; $i< count($livres); $i++) : ?>
    <tr>
        <td class="align-middle"><img src="public/images/livres/<?=$livres[$i]->getImage();?>" width="60px;"></td>
        <td class="align-middle"><?=$livres[$i]->getTitle();?></td>
        <td class="align-middle"><?=$livres[$i]->getAuthors();?></td>
        <td class="align-middle"><?=$livres[$i]->getNumbersOfPages();?></td>
        <td class="align-middle"><?=$livres[$i]->getPrice();?> Euros</td>
        <td class="align-middle"><a href="" class="btn btn-warning">Modifier</a></td>
        <td class="align-middle"><a href="" class="btn btn-danger">Modifier</a></td>
    </tr>
    <?php endfor; ?>
</table>

<a href=""class="btn btn-success d-block">Ajouter</a>


<?php
$content = ob_get_clean();
$titre = "Liste des livres";
require "template.php";
?>