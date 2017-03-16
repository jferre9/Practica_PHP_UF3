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
        $stmt    = odbc_prepare($this->conn, 'Select * FROM  empleat WHERE departament_id = ?');
        $result = odbc_execute($stmt, array($departamentId));
        while ($arr_result = odbc_fetch_array($stmt)) {
            array_push($empleats, $arr_result);
        }
        odbc_free_result($stmt);
        return $empleats;
    }

    public function crearDepartament($nom) {
        $stmt    = odbc_prepare($this->conn, 'INSERT INTO departament (nom) VALUES (?)');
        return odbc_execute($stmt, array($nom));
    }

    public function crearEmpleat($nom, $departamentId) {
        $stmt    = odbc_prepare($this->conn, 'INSERT INTO empleat (nom,departament_id) VALUES (?,?)');
        return odbc_execute($stmt, array($nom,$departamentId));
    }

    public function eliminarDepartament($id) {
        $stmt    = odbc_prepare($this->conn, 'DELETE FROM departament WHERE id = ?');
        $res = odbc_execute($stmt, array($id));
        return odbc_num_rows($stmt) == 1;
    }

    public function eliminarEmpleat($id) {
        $stmt    = odbc_prepare($this->conn, 'DELETE FROM empleat WHERE id = ?');
        $res = odbc_execute($stmt, array($id));
        return odbc_num_rows($stmt) == 1;
    }

    
    public function getEmpleat($empleatId) {
        $stmt    = odbc_prepare($this->conn, 'Select * FROM empleat WHERE id = ?');
        $result = odbc_execute($stmt, array($empleatId));
        $empleat = odbc_fetch_array($stmt);
        odbc_free_result($stmt);
        return $empleat;
    }

    public function modificarDepartament($id, $nom) {
        $stmt    = odbc_prepare($this->conn, 'UPDATE departament SET nom = ? WHERE id = ?');
        $res = odbc_execute($stmt, array($nom,$id));
        return odbc_num_rows($stmt) == 1;
    }

    public function modificarEmpleat($id, $nom, $departamentId) {
        $stmt    = odbc_prepare($this->conn, 'UPDATE empleat SET nom = ?, departament_id = ? WHERE id = ?');
        $res = odbc_execute($stmt, array($nom,$departamentId,$id));
        return odbc_num_rows($stmt) == 1;
    }
    
    public function eliminarEmpleats($data) {
        odbc_autocommit($this->conn);
        try {
            $stmt    = odbc_prepare($this->conn, 'DELETE FROM empleat WHERE id = ?');
            foreach ($data as $key => $value) {
                $res = odbc_execute($stmt, array($key));
                if (!$res || odbc_num_rows($stmt) != 1) throw new Exception ();
            }
            
            odbc_commit($this->conn);
            return true;
        } catch (Exception $ex) {
            odbc_rollback($this->conn);
            return false;
        }
    }

    public function modificarMultiple($data) {
        odbc_autocommit($this->conn);
        try {
            $stmt    = odbc_prepare($this->conn, 'UPDATE empleat SET departament_id = ? WHERE id = ?');
            foreach ($data as $key => $value) {
                $id = $key;
                $departamentId = $value;
                $res = odbc_execute($stmt, array($departamentId,$id));
                var_dump(odbc_num_rows($stmt));
                if (!$res) throw new Exception ();
            }
            odbc_commit($this->conn);
            return true;
        } catch (Exception $ex) {
            odbc_rollback($this->conn);
            return false;
        }
    }

    public function tancar() {
        odbc_close($this->conn);
    }

}
