<?php

require_once File::build_path(array("config", "Conf.php"));
require_once File::build_path(array("model" ,"Model.php"));

class ModelPlants extends Model {

    private $plant_ID;

    private $phylum;

    private $class;

    private $order;

    private $family;

    private $genus;

    private $species;

    private $scientific_name;

    private $scientific_name_authorship;

    private $taxonomic_status;

    private $taxon_rank;

    private $parent_name_usage_ID;

    private $accepted_name_usage_ID;

    private $original_name_usage_ID;

    private $tplid;

    private $synonym;


    protected static $object = "plants";
    protected static $primary='plant_ID';

    public function __construct($plant_ID=NULL, $phylum=NULL, $class=NULL, $order=NULL, $family=NULL, $genus=NULL,
    $species=NULL, $scientific_name_authorship=NULL, $scientific_name=NULL, $taxonomic_status=NULL, $taxon_rank=NULL,
    $parent_name_usage_ID=NULL, $accepted_name_usage_ID=NULL, $original_name_usage_ID=NULL,
    $tplid=NULL, $synonym=NULL) {
        if (!is_null($plant_ID) && !is_null($phylum) && !is_null($class) && !is_null($order) && !is_null($family) 
        && !is_null($genus) && !is_null($species) && !is_null($scientific_name_authorship) && !is_null($scientific_name) && !is_null($taxonomic_status)
        && !is_null($taxon_rank) && !is_null($parent_name_usage_ID) && !is_null($accepted_name_usage_ID)
        && !is_null($original_name_usage_ID) && !is_null($tplid) && !is_null($synonym)) {
            $this->plant_ID = $plant_ID;
            $this->phylum = $phylum;
            $this->class = $class;
            $this->order = $order;
            $this->family = $family;
            $this->genus = $genus;
            $this->species = $species;
            $this->scientific_name = $scientific_name;
            $this->scientific_name_authorship = $scientific_name_authorship;
            $this->taxonomic_status = $taxonomic_status;
            $this->taxon_rank = $taxon_rank;
            $this->parent_name_usage_ID = $parent_name_usage_ID;
            $this->accepted_name_usage_ID = $accepted_name_usage_ID;
            $this->original_name_usage_ID = $original_name_usage_ID;
            $this->tplid = $tplid;
            $this->synonym = $synonym;
        }
    }

    public function get($attribute) {
        return $this->$attribute; 
    }


    public function getAll() {
        return get_object_vars($this);
    }

    public function getSpeGen() {
        $tab = array();
        $tab['species'] = $this->get('species');
        $tab['genus'] = $this->get('genus');
        $tab['id'] = $this->get('plant_ID');
        return $tab;
    }

}