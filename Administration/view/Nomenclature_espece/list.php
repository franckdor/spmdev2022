

<?php

foreach($tab_esp as $esp)
echo '<p>' . htmlspecialchars($esp->get('nom_genre')). " " . htmlspecialchars($esp->get('nom_espece')) . " " . 
/*htmlspecialchars($esp->get('id_statut')) .*/ '</p>';

?>