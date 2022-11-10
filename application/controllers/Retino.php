<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retino extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('retino_model');
    }

    public function index()
    {
        cek_session_admin();
        $this->load->view('retino_view');
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
        $data   = $this->retino_model->get_retino($offset, $limit, $search, $warning, $jenis, $area, $tgl, $tgl2, $validate);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            // $rows[$i]->keluhanpenyerta = $this->getdatapenyerta2($r->id);
            if ($r->presentasi_klinis != '') {
                $rows[$i]->presentasiklinis = $this->getdataoptions($r->presentasi_klinis);
            }
            if ($r->keluhan_penyerta != '') {
                $rows[$i]->penyerta = $this->getdataoptions($r->keluhan_penyerta);
            }
            if ($r->riwayat_prenatal != '') {
                $rows[$i]->prenatal = $this->getdataoptions($r->riwayat_prenatal);
            }
            if ($r->pemeriksaan_klinis != '') {
                $rows[$i]->data_klinis = $this->getdataoptions($r->pemeriksaan_klinis);
            }
            if ($r->pemeriksaan_klinis2 != '') {
                $rows[$i]->data_klinis2 = $this->getdataoptions($r->pemeriksaan_klinis2);
            }
            if ($r->pemeriksaan_slitlamp != '') {
                $rows[$i]->data_slitlamp = $this->getdataoptions($r->pemeriksaan_slitlamp);
            }
            if ($r->pemeriksaan_slitlamp2 != '') {
                $rows[$i]->data_slitlamp2 = $this->getdataoptions($r->pemeriksaan_slitlamp2);
            }
            if ($r->pem_posterior != '') {
                $rows[$i]->data_posterior = $this->getdataoptions($r->pem_posterior);
            }
            if ($r->pem_posterior_kiri != '') {
                $rows[$i]->data_posterior2 = $this->getdataoptions($r->pem_posterior_kiri);
            }
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json

    }

    function getdataoptions($id)
    {
        $data = $this->retino_model->getdataoptions($id);
        $i = 0;
        $rows   = array();
        foreach ($data  as $r) {
            $rows[$i] = $r->nama_options;
            $i++;
        }
        return $rows;
    }

    function caripasien()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $q = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->retino_model->caripasien($offset, $limit, $q);
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

        if ($this->retino_model->simpan())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function update($id = null)
    {
        if (!isset($_POST))
            show_404();

        if ($this->retino_model->update($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    public function delete()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->retino_model->delete($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function dataoptions()
    {
        $q = '';
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $data = $this->retino_model->options($type, $q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
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
        $data   = $this->retino_model->read_kuratif($offset, $limit, $id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            // $rows[$i]->komplikasi_kemo = $this->getkomplikasi($r->id);
            if ($r->ekstraokular_kanan != '') {
                $rows[$i]->dataekstraokular_kanan = $this->getdataoptions($r->ekstraokular_kanan);
            }
            if ($r->ekstraokular_kiri != '') {
                $rows[$i]->dataekstraokular_kiri = $this->getdataoptions($r->ekstraokular_kiri);
            }
            if ($r->opt_radioterapi_kanan != '') {
                $rows[$i]->dataradioterapi_kanan = $this->getdataoptions($r->opt_radioterapi_kanan);
            }
            if ($r->opt_radioterapi_kiri != '') {
                $rows[$i]->dataradioterapi_kiri = $this->getdataoptions($r->opt_radioterapi_kiri);
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

        if ($this->retino_model->simpankuratif())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function updatekuratif($id = NULL)
    {
        if (!isset($_POST))
            show_404();
        if ($this->retino_model->updatekuratif($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function deletekuratif()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->retino_model->deletekuratif($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function readluaran()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->retino_model->read_luaran($offset, $limit, $id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            // $rows[$i]->komplikasi_kemo = $this->getkomplikasi($r->id);
            if ($r->tipe_regresi_kanan != '') {
                $rows[$i]->dataregresi_kanan = $this->getdataoptions($r->tipe_regresi_kanan);
            }
            if ($r->tipe_regresi_kiri != '') {
                $rows[$i]->dataregresi_kiri = $this->getdataoptions($r->tipe_regresi_kiri);
            }
            if ($r->opt_komplikasi_kanan != '') {
                $rows[$i]->datakomplikasi_kanan = $this->getdataoptions($r->opt_komplikasi_kanan);
            }
            if ($r->opt_komplikasi_kiri != '') {
                $rows[$i]->datakomplikasi_kiri = $this->getdataoptions($r->opt_komplikasi_kiri);
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

        if ($this->retino_model->simpanluaran())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function updateluaran($id = NULL)
    {
        if (!isset($_POST))
            show_404();
        if ($this->retino_model->updateluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function deleteluaran()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->retino_model->deleteluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function readfollowup()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->retino_model->read_followup($offset, $limit, $id);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            // $rows[$i]->komplikasi_kemo = $this->getkomplikasi($r->id);

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

        if ($this->retino_model->simpanfollowup())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function updatefollowup($id = NULL)
    {
        if (!isset($_POST))
            show_404();
        if ($this->retino_model->updatefollowup($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    function deletefollowup()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->retino_model->deletefollowup($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }
}
