<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registerreminder extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        cek_session_admin();
       /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('registerreminder_model');
    }

    public function index(){
        cek_session_admin();
        $this->load->view('registerreminder_view');
    }

    function getjmlkunjungan(){
        $data = $this->registerreminder_model->getjmlkunjungan();
        echo json_encode($data);
    }

    function read(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $tgl1 = isset($_POST['tglkunjungan']) ? $_POST['tglkunjungan'] : '';
        $tgl2 = isset($_POST['tglkunjungan2']) ? $_POST['tglkunjungan2'] : '';
        $followup = isset($_POST['followup']) ? $_POST['followup'] : '';
        $hari = isset($_POST['hari']) ? $_POST['hari'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->registerreminder_model->get_reminder($offset,$limit,$search,$followup,$hari,$tgl1,$tgl2,$status);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i] = $r;
           $rows[$i]->jmlkunjungan = $this->registerreminder_model->jmlkunjungan($r->registrasiid);
           $rows[$i]->followup = '';//$this->registerreminder_model->followup($r->id);
           $rows[$i]->keterangan_reminder = $this->registerreminder_model->keterangan($r->id);
            
         $i++;
        }
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json
    }

    function read1(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $tgl1 = isset($_POST['tglkunjungan']) ? $_POST['tglkunjungan'] : '';
        $tgl2 = isset($_POST['tglkunjungan2']) ? $_POST['tglkunjungan2'] : '';
        $followup = isset($_POST['followup']) ? $_POST['followup'] : '';
        $hari = isset($_POST['hari']) ? $_POST['hari'] : '';
        $interval = isset($_POST['interval']) ? $_POST['interval'] : '';
        $subgrupid = isset($_POST['subgrupid']) ? $_POST['subgrupid'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $offset = ($offset-1)*$limit;
       
        $data   = $this->registerreminder_model->get_reminder1($offset,$limit,$search,$followup,$hari,$tgl1,$tgl2,$interval,$subgrupid,$status);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i] = $r;
          // $rows[$i]->jmlkunjungan = $this->registerreminder_model->jmlkunjungan($r->registrasiid);
          //$rows[$i]->followup = $this->registerreminder_model->followup($r->id);
          //$rows[$i]->keterangan_reminder = $this->registerreminder_model->keterangan($r->id);
            
         $i++;
        }
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json
    }

    function save(){
        if(!isset($_POST))   
            show_404();
        
        if($this->registerreminder_model->create())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal memasukkan data'));
    }

    function update($id=null)
    {
        if(!isset($_POST))   
            show_404();
        
        if($this->registerreminder_model->update($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->registerreminder_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

}