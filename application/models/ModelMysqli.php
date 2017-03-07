<?php

class ModelMysqli extends CI_Model {

    private static $connexio = null;
    private $conn;

    private static function getConnexio() {
        if (ModelMysqli::$connexio == null) {
            ModelMysqli::$connexio = new mysqli('127.0.0.1', 'root', '', 'practica_php_uf3');
            if (ModelMysqli::$connexio->connect_error) {
                die('Connect Error (' . ModelMysqli::$connexio->connect_errno . ') ' . ModelMysqli::$connexio->connect_error);
            }
            ModelMysqli::$connexio->set_charset("utf8");
        }
        return ModelMysqli::$connexio;
    }

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->conn = ModelMysqli::getConnexio();
    }

    public function getDepartaments() {
        $departaments = array();
        $result = $this->conn->query("SELECT * FROM departament");
        while (($row = $result->fetch_assoc())) {
            array_push($departaments,$row);
        }
        return $departaments;
    }
    
    public function getDepartament($id) {
        
    }
    
    public function getEmpleats($departamentId) {
        
    }
    
    public function modificarDepartament($id,$nom) {
        
    }
    
    public function modificarEmpleat($id,$nom,$departamentId) {
        
    }
    
    public function eliminarDepartament($id) {
        
    }
    
    public function eliminarEmpleat($id) {
        
    }
    
    public function modificarMultiple($data) {
        
    }

    

}
