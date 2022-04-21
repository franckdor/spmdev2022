<?php
require_once("../lib/File.php");
require_once("../model/ModelNomenclature_espece.php");
    $tab = ModelNomenclature_espece::selectByName($_GET['espece']);
    sleep(1);
    echo json_encode($tab);
    