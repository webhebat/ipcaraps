<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Manajemenkuratif_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_manajemenkuratif($offset,$limit,$search,$warning,$jenis,$area,$tgl,$tgl2,$validate){
        $sql ="SELECT RM.*,R.noregistrasi,R.nama,R.nik,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl,R.jenis_kelamin,R.no_rekam, R.no_hp,R.no_hp2,O.nama_options as keluhan FROM rekam_medik RM 
        LEFT JOIN registrasi R on R.id = RM.registrasiid 
        LEFT JOIN options O on RM.keluhan_utama= O.id 
        WHERE RM.deleted ='n' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if($limit){
            $sql .=" LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function caripasien($offset, $limit, $q)
    {
        $unitid = $this->session->userdata('unitid');

        $where = '';
        if ($q!=''){
            $where .= " AND (R.nama like '%".$q."%' or R.no_rekam like '%".$q."%' or R.noregistrasi like '%".$q."%' or R.alamat like '%".$q."%' or S.subgrup like '%".$q."%' or M.morfologi like '%".$q."%' or T.topografi like '%".$q."%')" ; 
        }
        
        if($unitid==1){
         $sql="SELECT R.*,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END AS jkelamin,S.kodesubgrup,S.subgrup,S.stagingid as idstaging,M.kodemorfologi,M.morfologi,T.kodetopografi,T.topografi,P.propinsi,K.kabupaten FROM registrasi R
            LEFT JOIN subgrup S on S.id = R.subgrupid 
            LEFT JOIN morfologi M on M.id = R.morfologiid 
            LEFT JOIN topografi T on T.id = R.topografiid
            LEFT JOIN propinsi P on P.propid = R.propid 
            LEFT JOIN kabupaten K on K.kabid = R.kabid
            WHERE 1 AND R.deleted = 'n' AND R.validate = 'y' $where ORDER BY R.id DESC";
        }else{
             $sql="SELECT R.*,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END AS jkelamin,S.kodesubgrup,S.subgrup,S.stagingid as idstaging,M.kodemorfologi,M.morfologi,T.kodetopografi,T.topografi,P.propinsi,K.kabupaten FROM registrasi R
            LEFT JOIN subgrup S on S.id = R.subgrupid 
            LEFT JOIN morfologi M on M.id = R.morfologiid 
            LEFT JOIN topografi T on T.id = R.topografiid
            LEFT JOIN propinsi P on P.propid = R.propid 
            LEFT JOIN kabupaten K on K.kabid = R.kabid
            WHERE 1 AND R.deleted = 'n' AND R.unitid =  $unitid AND R.validate = 'y' $where ORDER BY R.id DESC";
        }

        $result['count'] = $this->db->query($sql)->num_rows();
        if($limit){
            $sql .=" LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function create(){
        return $this->db->insert('rekam_medik',array(
            'registrasiid'=>$this->input->post('registrasiid',true),
            'tgl_kunjungan'=>$this->input->post('tgl_kunjungan',true),
            'keluhan_utama'=>ltrim($this->input->get('optutama',true),','),
            'sikluske'=>$this->input->post('sikluske',true),
            'keluhan_utama_lainnya'=>$this->input->post('keluhan_utama_lainnya',true),
            'komplikasi_penyakit_dasar'=>$this->input->post('komplikasi_penyakit_dasar',true),
            'komplikasi_kemoterapi'=>ltrim($this->input->get('optkomplikasi',true),','),
            'infeksi_kemo'=>$this->input->post('infeksi_kemo',true),
            'non_infeksi_kemo'=>$this->input->post('non_infeksi_kemo',true),
            'evaluasi_pengobatan'=>$this->input->post('evaluasi_pengobatan',true),
            'tgl_evaluasi'=>$this->input->post('tgl_evaluasi',true),
            'evaluasi_pengobatan_lain'=>$this->input->post('evaluasi_pengobatan_lain',true),
            'periksa_fisik'=>ltrim($this->input->get('optfisik',true),','),
            'fisik_lainnya'=>$this->input->post('fisik_lainnya',true),
            'ukuran_tumor'=>$this->input->post('ukuran_tumor',true),
            'lokasi_tumor'=>$this->input->post('lokasi_tumor',true),
            'besar_hepar'=>$this->input->post('besar_hepar',true),
            'besar_lien'=>$this->input->post('besar_lien',true),
            'schuffner'=>$this->input->post('schuffner',true),
            'tgl_periksa_lab'=>$this->input->post('tgl_periksa_lab',true),
            'hemoglobin'=>$this->input->post('hemoglobin',true),
            'leukosit'=>$this->input->post('leukosit',true),
            'trombosit'=>$this->input->post('trombosit',true),
            'blast'=>$this->input->post('blast',true),
            'tumor_marker'=>$this->input->post('tumor_marker',true),
            'hasil'=>$this->input->post('hasil',true),
            'tambahan_infeksi'=>$this->input->post('tambahan_infeksi',true),
            'tambahan_non_infeksi'=>$this->input->post('tambahan_non_infeksi',true),
            'plan'=>ltrim($this->input->get('optplan',true),','),
            'plan_lainnya'=>$this->input->post('plan_lainnya',true),
            'user_insert'=>$this->session->userdata('username'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        ));
    }

    public function update($id){
        $data = array(
            'tgl_kunjungan'=>$this->input->post('tgl_kunjungan',true),
            'keluhan_utama'=>ltrim($this->input->get('optutama',true),','),
            'sikluske'=>$this->input->post('sikluske',true),
            'keluhan_utama_lainnya'=>$this->input->post('keluhan_utama_lainnya',true),
            'komplikasi_penyakit_dasar'=>$this->input->post('komplikasi_penyakit_dasar',true),
            'komplikasi_kemoterapi'=>ltrim($this->input->get('optkomplikasi',true),','),
            'infeksi_kemo'=>$this->input->post('infeksi_kemo',true),
            'non_infeksi_kemo'=>$this->input->post('non_infeksi_kemo',true),
            'evaluasi_pengobatan'=>$this->input->post('evaluasi_pengobatan',true),
            'tgl_evaluasi'=>$this->input->post('tgl_evaluasi',true),
            'evaluasi_pengobatan_lain'=>$this->input->post('evaluasi_pengobatan_lain',true),
            'periksa_fisik'=>ltrim($this->input->get('optfisik',true),','),
            'fisik_lainnya'=>$this->input->post('fisik_lainnya',true),
            'ukuran_tumor'=>$this->input->post('ukuran_tumor',true),
            'lokasi_tumor'=>$this->input->post('lokasi_tumor',true),
            'besar_hepar'=>$this->input->post('besar_hepar',true),
            'besar_lien'=>$this->input->post('besar_lien',true),
            'schuffner'=>$this->input->post('schuffner',true),
            'tgl_periksa_lab'=>$this->input->post('tgl_periksa_lab',true),
            'hemoglobin'=>$this->input->post('hemoglobin',true),
            'leukosit'=>$this->input->post('leukosit',true),
            'trombosit'=>$this->input->post('trombosit',true),
            'blast'=>$this->input->post('blast',true),
            'tumor_marker'=>$this->input->post('tumor_marker',true),
            'hasil'=>$this->input->post('hasil',true),
            'tambahan_infeksi'=>$this->input->post('tambahan_infeksi',true),
            'tambahan_non_infeksi'=>$this->input->post('tambahan_non_infeksi',true),
            'plan'=>ltrim($this->input->get('optplan',true),','),
            'plan_lainnya'=>$this->input->post('plan_lainnya',true),
            'user_update'=>$this->session->userdata('username'),
            'tgl_update'=>date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        return $this->db->update('rekam_medik', $data);
    }

    public function delete($id){
       
        $this->db->where('id', $id);
        return $this->db->update('rekam_medik', array(
            'deleted' => 'y',
            'user_delete'=>$this->session->userdata('username'),
            'tgl_delete'=>date('Y-m-d H:i:s')
        ));
    }

    public function options($type,$q){
        $this->db->where('deleted', 'n');
        $this->db->where('type', $type);
        $query = $this->db->get('options');
            return $query->result();
    }

    public function getkeluhanutama($id){
        $sql = "SELECT keluhan_penyerta FROM registrasi_spesifik_penyerta where registrasi_spesifikid = $spesifikid ";

       return $this->db->query($sql)->result();    
    }

    public function getdataoptions($id){
        $sql = "SELECT nama_options FROM options where id in ($id) ";
        return $this->db->query($sql)->result();    
    }
}