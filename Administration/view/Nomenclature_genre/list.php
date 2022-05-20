<?php



foreach($tab_gen as $gen) {
    echo '<p>' . htmlspecialchars($gen->get('genre')). " <a href=?action=read&controller=nomenclature_genre&id=" . rawurlencode($gen->get('code_genre')). ">Details</a> .</p>";
}

