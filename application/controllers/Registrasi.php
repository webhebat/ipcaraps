<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('registrasi_model');
    }

    public function index()
    {
        cek_session_admin();
        $this->load->view('registrasi_view');
    }

    function getdatediagnosis()
    {
        $result = $this->registrasi_model->gettgldiagnosis(13);
        echo json_encode($result); //return nya json
    }

    function read()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $validasi = isset($_POST['validasi']) ? $_POST['validasi'] : '';
        $luaran = isset($_POST['luaran']) ? $_POST['luaran'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $unitid = isset($_POST['unitid']) ? $_POST['unitid'] : '';
        $subgrupid = isset($_POST['subgrupid']) ? $_POST['subgrupid'] : '';
        $tgl = isset($_POST['tglregistrasi']) ? $_POST['tglregistrasi'] : '';
        $tgl2 = isset($_POST['tglregistrasi2']) ? $_POST['tglregistrasi2'] : '';
        $tgldiagnosis = isset($_POST['tgldiagnosis']) ? $_POST['tgldiagnosis'] : '';
        $tgldiagnosis2 = isset($_POST['tgldiagnosis2']) ? $_POST['tgldiagnosis2'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->get_registrasi($offset, $limit, $search, $validasi, $unitid, $tgl, $tgl2, $luaran, $status, $subgrupid, $tgldiagnosis, $tgldiagnosis2);
        $i  = 0;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            $rows[$i] = $r;
            $rows[$i]->usiadiagnosis = $this->registrasi_model->gettgldiagnosis($r->id);
            //$rows[$i]->diagnosis = $this->registrasi_model->getnamadiagnosis($r->id);
            $i++;
        }

        //keys total & rows wajib bagi jEasyUI
        $result = array('total' => $data['count'], 'rows' => $rows);
        echo json_encode($result); //return nya json

    }

    function readluaran()
    {

        $id = isset($_GET['registrasiid']) ? $_GET['registrasiid'] : '';

        $data   = $this->registrasi_model->get_luaran($id);
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

        $data = $this->registrasi_model->get_tatalaksana($id);
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
        $data = $this->registrasi_model->get_tatalaksana2($id);
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
        $data   = $this->registrasi_model->caritumor($offset, $limit, $search, $kategori);
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
        $data = json_decode($this->input->get('datajson'), true);
        $data2 = json_decode($this->input->get('datajson2'), true);
        if ($this->registrasi_model->simpan($data, $data2))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal memasukkan data'));
    }

    function update($id = null)
    {
        if (!isset($_POST))
            show_404();

        $data = json_decode($this->input->get('datajson'), true);
        $data2 = json_decode($this->input->get('datajson2'), true);

        if ($this->registrasi_model->update($id, $data, $data2))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    public function delete()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->registrasi_model->delete($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function saveluaran()
    {
        if (!isset($_POST))
            show_404();
        if ($this->registrasi_model->createluaran())
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal insert data'));
    }

    function updateluaran($id = null)
    {
        if (!isset($_POST))
            show_404();

        if ($this->registrasi_model->updateluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal mengubah data'));
    }

    public function deleteluaran()
    {
        if (!isset($_POST))
            show_404();

        $id = intval(addslashes($_POST['id']));
        if ($this->registrasi_model->deleteluaran($id))
            echo json_encode(array('success' => true));
        else
            echo json_encode(array('msg' => 'Gagal menghapus data'));
    }

    function propinsi()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->opt_propinsi($offset, $limit, $search, $q);
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

    function kabupaten()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset - 1) * $limit;
        $propid = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->opt_kabupaten($offset, $limit, $search, $q, $propid);
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

    function kecamatan()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset - 1) * $limit;
        $kabid = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->opt_kecamatan($offset, $limit, $search, $q, $kabid);
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

    function desa()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $q = isset($_POST['q']) ? $_POST['q'] : '';
        $offset = ($offset - 1) * $limit;
        $camatid = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->opt_desa($offset, $limit, $search, $q, $camatid);
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

    function diagnosis()
    {
        $q = '';
        $data = $this->registrasi_model->optdiagnosis($q);
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
        $data = $this->registrasi_model->opttatalaksana($q);
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
        $data = $this->registrasi_model->getstaging($stagingid);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    function getdatariwayat()
    {
        $q = '';
        $registrasiid = $this->input->get('registrasiid');
        $data = $this->registrasi_model->getdatariwayat($registrasiid);
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

    function getdatadiagnosis()
    {
        $q = '';
        $registrasiid = $this->input->get('registrasiid');
        $data = $this->registrasi_model->getdatadiagnosis($registrasiid);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }

    public function optionunit()
    {
        $q = '';
        $data = $this->registrasi_model->optionunit($q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
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
        $data   = $this->registrasi_model->optionsubgrup($offset, $limit, $search, $q);
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

    public function optionmorfologi()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $kodesubgrup = isset($_POST['kodesubgrup']) ? $_POST['kodesubgrup'] : '';
        $q = isset($_POST['search']) ? $_POST['search'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->optionmorfologi($offset, $limit, $search, $q, $kodesubgrup);
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

    public function optiontopografi()
    {
        /*Default request pager params dari jeasyUI*/
        $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $kodesubgrup = isset($_GET['kodesubgrup']) ? $_GET['kodesubgrup'] : '';
        $q = isset($_GET['search']) ? $_GET['search'] : '';
        $offset = ($offset - 1) * $limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->optiontopografi($offset, $limit, $search, $q, $kodesubgrup);
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

    public function export()
    {
        /*Default request pager params dari jeasyUI*/
        /*Default request pager params dari jeasyUI*/
        $offset = ''; //isset($_POST['page']) ? intval($_POST['page']) : 1;
        $limit  = ''; //isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $search = $this->input->get('search');
        $tgl = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');
        $tgldiagnosis = $this->input->get('tgldiagnosis');
        $tgldiagnosis2 = $this->input->get('tgldiagnosis2');
        $validasi = $this->input->get('validasi');
        $luaran = $this->input->get('luaran');
        $status = $this->input->get('status');
        $unitid = $this->input->get('unitid');
        $subgrupid = $this->input->get('subgrupid');
        //$offset = ($offset-1)*$limit;
        //$id = $this->uri->segment(3);
        //$search2 = $this->uri->segment(4);
        $data   = $this->registrasi_model->get_registrasi($offset, $limit, $search, $validasi, $unitid, $tgl, $tgl2, $luaran, $status, $subgrupid, $tgldiagnosis, $tgldiagnosis2);

        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //$objSet = $this->setActiveSheetIndex(0);
        $objGet = $this->excel->getActiveSheet();
        //name the worksheet
        $objGet->setTitle('Registrasi Pasien');
        //set cell A1 content with some text
        /* $this->excel->getActiveSheet()->setCellValue('A2', 'Kode Unit')
                                      ->setCellValue('B2', 'Unit')
                                      ->setCellValue('C2', 'Outlet');*/

        $heading = array('No Regisrasi', 'Nama Lengkap', 'NIK', 'Tempat,Tgl Lahir', 'JKelamin', 'Usia Terdiagnosis', 'Alamat', 'Propinsi', 'Kabupaten', 'Kecamatan', 'Desa', 'No Rekam Medis', 'No HP', 'No HP 2', 'No BPJS', 'BB', 'TB', 'Kesimpulan', 'Subgrup', 'Morfologi', 'Topografi', 'Literalitas', 'Rujukan', 'PPK1', 'Tgl PPK1', 'PPK2', 'Tgl PPK2', 'PPK3', 'Tgl PPK3', 'Tgl Pertama Konsultasi', 'Dasar Diagnosis', 'Berat Lahir', 'Umunisasi', 'ASI Eksklusif', 'Riwayat Keluarga', 'Tata Laksana', 'Staging/Stadium');
        //Loop Heading
        $rowNumberH = 2;
        $colH = 'A';
        foreach ($heading as $h) {
            $objGet->setCellValue($colH . $rowNumberH, $h);
            $objGet->getColumnDimension($colH)->setAutoSize(true);
            $colH++;
        }

        $i  = 3;
        $rows   = array();
        foreach ($data['data'] as $r) {
            //array keys ini = attribute 'field' di view nya
            //$rows[$i] = $r;
            $beratlahir = $r->berat_lahir;
            $imunisasi = ($r->imunisasi == 'imunisasi_t') ? "tidak" : (($r->imunisasi == 'imunisasi_y') ? "ya" : "-");
            $asi = (($r->asi == 'asi_t') ? "tidak" : ($r->asi == 'asi_d')) ? "dalam masa asi" : (($r->asi == 'asi_y') ? "ya" : "-");
            //echo $bar; // display 2 instead of 1
            $this->excel->getActiveSheet()->setCellValue('A' . $i, $r->noregistrasi)
                ->setCellValue('B' . $i, $r->nama)
                ->setCellValue('C' . $i, $r->nik)
                ->setCellValue('D' . $i, $r->ttl)
                ->setCellValue('E' . $i, $r->jkelamin)
                ->setCellValue('F' . $i, $this->registrasi_model->gettgldiagnosis($r->id))
                ->setCellValue('G' . $i, $r->alamat)
                ->setCellValue('H' . $i, $r->propinsi)
                ->setCellValue('I' . $i, $r->kabupaten)
                ->setCellValue('J' . $i, $r->kecamatan)
                ->setCellValue('K' . $i, $r->desa)
                ->setCellValue('L' . $i, $r->no_rekam)
                ->setCellValue('M' . $i, $r->no_hp)
                ->setCellValue('N' . $i, $r->no_hp2)
                ->setCellValue('O' . $i, $r->no_bpjs)
                ->setCellValue('P' . $i, $r->bb)
                ->setCellValue('Q' . $i, $r->tb)
                ->setCellValue('R' . $i, $r->kesimpulan)
                ->setCellValue('S' . $i, $r->subgrup)
                ->setCellValue('T' . $i, $r->morfologi)
                ->setCellValue('U' . $i, $r->topografi)
                ->setCellValue('V' . $i, $r->literalitas)
                ->setCellValue('W' . $i, $r->riwayat_rujukan)
                ->setCellValue('X' . $i, $r->ppk1)
                ->setCellValue('Y' . $i, $r->tgl_ppk1)
                ->setCellValue('Z' . $i, $r->ppk2)
                ->setCellValue('AA' . $i, $r->tgl_ppk2)
                ->setCellValue('AB' . $i, $r->ppk3)
                ->setCellValue('AC' . $i, $r->tgl_ppk3)
                ->setCellValue('AD' . $i, $r->tgl_konsultasi)
                ->setCellValue('AE' . $i, $this->registrasi_model->getnamadiagnosis($r->id))
                ->setCellValue('AF' . $i, $beratlahir)
                ->setCellValue('AG' . $i, $imunisasi)
                ->setCellValue('AH' . $i, $asi)
                ->setCellValue('AI' . $i, $this->registrasi_model->getriwayat($r->id))
                ->setCellValue('AJ' . $i, $this->registrasi_model->gettatalaksana($r->tatalaksanaid))
                ->setCellValue('AK' . $i, $this->registrasi_model->getstatusstaging($r->stagingid));
            //$rows[$i]->siswa_waktu = $this->getjatuhtempo($r->tgl_jatuh_tempo,$tgl);
            //$rows[$i]->warning = $this->warning($r->tgl_jatuh_tempo,$tgl);
            $i++;
        }

        $objGet->getStyle("A2:AK2")->applyFromArray(
            array(
                "fill" => array(
                    "type" => PHPExcel_Style_Fill::FILL_SOLID,
                    "color" => array("rgb" => "2c3e50")
                ),
                "font" => array(
                    "color" => array("rgb" => "ecf0f1")
                )
            )
        );
        //change the font size
        //$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $objGet->getStyle('A2:AK2')->getFont()->setBold(true);
        //merge cell A1 until D1
        // $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $filename = 'registrasi-pasien.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        //force user to download the Excel file without writing it to server's HD
        ob_end_clean();
        $objWriter->save('php://output');
    }
}
