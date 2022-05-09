<script type="text/javascript" src="javascript.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">



<?php
require_once "lib/File.php";
require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelStatut_genre.php"));

$tab = ModelNomenclature_espece::SelectSpeciesAndNameWhere("januae", "Afronobia");

var_dump($tab);



foreach($tab as $esp) {
    var_dump($esp->get('nom_genre'));
    var_dump($esp->get('nom_espece'));
    var_dump($esp->getStatusName());
    var_dump($esp->get('auteur_date'));
    var_dump($esp->get(('reference_page')));
}