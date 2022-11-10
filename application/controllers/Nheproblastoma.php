<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nheproblastoma extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('nheproblastoma_model');
    }

    public function index()
    {
        cek_session_admin();
        $this->load->view('nheproblastoma_view');
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
        $tgl = isset($_POST['tglprediksi']) ? $_POST['tglprediksi'] : '';
        $tgl2 = isset($_POST['tglprediksi2']) ? $_POST['tglprediksi2'] : '';
        $validate = isset($_POST['validate']) ? $_POST['validate'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->nheproblastoma_model->get_data($offset, $limit, $search, $warning, $jenis, $area, $tgl, $tgl2, $validate);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $rows[$i]->keluhanpenyerta = $this->getdatapenyerta2($r->id);
            if ($r->pemeriksaan_fisik != '') {
                $rows[$i]->periksafisik = $this->getdataoptions($r->pemeriksaan_fisik);
            }
            if ($r->optpaliatif != '') {
                $rows[$i]->datapaliatif = $this->getdataoptions($r->optpaliatif);
            }
            if ($r->optpain != '') {
                $rows[$i]->datapain = $this->getdataoptions($r->optpain);
            }
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json

    }

    function getdataoptions($id)
    {
        $data = $this->nheproblastoma_model->getdataoptions($id);
        $i = 0;
        $rows   = array();
        foreach ($data  as $r) {
            $rows[$i] = $r->nama_options;
            $i++;
        }
        return $rows;
    }

    function getdatapenyerta()
    {
        $q = '';
        $spesifikid = $this->input->get('spesifikid');
        $data = $this->nheproblastoma_model->getdatapenyerta($spesifikid);
        $i = 0;

        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json
        //echo json_encode($result);
    }

    function getdatapenyerta2($id)
    {
        $data = $this->nheproblastoma_model->getdatapenyerta2($id);
        $i = 0;
        $rows   = array();
        foreach ($data  as $r) {
            $rows[$i] = $r->keluhan_penyerta;
            $i++;
        }
        return $rows;
    }

    function getdarah()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $table = isset($_GET['table']) ? $_GET['table'] : '';
        $tableid = isset($_GET['tableid']) ? $_GET['tableid'] : '';
        $data = $this->nheproblastoma_model->getdarah($table, $tableid, $id);
        $i = 0;

        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $i++;
        }
        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json
        //echo json_encode($result);
    }

    function getjenis()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $table = isset($_GET['table']) ? $_GET['table'] : '';
        $tableid = isset($_GET['tableid']) ? $_GET['tableid'] : '';
        $data = $this->nheproblastoma_model->getjenis($table, $tableid, $id);
        $i = 0;

        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $i++;
        }
        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json
        //echo json_encode($result);
    }

    public function selectspesifik()
    {
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset - 1) * $limit;

        $data = $this->nheproblastoma_model->selectnhepro($offset, $limit, $search);

        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            //$rows[$i]->usiadiagnosis = $this->thaller_model->gettgldiagnosis($r->id);
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
        $data = $this->nheproblastoma_model->options($type, $q);
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

        $data1 = json_decode($this->input->get('datajson1'), true);
        $data2 = json_decode($this->input->get('datajson2'), true);
        $data3 = json_decode($this->input->get('datajson3'), true);
        if ($this->nheproblastoma_model->simpan($data1, $data2, $data3))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function update($id = null)
    {
        if (!isset($_POST))
            show_404();

        $data1 = json_decode($this->input->get('datajson1'), true);
        $data2 = json_decode($this->input->get('datajson2'), true);
        $data3 = json_decode($this->input->get('datajson3'), true);

        if ($this->nheproblastoma_model->update($id, $data1, $data2, $data3))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function readkuratif()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        // $search = isset($_POST['search']) ? $_POST['search'] : '';
        // $warning = isset($_POST['warning']) ? $_POST['warning'] : '';
        // $jenis = isset($_POST['jenis']) ? $_POST['jenis'] : '';
        // $area = isset($_POST['area']) ? $_POST['area'] : '';
        // $tgl = isset($_POST['tglprediksi']) ? $_POST['tglprediksi'] : '';
        // $tgl2 = isset($_POST['tglprediksi2']) ? $_POST['tglprediksi2'] : '';
        // $validate = isset($_POST['validate']) ? $_POST['validate'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->nheproblastoma_model->get_kuratif($offset, $limit, $id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            //$rows[$i]->komplikasi_kemo = $this->getkomplikasi($r->id);
            if ($r->protokol != '') {
                $rows[$i]->dataprotokol = $this->getdataoptions($r->protokol);
            }
            if ($r->efeksamping != '') {
                $rows[$i]->dataefeksamping = $this->getdataoptions($r->efeksamping);
            }
            if ($r->terapisuportif != '') {
                $rows[$i]->datasuportif = $this->getdataoptions($r->terapisuportif);
            }
            if ($r->lokasiradioterapi != '') {
                $rows[$i]->datalokasiradioterapi = $this->getdataoptions($r->lokasiradioterapi);
            }
            if ($r->metoderadioterapi != '') {
                $rows[$i]->datametoderadioterapi = $this->getdataoptions($r->metoderadioterapi);
            }
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json

    }

    function savekuratif()
    {
        if (!isset($_POST))
            show_404();

        if ($this->nheproblastoma_model->simpankuratif())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function updatekuratif($id = NULL)
    {
        if (!isset($_POST))
            show_404();
        if ($this->nheproblastoma_model->updatekuratif($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function readluaran()
    {

        $id = isset($_GET['id']) ? $_GET['id'] : '';

        $data   = $this->nheproblastoma_model->get_luaran($id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            if ($r->regresi != '') {
                $rows[$i]->dataregresi = $this->getdataoptions($r->regresi);
            }
            if ($r->regresi2 != '') {
                $rows[$i]->dataregresi2 = $this->getdataoptions($r->regresi2);
            }

            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json
    }

    function saveluaran()
    {
        if (!isset($_POST))
            show_404();
        if ($this->nheproblastoma_model->createluaran())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal insert data'));
    }

    function updateluaran($id = null)
    {
        if (!isset($_POST))
            show_404();

        if ($this->nheproblastoma_model->updateluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    public function deleteluaran()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->nheproblastoma_model->deleteluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }
}
