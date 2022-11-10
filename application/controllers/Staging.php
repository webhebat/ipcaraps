<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staging extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
       // cek_session_admin();
        $this->load->model('staging_model');
       
    }

    public function index(){
    	cek_session_admin();
    	$this->load->view('staging_view');
    }

    function read(){
		/*Default request pager params dari jeasyUI*/
		$offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->staging_model->get_staging($offset,$limit,$search);
        $i	= 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           
           //array keys ini = attribute 'field' di view nya
           $rows[$i]['id'] = $r->id;
           $rows[$i]['jenis'] = $r->jenis;
           $rows[$i]['tingkat'] = $r->tingkat;
           $rows[$i]['staging'] = $r->staging;
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
        
        if($this->staging_model->create())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal memasukkan data'));
    }

    function update($id=null)
    {
        if(!isset($_POST))   
            show_404();
        
        if($this->staging_model->update($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->staging_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

    function importdata(){
        $this->load->library('excel');
        //$media = $this->upload->data();
        $inputFileName = './assets/file/masterstaging.xls';

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

            for ($row = 2; $row <= $highestRow; $row++){                  
            //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE);

                //Sesuaikan sama nama kolom tabel di database                                
                $data = array(
                    "jenis"=> $rowData[0][0],
                    "tingkat"=> $rowData[0][1],
                    "staging"=> $rowData[0][2],
   
                );
                
                $insert = $this->db->insert("staging",$data);
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