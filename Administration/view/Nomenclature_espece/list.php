<?php
var_dump($tab);
foreach($tab_esp as $esp) {
echo '<p>' . htmlspecialchars($esp->get('nom_genre')). " " . htmlspecialchars($esp->get('nom_espece')) . /*" " . $st .*/ " " .
/*htmlspecialchars($esp->get('id_statut')) .*/ '</p>';
}
/*
foreach($tab as $value) {
    foreach($value as $id) {
        echo $id->get('nom_statut_genre');
        echo $id->get('id_statut_genre');
        echo "<br>";
    }
}
*/
?>