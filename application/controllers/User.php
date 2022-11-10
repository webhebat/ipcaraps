<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        $this->load->model('user_model');
    }

	public function index()
	{
		cek_session_admin();
        $this->load->view('user_view');
	}

	function read(){
		/*Default request pager params dari jeasyUI*/
		$offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->user_model->get_user($offset,$limit,$search);
        $i	= 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i] = $r;
          /* $rows[$i]['id'] = $r->id;
           $rows[$i]['nama_user'] = $r->nama_user;
           $rows[$i]['status'] = $r->status;*/
        	
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json

    }

    function save(){
    	if(!isset($_POST))   
            show_404();
        
        if($this->user_model->saveuser())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('errorMsg'=>'Gagal memasukkan data, user name tidak boleh sama, atau cek koneksi anda'));
    }

    function updateuser($id=null)
    {
        if(!isset($_POST))   
            show_404();
        
        if($this->user_model->updateuser($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->user_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

    public function nonaktif()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        $active = intval(addslashes($_POST['active']));
        if($this->user_model->nonaktif($id,$active))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

    public function options(){
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $data = $this->user_model->getoptions($q);
        /*$result[0]['id'] = 0;
        $result[0]['nama_user'] = '- Pilih user -';
        $result[0]['status'] = 'y';*/
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);

    }

    public function groupoption(){
        $q='';
        $data = $this->user_model->groupotion($q);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);

    }

    public function optionunit(){
        $q='';
        $data = $this->user_model->optionunit($q);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);

    }

    public function optionuser(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;

        $data   = $this->user_model->optionuser($offset,$limit,$search,$q);
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

}
