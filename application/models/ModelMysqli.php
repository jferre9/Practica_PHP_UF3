<?php

include_once APPPATH  .'interfaces/iPractica.php';

class ModelMysqli extends CI_Model implements iPractica {

    private $conn;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->conn = new mysqli('127.0.0.1', 'root', '', 'practica_php_uf3');
        if ($this->conn->connect_error) {
            die('Connect Error (' . $this->conn->connect_errno . ') ' . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }

    public function getDepartaments() {
        $departaments = array();
        $result = $this->conn->query("SELECT * FROM departament");
        while (($row = $result->fetch_assoc())) {
            array_push($departaments, $row);
        }
        return $departaments;
    }

    public function getDepartament($id) {
        $stmt = $this->conn->prepare("Select * FROM departament WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc())
        {
            return $row;
        }
        return false;
    }
    
    public function getEmpleat($empleatId) {
        $stmt = $this->conn->prepare("Select * FROM empleat WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc())
        {
            return $row;
        }
        return false;
    }

    public function getEmpleats($departamentId) {
        $empleats = array();
        $stmt = $this->conn->prepare("Select * FROM empleat WHERE departament_id = ?");
        $stmt->bind_param("i", $departamentId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc())
        {
            array_push($empleats, $row);
        }
        return $empleats;
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
