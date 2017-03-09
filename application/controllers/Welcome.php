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
        
        $departaments = $this->$driver->getDepartaments();
        
        echo "<br>$driver<br>";
        
        $data["departaments"] = $departaments;
        $data["driver"] = $driver;
        $data["vista"] = 'llistat';
        $this->load->view('template', $data);
    }
    
    public function asd() {
        echo "hola";
        $this->load->view('welcome');
    }
    
    public function detalls($departamentId) {
        $driver = $this->session->driver;
        
        if (!$driver) {
            $driver = "ModelMysqli";
            $this->session->set_userdata("driver",$driver);
        }
        $this->load->model($driver);
        
        $departament = $this->$driver->getDepartament($departamentId);
        var_dump($departament);
    }
    
    public function eliminardpt($departamentId) {
        
    }


    public function driver() {
        $post = $this->input->post();
        
        if (isset($post["driver"]) && isset($post["accio"])) {
            $this->session->set_userdata("driver",$post["driver"]);
            redirect("welcome/".$post["accio"]);
        }
        
    }

}
