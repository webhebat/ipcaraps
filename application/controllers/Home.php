<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        $this->load->model('home_model');
    }

    public function index(){
    	$this->load->view('home_view');
    }

    function menu(){
        if(!isset($_POST))   
            show_404();
        echo $this->home_model->getmenu();
    }
}