<?php
foreach($tab_plante as $plant) {
    echo '<p>' . htmlspecialchars($plant->get('species')). " " . htmlspecialchars($plant->get('genus')) . /*" " . $st .*/ " ";
}
