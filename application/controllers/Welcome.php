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
        var_dump($departaments);
        $data["departaments"] = $departaments;
        $data["driver"] = $driver;
        $data["vista"] = 'llistat';
        $this->load->view('template', $data);
    }

}
