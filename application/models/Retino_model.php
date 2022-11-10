<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retino_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_retino($offset, $limit, $search, $warning, $jenis, $area, $tgl, $tgl2, $validate)
    {
        $where = '';

        if ($search) {
            $where .= " AND (R.nama like '%$search%')";
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

        $sql = "SELECT RS.*,R.noregistrasi,R.nama,R.nik,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl,R.jenis_kelamin,R.no_rekam, R.no_hp,R.no_hp2,O.nama_options as keluhanR, R.unitid, U.nama_unit, 
        CASE WHEN RS.mk = '1' THEN 'Kanan' WHEN RS.mk = '2' THEN 'Kiri' WHEN RS.mk = '3' THEN 'Keduanya' END AS m_kena, 
        CASE WHEN RS.kup = 'y' THEN 'Ya' WHEN RS.kup = 't' THEN 'Tidak' END AS k_up, 
        CASE WHEN RS.rubela = 'y' THEN 'Ya' WHEN RS.rubela = 't' THEN 'Tidak' END AS rub, 
        CASE WHEN RS.neonatus = 'y' THEN 'Ya' WHEN RS.neonatus = 't' THEN 'Tidak' END AS stat_neonatus, 
        CASE WHEN RS.inkubator = 'y' THEN 'Ya' WHEN RS.inkubator = 't' THEN 'Tidak' END AS stat_inkubator, 
        CASE WHEN RS.penglihatan = '1' THEN 'Normal' WHEN RS.penglihatan = '2' THEN 'Gangguan' WHEN RS.penglihatan = '3' THEN 'Kebutaan' END AS stat_penglihatan, 
        CASE WHEN RS.penglihatan2 = '1' THEN 'Normal' WHEN RS.penglihatan2 = '2' THEN 'Gangguan' WHEN RS.penglihatan2 = '3' THEN 'Kebutaan' END AS stat_penglihatan2,
        CASE WHEN RS.ubm = '1' THEN 'Normal' WHEN RS.ubm = '2' THEN 'Membesar' WHEN RS.ubm = '3' THEN 'Mengecil' END AS stat_ubm, 
        CASE WHEN RS.ubm2 = '1' THEN 'Normal' WHEN RS.ubm2 = '2' THEN 'Membesar' WHEN RS.ubm2 = '3' THEN 'Mengecil' END AS stat_ubm2 
        FROM retino RS 
        LEFT JOIN registrasi R on R.id= RS.registrasiid 
        LEFT JOIN options O on RS.presentasi_klinis = O.id
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

    public function caripasien($offset, $limit, $q)
    {
        $unitid = $this->session->userdata('unitid');

        $where = '';

        if ($q != '') {
            $where .= " AND (R.nama like '%" . $q . "%' or R.no_rekam like '%" . $q . "%' or R.noregistrasi like '%" . $q . "%' or R.alamat like '%" . $q . "%' or S.subgrup like '%" . $q . "%' or M.morfologi like '%" . $q . "%' or T.topografi like '%" . $q . "%')";
        }

        $sql = "SELECT R.*,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END AS jkelamin,S.kodesubgrup,S.subgrup,S.stagingid as idstaging,M.kodemorfologi,M.morfologi,T.kodetopografi,T.topografi,P.nama as propinsi,K.nama as kabupaten FROM registrasi R
            LEFT JOIN subgrup S on S.id = R.subgrupid 
            LEFT JOIN morfologi M on M.id = R.morfologiid 
            LEFT JOIN topografi T on T.id = R.topografiid
            LEFT JOIN provinsi P on P.id_prov = R.id_prov 
            LEFT JOIN kabupaten K on K.id_kab = R.id_kab
            WHERE 1 AND R.deleted = 'n' AND R.validate = 'y' AND R.spesifik = 'n' AND R.subgrupid = '18' AND R.unitid = $unitid $where ORDER BY R.id DESC";

        $result['count'] = $this->db->query($sql)->num_rows();
        if ($limit) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function simpan()
    {

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        // $jkelamin = $this->input->post('jenis_kelamin');
        // if($jkelamin=='l'){
        //     $j=1;
        // }else{
        //     $j=2;
        // }

        $data = array(
            'registrasiid' => $this->input->post('registrasiid', true),
            'presentasi_klinis' =>  ltrim($this->input->get('present', true), ','),
            'presentasi_klinis_lainnya' => $this->input->post('presentasi_klinis_lainnya', true),
            'thn_keluhan' => $this->input->post('thn_keluhan', true),
            'bln_keluhan' => $this->input->post('bln_keluhan', true),
            'hari_keluhan' => 0, //,$this->input->post('hari_keluhan',true),
            'durasi_penyakit' => $this->input->post('durasi_penyakit', true),
            'mk' => $this->input->post('mk', true),
            'kup' => $this->input->post('kup', true),
            'keluhan_penyerta' => ltrim($this->input->get('penyerta', true), ','),
            'keluhan_penyerta_lainnya' => $this->input->post('keluhan_penyerta_lainnya', true),
            'riwayat_prenatal' => ltrim($this->input->get('prenatal', true), ','),
            'rubela' => $this->input->post('rubela', true),
            'bbl' => $this->input->post('bbl', true),
            'ugl' => $this->input->post('ugl', true),
            'neonatus' => $this->input->post('neonatus', true),
            'inkubator' => $this->input->post('inkubator', true),
            't_inkubator' => $this->input->post('t_inkubator', true),
            'p_tanpabantuan' => $this->input->post('p_tanpabantuan', true),
            'p_kacamata' => $this->input->post('p_kacamata', true),
            'penglihatan' => $this->input->post('penglihatan', true),
            'p_tanpabantuan2' => $this->input->post('p_tanpabantuan2', true),
            'p_kacamata2' => $this->input->post('p_kacamata2', true),
            'penglihatan2' => $this->input->post('penglihatan2', true),
            'pemeriksaan_klinis' => ltrim($this->input->get('pklinis', true), ','),
            'pemeriksaan_klinis_lainnya' => $this->input->post('pemeriksaan_klinis_lainnya', true),
            'ubm' => $this->input->post('ubm', true),
            'pemeriksaan_slitlamp' => ltrim($this->input->get('slitlamp', true), ','),
            'pemeriksaan_slitlamp_lainnya' => $this->input->post('pemeriksaan_slitlamp_lainnya', true),
            'pem_posterior' => ltrim($this->input->get('posterior', true), ','),
            'lesi' => $this->input->post('lesi', true),
            'u_tumor' => $this->input->post('u_tumor', true),
            'l_tumor' => $this->input->post('l_tumor', true),
            't_tumor' => $this->input->post('t_tumor', true),
            'pp_darah' => $this->input->post('pp_darah', true),
            'pem_darah_baru' => $this->input->post('pem_darah_baru', true),
            'det_retina' =>  $this->input->post('det_retina', true),
            'vitreous' => $this->input->post('vitreous', true),
            'grup' =>  $this->input->post('grup', true),
            'jmltumor' => $this->input->post('jmltumor', true),
            'ctscan' => $this->input->post('ctscan', true),
            'ctscankanan1' => ltrim($this->input->get('ctscankanan1', true), ','),
            'ctscankanan2' => ltrim($this->input->get('ctscankanan2', true), ','),
            'mri' => $this->input->post('mri', true),
            'mrikanan1' => ltrim($this->input->get('mrikanan1', true), ','),
            'mrikanan2' => ltrim($this->input->get('mrikanan2', true), ','),
            'usg_dasar_t_kanan' => $this->input->post('usg_dasar_t_kanan', true),
            'usg_dasar_l_kanan' => $this->input->post('usg_dasar_l_kanan', true),
            'usg_tinggi_t_kanan' => $this->input->post('usg_tinggi_t_kanan', true),
            'usg_tinggi_l_kanan' => $this->input->post('usg_tinggi_l_kanan', true),
            'staging_iirc_kanan' => $this->input->post('staging_iirc_kanan', true),
            'staging_ierc_kanan' => $this->input->post('staging_ierc_kanan', true),
            'diagnosis_infeksi_kanan' => $this->input->post('diagnosis_infeksi_kanan', true),
            'diagnosis_noninfeksi_kanan' => $this->input->post('diagnosis_noninfeksi_kanan', true),

            'pemeriksaan_klinis2' => ltrim($this->input->get('pklinis2', true), ','),
            'pemeriksaan_klinis_lainnya2' => $this->input->post('pemeriksaan_klinis_lainnya2', true),
            'ubm2' => $this->input->post('ubm2', true),
            'pemeriksaan_slitlamp2' => ltrim($this->input->get('slitlamp2', true), ','),
            'pemeriksaan_slitlamp_lainnya2' => $this->input->post('pemeriksaan_slitlamp_lainnya2', true),
            'pem_posterior_kiri' => ltrim($this->input->get('posterior2', true), ','),
            'lesi_kiri' => $this->input->post('lesi_kiri', true),
            'u_tumor_kiri' => $this->input->post('u_tumor_kiri', true),
            'l_tumor_kiri' => $this->input->post('l_tumor_kiri', true),
            't_tumor_kiri' => $this->input->post('t_tumor_kiri', true),
            'pp_darah_kiri' => $this->input->post('pp_darah_kiri', true),
            'pem_darah_baru_kiri' => $this->input->post('pem_darah_baru_kiri', true),
            'det_retina_kiri' =>  $this->input->post('det_retina_kiri', true),
            'vitreous_kiri' => $this->input->post('vitreous_kiri', true),
            'grup_kiri' =>  $this->input->post('grup_kiri', true),
            'jmltumor_kiri' => $this->input->post('jmltumor_kiri', true),
            'ctscan_kiri' => $this->input->post('ctscan_kiri', true),
            'ctscankiri1' => ltrim($this->input->get('ctscankiri1', true), ','),
            'ctscankiri2' => ltrim($this->input->get('ctscankiri2', true), ','),
            'mri_kiri' => $this->input->post('mri_kiri', true),
            'mrikiri1' => ltrim($this->input->get('mrikiri1', true), ','),
            'mrikiri2' => ltrim($this->input->get('mrikiri2', true), ','),
            'usg_dasar_t_kiri' => $this->input->post('usg_dasar_t_kiri', true),
            'usg_dasar_l_kiri' => $this->input->post('usg_dasar_l_kiri', true),
            'usg_tinggi_t_kiri' => $this->input->post('usg_tinggi_t_kiri', true),
            'usg_tinggi_l_kiri' => $this->input->post('usg_tinggi_l_kiri', true),
            'staging_iirc_kiri' => $this->input->post('staging_iirc_kiri', true),
            'staging_ierc_kiri' => $this->input->post('staging_ierc_kiri', true),
            'diagnosis_infeksi_kiri' => $this->input->post('diagnosis_infeksi_kiri', true),
            'diagnosis_noninfeksi_kiri' => $this->input->post('diagnosis_noninfeksi_kiri', true),

            'metastatik' => ltrim($this->input->get('metastatik', true), ','),
            'hasil_aspirasi' => $this->input->post('hasil_aspirasi', true),
            'hasil_css' => $this->input->post('hasil_css', true),
            'hasil_lainnya' => $this->input->post('hasil_lainnya', true),
            'genetik' => $this->input->post('genetik', true),
            'rdgenetik' => $this->input->post('rdgenetik', true),
            'diagnosis_kerja' => $this->input->post('diagnosis_kerja', true),
            'tgl_diagnosis' => $this->input->post('tgl_diagnosis', true),

            'kuratif' => $this->input->post('kuratif', true),
            'nonkuratif' => $this->input->post('nonkuratif', true),
            'alasan_tidak_lainnya' => $this->input->post('alasan_tidak_lainnya', true),
            'paliatif' => ltrim($this->input->get('paliatif', true), ','),
            'optpaliatif' => ltrim($this->input->get('optpaliatif', true), ','),
            'optpain' => ltrim($this->input->get('optpain', true), ','),
            'pain_lainnya' => $this->input->post('pain_lainnya', true),
            'obat_kemo' => $this->input->post('obat_kemo', true),
            'tgl_mulaikemo' => $this->input->post('tgl_mulaikemo', true),
            'tgl_selesaikemo' => $this->input->post('tgl_selesaikemo', true),
            'jml_siklus' => $this->input->post('jml_siklus', true),
            'lokasi_radioterapi' => $this->input->post('lokasi_radioterapi', true),
            'radioterapi_lainnya' => $this->input->post('radioterapi_lainnya', true),
            'jenis_operasi' => $this->input->post('jenis_operasi', true),
            'jenisoperasi_lainnya' => $this->input->post('jenisoperasi_lainnya', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );

        $this->db->insert('retino', $data);

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

    public function update($id)
    {

        $this->db->trans_begin();

        $data = array(
            'presentasi_klinis' =>  ltrim($this->input->get('present', true), ','),
            'presentasi_klinis_lainnya' => $this->input->post('presentasi_klinis_lainnya', true),
            'thn_keluhan' => $this->input->post('thn_keluhan', true),
            'bln_keluhan' => $this->input->post('bln_keluhan', true),
            'hari_keluhan' => 0, //,$this->input->post('hari_keluhan',true),
            'durasi_penyakit' => $this->input->post('durasi_penyakit', true),
            'mk' => $this->input->post('mk', true),
            'kup' => $this->input->post('kup', true),
            'keluhan_penyerta' => ltrim($this->input->get('penyerta', true), ','),
            'keluhan_penyerta_lainnya' => $this->input->post('keluhan_penyerta_lainnya', true),
            'riwayat_prenatal' => ltrim($this->input->get('prenatal', true), ','),
            'rubela' => $this->input->post('rubela', true),
            'bbl' => $this->input->post('bbl', true),
            'ugl' => $this->input->post('ugl', true),
            'neonatus' => $this->input->post('neonatus', true),
            'inkubator' => $this->input->post('inkubator', true),
            't_inkubator' => $this->input->post('t_inkubator', true),
            'p_tanpabantuan' => $this->input->post('p_tanpabantuan', true),
            'p_kacamata' => $this->input->post('p_kacamata', true),
            'penglihatan' => $this->input->post('penglihatan', true),
            'p_tanpabantuan2' => $this->input->post('p_tanpabantuan2', true),
            'p_kacamata2' => $this->input->post('p_kacamata2', true),
            'penglihatan2' => $this->input->post('penglihatan2', true),
            'pemeriksaan_klinis' => ltrim($this->input->get('pklinis', true), ','),
            'pemeriksaan_klinis_lainnya' => $this->input->post('pemeriksaan_klinis_lainnya', true),
            'ubm' => $this->input->post('ubm', true),
            'pemeriksaan_slitlamp' => ltrim($this->input->get('slitlamp', true), ','),
            'pemeriksaan_slitlamp_lainnya' => $this->input->post('pemeriksaan_slitlamp_lainnya', true),
            'pem_posterior' => ltrim($this->input->get('posterior', true), ','),
            'lesi' => $this->input->post('lesi', true),
            'u_tumor' => $this->input->post('u_tumor', true),
            'l_tumor' => $this->input->post('l_tumor', true),
            't_tumor' => $this->input->post('t_tumor', true),
            'pp_darah' => $this->input->post('pp_darah', true),
            'pem_darah_baru' => $this->input->post('pem_darah_baru', true),
            'det_retina' =>  $this->input->post('det_retina', true),
            'vitreous' => $this->input->post('vitreous', true),
            'grup' =>  $this->input->post('grup', true),
            'jmltumor' => $this->input->post('jmltumor', true),
            'ctscan' => $this->input->post('ctscan', true),
            'ctscankanan1' => ltrim($this->input->get('ctscankanan1', true), ','),
            'ctscankanan2' => ltrim($this->input->get('ctscankanan2', true), ','),
            'mri' => $this->input->post('mri', true),
            'mrikanan1' => ltrim($this->input->get('mrikanan1', true), ','),
            'mrikanan2' => ltrim($this->input->get('mrikanan2', true), ','),
            'usg_dasar_t_kanan' => $this->input->post('usg_dasar_t_kanan', true),
            'usg_dasar_l_kanan' => $this->input->post('usg_dasar_l_kanan', true),
            'usg_tinggi_t_kanan' => $this->input->post('usg_tinggi_t_kanan', true),
            'usg_tinggi_l_kanan' => $this->input->post('usg_tinggi_l_kanan', true),
            'staging_iirc_kanan' => $this->input->post('staging_iirc_kanan', true),
            'staging_ierc_kanan' => $this->input->post('staging_ierc_kanan', true),
            'diagnosis_infeksi_kanan' => $this->input->post('diagnosis_infeksi_kanan', true),
            'diagnosis_noninfeksi_kanan' => $this->input->post('diagnosis_noninfeksi_kanan', true),

            'pemeriksaan_klinis2' => ltrim($this->input->get('pklinis2', true), ','),
            'pemeriksaan_klinis_lainnya2' => $this->input->post('pemeriksaan_klinis_lainnya2', true),
            'ubm2' => $this->input->post('ubm2', true),
            'pemeriksaan_slitlamp2' => ltrim($this->input->get('slitlamp2', true), ','),
            'pemeriksaan_slitlamp_lainnya2' => $this->input->post('pemeriksaan_slitlamp_lainnya2', true),
            'pem_posterior_kiri' => ltrim($this->input->get('posterior2', true), ','),
            'lesi_kiri' => $this->input->post('lesi_kiri', true),
            'u_tumor_kiri' => $this->input->post('u_tumor_kiri', true),
            'l_tumor_kiri' => $this->input->post('l_tumor_kiri', true),
            't_tumor_kiri' => $this->input->post('t_tumor_kiri', true),
            'pp_darah_kiri' => $this->input->post('pp_darah_kiri', true),
            'pem_darah_baru_kiri' => $this->input->post('pem_darah_baru_kiri', true),
            'det_retina_kiri' =>  $this->input->post('det_retina_kiri', true),
            'vitreous_kiri' => $this->input->post('vitreous_kiri', true),
            'grup_kiri' =>  $this->input->post('grup_kiri', true),
            'jmltumor_kiri' => $this->input->post('jmltumor_kiri', true),
            'ctscan_kiri' => $this->input->post('ctscan_kiri', true),
            'ctscankiri1' => ltrim($this->input->get('ctscankiri1', true), ','),
            'ctscankiri2' => ltrim($this->input->get('ctscankiri2', true), ','),
            'mri_kiri' => $this->input->post('mri_kiri', true),
            'mrikiri1' => ltrim($this->input->get('mrikiri1', true), ','),
            'mrikiri2' => ltrim($this->input->get('mrikiri2', true), ','),
            'usg_dasar_t_kiri' => $this->input->post('usg_dasar_t_kiri', true),
            'usg_dasar_l_kiri' => $this->input->post('usg_dasar_l_kiri', true),
            'usg_tinggi_t_kiri' => $this->input->post('usg_tinggi_t_kiri', true),
            'usg_tinggi_l_kiri' => $this->input->post('usg_tinggi_l_kiri', true),
            'staging_iirc_kiri' => $this->input->post('staging_iirc_kiri', true),
            'staging_ierc_kiri' => $this->input->post('staging_ierc_kiri', true),
            'diagnosis_infeksi_kiri' => $this->input->post('diagnosis_infeksi_kiri', true),
            'diagnosis_noninfeksi_kiri' => $this->input->post('diagnosis_noninfeksi_kiri', true),

            'metastatik' => ltrim($this->input->get('metastatik', true), ','),
            'hasil_aspirasi' => $this->input->post('hasil_aspirasi', true),
            'hasil_css' => $this->input->post('hasil_css', true),
            'hasil_lainnya' => $this->input->post('hasil_lainnya', true),
            'genetik' => $this->input->post('genetik', true),
            'rdgenetik' => $this->input->post('rdgenetik', true),
            'diagnosis_kerja' => $this->input->post('diagnosis_kerja', true),
            'tgl_diagnosis' => $this->input->post('tgl_diagnosis', true),

            'kuratif' => $this->input->post('kuratif', true),
            'nonkuratif' => $this->input->post('nonkuratif', true),
            'alasan_tidak_lainnya' => $this->input->post('alasan_tidak_lainnya', true),
            'paliatif' => ltrim($this->input->get('paliatif', true), ','),
            'optpaliatif' => ltrim($this->input->get('optpaliatif', true), ','),
            'optpain' => ltrim($this->input->get('optpain', true), ','),
            'pain_lainnya' => $this->input->post('pain_lainnya', true),
            'obat_kemo' => $this->input->post('obat_kemo', true),
            'tgl_mulaikemo' => $this->input->post('tgl_mulaikemo', true),
            'tgl_selesaikemo' => $this->input->post('tgl_selesaikemo', true),
            'jml_siklus' => $this->input->post('jml_siklus', true),
            'lokasi_radioterapi' => $this->input->post('lokasi_radioterapi', true),
            'radioterapi_lainnya' => $this->input->post('radioterapi_lainnya', true),
            'jenis_operasi' => $this->input->post('jenis_operasi', true),
            'jenisoperasi_lainnya' => $this->input->post('jenisoperasi_lainnya', true),
            'user_insert' => $this->session->userdata('username'),
            'tgl_insert' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        $this->db->update('retino', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function delete($id)
    {
        $this->db->trans_begin();

        $this->db->where('id', $this->input->post('regid', true));
        $this->db->update('registrasi', array('spesifik' => 'n'));

        $this->db->where('id', $id);
        $this->db->delete('retino');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function options($type, $q)
    {
        $this->db->where('deleted', 'n');
        $this->db->where('type', $type);
        $query = $this->db->get('options');
        return $query->result();
    }

    public function simpankuratif()
    {

        $this->db->trans_begin();
        $data = array(
            'retinoid' => $this->input->post('retinoid', true),
            'stat_kemo' => $this->input->post('stat_kemo', true),
            'tgl_kemo' => $this->input->post('tgl_kemo', true),
            'jenis_kemo' =>  ltrim($this->input->get('optjenis', true), ','),
            'siklus' => $this->input->post('siklus', true),
            'opt_okular' =>  ltrim($this->input->get('optokular', true), ','),
            'xkanan' => $this->input->post('xkanan', true),
            'xkiri' => $this->input->post('xkiri', true),
            'enukleasi_kanan' => $this->input->post('enukleasi_kanan', true),
            'hasilhpe_kanan' => $this->input->post('hasilhpe_kanan', true),
            'ekstraokular_kanan' =>  ltrim($this->input->get('optekstraokularkanan', true), ','),
            'fokal_kanan' => $this->input->post('fokal_kanan', true),
            'opt_fokal_kanan' =>  ltrim($this->input->get('optfokalkanan', true), ','),
            'radioterapi_kanan' => $this->input->post('radioterapi_kanan', true),
            'opt_radioterapi_kanan' =>  ltrim($this->input->get('optradioterapikanan', true), ','),
            'enukleasi_kiri' => $this->input->post('enukleasi_kiri', true),
            'hasilhpe_kiri' => $this->input->post('hasilhpe_kiri', true),
            'ekstraokular_kiri' =>  ltrim($this->input->get('optekstraokularkiri', true), ','),
            'fokal_kiri' => $this->input->post('fokal_kiri', true),
            'opt_fokal_kiri' =>  ltrim($this->input->get('optfokalkiri', true), ','),
            'radioterapi_kiri' => $this->input->post('radioterapi_kiri', true),
            'opt_radioterapi_kiri' =>  ltrim($this->input->get('optradioterapikiri', true), ','),
            'tradisional' => $this->input->post('tradisional', true)
        );

        $this->db->insert('retino_kuratif', $data);

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
        $data = array(
            'retinoid' => $this->input->post('retinoid', true),
            'stat_kemo' => $this->input->post('stat_kemo', true),
            'tgl_kemo' => $this->input->post('tgl_kemo', true),
            'jenis_kemo' =>  ltrim($this->input->get('optjenis', true), ','),
            'siklus' => $this->input->post('siklus', true),
            'opt_okular' =>  ltrim($this->input->get('optokular', true), ','),
            'xkanan' => $this->input->post('xkanan', true),
            'xkiri' => $this->input->post('xkiri', true),
            'enukleasi_kanan' => $this->input->post('enukleasi_kanan', true),
            'hasilhpe_kanan' => $this->input->post('hasilhpe_kanan', true),
            'ekstraokular_kanan' =>  ltrim($this->input->get('optekstraokularkanan', true), ','),
            'fokal_kanan' => $this->input->post('fokal_kanan', true),
            'opt_fokal_kanan' =>  ltrim($this->input->get('optfokalkanan', true), ','),
            'radioterapi_kanan' => $this->input->post('radioterapi_kanan', true),
            'opt_radioterapi_kanan' =>  ltrim($this->input->get('optradioterapikanan', true), ','),
            'enukleasi_kiri' => $this->input->post('enukleasi_kiri', true),
            'hasilhpe_kiri' => $this->input->post('hasilhpe_kiri', true),
            'ekstraokular_kiri' =>  ltrim($this->input->get('optekstraokularkiri', true), ','),
            'fokal_kiri' => $this->input->post('fokal_kiri', true),
            'opt_fokal_kiri' =>  ltrim($this->input->get('optfokalkiri', true), ','),
            'radioterapi_kiri' => $this->input->post('radioterapi_kiri', true),
            'opt_radioterapi_kiri' =>  ltrim($this->input->get('optradioterapikiri', true), ','),
            'tradisional' => $this->input->post('tradisional', true)
        );
        $this->db->where('id', $id);
        $this->db->update('retino_kuratif', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function read_kuratif($offset, $limit, $id)
    {
        $where = '';
        $sql = "SELECT K.*, 
        CASE WHEN K.stat_kemo = 'y' THEN 'Ya' WHEN K.stat_kemo = 'n' THEN 'Tidak' END AS statkemo,
        CASE WHEN K.jenis_kemo = '1' THEN 'Kemoterapi Sistemik' WHEN K.jenis_kemo = '2' THEN 'Injeksi Kemoterapi Okular' WHEN K.jenis_kemo = '2,1' OR K.jenis_kemo = '1,2' THEN 'Kemoterapi Sistemik,Injeksi Kemoterapi Okular' END AS optjeniskemo,
        CASE WHEN K.opt_okular = '1' THEN 'Injeksi Subtenon' WHEN K.opt_okular = '2' THEN 'Injeksi Intravitral' WHEN K.opt_okular = '2,1' OR K.opt_okular = '1,2' THEN 'Injeksi Subtenon,Injeksi Intravitral' END AS optokular,
        CASE WHEN K.opt_fokal_kanan = '1' THEN 'Laser' WHEN K.opt_fokal_kanan = '2' THEN 'Krioterapi' WHEN K.opt_fokal_kanan = '2,1' OR K.opt_fokal_kanan = '1,2' THEN 'Laser,Krioterapi' END AS optfokalkanan,
        CASE WHEN K.opt_fokal_kiri = '1' THEN 'Laser' WHEN K.opt_fokal_kiri = '2' THEN 'Krioterapi' WHEN K.opt_fokal_kiri = '2,1' OR K.opt_fokal_kiri = '1,2' THEN 'Laser,Krioterapi' END AS optfokalkiri,
        CASE WHEN K.tradisional = 'y' THEN 'Ya' WHEN K.tradisional = 'n' THEN 'Tidak' END AS stattradisional,
        CASE WHEN K.enukleasi_kanan = 'y' THEN 'Ya' WHEN K.enukleasi_kanan = 'n' THEN 'Tidak' END AS statenukleasi_kanan,
        CASE WHEN K.enukleasi_kiri = 'y' THEN 'Ya' WHEN K.enukleasi_kiri = 'n' THEN 'Tidak' END AS statenukleasi_kiri,
        CASE WHEN K.hasilhpe_kanan = 'y' THEN 'Ya' WHEN K.hasilhpe_kanan = 'n' THEN 'Tidak' END AS stathasilhpe_kanan,
        CASE WHEN K.hasilhpe_kiri = 'y' THEN 'Ya' WHEN K.hasilhpe_kiri = 'n' THEN 'Tidak' END AS stathasilhpe_kiri,
        CASE WHEN K.fokal_kanan = 'y' THEN 'Ya' WHEN K.fokal_kanan = 'n' THEN 'Tidak' END AS statfokal_kanan,
        CASE WHEN K.fokal_kiri = 'y' THEN 'Ya' WHEN K.fokal_kiri = 'n' THEN 'Tidak' END AS statfokal_kiri,
        CASE WHEN K.radioterapi_kanan = 'y' THEN 'Ya' WHEN K.radioterapi_kanan = 'n' THEN 'Tidak' END AS statradioterapi_kanan,
        CASE WHEN K.radioterapi_kiri = 'y' THEN 'Ya' WHEN K.radioterapi_kiri = 'n' THEN 'Tidak' END AS statradioterapi_kiri
        FROM retino_kuratif K where K.deleted = 'n' AND K.retinoid = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if ($limit) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function deletekuratif($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('retino_kuratif');
    }

    public function read_luaran($offset, $limit, $id)
    {
        $where = '';
        $sql = "SELECT K.*, 
        CASE WHEN K.tampak_kanan = '1' THEN 'Normal' WHEN K.tampak_kanan = '2' THEN 'Gangguan Penglihatan' WHEN K.tampak_kanan = '3' THEN 'Kebutaan'  END AS stattampak_kanan,
        CASE WHEN K.tampak_kiri = '1' THEN 'Normal' WHEN K.tampak_kiri = '2' THEN 'Gangguan Penglihatan' WHEN K.tampak_kiri = '3' THEN 'Kebutaan'  END AS stattampak_kiri,
        CASE WHEN K.remisi_kanan = '1' THEN 'Tidak ada regresi' WHEN K.remisi_kanan = '2' THEN 'Regresi Parsial' WHEN K.remisi_kanan = '3' THEN 'Regresi Komplit'  END AS statremisi_kanan,
        CASE WHEN K.remisi_kiri = '1' THEN 'Tidak ada regresi' WHEN K.remisi_kiri = '2' THEN 'Regresi Parsial' WHEN K.remisi_kiri = '3' THEN 'Regresi Komplit' END AS statremisi_kiri,
        CASE WHEN K.rekurensi_kanan = '1' THEN 'Ya' WHEN K.rekurensi_kanan = '2' THEN 'Tidak' END AS statrekurensi_kanan,
        CASE WHEN K.rekurensi_kiri = '1' THEN 'Ya' WHEN K.rekurensi_kiri = '2' THEN 'Tidak' END AS statrekurensi_kiri,
        CASE WHEN K.komplikasi_kanan = '1' THEN 'Ya' WHEN K.komplikasi_kanan = '2' THEN 'Tidak' END AS statkomplikasi_kanan,
        CASE WHEN K.komplikasi_kiri = '1' THEN 'Ya' WHEN K.komplikasi_kiri = '2' THEN 'Tidak' END AS statkomplikasi_kiri
        FROM retino_luaran K where K.deleted = 'n' AND K.retinoid = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if ($limit) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function simpanluaran()
    {
        $this->db->trans_begin();
        $data = array(
            'retinoid' => $this->input->post('retinoid3', true),
            'ptb_kanan' => $this->input->post('ptb_kanan', true),
            'ptb_kiri' => $this->input->post('ptb_kiri', true),
            'pdk_kanan' =>  $this->input->post('pdk_kanan', true),
            'pdk_kiri' => $this->input->post('pdk_kiri', true),
            'tampak_kanan' => $this->input->post('tampak_kanan', true),
            'tampak_kiri' => $this->input->post('tampak_kiri', true),
            'remisi_kanan' => $this->input->post('remisi_kanan', true),
            'remisi_kiri' => $this->input->post('remisi_kiri', true),
            'tipe_regresi_kanan' => ltrim($this->input->get('optregresikanan', true), ','),
            'tipe_regresi_kiri' => ltrim($this->input->get('optregresikiri', true), ','),
            'rekurensi_kanan' => $this->input->post('rekurensi_kanan', true),
            'rekurensi_kiri' => $this->input->post('rekurensi_kiri', true),
            'durasi_kanan' => $this->input->post('durasi_kanan', true),
            'durasi_kiri' => $this->input->post('durasi_kiri', true),
            'komplikasi_kanan' =>  $this->input->post('komplikasi_kanan', true),
            'komplikasi_kiri' =>  $this->input->post('komplikasi_kiri', true),
            'opt_komplikasi_kanan' => ltrim($this->input->get('optkomplikasikanan', true), ','),
            'opt_komplikasi_kiri' => ltrim($this->input->get('optkomplikasikiri', true), ','),
            'ket_socket_kanan' =>  $this->input->post('ket_socket_kanan', true),
            'ket_socket_kiri' =>  $this->input->post('ket_socket_kiri', true),
            'ket_kemoterapi_kanan' =>  $this->input->post('ket_kemoterapi_kanan', true),
            'ket_kemoterapi_kiri' =>  $this->input->post('ket_kemoterapi_kiri', true),
            'ket_penyakit_kanan' =>  $this->input->post('ket_penyakit_kanan', true),
            'ket_penyakit_kiri' =>  $this->input->post('ket_penyakit_kiri', true),
            'ket_radiasi_kanan' =>  $this->input->post('ket_radiasi_kanan', true),
            'ket_radiasi_kiri' =>  $this->input->post('ket_radiasi_kiri', true)
        );

        $this->db->insert('retino_luaran', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function updateluaran($id)
    {

        $this->db->trans_begin();
        $data = array(
            'ptb_kanan' => $this->input->post('ptb_kanan', true),
            'ptb_kiri' => $this->input->post('ptb_kiri', true),
            'pdk_kanan' =>  $this->input->post('pdk_kanan', true),
            'pdk_kiri' => $this->input->post('pdk_kiri', true),
            'tampak_kanan' => $this->input->post('tampak_kanan', true),
            'tampak_kiri' => $this->input->post('tampak_kiri', true),
            'remisi_kanan' => $this->input->post('remisi_kanan', true),
            'remisi_kiri' => $this->input->post('remisi_kiri', true),
            'tipe_regresi_kanan' => ltrim($this->input->get('optregresikanan', true), ','),
            'tipe_regresi_kiri' => ltrim($this->input->get('optregresikiri', true), ','),
            'rekurensi_kanan' => $this->input->post('rekurensi_kanan', true),
            'rekurensi_kiri' => $this->input->post('rekurensi_kiri', true),
            'durasi_kanan' => $this->input->post('durasi_kanan', true),
            'durasi_kiri' => $this->input->post('durasi_kiri', true),
            'komplikasi_kanan' =>  $this->input->post('komplikasi_kanan', true),
            'komplikasi_kiri' =>  $this->input->post('komplikasi_kiri', true),
            'opt_komplikasi_kanan' => ltrim($this->input->get('optkomplikasikanan', true), ','),
            'opt_komplikasi_kiri' => ltrim($this->input->get('optkomplikasikiri', true), ','),
            'ket_socket_kanan' =>  $this->input->post('ket_socket_kanan', true),
            'ket_socket_kiri' =>  $this->input->post('ket_socket_kiri', true),
            'ket_kemoterapi_kanan' =>  $this->input->post('ket_kemoterapi_kanan', true),
            'ket_kemoterapi_kiri' =>  $this->input->post('ket_kemoterapi_kiri', true),
            'ket_penyakit_kanan' =>  $this->input->post('ket_penyakit_kanan', true),
            'ket_penyakit_kiri' =>  $this->input->post('ket_penyakit_kiri', true),
            'ket_radiasi_kanan' =>  $this->input->post('ket_radiasi_kanan', true),
            'ket_radiasi_kiri' =>  $this->input->post('ket_radiasi_kiri', true)
        );
        $this->db->where('id', $id);
        $this->db->update('retino_luaran', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function deleteluaran($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('retino_luaran');
    }


    public function read_followup($offset, $limit, $id)
    {
        $where = '';
        $sql = "SELECT K.*
        FROM retino_followup K where K.deleted = 'n' AND K.retinoid = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if ($limit) {
            $sql .= " LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }


    public function simpanfollowup()
    {
        $this->db->trans_begin();
        $data = array(
            'retinoid' => $this->input->post('retinoid4', true),
            'tgl_abstraksi' => $this->input->post('tgl_abstraksi', true),
            'evaluasi_klinis_kanan' => $this->input->post('evaluasi_klinis_kanan', true),
            'evaluasi_klinis_kiri' => $this->input->post('evaluasi_klinis_kiri', true),
            'pemeriksaan_slitlamp_kanan' => $this->input->post('pemeriksaan_slitlamp_kanan', true),
            'pemeriksaan_slitlamp_kiri' => $this->input->post('pemeriksaan_slitlamp_kiri', true),
            'tgl_ctscan' => $this->input->post('tgl_ctscan', true),
            'kesan_ctscan' => $this->input->post('kesan_ctscan', true),
            'tgl_mri' => $this->input->post('tgl_mri', true),
            'kesan_mri' => $this->input->post('kesan_mri', true)
        );

        $this->db->insert('retino_followup', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function updatefollowup($id)
    {
        $this->db->trans_begin();
        $data = array(
            'retinoid' => $this->input->post('retinoid4', true),
            'tgl_abstraksi' => $this->input->post('tgl_abstraksi', true),
            'evaluasi_klinis_kanan' => $this->input->post('evaluasi_klinis_kanan', true),
            'evaluasi_klinis_kiri' => $this->input->post('evaluasi_klinis_kiri', true),
            'pemeriksaan_slitlamp_kanan' => $this->input->post('pemeriksaan_slitlamp_kanan', true),
            'pemeriksaan_slitlamp_kiri' => $this->input->post('pemeriksaan_slitlamp_kiri', true),
            'tgl_ctscan' => $this->input->post('tgl_ctscan', true),
            'kesan_ctscan' => $this->input->post('kesan_ctscan', true),
            'tgl_mri' => $this->input->post('tgl_mri', true),
            'kesan_mri' => $this->input->post('kesan_mri', true)
        );

        $this->db->where('id', $id);
        $this->db->update('retino_followup', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function deletefollowup($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('retino_followup');
    }
}
