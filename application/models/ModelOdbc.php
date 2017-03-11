<?php

include_once APPPATH  .'interfaces/iPractica.php';

class ModelOdbc extends CI_Model implements iPractica {

    private $conn;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->conn = odbc_connect('practica_php', "root", "");
        if (!$this->conn) die("Connect error");
    }

    public function getDepartaments() {
        $departaments = array();
        $result = odbc_exec($this->conn, "SELECT * FROM departament");
        while ($arr_result = odbc_fetch_array($result)) {
            array_push($departaments, $arr_result);
        }
        odbc_free_result($result);
        return $departaments;
    }

    public function getDepartament($id) {
        $stmt    = odbc_prepare($this->conn, 'Select * FROM departament WHERE id = ?');
        $result = odbc_execute($stmt, array($id));
        $departament = odbc_fetch_array($stmt);
        odbc_free_result($stmt);
        return $departament;
    }

    public function getEmpleats($departamentId) {
        $empleats = array();
        $stmt    = odbc_prepare($this->conn, 'Select * FROM  empleat WHERE d.departament_id = ?');
        $result = odbc_execute($stmt, array($departamentId));
        while ($arr_result = odbc_fetch_array($stmt)) {
            array_push($empleats, $arr_result);
        }
        odbc_free_result($stmt);
        return $empleats;
    }

    public function crearDepartament($nom) {
        
    }

    public function crearEmpleat($nom, $departamentId) {
        
    }

    public function eliminarDepartament($id) {
        
    }

    public function eliminarEmpleat($id) {
        
    }

    public function eliminarEmpleats($data) {
        
    }

    public function getEmpleat($empleatId) {
        
    }

    public function modificarDepartament($id, $nom) {
        
    }

    public function modificarEmpleat($id, $nom, $departamentId) {
        
    }

    public function modificarMultiple($data) {
        
    }

}
