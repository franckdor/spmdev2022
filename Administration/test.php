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

require_once File::build_path(array("model", "Modelris.php"));
require_once File::build_path(array('vendor', 'autoload.php'));


$tab = ModelClassification::selectTribe();

        $tabjson = array();
        foreach($tab as $tribe) {
            array_push($tabjson, $tribe->getIDandName());
        }
        var_dump($tabjson);
/*
foreach($tab as $esp) {
    array_push($tabjson, $esp->getAll());
}

var_dump($tabjson);
*/

