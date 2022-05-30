<?php
require_once 'File.php';
require_once File::build_path(array('vendor', 'autoload.php'));
require_once File::build_path(array("model", "Modelris.php"));

use \LibRIS\RISReader;

class Ris {

    //NEED RIS FILE SRC
    public static function getAll($filename) {   
        $count = 0;
        
        $reader = new RISReader();

        $reader->parseFile($filename);

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
    
    function saveRis($filename) {
      $reader = new RISReader();
  
      $reader->parseFile($filename);
  
      $records = $reader->getRecords();
  
      $array = array();
      for ($i=0; $i<count($records); $i++) {
          $ris = [];
          foreach($records[$i] as $key => $value) {
              $ris[$key] = $value[0];
              }
              array_push($array, $ris);
      }
      $id = ModelRis::selectMaxId()+1;
      for($i=0; $i<count($array); $i++) {
          foreach($array[$i] as $key => $value) {
              
              $data = array(
                  'id_ris' => $id,
                  'tag' => $key,
                  'value' => $value
              );
              echo $id;
              //ModelRis::save($data);
              ModelRis::save($data);
          }
          $id++;
      }
  }

}