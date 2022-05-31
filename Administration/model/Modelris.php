<?php 

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));
require_once File::build_path(array('vendor', 'autoload.php'));
use \LibRIS\RISReader;

class ModelRis extends Model {


    private $id_ris;
    private $tag;
    private $value;

    protected static $object = "ris";
    protected static $primary='id_ris';


    public function __construct($id_ris=NULL, $tag=NULL, $value=NULL) {
        if (!is_null($id_ris) && !is_null($tag) && !is_null($value)) {
            $this->$id_ris = $id_ris;
            $this->$tag = $tag;
            $this->$value = $value;
        }
    }

    public static function saveRis($filename) {
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
                //ModelRis::save($data);
                ModelRis::save($data);
            }
            $id++;
        }
    }

}