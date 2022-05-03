<?php

foreach($tab_gen as $gen) {
    echo '<p>' . htmlspecialchars($gen->get('nom_genre')). " " . /*" " . $st .*/ " " .
/*htmlspecialchars($esp->get('id_statut')) .*/ '</p>';
}