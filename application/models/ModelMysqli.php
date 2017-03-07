<?php

class ModelMysqli extends CI_Model {
    
    private static $connexio = null;
    
    private static function getConnexio() {
        
    }


    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function prova() {
        echo "Hola";
    }

}
