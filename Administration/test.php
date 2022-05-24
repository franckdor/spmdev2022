<?php
require_once 'vendor/autoload.php';

use \LibRIS\RISReader;

$reader = new RISReader();

$reader->parseFile('./file.ris');

$reader->printRecords();

//var_dump($reader);




$records = $reader->getRecords();

var_dump($records);


var_dump(affficheAll($records));

function affficheAll($records) {
  
  $array = array();
  for ($i=0; $i<count($records); $i++) {
    $ris = [];
    foreach($records[$i] as $key => $value) {
      $ris[$key] = $value[0];
    }
    array_push($array, $ris);
  }
  return $array;
}


?>
