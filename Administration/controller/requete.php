<?php

require_once ("../model/ModelNomenclature_espece");
    $_GET['espece'] = "januae";
    $tab = ModelNomenclature_espece::selectByName($_GET['espece']);
    sleep(1);
    $tab = json_encode($tab);
    echo $tab;