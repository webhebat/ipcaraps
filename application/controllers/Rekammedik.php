<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekammedik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        $this->load->model('rekammedik_model');
    }

    public function index()
    {
        cek_session_admin();
        $this->load->view('rekammedik_view');
    }

    function getjmlvalidasi()
    {
        $data = $this->rekammedik_model->getjmlvalidasi();
        echo json_encode($data);
    }

    function read()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $warning = isset($_POST['warning']) ? $_POST['warning'] : '';
        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
        $area = isset($_POST['area']) ? $_POST['area'] : '';
        $tgl1 = isset($_POST['tgl1']) ? $_POST['tgl1'] : '';
        $tgl2 = isset($_POST['tgl2']) ? $_POST['tgl2'] : '';
        $validate = isset($_POST['validate']) ? $_POST['validate'] : '';
        $subgrupid = isset($_POST['subgrupid']) ? $_POST['subgrupid'] : '';
        $unitid = isset($_POST['unitid']) ? $_POST['unitid'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->rekammedik_model->get_rekammedik($offset, $limit, $search, $warning, $jenis, $area, $tgl1, $tgl2, $validate, $subgrupid, $unitid);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            //$rows[$i]->keluhan_utama = $this->getkeluhanutama($r->id);
            if ($r->keluhan_utama != '') {
                $rows[$i]->datakeluhanutama = $this->getdataoptions($r->keluhan_utama);
            }
            if ($r->komplikasi_kemoterapi != '') {
                $rows[$i]->komplikasikemo = $this->getdataoptions($r->komplikasi_kemoterapi);
            }
            if ($r->evaluasi_pengobatan != '') {
                $rows[$i]->evaluasipengobatan = $this->getdataoptions($r->evaluasi_pengobatan);
            }
            if ($r->periksa_fisik != '') {
                $rows[$i]->periksafisik = $this->getdataoptions($r->periksa_fisik);
            }
            if ($r->plan != '') {
                $rows[$i]->dataplan = $this->getdataoptions($r->plan);
            }
            $i++;
        }
        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json
    }

    function readhistory()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $warning = isset($_POST['warning']) ? $_POST['warning'] : '';
        $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
        $area = isset($_POST['area']) ? $_POST['area'] : '';
        $tgl = isset($_POST['tgl1']) ? $_POST['tgl1'] : '';
        $tgl2 = isset($_POST['tgl2']) ? $_POST['tgl2'] : '';
        $validate = isset($_POST['validate']) ? $_POST['validate'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->rekammedik_model->readhistory($offset, $limit, $search, $warning, $jenis, $area, $tgl, $tgl2, $validate, $id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            //$rows[$i]->keluhan_utama = $this->getkeluhanutama($r->id);
            if ($r->keluhan_utama != '') {
                $rows[$i]->datakeluhanutama = $this->getdataoptions($r->keluhan_utama);
            }
            if ($r->komplikasi_kemoterapi != '') {
                $rows[$i]->komplikasikemo = $this->getdataoptions($r->komplikasi_kemoterapi);
            }
            if ($r->evaluasi_pengobatan != '') {
                $rows[$i]->evaluasipengobatan = $this->getdataoptions($r->evaluasi_pengobatan);
            }
            if ($r->periksa_fisik != '') {
                $rows[$i]->periksafisik = $this->getdataoptions($r->periksa_fisik);
            }
            if ($r->plan != '') {
                $rows[$i]->dataplan = $this->getdataoptions($r->plan);
            }
            $i++;
        }
        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json
    }

    function caripasien()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->rekammedik_model->caripasien($offset, $limit, $q);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json
    }

    function dataoptions()
    {
        $q = '';
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $data = $this->rekammedik_model->options($type, $q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    function save()
    {
        if (!isset($_POST))
            show_404();
        $result = $this->rekammedik_model->create();
        if ($result)
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('errorMsg' => 'Input Data Gagal'));
    }

    function update($id = null)
    {
        if (!isset($_POST))
            show_404();

        if ($this->rekammedik_model->update($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function validate($id = null)
    {
        if (!isset($_POST))
            show_404();

        if ($this->rekammedik_model->validate($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function delete()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->rekammedik_model->delete($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function getdataoptions($id)
    {
        $data = $this->rekammedik_model->getdataoptions($id);
        $i = 0;
        $rows   = array();
        foreach ($data  as $r) {
            $rows[$i] = $r->nama_options;
            $i++;
        }
        return $rows;
    }

    public function optionsubgrup()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->rekammedik_model->optionsubgrup($offset, $limit, $search, $q);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($rows); //return nya json
    }

    public function optionunit()
    {
        $q = '';
        $data = $this->rekammedik_model->optionunit($q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }
}
