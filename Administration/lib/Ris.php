<?php
require_once 'File.php';
require_once File::build_path(array('vendor', 'autoload.php'));
require_once File::build_path(array("model", "Modelris.php"));

use \LibRIS\RISReader;

class Ris {

    //NEED RIS FILE SRC
    public static function getAll($filename) {
        $val = ModelRis::getColumns();
        $upperval = array();
        foreach($val as $low) {
            array_push($upperval, strtoupper($low));
        }
        
    
        $count = 0;
        
        $reader = new RISReader();

        $reader->parseFile('./file.ris');

        $records = $reader->getRecords();

        $array = array();
        for ($i=0; $i<count($records); $i++) {
          $ris = [];
          foreach($records[$i] as $key => $value) {
              if (in_array($key, $upperval)) {
                $ris[$key] = $value[0];
              }
          }
          array_push($array, $ris);
          $count++;
        }
        return $array;
    }
    


}