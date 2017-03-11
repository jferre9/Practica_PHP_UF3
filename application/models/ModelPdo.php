<?php

include_once APPPATH  .'interfaces/iPractica.php';

class ModelPdo extends CI_Model implements iPractica {

    private $conn;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $dsn = 'mysql:dbname=practica_php_uf3;host=127.0.0.1;charset=utf8';
        $user = 'root';
        $password = '';

        try {
            $this->conn = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
            //print_r($this->conn->errorInfo());
        }
    }

    public function getDepartaments() {
        $statement = $this->conn->prepare("SELECT * FROM departament");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getDepartament($id) {
        $statement = $this->conn->prepare("SELECT * FROM departament where id = :id");
        $statement->execute(array('id'=>$id));
        return $statement->fetch();
    }

    public function getEmpleats($departamentId) {
        $statement = $this->conn->prepare("SELECT * FROM empleat where departament_id = :id");
        $statement->execute(array('id'=>$departamentId));
        return $statement->fetchAll();
    }

    public function modificarDepartament($id, $nom) {
        $statement = $this->conn->prepare("UPDATE departament set nom = :nom WHERE id = :id");
        $statement->execute(array('id'=>$id, 'nom'=>$nom));
    }

    public function modificarEmpleat($id, $nom, $departamentId) {
        $statement = $this->conn->prepare("UPDATE empleat set nom = :nom, departament_id = :departament WHERE id = :id");
        $statement->execute(array('id'=>$id, 'nom'=>$nom,'departament'=>$departamentId));
    }

    public function eliminarDepartament($id) {
        $statement = $this->conn->prepare("DELETE FROM departament WHERE id = :id");
        return $statement->execute(array('id'=>$id));
    }

    public function eliminarEmpleat($id) {
        $statement = $this->conn->prepare("DELETE FROM empleat WHERE id = :id");
        $statement->execute(array('id'=>$id));
    }

    public function crearDepartament($nom) {
        $statement = $this->conn->prepare("INSERT INTO departament (nom) VALUES (?)");
        return $statement->execute(array($nom));
    }

    public function crearEmpleat($nom, $departamentId) {
        $statement = $this->conn->prepare("INSERT INTO empleat (nom,departament_id) VALUES (?,?)");
        return $statement->execute(array ($nom, $departamentId));
    }

    public function eliminarEmpleats($data) {
        try {
            $this->conn->beginTransaction();
            $statement = $this->conn->prepare("DELETE FROM empleat WHERE id = ?");
            foreach ($data as $key => $value) {
                if (!$statement->execute(array($key)) || $statement->rowCount() != 1) throw new Exception ();
            }
            $this->conn->commit();
            return true;
        } catch (Exception $ex) {
            $this->conn->rollback();
            return false;
        }
    }

    public function getEmpleat($empleatId) {
        $statement = $this->conn->prepare("Select * FROM empleat WHERE id = ?");
        $statement->execute(array($empleatId));
        return $statement->fetch();
    }

    public function modificarMultiple($data) {
        try {
            $this->conn->beginTransaction();
            $statement = $this->conn->prepare("UPDATE empleat SET departament_id = ? WHERE id = ?");
            foreach ($data as $key => $value) {
                $id = $key;
                $departamentId = $value;
                if (!$statement->execute(array($departamentId,$id))) throw new Exception ();
            }
            $this->conn->commit();
            return true;
        } catch (Exception $ex) {
            $this->conn->rollback();
            return false;
        }
    }

}
