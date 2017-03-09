<?php

class ModelOracle extends CI_Model {

    private $conn;

    

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function getDepartaments() {
        $departaments = array();
        
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
