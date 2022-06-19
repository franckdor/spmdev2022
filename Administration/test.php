
<script type="text/javascript" src="controller/NomenclatureJS/scriptRecherche.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<?php


require_once 'lib/File.php';
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelNomenclature_genre.php"));
require_once File::build_path(array("model", "ModelPays.php"));
require_once File::build_path(array("model", "ModelZone_biogeographique.php"));
require_once File::build_path(array("model", "ModelPlants.php"));
require_once File::build_path(array("model", "ModelPlante_hote.php"));
require_once File::build_path(array("model", "ModelClassification.php"));
require_once File::build_path(array("model", "ModelStatut_espece.php"));
require_once File::build_path(array("model", "ModelBibliographie.php"));
require_once File::build_path(array("model", "ModelPays.php"));

require_once File::build_path(array("model", "Modelris.php"));
require_once File::build_path(array('vendor', 'autoload.php'));



function autocomplete() {

    $tab_gen = ModelNomenclature_genre::selectALL();


    $tabjson = array();
    foreach($tab_gen as $gen) {
        $biblio = ModelBibliographie::select($gen->get('code_reference'));
        if ($biblio !== false) {
            $array = array(
                'gen' => $gen->getAll(),
            );
        } else {
            $array = array(
                'gen' => $gen->getAll(),
                'biblio' => $biblio->getAll(),
            );
        }
        array_push($tabjson, $array);
    }
    echo json_encode($tabjson);
    
}

autocomplete();
?>

<select id="bibliographie"></select>