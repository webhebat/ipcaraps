<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        cek_session_admin();
       /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('validasi_model');
    }

    public function index(){
        cek_session_admin();
        $this->load->view('validasi_view');
    }

    function no_validasi(){
        $data = $this->validasi_model->get_no_validasi();
        echo json_encode($data);
    }

    function getjmlvalidasi(){
        $data = $this->validasi_model->getjmlvalidasi();
        echo json_encode($data);
    }

    function read(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $warning = isset($_POST['warning']) ? $_POST['warning'] : '';
        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
        $area = isset($_POST['area']) ? $_POST['area'] : '';
        $tgl = isset($_POST['tglprediksi']) ? $_POST['tglprediksi'] : '';
        $tgl2 = isset($_POST['tglprediksi2']) ? $_POST['tglprediksi2'] : '';
        $validate = isset($_POST['validate']) ? $_POST['validate'] : '';
        $offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->get_validasi($offset,$limit,$search,$warning,$jenis,$area,$tgl,$tgl2,$validate);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $rows[$i]->usiadiagnosis = $this->validasi_model->gettgldiagnosis($r->id);
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json

    }

    function readluaran(){

        $id = isset($_GET['validasiid']) ? $_GET['validasiid'] : '';

        $data   = $this->validasi_model->get_luaran($id);
        $i  = 0;
        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $rows[$i]->tindakan = $this->gettatalaksana($r->tindakan);
            $rows[$i]->namatindakan = $this->namatindakan($r->idtindakan);
            if($rows[$i]->date_complete!='0000-00-00'){
                $rows[$i]->tgl_status = $rows[$i]->date_complete;
            }else if($rows[$i]->date_stable!='0000-00-00'){
                $rows[$i]->tgl_status = $rows[$i]->date_stable;
            }else if($rows[$i]->date_relaps!='0000-00-00'){
                $rows[$i]->tgl_status = $rows[$i]->date_relaps;
            }else if($rows[$i]->date_progresif!='0000-00-00'){
                $rows[$i]->tgl_status = $rows[$i]->date_progresif;
            }
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json

    }

    function gettatalaksana($id=null){
        $id = isset($_GET['id']) ? $_GET['id'] : $id;
        
        $data = $this->validasi_model->get_tatalaksana($id);
        $i  = 0;
        $rows   = array(); 
        foreach ($data as $r){
            $rows[$i] = $r->tatalaksana;
            $rows[$i] = $r->id;
        $i++;
        }
        return $rows;
    }

    function namatindakan($id){
        $data = $this->validasi_model->get_tatalaksana2($id);
        $i  = 0;
        $rows   = array(); 
        foreach ($data as $r){
            $rows[$i] = $r->tatalaksana;
           // $rows[$i] = $r->id;
        $i++;
        }
        return $rows;
    }


    function searchtumor(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
        //$kdmorfologi = isset($_POST['keymor']) ? $_POST['keymor'] : '';
        $offset = ($offset-1)*$limit;
        $data   = $this->validasi_model->caritumor($offset,$limit,$search,$kategori);
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
        $data = json_decode($this->input->get('datajson'),true);
        $data2 = json_decode($this->input->get('datajson2'),true);
        if($this->validasi_model->simpan($data,$data2))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal memasukkan data'));
    }

    function update($id=null)
    {
        if(!isset($_POST))   
            show_404();

        $data = json_decode($this->input->get('datajson'),true);
        $data2 = json_decode($this->input->get('datajson2'),true);
        
        if($this->validasi_model->update($id,$data,$data2))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }

    function validate($id=null)
    {
        if(!isset($_POST))   
            show_404();

        $data = json_decode($this->input->get('datajson'),true);
        $data2 = json_decode($this->input->get('datajson2'),true);
        
        if($this->validasi_model->validate($id,$data,$data2))
            echo json_encode(array('success'=>true));
        else
            //echo json_encode(array('msg'=>'Gagal mengubah data'));
            echo json_encode(array('errorMsg'=>'Gagal mengubah data'));
    }

    public function delete()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->validasi_model->delete($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

    function saveluaran(){
        if(!isset($_POST))   
            show_404();
        if($this->validasi_model->createluaran())
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal insert data'));
    }

    function updateluaran($id=null)
    {
        if(!isset($_POST))   
            show_404();

        if($this->validasi_model->updateluaran($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal mengubah data'));
    }

    public function deleteluaran()
    {
        if(!isset($_POST))   
            show_404();
        
        $id = intval(addslashes($_POST['id']));
        if($this->validasi_model->deleteluaran($id))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Gagal menghapus data'));
    }

    function propinsi(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->opt_propinsi($offset,$limit,$search,$q);
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

    function kabupaten(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;
        $propid = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->opt_kabupaten($offset,$limit,$search,$q,$propid);
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

    function kecamatan(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;
        $kabid = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->opt_kecamatan($offset,$limit,$search,$q,$kabid);
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

    function desa(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;
        $camatid = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->opt_desa($offset,$limit,$search,$q,$camatid);
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

    function diagnosis(){
        $q='';
        $data = $this->validasi_model->optdiagnosis($q);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);

    }

    function tatalaksana(){
        $q='';
        $data = $this->validasi_model->opttatalaksana($q);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);

    }

    function staging(){
        $q='';
        $stagingid = $this->input->get('stagingid');
        $data = $this->validasi_model->getstaging($stagingid);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);

    }

    function getdatariwayat(){
        $q='';
        $validasiid = $this->input->get('validasiid');
        $data = $this->validasi_model->getdatariwayat($validasiid);
        $i=0;

        $rows   = array(); 
        foreach ($data ['data'] as $r) {
           //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
         $i++;
        }
        
        //keys total & rows wajib bagi jEasyUI
        $result = array('total'=>$data['count'],'rows'=>$rows);
        echo json_encode($result); //return nya json
        //echo json_encode($result);
    }

    function getdatadiagnosis(){
        $q='';
        $validasiid = $this->input->get('validasiid');
        $data = $this->validasi_model->getdatadiagnosis($validasiid);
        $i=0;

        foreach ($data as $fields) {
            $result[$i]=$fields;
            $i++;
        }
        echo json_encode($result);
    }

    public function optionsubgrup(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->optionsubgrup($offset,$limit,$search,$q);
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

    public function optionmorfologi(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $kodesubgrup = isset($_POST['kodesubgrup']) ? $_POST['kodesubgrup'] : '';
        $q = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->optionmorfologi($offset,$limit,$search,$q,$kodesubgrup);
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

    public function optiontopografi(){
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $kodesubgrup = isset($_GET['kodesubgrup']) ? $_GET['kodesubgrup'] : '';
        $q = isset($_GET['search']) ? $_GET['search'] : '';
        $offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->validasi_model->optiontopografi($offset,$limit,$search,$q,$kodesubgrup);
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