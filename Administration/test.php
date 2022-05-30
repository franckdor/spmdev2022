<?php


require_once 'lib/File.php';
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelPays.php"));
require_once File::build_path(array("model", "ModelZone_biogeographique.php"));
require_once File::build_path(array("model", "ModelPlants.php"));
require_once File::build_path(array("model", "ModelPlante_hote.php"));

$tabHost = ModelPlante_hote::selectByCodeBiblio(7);
        $i = 0;
        $tab = array();
        
        foreach($tabHost as $plant) {
            $id = $plant->get('id_plante');
            var_dump($id);
            $hplant = ModelPlants::select($id);
            if (count($hplant) == 0) {
                break;
            } else {
                $specy = ModelNomenclature_espece::select($plant->get('id_nomenclature_espece'));
                $tab[$i] = ['espece' => $specy->get('nom_espece'), 
                'genre' => $specy->get('nom_genre') , 
                'specy_plant' => $hplant->get('species'), 
                'genus_plant' => $hplant->get('genus')];
                $i = $i+1;     
            }
        }
?>


