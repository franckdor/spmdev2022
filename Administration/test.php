<?php


require_once 'lib/File.php';
require_once File::build_path(array("model", "ModelRepartition.php"));
require_once File::build_path(array("model", "ModelNomenclature_espece.php"));
require_once File::build_path(array("model", "ModelPays.php"));
require_once File::build_path(array("model", "ModelZone_biogeographique.php"));

$tabRepart = ModelRepartition::selectByCodeBiblio(6936);
$i = 0;
$tab = array();
        
        foreach($tabRepart as $repart) {
            $specy = ModelNomenclature_espece::select($repart->get('id_nomenclature_espece'));
            $tab['espece'.$i] = $specy;
            $pays = ModelPays::select($repart->get('id_pays'));
            $tab['pays'.$i] = $pays;
            $i = $i+1;     
        }

        var_dump($tab);

        $tab1 = ModelZone_biogeographique::select(1);
        var_dump($tab1);
?>


