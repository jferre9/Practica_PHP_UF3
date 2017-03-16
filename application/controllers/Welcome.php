<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    
    public function index() {
        
        $driver = $this->session->driver;
        
        if (!$driver) {
            $driver = "ModelMysqli";
            $this->session->set_userdata("driver",$driver);
        }
        $this->load->model($driver);
        
        $post = $this->input->post();
        if (isset($post["nom"])) {
            $this->$driver->crearDepartament($post["nom"]);
        }
        
        $departaments = $this->$driver->getDepartaments();
        
        
        $data["error"] = $this->session->flashdata("error");
        
        $data["departaments"] = $departaments;
        $data["driver"] = $driver;
        $data["vista"] = 'llistat';
        $this->load->view('template', $data);
        $this->$driver->tancar();
    }
    
    public function moddpt($departamentId) {
        $driver = $this->session->driver;
        
        if (!$driver) {
            $driver = "ModelMysqli";
            $this->session->set_userdata("driver",$driver);
        }
        $this->load->model($driver);
        $departament = $this->$driver->getDepartament($departamentId);
        if (!$departament) redirect ();
        $post = $this->input->post();
        if (isset($post["nom"])) {
            $this->$driver->modificarDepartament($departamentId,$post["nom"]);
            redirect();
        }
        
        
        $data["departament"] = $departament;
        $data["driver"] = $driver;
        $data["vista"] = 'moddpt';
        $this->load->view('template', $data);
        $this->$driver->tancar();
    }
    
    public function modemp($empleatId) {
        $driver = $this->session->driver;
        
        if (!$driver) {
            $driver = "ModelMysqli";
            $this->session->set_userdata("driver",$driver);
        }
        $this->load->model($driver);
        
        $empleat = $this->$driver->getEmpleat($empleatId);
        if (!$empleat) redirect ();
        $post = $this->input->post();
        if (isset($post["nom"]) && isset($post["departament"])) {
            $this->$driver->modificarEmpleat($empleatId,$post["nom"],$post["departament"]);
            redirect();
        }
        
        $data["departaments"] = $this->$driver->getDepartaments();
        
        $data["empleat"] = $empleat;
        $data["driver"] = $driver;
        $data["vista"] = 'modemp';
        $this->load->view('template', $data);
        $this->$driver->tancar();
    }

    
    public function detalls($departamentId) {
        $driver = $this->session->driver;
        
        if (!$driver) {
            $driver = "ModelMysqli";
            $this->session->set_userdata("driver",$driver);
        }
        $this->load->model($driver);
        
        $departament = $this->$driver->getDepartament($departamentId);
        if (!$departament) {
            redirect();
        }
        $data["departament"] = $departament;
        
        $post = $this->input->post();
        if (isset($post["nom"])) {
            if ($post["nom"]) {
                $this->$driver->crearEmpleat($post["nom"], $departamentId);
            }
        } else if (isset ($post["eliminar"]) && isset ($post["empleat"])) {
            $res = $this->$driver->eliminarEmpleats($post["empleat"]);
        } else if (isset ($post["canviar"]) && isset ($post["departament"])) {
            $res = $this->$driver->modificarMultiple($post["departament"]);
        }
        
        
        
        $empleats = $this->$driver->getEmpleats($departamentId);
        $data["empleats"] = $empleats;
        
        $data["departaments"] = $this->$driver->getDepartaments();
        
        $data["driver"] = $driver;
        $data["vista"] = "detalls";
        $this->load->view("template",$data);
        
    }
    
    public function eliminardpt($departamentId) {
        $driver = $this->session->driver;
        
        if (!$driver) {
            $driver = "ModelMysqli";
            $this->session->set_userdata("driver",$driver);
        }
        $this->load->model($driver);
        
        $empleats = $this->$driver->getEmpleats($departamentId);
        if (count($empleats) > 0) {
            $this->session->set_flashdata("error","No es pot eliminar un departament amb empleats");
        } else {
            $this->$driver->eliminarDepartament($departamentId);
        }
        
        redirect();
    }
    
    public function eliminaremp($empleatId) {
        $driver = $this->session->driver;
        
        if (!$driver) {
            $driver = "ModelMysqli";
            $this->session->set_userdata("driver",$driver);
        }
        $this->load->model($driver);
        
        $empleat = $this->$driver->getEmpleat($empleatId);
        if (!$empleat) redirect ();
        $this->$driver->eliminarEmpleat($empleatId);
        
        redirect("welcome/detalls/".$empleat["departament_id"]);
        $this->$driver->tancar();
    }


    public function driver() {
        $post = $this->input->post();
        $drivers = array("ModelMysqli","ModelPdo","ModelAdodb","ModelOdbc","ModelOracle");
        
        if (isset($post["driver"]) && isset($post["url"]) && in_array($post["driver"], $drivers)) {
            $this->session->set_userdata("driver",$post["driver"]);
            redirect($post["url"]);
        } else {
            redirect();
        }
    }

}
