<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topografi extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
       // cek_session_admin();
        $this->load->model('topografi_model');
       
    }

    public function index(){
    	cek_session_admin();
    	$this->load->view('topografi_view');
    }

    function read(){
		/*Default request pager params dari jeasyUI*/
		$offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->topografi_model->get_topografi($offset,$limit,$search);
        $i	= 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i]['id'] = $r->id;
           $rows[$i]['subgrupid'] = $r->subgrupid;
           $rows[$i]['subgrup'] = $r->kodesubgrup.' - '.$r->subgrup;
           $rows[$i]['kodetopografi'] = $r->kodetopografi;
           $rows[$i]['topografi'] = $r->topografi;
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
        //$cekkode = $this->topografi_model->cekkode();
        
        // if($cekkode){
        //     echo json_encode(array('errorMsg'=>'Kode topografi Sudah Ada'));
        // }else {
            $result = $this->topografi_model->create();
            if($result)
            echo json_encode(array('success'=>true));
                else
            echo json_encode(array('errorMsg'=>'Input Data Gagal'));
        //}
        
    }

    function update($id=null)
    {
        if(!isset($_POST))   
            show_404();
        // $kode = $this->input->post('kodetopografi');
        // $h_kode = $this->input->post('h_kode');
        // if($kode != $h_kode){
        //     echo json_encode(array('errorMsg'=>'Kode Tidak Sesuai'));
        //     die;
        // }
        // cek kode apakah sama dengan kode yang ada di database
        //$cekkode = $this->topografi_model->cekkodeupdate($kode);
        
       // if($kode == $h_kode){
            $result = $this->topografi_model->update($id);
            if($result)
            echo json_encode(array('success'=>true));
                else
            echo json_encode(array('errorMsg'=>'Update Data Gagal'));
        // } else {
        //     echo json_encode(array('errorMsg'=>'Update Data Gagal'));
        // };
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->topografi_model->delete($id))
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
        $data   = $this->topografi_model->optgrup($offset,$limit,$search,$q);
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

    function importdata(){
        $this->load->library('excel');
        //$media = $this->upload->data();
        $inputFileName = './assets/file/mastertopografi.xls';

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

            for ($row = 1; $row <= $highestRow; $row++){                  
            //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE);

                //Sesuaikan sama nama kolom tabel di database                                
                $data = array(
                    "subgrupid"=> $rowData[0][0],
                    "kodetopografi"=> $rowData[0][1],
                    "topografi"=> $rowData[0][2],
   
                );
                
                $insert = $this->db->insert("topografi",$data);
            }
            //echo print_r($data);
                 //die;
        //die;
        //sesuaikan nama dengan nama tabel
        
        //delete_files($media['file_path']);

        if($insert)
        {
            $status = "success";
            $msg = "File successfully uploaded";
            //unlink($inputFileName);
        }
        else
        {
            //unlink($data['full_path']);
            //unlink($inputFileName);
            $status = "error";
            $msg = "Something went wrong when saving the file, please try again.";
        }
    }
}