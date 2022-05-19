<?php
$idGen = htmlspecialchars($genus->get('code_genre'));
$nameGen = htmlspecialchars($genus->get('genre'));
$tribe = htmlspecialchars($genus->get('tribu'));
$subfamily = htmlspecialchars($genus->get('sous_famille'));
$rawUrlIdGen = rawurlencode($genus->get('code_genre'));
$tab = $genus->getAll();

if(isset($_SESSION['login'])) {
    //echo('<a href="?controller=repliques&action=delete&idReplique=' . $rawUrlReplique . '"     >Supprimer</a>');
    //echo '<br>';
    foreach($tab as $key => $gen) {
        echo $key . " => " . $gen . "<br>";
    }
    echo('<a href="?controller=nomenclature_genre&action=update&id=' . $rawUrlIdGen . '"     >Update</a>');
    echo '<br>';
}