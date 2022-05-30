<?php


require_once 'lib/File.php';
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelPays.php"));
require_once File::build_path(array("model", "ModelZone_biogeographique.php"));
require_once File::build_path(array("model", "ModelPlants.php"));
require_once File::build_path(array("model", "ModelPlante_hote.php"));
require_once File::build_path(array('vendor', 'autoload.php'));
require_once File::build_path(array("model", "Modelris.php"));
use \LibRIS\RISReader;

$reader = new RISReader();

$reader->parseFile('./file.ris');

$records = $reader->getRecords();

$array = array();
for ($i=0; $i<count($records); $i++) {
    $ris = [];
    foreach($records[$i] as $key => $value) {
        $ris[$key] = $value[0];
        }
        array_push($array, $ris);
}
var_dump($array);

adapt('./file.ris');


