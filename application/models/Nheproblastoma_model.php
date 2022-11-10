<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nheproblastoma_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data($offset, $limit, $search, $warning, $jenis, $area, $tgl, $tgl2, $validate)
    {

        $where = '';

        if ($search) {
            $where .= " AND (R.nama like '%" . $search . "%')";
        }

        $whereadm1 =  '';

        $unitid = $this->session->userdata('unitid');
        $grupid = $this->session->userdata('grupid');

        //jika login selain admin pusat
        if ($unitid == '1' && $grupid == '1') {
            $whereadm1 = '';
        } elseif ($unitid == '1' && $grupid == '3') {
            $whereadm1 = '';
        } else {
            $whereadm1 = " AND R.unitid = '$unitid' ";
        }

        $sql = "SELECT RS.*,R.noregistrasi,R.nama,R.nik,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl,R.jenis_kelamin,R.no_rekam, R.no_hp,R.no_hp2,O.nama_options as keluhan, R.unitid, U.nama_unit FROM nheproblastoma RS 
        LEFT JOIN registrasi R on R.id= RS.registrasiid 
        LEFT JOIN options O on RS.keluhan_utama= O.id
        LEFT JOIN unit U ON U.id = R.unitid 
        WHERE RS.deleted ='n' $where $whereadm1 ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if ($limit) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function getdataoptions($id)
    {
        $sql = "SELECT nama_options FROM options where id in ($id) ";
        return $this->db->query($sql)->result();
    }

    public function getdatapenyerta($spesifikid)
    {
        $sql = "SELECT * FROM nheproblastoma_penyerta where nheproblastomaid = $spesifikid";

        $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;

        //return $result = $this->db->query($sql)->result();      
    }

    public function getdatapenyerta2($spesifikid)
    {
        $sql = "SELECT keluhan_penyerta FROM nheproblastoma_penyerta where nheproblastomaid = $spesifikid ";

        return $this->db->query($sql)->result();
    }

    public function selectnhepro($offset, $limit, $search)
    {
        $unitid = $this->session->userdata('unitid');
        $where = '';

        if ($search) {
            $where .= " AND (R.nama like '%" . $search . "%' or R.noregistrasi like '%" . $search . "%' or R.nik like '%" . $search . "%' or R.alamat like '%" . $search . "%')";
        }

        $sql = "SELECT R.id, R.nama,R.alamat,R.nik,R.noregistrasi,R.no_hp,R.no_rekam, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END AS jkelamin, CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl from registrasi R WHERE 1 AND R.subgrupid = '19' AND R.unitid = $unitid AND R.deleted ='n' AND R.validate = 'y' AND R.spesifik = 'n'  $where ";

        $result['count'] = $this->db->query($sql)->num_rows();

        if ($limit) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function options($type, $q)
    {
        $this->db->where('deleted', 'n');
        $this->db->where('type', $type);
        $query = $this->db->get('options');
        return $query->result();
    }

    public function simpan($detail1, $detail2, $detail3)
    {

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        // $jkelamin = $this->input->post('jenis_kelamin');
        // if($jkelamin=='l'){
        //     $j=1;
        // }else{
        //     $j=2;
        // }
        $p1 = $this->input->post('lokasi1', true);
        if ($p1 == '1') {
            $p1 = '1';
        } else {
            $p1 = '0';
        }
        $n1 = $this->input->post('lokasi2', true);
        if ($n1 == '1') {
            $n1 = '1';
        } else {
            $n1 = '0';
        }

        $l1 = $this->input->post('lokasi3', true);
        if ($l1 == '1') {
            $l1 = '1';
        } else {
            $l1 = '0';
        }

        $data = array(
            'registrasiid' => $this->input->post('registrasiid', true),
            'keluhan_utama' => $this->input->post('keluhan_utama', true),
            'keluhan_utama_lainnya' => $this->input->post('keluhan_utama_lainnya', true),
            'thn_keluhan' => $this->input->post('thn_keluhan', true),
            'bln_keluhan' => $this->input->post('bln_keluhan', true),
            'hari_keluhan' => $this->input->post('hari_keluhan', true),
            'durasi_penyakit' => $this->input->post('durasi_penyakit', true),
            'lokasi1' => $p1,
            'lokasi2' => $n1,
            'lokasi3' => $l1,
            'pemeriksaan_fisik' => ltrim($this->input->get('fisik', true), ','),
            'pemeriksaan_fisik_lainnya' => $this->input->post('pemeriksaan_fisik_lainnya', true),
            'keluhan_penyerta_lainnya' => $this->input->post('keluhan_penyerta_lainnya', true),
            'besar_hepar' => $this->input->post('besar_hepar', true),
            'besar_spleen' => $this->input->post('besar_spleen', true),
            'besar_schuffner' => $this->input->post('besar_schuffner', true),
            'bimanual_ginjal' => $this->input->post('bimanual_ginjal', true),
            'nama_limfadenopati' => $this->input->post('nama_limfadenopati', true),
            'sindrom_penyerta_lainnya' => $this->input->post('sindrom_penyerta_lainnya', true),
            'tanner_stage' => $this->input->post('tanner_stage', true),
            'tgl_periksadarah' => $this->input->post('tgl_periksadarah', true),
            'tgl_periksa_urine' => $this->input->post('tgl_periksa_urine', true),
            'warna_urine' => $this->input->post('warna_urine', true),
            'berat_jenis' => $this->input->post('berat_jenis', true),
            'eritrosit' => $this->input->post('eritrosit', true),
            'leukosit' => $this->input->post('leukosit', true),
            'albumin' => $this->input->post('albumin', true),
            'glukosa' => $this->input->post('glukosa', true),
            'bilirubin' => $this->input->post('bilirubin', true),
            'usg' => $this->input->post('usg', true),
            'tgl_usg' => $this->input->post('tgl_usg', true),
            'massa_primer' => $this->input->post('massa_primer', true),
            'ukuran_primer' => $this->input->post('ukuran_primer', true),
            'konsistensi_massa' => $this->input->post('konsistensi_massa', true),
            'kgb' => $this->input->post('kgb', true),
            'metastasis_usg' => $this->input->post('metastasis_usg', true),
            'metastasis_usg_ket' => $this->input->post('metastasis_usg_ket', true),
            'usg_dropler' => $this->input->post('usg_dropler', true),
            'ket_usg' => $this->input->post('ket_usg', true),
            'ctscan' => $this->input->post('ctscan', true),
            'tgl_ctscan' => $this->input->post('tgl_ctscan', true),
            'lokasi_primer_ctscan' => $this->input->post('lokasi_primer_ctscan', true),
            'ukuran_ctscan' => $this->input->post('ukuran_ctscan', true),
            'kgb_ctscan' => $this->input->post('kgb_ctscan', true),
            'pelvokalises' => $this->input->post('pelvokalises', true),
            'metastasis_ctscan' => $this->input->post('metastasis_ctscan', true),
            'ket_metastasis_ctscan' => $this->input->post('ket_metastasis_ctscan', true),
            'ket_ctscan' => $this->input->post('ket_ctscan', true),
            'tgl_histopatologi' => $this->input->post('tgl_histopatologi', true),
            'histopatologi' => $this->input->post('histopatologi', true),
            'molekular' => $this->input->post('molekular', true),
            'opt_molekular' => ltrim($this->input->get('opt_molekular', true), ','),
            'nwts' => $this->input->post('nwts', true),
            'siop' => $this->input->post('siop', true),
            'stratifikasi' => ltrim($this->input->get('stratifikasi', true), ','),
            'diagnosis_infeksi' => $this->input->post('diagnosis_infeksi', true),
            'diagnosis_noninfeksi' => $this->input->post('diagnosis_noninfeksi', true),
            'kuratif' => $this->input->post('kuratif', true),
            'nonkuratif' => $this->input->post('nonkuratif', true),
            'alasan_tidak_lainnya' => $this->input->post('alasan_tidak_lainnya', true),
            'paliatif' => $this->input->post('paliatif', true),
            'optpaliatif' => ltrim($this->input->get('optpaliatif', true), ','),
            'optpain' => ltrim($this->input->get('optpain', true), ','),
            'pain_lainnya' => $this->input->post('pain_lainnya', true),
            'obat_kemo' => $this->input->post('obat_kemo', true),
            'tgl_mulaikemo' => $this->input->post('tgl_mulaikemo', true),
            'tgl_selesaikemo' => $this->input->post('tgl_selesaikemo', true),
            'jml_siklus' => $this->input->post('jml_siklus', true),
            'lokasi_radioterapi' => $this->input->post('lokasi_radioterapi', true),
            'radioterapi_lainnya' => $this->input->post('radioterapi_lainnya', true),
            'lokasi_operasi' => $this->input->post('lokasi_operasi', true),
            'operasi_lainnya' => $this->input->post('operasi_lainnya', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );

        $this->db->insert('nheproblastoma', $data);
        $regspesifik_id = $this->db->insert_id();
        //return true;
        if (count($detail1) != 0) {
            $result = array();
            for ($i = 0; $i < count($detail1); $i++) {

                $result[] = array(
                    'nheproblastomaid' => $regspesifik_id,
                    'penyertaid' => $detail1[$i]['penyertaid'],
                    'keluhan_penyerta' => $detail1[$i]['keluhan_penyerta'],
                    'tanggal' => $detail1[$i]['tanggal'],
                );
            }
            $this->db->insert_batch('nheproblastoma_penyerta', $result);
        }

        if (count($detail2) != 0) {

            $result2 = array();
            for ($x = 0; $x < count($detail2); $x++) {
                $result2[] = array(
                    'nheproblastomaid' => $regspesifik_id,
                    'darah' => $detail2[$x]['nama_options'],
                    'jml' => isset($detail2[$x]['jml']) ? $detail2[$x]['jml'] : '',
                    'ket' => $detail2[$x]['ket'],
                );
            }
            $this->db->insert_batch('nheproblastoma_darah', $result2);
        }

        if (count($detail3) != 0) {

            $result3 = array();
            for ($y = 0; $y < count($detail3); $y++) {
                $result3[] = array(
                    'nheproblastomaid' => $regspesifik_id,
                    'nama_jenis' => $detail3[$y]['nama_options'],
                    'jml' => isset($detail3[$y]['jml']) ? $detail3[$y]['jml'] : '',
                    'ket' => $detail3[$y]['ket'],
                );
            }
            $this->db->insert_batch('nheproblastoma_jenis', $result3);
        }

        $this->db->where('id', $this->input->post('registrasiid', true));
        $this->db->update('registrasi', array('spesifik' => 'y'));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update($id, $detail1, $detail2, $detail3)
    {
        $p1 = $this->input->post('lokasi1', true);
        if ($p1 == '1') {
            $p1 = '1';
        } else {
            $p1 = '0';
        }
        $n1 = $this->input->post('lokasi2', true);
        if ($n1 == '1') {
            $n1 = '1';
        } else {
            $n1 = '0';
        }
        $l1 = $this->input->post('lokasi3', true);
        if ($l1 == '1') {
            $l1 = '1';
        } else {
            $l1 = '0';
        }

        $this->db->trans_begin();

        $data = array(
            'keluhan_utama' => $this->input->post('keluhan_utama', true),
            'keluhan_utama_lainnya' => $this->input->post('keluhan_utama_lainnya', true),
            'thn_keluhan' => $this->input->post('thn_keluhan', true),
            'bln_keluhan' => $this->input->post('bln_keluhan', true),
            'hari_keluhan' => $this->input->post('hari_keluhan', true),
            'durasi_penyakit' => $this->input->post('durasi_penyakit', true),
            'lokasi1' => $p1,
            'lokasi2' => $n1,
            'lokasi3' => $l1,
            'pemeriksaan_fisik' => ltrim($this->input->get('fisik', true), ','),
            'pemeriksaan_fisik_lainnya' => $this->input->post('pemeriksaan_fisik_lainnya', true),
            'keluhan_penyerta_lainnya' => $this->input->post('keluhan_penyerta_lainnya', true),
            'besar_hepar' => $this->input->post('besar_hepar', true),
            'besar_spleen' => $this->input->post('besar_spleen', true),
            'besar_schuffner' => $this->input->post('besar_schuffner', true),
            'bimanual_ginjal' => $this->input->post('bimanual_ginjal', true),
            'nama_limfadenopati' => $this->input->post('nama_limfadenopati', true),
            'sindrom_penyerta_lainnya' => $this->input->post('sindrom_penyerta_lainnya', true),
            'tanner_stage' => $this->input->post('tanner_stage', true),
            'tgl_periksadarah' => $this->input->post('tgl_periksadarah', true),
            'tgl_periksa_urine' => $this->input->post('tgl_periksa_urine', true),
            'warna_urine' => $this->input->post('warna_urine', true),
            'berat_jenis' => $this->input->post('berat_jenis', true),
            'eritrosit' => $this->input->post('eritrosit', true),
            'leukosit' => $this->input->post('leukosit', true),
            'albumin' => $this->input->post('albumin', true),
            'glukosa' => $this->input->post('glukosa', true),
            'bilirubin' => $this->input->post('bilirubin', true),
            'usg' => $this->input->post('usg', true),
            'tgl_usg' => $this->input->post('tgl_usg', true),
            'massa_primer' => $this->input->post('massa_primer', true),
            'ukuran_primer' => $this->input->post('ukuran_primer', true),
            'konsistensi_massa' => $this->input->post('konsistensi_massa', true),
            'kgb' => $this->input->post('kgb', true),
            'metastasis_usg' => $this->input->post('metastasis_usg', true),
            'metastasis_usg_ket' => $this->input->post('metastasis_usg_ket', true),
            'usg_dropler' => $this->input->post('usg_dropler', true),
            'ket_usg' => $this->input->post('ket_usg', true),
            'ctscan' => $this->input->post('ctscan', true),
            'tgl_ctscan' => $this->input->post('tgl_ctscan', true),
            'lokasi_primer_ctscan' => $this->input->post('lokasi_primer_ctscan', true),
            'ukuran_ctscan' => $this->input->post('ukuran_ctscan', true),
            'kgb_ctscan' => $this->input->post('kgb_ctscan', true),
            'pelvokalises' => $this->input->post('pelvokalises', true),
            'metastasis_ctscan' => $this->input->post('metastasis_ctscan', true),
            'ket_metastasis_ctscan' => $this->input->post('ket_metastasis_ctscan', true),
            'ket_ctscan' => $this->input->post('ket_ctscan', true),
            'tgl_histopatologi' => $this->input->post('tgl_histopatologi', true),
            'histopatologi' => $this->input->post('histopatologi', true),
            'molekular' => $this->input->post('molekular', true),
            'opt_molekular' => ltrim($this->input->get('opt_molekular', true), ','),
            'nwts' => $this->input->post('nwts', true),
            'siop' => $this->input->post('siop', true),
            'stratifikasi' => ltrim($this->input->get('stratifikasi', true), ','),
            'diagnosis_infeksi' => $this->input->post('diagnosis_infeksi', true),
            'diagnosis_noninfeksi' => $this->input->post('diagnosis_noninfeksi', true),
            'kuratif' => $this->input->post('kuratif', true),
            'nonkuratif' => $this->input->post('nonkuratif', true),
            'alasan_tidak_lainnya' => $this->input->post('alasan_tidak_lainnya', true),
            'paliatif' => $this->input->post('paliatif', true),
            'optpaliatif' => ltrim($this->input->get('optpaliatif', true), ','),
            'optpain' => ltrim($this->input->get('optpain', true), ','),
            'pain_lainnya' => $this->input->post('pain_lainnya', true),
            'obat_kemo' => $this->input->post('obat_kemo', true),
            'tgl_mulaikemo' => $this->input->post('tgl_mulaikemo', true),
            'tgl_selesaikemo' => $this->input->post('tgl_selesaikemo', true),
            'jml_siklus' => $this->input->post('jml_siklus', true),
            'lokasi_radioterapi' => $this->input->post('lokasi_radioterapi', true),
            'radioterapi_lainnya' => $this->input->post('radioterapi_lainnya', true),
            'lokasi_operasi' => $this->input->post('lokasi_operasi', true),
            'operasi_lainnya' => $this->input->post('operasi_lainnya', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        $this->db->update('nheproblastoma', $data);

        //return true;
        if (count($detail1) != 0) {
            $this->db->where('nheproblastomaid', $id);
            $this->db->delete('nheproblastoma_penyerta');

            $result = array();
            for ($i = 0; $i < count($detail1); $i++) {

                $result[] = array(
                    'nheproblastomaid' => $id,
                    'penyertaid' => $detail1[$i]['penyertaid'],
                    'keluhan_penyerta' => $detail1[$i]['keluhan_penyerta'],
                    'tanggal' => $detail1[$i]['tanggal'],
                );
            }
            $this->db->insert_batch('nheproblastoma_penyerta', $result);
        }

        if (count($detail2) != 0) {
            $this->db->where('nheproblastomaid', $id);
            $this->db->delete('nheproblastoma_darah');

            $result2 = array();
            for ($x = 0; $x < count($detail2); $x++) {
                $result2[] = array(
                    'nheproblastomaid' => $id,
                    'darah' => $detail2[$x]['nama_options'],
                    'jml' => isset($detail2[$x]['jml']) ? $detail2[$x]['jml'] : '',
                    'ket' => $detail2[$x]['ket'],
                );
            }
            $this->db->insert_batch('nheproblastoma_darah', $result2);
        }

        if (count($detail3) != 0) {
            $this->db->where('nheproblastomaid', $id);
            $this->db->delete('nheproblastoma_jenis');

            $result3 = array();
            for ($y = 0; $y < count($detail3); $y++) {
                $result3[] = array(
                    'nheproblastomaid' => $id,
                    'nama_jenis' => $detail3[$y]['nama_options'],
                    'jml' => isset($detail3[$y]['jml']) ? $detail3[$y]['jml'] : '',
                    'ket' => $detail3[$y]['ket'],
                );
            }
            $this->db->insert_batch('nheproblastoma_jenis', $result3);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function simpankuratif()
    {

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        $data = array(
            'nheproblastomaid' => $this->input->post('nheproblastomaid', true),
            'kemoterapi' => $this->input->post('kemoterapi', true),
            'fase_kemo' => $this->input->post('fase_kemo', true),
            'protokol' => ltrim($this->input->get('protokol', true), ','),
            'tgl_mulai' => $this->input->post('tgl_mulai', true),
            'tgl_selesai' => $this->input->post('tgl_selesai', true),
            'ketepatan' => $this->input->post('ketepatan', true),
            'evaluasi' => $this->input->post('evaluasi', true),
            'efeksamping' => ltrim($this->input->get('efeksamping', true), ','),
            'terapisuportif' => ltrim($this->input->get('terapisuportif', true), ','),
            'radioterapi' => $this->input->post('radioterapi', true),
            'lokasiradioterapi' => ltrim($this->input->get('lokasiradioterapi', true), ','),
            'metoderadioterapi' => ltrim($this->input->get('metoderadioterapi', true), ','),
            'dosisradioterapi' => $this->input->post('dosisradioterapi', true),
            'tgl_mulairadioterapi' => $this->input->post('tgl_mulairadioterapi', true),
            'tgl_selesairadioterapi' => $this->input->post('tgl_selesairadioterapi', true),
            'pembedahan' => $this->input->post('pembedahan', true),
            'tgl_pembedahan' => $this->input->post('tgl_pembedahan', true),
            'intraoperasi' => $this->input->post('intraoperasi', true),
            'tradisional' => $this->input->post('tradisional', true),
            'nama_pengobatan' => $this->input->post('nama_pengobatan', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );

        $this->db->insert('nheproblastoma_kuratif', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function updatekuratif($id)
    {

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        $data = array(
            'kemoterapi' => $this->input->post('kemoterapi', true),
            'fase_kemo' => $this->input->post('fase_kemo', true),
            'protokol' => ltrim($this->input->get('protokol', true), ','),
            'tgl_mulai' => $this->input->post('tgl_mulai', true),
            'tgl_selesai' => $this->input->post('tgl_selesai', true),
            'ketepatan' => $this->input->post('ketepatan', true),
            'evaluasi' => $this->input->post('evaluasi', true),
            'efeksamping' => ltrim($this->input->get('efeksamping', true), ','),
            'terapisuportif' => ltrim($this->input->get('terapisuportif', true), ','),
            'radioterapi' => $this->input->post('radioterapi', true),
            'lokasiradioterapi' => ltrim($this->input->get('lokasiradioterapi', true), ','),
            'metoderadioterapi' => ltrim($this->input->get('metoderadioterapi', true), ','),
            'dosisradioterapi' => $this->input->post('dosisradioterapi', true),
            'tgl_mulairadioterapi' => $this->input->post('tgl_mulairadioterapi', true),
            'tgl_selesairadioterapi' => $this->input->post('tgl_selesairadioterapi', true),
            'pembedahan' => $this->input->post('pembedahan', true),
            'tgl_pembedahan' => $this->input->post('tgl_pembedahan', true),
            'intraoperasi' => $this->input->post('intraoperasi', true),
            'tradisional' => $this->input->post('tradisional', true),
            'nama_pengobatan' => $this->input->post('nama_pengobatan', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('nheproblastoma_kuratif', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function get_kuratif($offset, $limit, $id)
    {
        $where = '';
        $sql = "SELECT K.* FROM nheproblastoma_kuratif K where K.deleted = 'n' AND K.nheproblastomaid = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if ($limit) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function getdarah($table, $tableid, $id)
    {
        $sql = "SELECT *, darah as nama_options FROM $table where $tableid= $id";

        $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function getjenis($table, $tableid, $id)
    {
        $sql = "SELECT *, nama_jenis as nama_options FROM $table where $tableid = $id";

        $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;

        //return $result = $this->db->query($sql)->result();      
    }

    public function get_luaran($id)
    {
        $where = '';

        // if ($search){
        //     $where .= " AND (R.nama like '%".$search."%')" ; 
        // }

        $sql = "SELECT L.*,CASE WHEN L.ultrasonografi = '1' THEN 'Positif Wilms tumor' WHEN L.ultrasonografi = '2' THEN 'Negatif Wilms tumor' END AS d_ultrasonografi,CASE WHEN L.ctscan_l = '1' THEN 'Positif Wilms tumor' WHEN L.ctscan_l = '2' THEN 'Negatif Wilms tumor' END AS d_ctscan FROM nheproblastoma_luaran L
            LEFT JOIN nheproblastoma R on R.id = L.nheproblastomaid 
            WHERE 1 AND L.deleted = 'n' AND L.nheproblastomaid = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        // if($limit){
        //     $sql .=" LIMIT {$offset},{$limit} ";
        // }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function createluaran()
    {
        $p1 = $this->input->post('positifwilms1', true);
        if ($p1 == '1') {
            $p1 = '1';
        } else {
            $p1 = '0';
        }
        $n1 = $this->input->post('negatifwilms1', true);
        if ($n1 == '1') {
            $n1 = '1';
        } else {
            $n1 = '0';
        }
        $p2 = $this->input->post('positifwilms2', true);
        if ($p2 == '1') {
            $p2 = '1';
        } else {
            $p2 = '0';
        }
        $n2 = $this->input->post('negatifwilms2', true);
        if ($n2 == '1') {
            $n2 = '1';
        } else {
            $n2 = '0';
        }
        $data = array(
            'nheproblastomaid' => $this->input->post('nheproblastomaid3', true),
            'tgl_abstraksi' => $this->input->post('tgl_abstraksi', true),
            'ultrasonografi' => $this->input->post('ultrasonografi', true),
            'tgl_periksa_sonografi' => $this->input->post('tgl_periksa_sonografi', true),
            'ctscan_l' => $this->input->post('ctscan_l', true),
            'tgl_periksa_ctscan' => $this->input->post('tgl_periksa_ctscan', true),
            'remisi' => $this->input->post('remisi', true),
            'remisi2' => $this->input->post('remisi2', true),
            'regresi' => ltrim($this->input->get('regresi', true), ','),
            'regresi2' => ltrim($this->input->get('regresi2', true), ','),
            'rekurensi' => $this->input->post('rekurensi', true),
            'rekurensi2' => $this->input->post('rekurensi2', true),
            'bln_rekurensi' => $this->input->post('bln_rekurensi', true),
            'bln_rekurensi2' => $this->input->post('bln_rekurensi2', true),
            'komplikasi' => $this->input->post('komplikasi', true),
            'komplikasi2' => $this->input->post('komplikasi2', true),
            'b_prostesis' => $this->input->post('b_prostesis', true),
            'b_prostesis2' => $this->input->post('b_prostesis2', true),
            'b_kemoterapi' => $this->input->post('b_kemoterapi', true),
            'b_kemoterapi2' => $this->input->post('b_kemoterapi2', true),
            'b_penyakitnya' => $this->input->post('b_penyakitnya', true),
            'b_penyakitnya2' => $this->input->post('b_penyakitnya2', true),
            'b_radiasi' => $this->input->post('b_radiasi', true),
            'b_radiasi2' => $this->input->post('b_radiasi2', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('nheproblastoma_luaran', $data);
    }

    public function updateluaran($id)
    {
        $p1 = $this->input->post('positifwilms1', true);
        if ($p1 == '1') {
            $p1 = '1';
        } else {
            $p1 = '0';
        }
        $n1 = $this->input->post('negatifwilms1', true);
        if ($n1 == '1') {
            $n1 = '1';
        } else {
            $n1 = '0';
        }
        $p2 = $this->input->post('positifwilms2', true);
        if ($p2 == '1') {
            $p2 = '1';
        } else {
            $p2 = '0';
        }
        $n2 = $this->input->post('negatifwilms2', true);
        if ($n2 == '1') {
            $n2 = '1';
        } else {
            $n2 = '0';
        }
        $data = array(
            'tgl_abstraksi' => $this->input->post('tgl_abstraksi', true),
            'ultrasonografi' => $this->input->post('ultrasonografi', true),
            'tgl_periksa_sonografi' => $this->input->post('tgl_periksa_sonografi', true),
            'ctscan_l' => $this->input->post('ctscan_l', true),
            'tgl_periksa_ctscan' => $this->input->post('tgl_periksa_ctscan', true),
            'remisi' => $this->input->post('remisi', true),
            'remisi2' => $this->input->post('remisi2', true),
            'regresi' => ltrim($this->input->get('regresi', true), ','),
            'regresi2' => ltrim($this->input->get('regresi2', true), ','),
            'rekurensi' => $this->input->post('rekurensi', true),
            'rekurensi2' => $this->input->post('rekurensi2', true),
            'bln_rekurensi' => $this->input->post('bln_rekurensi', true),
            'bln_rekurensi2' => $this->input->post('bln_rekurensi2', true),
            'komplikasi' => $this->input->post('komplikasi', true),
            'komplikasi2' => $this->input->post('komplikasi2', true),
            'b_prostesis' => $this->input->post('b_prostesis', true),
            'b_prostesis2' => $this->input->post('b_prostesis2', true),
            'b_kemoterapi' => $this->input->post('b_kemoterapi', true),
            'b_kemoterapi2' => $this->input->post('b_kemoterapi2', true),
            'b_penyakitnya' => $this->input->post('b_penyakitnya', true),
            'b_penyakitnya2' => $this->input->post('b_penyakitnya2', true),
            'b_radiasi' => $this->input->post('b_radiasi', true),
            'b_radiasi2' => $this->input->post('b_radiasi2', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        return $this->db->update('nheproblastoma_luaran', $data);
    }

    public function deleteluaran($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('nheproblastoma_luaran', array(
            'deleted' => 'y',
            'user_delete' => $this->session->userdata('username'),
            'tgl_delete' => date('Y-m-d H:i:s')
        ));
    }
}
