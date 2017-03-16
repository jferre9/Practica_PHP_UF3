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
        $stmt->bind_param("i", $empleatId);
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
        $stmt = $this->conn->prepare("UPDATE departament SET nom = ? WHERE id = ?");
        $stmt->bind_param("si", $nom, $id);
        return $stmt->execute();
    }

    public function modificarEmpleat($id, $nom, $departamentId) {
        $stmt = $this->conn->prepare("UPDATE empleat SET nom = ?, departament_id = ? WHERE id = ?");
        $stmt->bind_param("sii", $nom, $departamentId,$id);
        return $stmt->execute();
    }
    
    public function crearDepartament($nom) {
        $stmt = $this->conn->prepare("INSERT INTO departament (nom) VALUES (?)");
        $stmt->bind_param("s", $nom);
        return $stmt->execute();
    }

    public function crearEmpleat($nom, $departamentId) {
        $stmt = $this->conn->prepare("INSERT INTO empleat (nom,departament_id) VALUES (?,?)");
        $stmt->bind_param("si", $nom, $departamentId);
        return $stmt->execute();
    }

    public function eliminarDepartament($id) {
        $stmt = $this->conn->prepare("DELETE FROM departament WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows == 1;
    }

    public function eliminarEmpleats($data) {
        $this->conn->autocommit(false);
        try {
            $this->conn->begin_transaction();
            $stmt = $this->conn->prepare("DELETE FROM empleat WHERE id = ?");
            $id;
            $stmt->bind_param("i", $id);
            foreach ($data as $key => $value) {
                $id = $key;
                if (!$stmt->execute() || $stmt->affected_rows != 1) throw new Exception ();
            }
            
            $this->conn->commit();
            return true;
        } catch (Exception $ex) {
            $this->conn->rollback();
            return false;
        }
        
        
    }

    public function modificarMultiple($data) {
        $this->conn->autocommit(false);
        try {
            $this->conn->begin_transaction();
            $stmt = $this->conn->prepare("UPDATE empleat SET departament_id = ? WHERE id = ?");
            $id;
            $departamentId;
            $stmt->bind_param("ii", $departamentId, $id);
            foreach ($data as $key => $value) {
                $id = $key;
                $departamentId = $value;
                if (!$stmt->execute()) throw new Exception ();
            }
            $this->conn->commit();
            return true;
        } catch (Exception $ex) {
            $this->conn->rollback();
            return false;
        }
    }

    public function eliminarEmpleat($id) {
        $stmt = $this->conn->prepare("DELETE FROM empleat WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows == 1;
    }

    public function tancar() {
        try {
            mysqli_close($this->conn);
        } catch (Exception $ex) {

        }
        
    }

}
