<?php
#Cette fonction a pour objectif d'avoir un code propre
#Elle permet de créer des chemins absolus
class File {

    public static function build_path($path_array) {
        // $ROOT_FOLDER (sans slash à la fin) vaut
        //  
        $upOne = dirname(__DIR__, 1);
        return $upOne. DIRECTORY_SEPARATOR . join(DIRECTORY_SEPARATOR, $path_array);
    } 
}