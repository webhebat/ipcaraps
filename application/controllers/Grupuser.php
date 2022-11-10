<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupuser extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        cek_session_admin();
       /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('grupuser_model');
    }

	public function index()
	{
		cek_session_admin();
        $this->load->view('grupuser_view');
	}

	function read(){
		/*Default request pager params dari jeasyUI*/
		$offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->grupuser_model->get_grupuser($offset,$limit,$search);
        $i	= 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           $id_menu = NULL;
           $count_menu = 0;
           //array keys ini = attribute 'field' di view nya
           $rows[$i] = $r;
           if ($r->menu_id) $id_menu = explode(",",$r->menu_id);
           if (is_array($id_menu)) $count_menu = count($id_menu);
           $rows[$i]->count_menu = $count_menu;
          /* $rows[$i]['id'] = $r->id;
           $rows[$i]['nama_grupuser'] = $r->nama_grupuser;
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
        
        if($this->grupuser_model->create())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal memasukkan data'));
    }

    function update($id=null)
    {
        if(!isset($_POST))   
            show_404();
        
        if($this->grupuser_model->update($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->grupuser_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

    public function options(){
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $data = $this->grupuser_model->getoptions($q);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);

    }

    public function optiongrupuser(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;

        $data   = $this->grupuser_model->optiongrupuser($offset,$limit,$search,$q);
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
