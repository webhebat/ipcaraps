<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Propinsi extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        cek_session_admin();
       /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('propinsi_model');
    }

    public function index(){
        cek_session_admin();
        $this->load->view('propinsi_view');
    }

    function read(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->propinsi_model->get_propinsi($offset,$limit,$search);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i]['propid'] = $r->id_prov;
           $rows[$i]['propinsi'] = $r->nama;
           $rows[$i]['ibukota'] = $r->ibukota;
           $rows[$i]['lat'] = $r->lat;
           $rows[$i]['lng'] = $r->lng;
           //$rows[$i]['aktif'] = $r->aktif;
            
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json

    }
}