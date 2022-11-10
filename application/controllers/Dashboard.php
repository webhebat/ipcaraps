<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_session_admin();
        /* $group = 'admin';
        if(!$this->ion_auth->in_group($group)){
            redirect(base_url('home'));
        }*/
        $this->load->model('dashboard_model');
    }

    public function index()
    {
        cek_session_admin();
        $this->load->view('dashboard_view');
    }

    function countdata()
    {
        $data = $this->dashboard_model->countdashboard();
        echo json_encode($data);
    }

    function showdata()
    {

        $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
        $subgrupid = isset($_GET['subgrupid']) ? $_GET['subgrupid'] : '';
        $jtanggal = isset($_GET['jtanggal']) ? $_GET['jtanggal'] : '';
        $tgl1 = isset($_GET['tgl1']) ? $_GET['tgl1'] : '';
        $tgl2 = isset($_GET['tgl2']) ? $_GET['tgl2'] : '';
        $unitid = isset($_GET['unitid']) ? $_GET['unitid'] : '';

        $data = $this->dashboard_model->getdashboard($kategori, $subgrupid, $jtanggal, $tgl1, $tgl2, $unitid);
        $level = 0;
        $i  = $sjumlah = 0;
        $color = NULL;
        $level++;
        $rows   = array();
        foreach ($data as $r) {

            $color = ($level == 1) ? $i : $v_color_parent;
            //array keys ini = attribute 'field' di view nya
            //$rows[$i] = $r;
            $categories[$i] = $r->kategori;
            $v_data['rows'][$i]['id'] = $r->id;
            $v_data['rows'][$i]['kategori'] = $r->kategori;
            $v_data['rows'][$i]['jumlah'] = (float)$r->jumlah;
            $sjumlah += (float)$r->jumlah;

            if ($i < 10) {
                $ar_color = array("#7cb5ec", "#434348", "#90ed7d", "#f7a35c", "#8085e9", "#f15c80", "#e4d354", "#8085e8", "#8d4653", "#91e8e1");
                $v_items[$i] = array(
                    'y' => (float)$r->jumlah,
                    //'color'=>"colors[".$color."]",
                    'color' => $ar_color[$color],
                    'drilldown' => null
                );
            }

            //echo $r->kategori;

            $i++;
        }

        $str = '';
        if ($i > 10) {
            $str = '10 BESAR ';
        }

        $pasien = $this->dashboard_model->countdashboard($kategori, $subgrupid, $jtanggal, $tgl1, $tgl2,$unitid);

        //keys total & rows wajib bagi jEasyUI

        $result = array('categories' => $categories, 'data' => $v_data, 'items' => $v_items, 'str' => $str, 'pasien' => $pasien, 'tgl1' => $tgl1);

        echo json_encode($result); //return nya json
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
        $data   = $this->dashboard_model->optionsubgrup($offset, $limit, $search, $q);
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
        $data = $this->dashboard_model->optionunit($q);
        $i = 0;

        foreach ($data as $fields) {
            $result[$i] = $fields;
            $i++;
        }
        echo json_encode($result);
    }
}
