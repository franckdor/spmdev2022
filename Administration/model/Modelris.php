<?php 

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelRis extends Model {


    private $id_ris;
    private $TY;
    private $A1;
    private $AB;
    private $DA;
    private $DB;
    private $ED;
    private $EP;
    private $ID;
    private $LA;
    private $LK;
    private $N1;
    private $N2;
    private $OP;
    private $RN;
    private $UR;

    protected static $object = "ris";
    protected static $primary='id_ris';


    public function __construct($id_ris=NULL, $TY=NULL, $A1=NULL, $AB=NULL, $DA=NULL, $DB=NULL, $ED=NULL, $EP=NULL,
    $ID=NULL, $LA=NULL, $LK=NULL, $N1=NULL, $N2=NULL, $OP=NULL, $RN=NULL, $UR=NULL) {
        if (!is_null($id_ris) && !is_null($TY) && !is_null($A1) && !is_null($AB) && !is_null($DA) && !is_null($DB) &&
        !is_null($ED) && !is_null($EP) && !is_null($ID) && !is_null($LA) && !is_null($LK) && !is_null($N1) && !is_null($N2)
        && !is_null($OP) && !is_null($RN) && !is_null($UR)) {
            $this->$id_ris = $id_ris;
            $this->$TY = $TY;
            $this->$A1 = $A1;
            $this->$AB = $AB;
            $this->$DA = $DA;
            $this->$DB = $DB;
            $this->$ED = $ED;
            $this->$EP = $EP;
            $this->$ID = $ID;
            $this->$LA = $LA;
            $this->$LK = $LK;
            $this->$N1 = $N1;
            $this->$N2 = $N2;
            $this->$OP = $OP;
            $this->$RN = $RN;
            $this->$UR = $UR;
        }
    }

}