<?php 

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelPlante_hote extends Model {
    private $id_plante_hote;
    private $id_plante;
    private $id_nomenclature_espece;
    private $code_bibliographie;
    private $utilisateur;
    private $date_add;

    protected static $object = "plante_hote";
    protected static $primary='id_plante_hote';

    public function __construct($id_plante_hote=NULL, $id_plante=NULL, $id_nomenclature_espece=NULL, $code_bibliographie=NULL,
    $utilisateur=NULL, $date_add=NULL) {
        if(!is_null($id_plante_hote) && !is_null($id_plante) && !is_null($id_nomenclature_espece) && !is_null($code_bibliographie)
        && !is_null($utilisateur) && !is_null($date_add)) {
            $this->id_plante_hote = $id_plante_hote;
            $this->id_plante = $id_plante;
            $this->id_nomenclature_espece = $id_nomenclature_espece;
            $this->code_bibliographie = $code_bibliographie;
            $this->utilisateur = $utilisateur;
            $this->date_add = $date_add;
        }
    }

    public function get($attribute) {
        return $this->$attribute;
    }

    public function set($attribute) {
        $this->$attribute = $attribute;
    }

}