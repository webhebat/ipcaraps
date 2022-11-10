<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aml extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('aml_model');
    }

    public function index()
    {
        cek_session_admin();
        $this->load->view('aml_view');
    }

    function no_aml()
    {
        $data = $this->aml_model->get_no_aml();
        echo json_encode($data);
    }

    function getjmlaml()
    {
        $data = $this->aml_model->getjmlaml();
        echo json_encode($data);
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
        $data   = $this->aml_model->caripasien($offset, $limit, $q);
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
        $data   = $this->aml_model->get_aml($offset, $limit, $search, $warning, $jenis, $area, $tgl, $tgl2, $validate);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $rows[$i]->keluhanpenyerta = $this->getdatapenyerta2($r->id);
            if ($r->pemeriksaan_fisik != '') {
                $rows[$i]->periksafisik = $this->getdataoptions($r->pemeriksaan_fisik);
            }
            if ($r->infeksi != '') {
                $rows[$i]->datainfeksi = $this->getdataoptions($r->infeksi);
            }
            if ($r->non_infeksi != '') {
                $rows[$i]->datanoninfeksi = $this->getdataoptions($r->non_infeksi);
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

    function readluaran()
    {

        $id = isset($_GET['amlid']) ? $_GET['amlid'] : '';

        $data   = $this->aml_model->get_luaran($id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $rows[$i]->tindakan = $this->gettatalaksana($r->tindakan);
            $rows[$i]->namatindakan = $this->namatindakan($r->idtindakan);
            if ($rows[$i]->date_complete != '0000-00-00') {
                $rows[$i]->tgl_status = $rows[$i]->date_complete;
            } else if ($rows[$i]->date_stable != '0000-00-00') {
                $rows[$i]->tgl_status = $rows[$i]->date_stable;
            } else if ($rows[$i]->date_relaps != '0000-00-00') {
                $rows[$i]->tgl_status = $rows[$i]->date_relaps;
            } else if ($rows[$i]->date_progresif != '0000-00-00') {
                $rows[$i]->tgl_status = $rows[$i]->date_progresif;
            }
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json

    }

    function gettatalaksana($id = null)
    {
        $id = isset($_GET['id']) ? $_GET['id'] : $id;

        $data = $this->aml_model->get_tatalaksana($id);
        $i  = 0;
        $rows   = array();
        foreach ($data as $r) {
            $rows[$i] = $r->tatalaksana;
            $rows[$i] = $r->id;
            $i++;
        }
        return $rows;
    }

    function namatindakan($id)
    {
        $data = $this->aml_model->get_tatalaksana2($id);
        $i  = 0;
        $rows   = array();
        foreach ($data as $r) {
            $rows[$i] = $r->tatalaksana;
            // $rows[$i] = $r->id;
            $i++;
        }
        return $rows;
    }


    function searchtumor()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
        //$kdmorfologi = isset($_POST['keymor']) ? $_POST['keymor'] : '';
        $offset = ($offset - 1) * $limit;
        $data   = $this->aml_model->caritumor($offset, $limit, $search, $kategori);
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

    public function options()
    {
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $data = $this->desa_model->getoptions($q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    public function optionkecamatan()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->desa_model->optionkecamatan($offset, $limit, $search, $q);
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

    function save()
    {
        if (!isset($_POST))
            show_404();

        $data1 = json_decode($this->input->get('datajson1'), true);
        $data2 = json_decode($this->input->get('datajson2'), true);
        $data3 = json_decode($this->input->get('datajson3'), true);
        if ($this->aml_model->simpan($data1, $data2, $data3))
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

        if ($this->aml_model->update($id, $data1, $data2, $data3))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function validate($id = null)
    {
        if (!isset($_POST))
            show_404();

        $data = json_decode($this->input->get('datajson'), true);
        $data2 = json_decode($this->input->get('datajson2'), true);

        if ($this->aml_model->validate($id, $data, $data2))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    public function delete()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->aml_model->delete($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function readkuratif()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $id = isset($_GET['id']) ? $_GET['id'] : '';
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
        $data   = $this->aml_model->get_kuratif($offset, $limit, $id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $rows[$i]->komplikasi_kemo = $this->getkomplikasi($r->id);
            if ($r->protokol != '') {
                $rows[$i]->dataprotokol = $this->getdataoptions($r->protokol);
            }
            if ($r->jenis_obat != '') {
                $rows[$i]->dataobat = $this->getdataoptions($r->jenis_obat);
            }
            if ($r->kelengkapan_kemo != '') {
                $rows[$i]->datakelengkapan_kemo = $this->getdataoptions($r->kelengkapan_kemo);
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

        $data1 = json_decode($this->input->get('datakomplikasi'), true);
        $data2 = json_decode($this->input->get('datasuportif'), true);
        $data3 = json_decode($this->input->get('datasiklus'), true);
        $data4 = json_decode($this->input->get('datadarah'), true);
        $data5 = json_decode($this->input->get('datajenis'), true);

        if ($this->aml_model->simpankuratif($data1, $data2, $data3, $data4, $data5))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function updatekuratif($id = NULL)
    {
        if (!isset($_POST))
            show_404();
        $data1 = json_decode($this->input->get('datakomplikasi'), true);
        $data2 = json_decode($this->input->get('datasuportif'), true);
        $data3 = json_decode($this->input->get('datasiklus'), true);
        $data4 = json_decode($this->input->get('datadarah'), true);
        $data5 = json_decode($this->input->get('datajenis'), true);
        if ($this->aml_model->updatekuratif($id, $data1, $data2, $data3, $data4, $data5))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function readrelaps()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $id = isset($_GET['id']) ? $_GET['id'] : '';
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
        $data = $this->aml_model->get_relaps($offset, $limit, $id);
        $i = 0;
        $rows = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json

    }

    function saverelaps()
    {
        if (!isset($_POST))
            show_404();

        $data1 = json_decode($this->input->get('datadarah'), true);
        $data2 = json_decode($this->input->get('datajenis'), true);

        if ($this->aml_model->simpanrelaps($data1, $data2))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function updaterelaps($id = NULL)
    {
        if (!isset($_POST))
            show_404();
        $data4 = json_decode($this->input->get('datadarah'), true);
        $data5 = json_decode($this->input->get('datajenis'), true);
        if ($this->aml_model->updaterelaps($id, $data4, $data5))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function readfollowup()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $id = isset($_GET['id']) ? $_GET['id'] : '';
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
        $data   = $this->aml_model->get_followup($offset, $limit, $id);
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

    function savefollowup()
    {
        if (!isset($_POST))
            show_404();

        $data1 = json_decode($this->input->get('datadarah'), true);
        $data2 = json_decode($this->input->get('datajenis'), true);

        if ($this->aml_model->simpanfollowup($data1, $data2))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function updatefollowup($id = NULL)
    {
        if (!isset($_POST))
            show_404();
        $data1 = json_decode($this->input->get('datadarah'), true);
        $data2 = json_decode($this->input->get('datajenis'), true);
        if ($this->aml_model->updatefollowup($id, $data1, $data2))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    public function deletefollowup()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->aml_model->deletefollowup($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function saveluaran()
    {
        if (!isset($_POST))
            show_404();
        if ($this->aml_model->createluaran())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal insert data'));
    }

    function updateluaran($id = null)
    {
        if (!isset($_POST))
            show_404();

        if ($this->aml_model->updateluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    public function deleteluaran()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->aml_model->deleteluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function diagnosis()
    {
        $q = '';
        $data = $this->aml_model->optdiagnosis($q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    function penyertalaiinya()
    {
        $q = '';
        $data = $this->aml_model->options('penyerta lainnya', $q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    function dataoptions()
    {
        $q = '';
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $data = $this->aml_model->options($type, $q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    function tatalaksana()
    {
        $q = '';
        $data = $this->aml_model->opttatalaksana($q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }


    function staging()
    {
        $q = '';
        $stagingid = $this->input->get('stagingid');
        $data = $this->aml_model->getstaging($stagingid);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    function getdatapenyerta()
    {
        $q = '';
        $spesifikid = $this->input->get('spesifikid');
        $data = $this->aml_model->getdatapenyerta($spesifikid);
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

    function getkomplikasi($id)
    {
        $data = $this->aml_model->getkomplikasi($id);
        $i = 0;
        $rows   = array();
        foreach ($data  as $r) {
            $rows[$i] = $r->nama_komplikasi;
            $i++;
        }
        return $rows;
    }

    // function getkelengkapan($id){
    //     $data = $this->aml_model->getkelengkapan($id);
    //     $i=0;
    //     $rows   = array(); 
    //     foreach ($data  as $r) {
    //         $rows[$i] = $r->nama_komplikasi;
    //      $i++;
    //     }
    //     return $rows;
    // }

    function getdatapenyerta2($id)
    {
        $data = $this->aml_model->getdatapenyerta2($id);
        $i = 0;
        $rows   = array();
        foreach ($data  as $r) {
            $rows[$i] = $r->keluhan_penyerta;
            $i++;
        }
        return $rows;
    }


    function getdataoptions($id)
    {
        $data = $this->aml_model->getdataoptions($id);
        $i = 0;
        $rows   = array();
        foreach ($data  as $r) {
            $rows[$i] = $r->nama_options;
            $i++;
        }
        return $rows;
    }

    function getdatakomplikasi($id = NULL)
    {
        $data = $this->aml_model->getdatakomplikasi($id);
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

    function getdatasuportif($id = NULL)
    {
        $data = $this->aml_model->getdatasuportif($id);
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

    function getdatasuportifsiklus($id = NULL)
    {
        $data = $this->aml_model->getdatasuportifsiklus($id);
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

    function getdatadarahkuratif($id = NULL)
    {
        $data = $this->aml_model->getdatadarahkuratif($id);
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

    function getdatajeniskuratif($id = NULL)
    {
        $data = $this->aml_model->getdatajeniskuratif($id);
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

    function getdarah()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $table = isset($_GET['table']) ? $_GET['table'] : '';
        $tableid = isset($_GET['tableid']) ? $_GET['tableid'] : '';
        $data = $this->aml_model->getdarah($table, $tableid, $id);
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
        $data = $this->aml_model->getjenis($table, $tableid, $id);
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

    function getdatadarah()
    {
        $q = '';
        $spesifikid = $this->input->get('spesifikid');
        $data = $this->aml_model->getdatadarah($spesifikid);
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

    function getdatajenis()
    {
        $q = '';
        $spesifikid = $this->input->get('spesifikid');
        $data = $this->aml_model->getdatajenis($spesifikid);
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

    function getdatadarahfollowup($id = NULL)
    {
        $data = $this->aml_model->getdatadarahfollowup($id);
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

    function getdatajenisfollowup($id = NULL)
    {
        $data = $this->aml_model->getdatajenisfollowup($id);
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
}
