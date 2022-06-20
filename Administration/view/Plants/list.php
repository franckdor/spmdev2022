<?php
foreach($tab_plante as $plant) {
    echo '<p>' . htmlspecialchars($plant->get('espece')). " " . htmlspecialchars($plant->get('genre')) . /*" " . $st .*/ " ";
}

