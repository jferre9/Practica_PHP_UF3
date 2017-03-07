<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    
    public function index() {
        $this->load->model("ModelMysqli");
        
        
        if ($this->session->driver) {
            
        }
        
        $driver = "ModelMysqli";
        $this->$driver->prova();
        $data["vista"] = 'llistat';
        $this->load->view('template', $data);
    }

}
