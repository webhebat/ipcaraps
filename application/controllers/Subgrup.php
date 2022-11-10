<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subgrup extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
       // cek_session_admin();
        $this->load->model('subgrup_model');
       
    }

    public function index(){
    	cek_session_admin();
    	$this->load->view('subgrup_view');
    }

    function read(){
		/*Default request pager params dari jeasyUI*/
		$offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->subgrup_model->get_subgrup($offset,$limit,$search);
        $i	= 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i]['id'] = $r->id;
           $rows[$i]['grupdiagnostikid'] = $r->grupdiagnostikid;
           $rows[$i]['grupdiagnostik'] = $r->grupdiagnostik;
           $rows[$i]['kodesubgrup'] = $r->kodesubgrup;
           $rows[$i]['subgrup'] = $r->subgrup;
           $rows[$i]['stagingid'] = $r->stagingid;
           $rows[$i]['aktif'] = $r->aktif;
        	
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json

    }

    function readstaging(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
        $tingkat = isset($_POST['tingkat']) ? $_POST['tingkat'] : '';
        $offset = ($offset-1)*$limit;
        $id_staging = array();
        if ($this->input->post('staging_id')) $id_staging = explode(",",$this->input->post('staging_id'));
        
        $data   = $this->subgrup_model->get_staging($offset,$limit,$search,$jenis,$tingkat);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           //array keys ini = attribute 'field' di view nya
           $rows[$i] = $r;
           if (is_array($id_staging)){
                if (in_array($r->id,$id_staging))
                    $rows[$i]->ck = "1";
                else
                    $rows[$i]->ck = "0";                
            }
            
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
        $cekkode = $this->subgrup_model->cekkode();
        
        if($cekkode){
            echo json_encode(array('errorMsg'=>'Kode Sub Grup Sudah Ada'));
        }else {
            $result = $this->subgrup_model->create();
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
        $kode = $this->input->post('kodesubgrup');
        $h_kode = $this->input->post('h_kode');
        if($kode != $h_kode){
            echo json_encode(array('errorMsg'=>'Kode Tidak Sesuai'));
            die;
        }
        // cek kode apakah sama dengan kode yang ada di database
        //$cekkode = $this->subgrup_model->cekkodeupdate($kode);
        
        if($kode == $h_kode){
            $result = $this->subgrup_model->update($id);
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
        if($this->subgrup_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

    public function optgrup(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->subgrup_model->optgrup($offset,$limit,$search,$q);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($rows); //return nya json
    }
}