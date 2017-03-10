<?php


interface iPractica {
    
    public function getDepartaments();

    public function getDepartament($id);
    
    public function getEmpleat($empleatId);

    public function getEmpleats($departamentId);

    public function modificarDepartament($id, $nom);

    public function modificarEmpleat($id, $nom, $departamentId);

    public function eliminarDepartament($id);

    public function eliminarEmpleat($id);

    public function modificarMultiple($data);

}
