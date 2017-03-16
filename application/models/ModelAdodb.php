<?php

include(APPPATH.'/libraries/adodb5/adodb.inc.php');
include_once APPPATH  .'interfaces/iPractica.php';

class ModelAdodb extends CI_Model implements iPractica {

    private $conn;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->conn = ADONewConnection('mysqli');
        $this->conn->PConnect('127.0.0.1', 'root', '', 'practica_php_uf3');
    }

    public function getDepartaments() {
        $rs = $this->conn->Execute("SELECT * FROM departament");
        $items = $rs->GetArray();
        return $items;
    }

    public function getDepartament($id) {
        $p = $this->conn->Prepare("Select * FROM departament WHERE id = ?");
        $rs = $this->conn->Execute($p, array($id));
        $departament = $rs->GetArray();
        if (isset($departament[0])) return $departament[0];
        return false;
    }
    
    public function getEmpleats($departamentId) {
        $statement = $this->conn->Prepare("SELECT * FROM empleat where departament_id = ?");
        $rs = $this->conn->Execute($statement,array($departamentId));
        return $rs->GetArray();
    }
    
    public function modificarDepartament($id, $nom) {
        $statement = $this->conn->Prepare("UPDATE departament set nom = ? WHERE id = ?");
        $this->conn->Execute($statement,array($nom,$id));
    }
    
    public function modificarEmpleat($id, $nom, $departamentId) {
        $statement = $this->conn->Prepare("UPDATE empleat set nom = ?, departament_id = ? WHERE id = ?");
        $this->conn->Execute($statement,array($nom,$departamentId,$id));
    }
    
    public function eliminarDepartament($id) {
        $statement = $this->conn->Prepare("DELETE FROM departament WHERE id = ?");
        $this->conn->Execute($statement,array($id));
    }
    
    public function eliminarEmpleat($id) {
        $statement = $this->conn->Prepare("DELETE FROM empleat WHERE id = ?");
        $this->conn->Execute($statement,array($id));
    }
    
    public function crearDepartament($nom) {
        $statement = $this->conn->Prepare("INSERT INTO departament (nom) VALUES (?)");
        $this->conn->Execute($statement,array($nom));
    }
    
    public function crearEmpleat($nom, $departamentId) {
        $statement = $this->conn->Prepare("INSERT INTO empleat (nom,departament_id) VALUES (?,?)");
        $this->conn->Execute($statement,array($nom, $departamentId));
    }
    
    public function eliminarEmpleats($data) {
        try {
            $this->conn->BeginTrans();
            $statement = $this->conn->prepare("DELETE FROM empleat WHERE id = ?");
            foreach ($data as $key => $value) {
                $this->conn->Execute($statement,array($key));
            }
            $this->conn->CommitTrans();
            return true;
        } catch (Exception $ex) {
            $this->conn->RollbackTrans();
            return false;
        }
    }
    
    public function getEmpleat($empleatId) {
        $p = $this->conn->Prepare("Select * FROM empleat WHERE id = ?");
        $rs = $this->conn->Execute($p, array($empleatId));
        $departament = $rs->GetArray();
        if (isset($departament[0])) return $departament[0];
        return false;
    }
    
    public function modificarMultiple($data) {
        try {
            $this->conn->BeginTrans();
            $statement = $this->conn->prepare("UPDATE empleat SET departament_id = ? WHERE id = ?");
            foreach ($data as $key => $value) {
                $id = $key;
                $departamentId = $value;
                $this->conn->Execute($statement,array($departamentId,$id));
            }
            $this->conn->CommitTrans();
            return true;
        } catch (Exception $ex) {
            $this->conn->RollbackTrans();
            return false;
        }
    }

    public function tancar() {
        try {
            $this->conn->Close();
        } catch (Exception $ex) {

        }
    }

}
