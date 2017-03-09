<?php

class ModelPdo extends CI_Model {

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
        $statement = $this->conn->prepare("UPDATE empleat set nom = :nom departament_id = :departament WHERE id = :id");
        $statement->execute(array('id'=>$id, 'nom'=>$nom,'departament'=>$departamentId));
    }

    public function eliminarDepartament($id) {
        $statement = $this->conn->prepare("DELETE FROM departament WHERE id = :id");
        $statement->execute(array('id'=>$id));
    }

    public function eliminarEmpleat($id) {
        $statement = $this->conn->prepare("DELETE FROM empleat WHERE id = :id");
        $statement->execute(array('id'=>$id));
    }

    public function modificarMultiple($data) {
        $this->conn->beginTransaction();
        
        $this->conn->commit();
        
    }

}
