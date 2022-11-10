<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupdiagnostik extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
       // cek_session_admin();
        $this->load->model('grupdiagnostik_model');
       
    }

    public function index(){
    	cek_session_admin();
    	$this->load->view('grupdiagnostik_view');
    }

    function read(){
		/*Default request pager params dari jeasyUI*/
		$offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->grupdiagnostik_model->get_grupdiagnostik($offset,$limit,$search);
        $i	= 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i]['id'] = $r->id;
           $rows[$i]['kode'] = $r->kode;
           $rows[$i]['grupdiagnostik'] = $r->grupdiagnostik;
           $rows[$i]['aktif'] = $r->aktif;
        	
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json

    }

    function save(){
    	if(!isset($_POST))   
            show_404();
        //$a = false;
        $cekkode = $this->grupdiagnostik_model->cekkode();
        
        if($cekkode){
            echo json_encode(array('errorMsg'=>'Kode Grup Diagnostik Sudah Ada'));
        }else {
            $result = $this->grupdiagnostik_model->create();
            if($result)
            echo json_encode(array('success'=>true));
                else
            echo json_encode(array('errorMsg'=>'Input Data Gagal'));
        }
        
    }

    function update($id=null)
    {
        if(!isset($_POST))   
            show_404();
        $kode = $this->input->post('kode');
        $h_kode = $this->input->post('h_kode');
        if($kode != $h_kode){
            echo json_encode(array('errorMsg'=>'Kode Tidak Sesuai'));
            die;
        }
        // cek kode apakah sama dengan kode yang ada di database
        //$cekkode = $this->grupdiagnostik_model->cekkodeupdate($kode);
        
        if($kode == $h_kode){
            $result = $this->grupdiagnostik_model->update($id);
            if($result)
            echo json_encode(array('success'=>true));
                else
            echo json_encode(array('errorMsg'=>'Update Data Gagal'));
        } else {
            echo json_encode(array('errorMsg'=>'Update Data Gagal'));
        };
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->grupdiagnostik_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }
}