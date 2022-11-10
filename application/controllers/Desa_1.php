<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        cek_session_admin();
       /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('desa_model');
    }

    public function index(){
        cek_session_admin();
        $this->load->view('desa_view');
    }

    function read(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->desa_model->get_desa($offset,$limit,$search);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
           // $rows[$i]['desaid'] = $r->desaid;
           // $rows[$i]['camatid'] = $r->camatid;
           // $rows[$i]['desa'] = $r->desa;
           // $rows[$i]['kecamatan'] = $r->kecamatan;
           // $rows[$i]['aktif'] = $r->aktif;
            
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json

    }

    public function options(){
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $data = $this->desa_model->getoptions($q);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);
    }

    public function optionkecamatan(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->desa_model->optionkecamatan($offset,$limit,$search,$q);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json
    }

    function save(){
        if(!isset($_POST))   
            show_404();
        
        if($this->desa_model->create())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal memasukkan data'));
    }

    function update($id=null)
    {
        if(!isset($_POST))   
            show_404();
        
        if($this->desa_model->update($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->desa_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }
}