<?php

class ModelOdbc extends CI_Model {

    private $conn;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->conn = odbc_connect('practica_php_uf3', "root", "");
        if (!$this->conn) die("Connect error");
    }

    public function getDepartaments() {
        $departaments = array();
        $result = odbc_exec($this->conn, "SELECT * FROM departament");
        while (odbc_fetch_into($result, $arr_result)) {
            array_push($departaments, $arr_result);
        }
        odbc_free_result($result);
        return $departaments;
    }

    public function getDepartament($id) {
        
    }

    public function getEmpleats($departamentId) {
        
    }

    public function modificarDepartament($id, $nom) {
        
    }

    public function modificarEmpleat($id, $nom, $departamentId) {
        
    }

    public function eliminarDepartament($id) {
        
    }

    public function eliminarEmpleat($id) {
        
    }

    public function modificarMultiple($data) {
        
    }

}
