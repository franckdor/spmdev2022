<?php
$idReplique = htmlspecialchars($esp->get('id_nomenclature_espece'));
$nomReplique = htmlspecialchars($esp->get('nom_espece'));
$nomCategorie = htmlspecialchars($esp->get('nom_genre'));
$rawUrlReplique = rawurlencode($esp->get('id_nomenclature_espece'));
$tab = $esp->getAll();

if(isset($_SESSION['login'])) {
    //echo('<a href="?controller=repliques&action=delete&idReplique=' . $rawUrlReplique . '"     >Supprimer</a>');
    //echo '<br>';
    foreach($tab as $key => $esp) {
        echo $key . " => " . $esp . "<br>";
    }
    echo('<a href="?controller=nomenclature_espece&action=update&idReplique=' . $rawUrlReplique . '"     >Modifier</a>');
    echo '<br>';
}