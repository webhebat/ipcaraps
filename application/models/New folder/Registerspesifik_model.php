<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Registerspesifik_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_registerspesifik($offset,$limit,$search,$warning,$jenis,$area,$tgl,$tgl2,$validate){
        $where = '';

        $unitid = $this->session->userdata('unitid');

        if($unitid!='1'){
            $where .= " AND R.unitid = '$unitid' "; 
        }

        $sql ="SELECT RS.*,R.noregistrasi,R.nama,R.nik,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl,R.jenis_kelamin,R.no_rekam, R.no_hp,R.no_hp2,O.nama_options as keluhanR, R.unitid, U.nama_unit  FROM registrasi_spesifik RS 
        LEFT JOIN registrasi R on R.id= RS.registrasiid 
        LEFT JOIN options O on RS.keluhan_utama= O.id
        LEFT JOIN unit U ON U.id = R.unitid  
        WHERE RS.deleted ='n' $where ";

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
        
        $sql="SELECT R.*,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END AS jkelamin,S.kodesubgrup,S.subgrup,S.stagingid as idstaging,M.kodemorfologi,M.morfologi,T.kodetopografi,T.topografi,P.nama as propinsi,K.nama as kabupaten FROM registrasi R
            LEFT JOIN subgrup S on S.id = R.subgrupid 
            LEFT JOIN morfologi M on M.id = R.morfologiid 
            LEFT JOIN topografi T on T.id = R.topografiid
            LEFT JOIN provinsi P on P.id_prov = R.id_prov 
            LEFT JOIN kabupaten K on K.id_kab = R.id_kab
            WHERE 1 AND R.deleted = 'n' AND R.validate = 'y' AND R.spesifik = 'n' AND R.subgrupid = '1' AND R.unitid = $unitid $where ORDER BY R.id DESC";

        $result['count'] = $this->db->query($sql)->num_rows();
        if($limit){
            $sql .=" LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function simpan($detail1,$detail2,$detail3){

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        // $jkelamin = $this->input->post('jenis_kelamin');
        // if($jkelamin=='l'){
        //     $j=1;
        // }else{
        //     $j=2;
        // }

        $data = array(
            'registrasiid'=>$this->input->post('registrasiid',true),
            'keluhan_utama'=>$this->input->post('keluhan_utama',true),
            'keluhan_utama_lainnya'=>$this->input->post('keluhan_utama_lainnya',true),
            'thn_keluhan'=>$this->input->post('thn_keluhan',true),
            'bln_keluhan'=>$this->input->post('bln_keluhan',true),
            'hari_keluhan'=>0,//,$this->input->post('hari_keluhan',true),
            'durasi_penyakit'=>$this->input->post('durasi_penyakit',true),
            'pemeriksaan_fisik'=>ltrim($this->input->get('fisik',true),','),
            'pemeriksaan_fisik_lainnya'=>$this->input->post('pemeriksaan_fisik_lainnya',true),
            'keluhan_penyerta_lainnya'=>$this->input->post('keluhan_penyerta_lainnya',true),
            'besar_hepar'=>$this->input->post('besar_hepar',true),
            'besar_spleen'=>$this->input->post('besar_spleen',true),
            'besar_schuffner'=>$this->input->post('besar_schuffner',true),
            'nama_limfadenopati'=>$this->input->post('nama_limfadenopati',true),
            'sindrom_penyerta_lainnya'=>$this->input->post('sindrom_penyerta_lainnya',true),
            'tanner_stage'=>$this->input->post('tanner_stage',true),
            'tgl_periksadarah'=>$this->input->post('tgl_periksadarah',true),
            'tgl_periksa_tulangbelakang'=>$this->input->post('tgl_periksa_tulangbelakang',true),
            'mieloblas'=>$this->input->post('mieloblas',true),
            'limfoblas'=>$this->input->post('limfoblas',true),
            'imunofenotipe'=>$this->input->post('imunofenotipe',true),
            'tgl_serebrospinal'=>$this->input->post('tgl_serebrospinal',true),
            'jml_sel'=>$this->input->post('jml_sel',true),
            'blast'=>$this->input->post('blast',true),
            'leukosit'=>$this->input->post('leukosit',true),
            'eritrosit'=>$this->input->post('eritrosit',true),
            'tgl_periksaurin'=>$this->input->post('tgl_periksaurin',true),
            'ph_urin'=>$this->input->post('ph_urin',true),
            'fab'=>$this->input->post('fab',true),
            'sitogenetik'=>$this->input->post('sitogenetik',true),
            'stratifikasi'=>$this->input->post('stratifikasi',true),
            'tgl_diagnosis'=>$this->input->post('tgl_diagnosis',true),
            'neutropenia'=>$this->input->post('neutropenia',true),
            'infeksi'=>ltrim($this->input->get('infeksi',true),','),
            'infeksi_lainnya'=>$this->input->post('infeksi_lainnya',true),
            'non_infeksi'=>ltrim($this->input->get('non_infeksi',true),','),
            'non_infeksi_lainnya'=>$this->input->post('non_infeksi_lainnya',true),
            'kuratif'=>$this->input->post('kuratif',true),
            'nonkuratif'=>$this->input->post('nonkuratif',true),
            'alasan_tidak_lainnya'=>$this->input->post('alasan_tidak_lainnya',true),
            'paliatif'=>$this->input->post('paliatif',true),
            'optpaliatif'=>ltrim($this->input->get('optpaliatif',true),','),
            'optpain'=>ltrim($this->input->get('optpain',true),','),
            'pain_lainnya'=>$this->input->post('pain_lainnya',true),
            'obat_kemo'=>$this->input->post('obat_kemo',true),
            'tgl_mulaikemo'=>$this->input->post('tgl_mulaikemo',true),
            'tgl_selesaikemo'=>$this->input->post('tgl_selesaikemo',true),
            'jml_siklus'=>$this->input->post('jml_siklus',true),
            'lokasi_radioterapi'=>$this->input->post('lokasi_radioterapi',true),
            'radioterapi_lainnya'=>$this->input->post('radioterapi_lainnya',true),
            'user_insert'=>$this->session->userdata('username'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );

        $this->db->insert('registrasi_spesifik', $data);
        $regspesifik_id = $this->db->insert_id();
        //return true;
        if(count($detail1)!=0){
            $result=array();
            for($i=0;$i<count($detail1);$i++){
                
                $result[] = array(
                    'registrasi_spesifikid'=>$regspesifik_id,
                    'penyertaid'=>$detail1[$i]['penyertaid'],
                    'keluhan_penyerta'=>$detail1[$i]['keluhan_penyerta'],
                    'tanggal'=>$detail1[$i]['tanggal'],
                );
            }
            $this->db->insert_batch('registrasi_spesifik_penyerta', $result);
        }

        if(count($detail2)!=0){

            $result2=array();
            for($x=0;$x<count($detail2);$x++){
                $result2[] = array(
                    'registrasi_spesifikid'=>$regspesifik_id,
                    'darah'=>$detail2[$x]['nama_options'],
                    'jml'=>isset($detail2[$x]['jml']) ? $detail2[$x]['jml'] : '',
                    'ket'=>$detail2[$x]['ket'],
                );
            }
            $this->db->insert_batch('registrasi_spesifik_darah', $result2);
        }

        if(count($detail3)!=0){

            $result3=array();
            for($y=0;$y<count($detail3);$y++){
                $result3[] = array(
                    'registrasi_spesifikid'=>$regspesifik_id,
                    'nama_jenis'=>$detail3[$y]['nama_options'],
                    'jml'=>isset($detail3[$y]['jml']) ? $detail3[$y]['jml'] : '',
                    'ket'=>$detail3[$y]['ket'],
                );
            }
            $this->db->insert_batch('registrasi_spesifik_darah_jenis', $result3);
        }

        $this->db->where('id', $this->input->post('registrasiid',true));
        $this->db->update('registrasi', array('spesifik' => 'y'));

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }

    public function update($id,$detail1,$detail2,$detail3){
        $this->db->trans_begin();

        $data = array(
            'keluhan_utama'=>$this->input->post('keluhan_utama',true),
            'keluhan_utama_lainnya'=>$this->input->post('keluhan_utama_lainnya',true),
            'thn_keluhan'=>$this->input->post('thn_keluhan',true),
            'bln_keluhan'=>$this->input->post('bln_keluhan',true),
            'hari_keluhan'=>0,//,$this->input->post('hari_keluhan',true),
            'durasi_penyakit'=>$this->input->post('durasi_penyakit',true),
            'pemeriksaan_fisik'=>ltrim($this->input->get('fisik',true),','),
            'pemeriksaan_fisik_lainnya'=>$this->input->post('pemeriksaan_fisik_lainnya',true),
            'keluhan_penyerta_lainnya'=>$this->input->post('keluhan_penyerta_lainnya',true),
            'besar_hepar'=>$this->input->post('besar_hepar',true),
            'besar_spleen'=>$this->input->post('besar_spleen',true),
            'besar_schuffner'=>$this->input->post('besar_schuffner',true),
            'nama_limfadenopati'=>$this->input->post('nama_limfadenopati',true),
            'sindrom_penyerta_lainnya'=>$this->input->post('sindrom_penyerta_lainnya',true),
            'tanner_stage'=>$this->input->post('tanner_stage',true),
            'tgl_periksadarah'=>$this->input->post('tgl_periksadarah',true),
            'tgl_periksa_tulangbelakang'=>$this->input->post('tgl_periksa_tulangbelakang',true),
            'mieloblas'=>$this->input->post('mieloblas',true),
            'limfoblas'=>$this->input->post('limfoblas',true),
            'imunofenotipe'=>$this->input->post('imunofenotipe',true),
            'tgl_serebrospinal'=>$this->input->post('tgl_serebrospinal',true),
            'jml_sel'=>$this->input->post('jml_sel',true),
            'blast'=>$this->input->post('blast',true),
            'leukosit'=>$this->input->post('leukosit',true),
            'eritrosit'=>$this->input->post('eritrosit',true),
            'tgl_periksaurin'=>$this->input->post('tgl_periksaurin',true),
            'ph_urin'=>$this->input->post('ph_urin',true),
            'fab'=>$this->input->post('fab',true),
            'sitogenetik'=>$this->input->post('sitogenetik',true),
            'stratifikasi'=>$this->input->post('stratifikasi',true),
            'tgl_diagnosis'=>$this->input->post('tgl_diagnosis',true),
            'neutropenia'=>$this->input->post('neutropenia',true),
            'infeksi'=>ltrim($this->input->get('infeksi',true),','),
            'infeksi_lainnya'=>$this->input->post('infeksi_lainnya',true),
            'non_infeksi'=>ltrim($this->input->get('non_infeksi',true),','),
            'non_infeksi_lainnya'=>$this->input->post('non_infeksi_lainnya',true),
            'kuratif'=>$this->input->post('kuratif',true),
            'nonkuratif'=>$this->input->post('nonkuratif',true),
            'alasan_tidak_lainnya'=>$this->input->post('alasan_tidak_lainnya',true),
            'paliatif'=>$this->input->post('paliatif',true),
            'optpaliatif'=>ltrim($this->input->get('optpaliatif',true),','),
            'optpain'=>ltrim($this->input->get('optpain',true),','),
            'pain_lainnya'=>$this->input->post('pain_lainnya',true),
            'obat_kemo'=>$this->input->post('obat_kemo',true),
            'tgl_mulaikemo'=>$this->input->post('tgl_mulaikemo',true),
            'tgl_selesaikemo'=>$this->input->post('tgl_selesaikemo',true),
            'jml_siklus'=>$this->input->post('jml_siklus',true),
            'lokasi_radioterapi'=>$this->input->post('lokasi_radioterapi',true),
            'radioterapi_lainnya'=>$this->input->post('radioterapi_lainnya',true),
            'user_update'=>$this->session->userdata('username'),
            'tgl_update'=>date('Y-m-d H:i:s')
        );

        $this->db->where('id', $id);
        $this->db->update('registrasi_spesifik', $data);
        
        //return true;
        if(count($detail1)!=0){
            $this->db->where('registrasi_spesifikid', $id);
            $this->db->delete('registrasi_spesifik_penyerta');

            $result=array();
            for($i=0;$i<count($detail1);$i++){
                
                $result[] = array(
                    'registrasi_spesifikid'=>$id,
                    'penyertaid'=>$detail1[$i]['penyertaid'],
                    'keluhan_penyerta'=>$detail1[$i]['keluhan_penyerta'],
                    'tanggal'=>$detail1[$i]['tanggal'],
                );
            }
            $this->db->insert_batch('registrasi_spesifik_penyerta', $result);
        }

        if(count($detail2)!=0){
            $this->db->where('registrasi_spesifikid', $id);
            $this->db->delete('registrasi_spesifik_darah');

            $result2=array();
            for($x=0;$x<count($detail2);$x++){
                $result2[] = array(
                    'registrasi_spesifikid'=>$id,
                    'darah'=>$detail2[$x]['nama_options'],
                    'jml'=>isset($detail2[$x]['jml']) ? $detail2[$x]['jml'] : '',
                    'ket'=>$detail2[$x]['ket'],
                );
            }
            $this->db->insert_batch('registrasi_spesifik_darah', $result2);
        }

        if(count($detail3)!=0){
            $this->db->where('registrasi_spesifikid', $id);
            $this->db->delete('registrasi_spesifik_darah_jenis');

            $result3=array();
            for($y=0;$y<count($detail3);$y++){
                $result3[] = array(
                    'registrasi_spesifikid'=>$id,
                    'nama_jenis'=>$detail3[$y]['nama_options'],
                    'jml'=>isset($detail3[$y]['jml']) ? $detail3[$y]['jml'] : '',
                    'ket'=>$detail3[$y]['ket'],
                );
            }
            $this->db->insert_batch('registrasi_spesifik_darah_jenis', $result3);
        }

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }

    public function validate($id,$detail,$detail2){
        $this->db->trans_begin();

        $nounit = $this->session->userdata('nounit');
        $jkelamin = $this->input->post('jenis_kelamin');
        if($jkelamin=='l'){
            $j=1;
        }else{
            $j=2;
        }

        $data = array(

            'nama'=>$this->input->post('nama'),
            'nik'=>$this->input->post('nik'),
            'tempat_lahir'=>$this->input->post('tempat_lahir'),
            'tgl_lahir'=>$this->input->post('tgl_lahir'),
            'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
            'th_terdiagnosis'=>$this->input->post('th_terdiagnosis'),
            'bln_terdiagnosis'=>$this->input->post('bln_terdiagnosis'),
            'alamat'=>$this->input->post('alamat'),
            'rt'=>$this->input->post('rt'),
            'rw'=>$this->input->post('rw'),
            'id_prov'=>$this->input->post('id_prov'),
            'id_kab'=>$this->input->post('id_kab'),
            'id_kec'=>$this->input->post('id_kec'),
            'id_kel'=>$this->input->post('id_kel'),
            'alamat_2'=>$this->input->post('alamat_2'),
            'rt_2'=>$this->input->post('rt_2'),
            'rw_2'=>$this->input->post('rw_2'),
            'id_prov_2'=>$this->input->post('id_prov_2'),
            'id_kab_2'=>$this->input->post('id_kab_2'),
            'id_kec_2'=>$this->input->post('id_kec_2'),
            'id_kel_2'=>$this->input->post('id_kel_2'),
            'no_rekam'=>$this->input->post('no_rekam'),
            'no_bpjs'=>$this->input->post('no_bpjs'),
            'no_hp'=>$this->input->post('no_hp'),
            'bb'=>$this->input->post('bb'),
            'tb'=>$this->input->post('tb'),
            'kesimpulan'=>$this->input->post('kesimpulan'),
            'nama_ayah'=>$this->input->post('nama_ayah'),
            'nama_ibu'=>$this->input->post('nama_ibu'),
            'berat_lahir'=>$this->input->post('berat_lahir'),
            'imunisasi'=>$this->input->post('imunisasi'),
            'asi'=>$this->input->post('asi'),
            'riwayat'=>$this->input->post('riwayat'),
            'ppk1'=>$this->input->post('ppk1'),
            'tgl_ppk1'=>$this->input->post('tgl_ppk1'),
            'ppk2'=>$this->input->post('ppk2'),
            'tgl_ppk2'=>$this->input->post('tgl_ppk2'),
            'tgl_konsultasi'=>$this->input->post('tgl_konsultasi'),
            'subgrupid'=>$this->input->post('subgrupid'),
            'topografiid'=>$this->input->post('topografiid'),
            'morfologiid'=>$this->input->post('morfologiid'),
            'tatalaksanaid'=>$this->input->post('tatalaksanaid'),
            'stagingid'=>$this->input->post('stagingid'),
            'validate'=>'y',
            'user_validate'=>$this->session->userdata('username'),
            'tgl_validate'=>date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('registrasi', $data);
        
        if(count($detail)!=0){

            $this->db->where('registrasiid', $id);
            $this->db->delete('registrasi_riwayat');
 
            $result=array();
            for($i=0;$i<count($detail);$i++){
                
                $result[] = array(
                    'registrasiid'=>$id,
                    'keluarga'=>$detail[$i]['keluarga'],
                    'jenis_kanker'=>$detail[$i]['jenis_kanker']
                );
            }
            $this->db->insert_batch('registrasi_riwayat', $result);
        }

        $this->db->where('registrasiid', $id);
        $this->db->delete('registrasi_diagnosis');

        $result2=array();
        for($x=0;$x<count($detail2);$x++){
            
            $result2[] = array(
                'registrasiid'=>$id,
                'diagnosis'=>$detail2[$x]['diagnosis'],
                'tgl_diagnosis'=>$detail2[$x]['tgl_diagnosis']
            );
        }
        $this->db->insert_batch('registrasi_diagnosis', $result2);

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return true;
        }
        else
        {
                $this->db->trans_commit();
                return false;
        }
    }

    public function delete($id){
       
        $this->db->where('id', $id);
        return $this->db->update('registrasi_spesifik', array(
            'deleted' => 'y',
            'user_delete'=>$this->session->userdata('username'),
            'tgl_delete'=>date('Y-m-d H:i:s')
        ));
    }

    

    public function delete_validasi($id){
        $this->db->where('id',$id);
        $this->db->delete('validasi');
    }

    public function caritumor($offset, $limit,$q,$kategori)
    {
            $sql="SELECT S.*,M.id as idmorfologi, M.kodemorfologi,M.morfologi,T.id as idtopografi, T.kodetopografi, T.topografi FROM subgrup S left join morfologi M on M.subgrupid = S.id left join topografi T on T.subgrupid = S.id WHERE 1 AND S.aktif = 'y' ";

        // if ($q!=''){
        //    echo  $sql .=" AND S.subgrup like '%$q%' or M.morfologi like '%$q%' or T.topografi like '%$q%'"; 
        // }
        if($kategori=='mor'){
             $sql .=" AND M.kodemorfologi = '$q' "; 
        }
        if($kategori=='top'){
             $sql .=" AND T.kodetopografi = '$q' "; 
        }
        if($kategori=='all'){
            $sql .=" AND S.subgrup like '%$q%' or M.kodemorfologi like '%$q%' or M.morfologi like '%$q%' or T.kodetopografi like '%$q%' or T.topografi like '%$q%'";
        }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function opt_provinsi($offset, $limit, $search='',$q){
         $sql="SELECT * FROM provinsi
            WHERE 1 AND aktif = 'y' AND provinsi like '%".$q."%' OR id_prov = '".$q."' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function opt_kabupaten($offset, $limit, $search='',$q,$id_prov){
          $sql="SELECT * FROM kabupaten
            WHERE 1 AND aktif = 'y' AND kabupaten like '%".$q."%' ";

            if($id_prov!=''){
            	$sql .="AND id_prov = '$id_prov' ";
            }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function opt_kecamatan($offset, $limit, $search='',$q,$id_kab){
          $sql="SELECT * FROM kecamatan
            WHERE 1 AND aktif = 'y' AND kecamatan like '%".$q."%' ";

            if($id_kab!=''){
            	$sql .="AND id_kab = '$id_kab' ";
            }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    } 

    public function opt_desa($offset, $limit, $search='',$q,$id_kec){
          $sql="SELECT * FROM desa
            WHERE 1 AND aktif = 'y' AND desa like '%".$q."%' ";

            if($id_kec!=''){
            	$sql .="AND id_kec = '$id_kec' ";
            }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function optdiagnosis($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('dasardiagnosis');
            return $query->result();
    } 

    public function opttatalaksana($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('tatalaksana');
            return $query->result();
    }

    public function getstaging($stagingid){
        $this->db->where('aktif', 'y');
        if($stagingid){
            $sql = "SELECT id,staging, CASE WHEN tingkat=1 THEN 'Tingkat 1' WHEN tingkat=2 THEN 'Tingkat 2' END AS grup FROM staging where id IN($stagingid)";
            $result['count'] = $this->db->query($sql)->num_rows();
            //$sql .=" LIMIT {$offset},{$limit} ";
            $result = $this->db->query($sql)->result();

            return $result;
            //var_dump($result);
        }else{
            return array("id"=>0, "staging"=>"", "grup"=>"0");
        }    
    }

    public function getdatapenyerta($spesifikid){
            $sql = "SELECT * FROM registrasi_spesifik_penyerta where registrasi_spesifikid = $spesifikid";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
        //return $result = $this->db->query($sql)->result();      
    }

    public function getdatapenyerta2($spesifikid){
        $sql = "SELECT keluhan_penyerta FROM registrasi_spesifik_penyerta where registrasi_spesifikid = $spesifikid ";

       return $this->db->query($sql)->result();    
    }

    public function getkomplikasi($kuratifid){
        $sql = "SELECT nama_komplikasi FROM komplikasi_kemo where kuratifid = $kuratifid ";

       return $this->db->query($sql)->result();    
    }

    public function getdataoptions($id){
        $sql = "SELECT nama_options FROM options where id in ($id) ";
        return $this->db->query($sql)->result();    
    }

    public function getdatakomplikasi($id){
            $sql = "SELECT * FROM komplikasi_kemo where kuratifid = $id";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
            //return $result = $this->db->query($sql)->result();      
    }

    public function getdatasuportif($id){
            $sql = "SELECT *, jenis_terapi AS nama_options FROM terapi_suportif where kuratifid = $id";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
            //return $result = $this->db->query($sql)->result();      
    }

    public function getdatadarah($spesifikid){
            $sql = "SELECT *, darah as nama_options FROM registrasi_spesifik_darah where registrasi_spesifikid = $spesifikid";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
            //return $result = $this->db->query($sql)->result();      
    }

    public function getdatajenis($spesifikid){
            $sql = "SELECT *, nama_jenis as nama_options FROM registrasi_spesifik_darah_jenis where registrasi_spesifikid = $spesifikid";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
            //return $result = $this->db->query($sql)->result();      
    }

    public function getdatadarahfollowup($id){
            $sql = "SELECT *, darah AS nama_options FROM followup_darah where followupid = $id";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
            //return $result = $this->db->query($sql)->result();      
    }
    public function getdatajenisfollowup($id){
            $sql = "SELECT *, jenis AS nama_options FROM followup_jenis where followupid = $id";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
            //return $result = $this->db->query($sql)->result();      
    }

    public function get_tatalaksana($id){
        if($id){
             $sql = "SELECT id,tatalaksana FROM tatalaksana where id IN($id)"; 
        }else{
             $sql = "SELECT id,tatalaksana FROM tatalaksana where id IN(0)";
        }       
        return $result = $this->db->query($sql)->result();    
    }

    public function get_tatalaksana2($id){
        if($id){
             $sql = "SELECT tatalaksana FROM tatalaksana where id IN($id)"; 
        }else{
             $sql = "SELECT tatalaksana FROM tatalaksana where id IN(0)";
        }       
        return $result = $this->db->query($sql)->result();    
    }

    public function get_luaran($id)
    {
        $where = '';
        // if ($search){
        //     $where .= " AND (R.nama like '%".$search."%')" ; 
        // }
        
        $sql="SELECT L.*,CASE WHEN L.status = 1 THEN 'Hidup' WHEN L.status = 2 THEN 'Loss to follow up' WHEN L.status = 3 THEN 'Meninggal' END AS newstatus, CASE WHEN L.status2 = 'cm' THEN 'Complete Remission' WHEN L.status2 = 'st' THEN 'Stable Disease' WHEN L.status2 = 're' THEN 'Relaps' WHEN L.status2 = 'pr' THEN 'Progresif' END AS statusnow,L.tindakan as idtindakan, R.nama FROM luaran L
            LEFT JOIN registrasi R on R.id = L.registrasiid 
            WHERE 1 AND L.deleted = 'n' AND L.registrasiid = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        // if($limit){
        //     $sql .=" LIMIT {$offset},{$limit} ";
        // }
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function createluaran(){
        $data = array(
            'registrasiid'=>$this->input->post('registrasiid'),
            'tgl_abstraksi'=>$this->input->post('tgl_abstraksi'),
            'status'=>$this->input->post('status'),
            'status2'=>$this->input->post('status2'),
            'date_loss'=>$this->input->post('date_loss'),
            'date_meninggal'=>$this->input->post('date_meninggal'),
            'date_complete'=>$this->input->post('date_complete'),
            'date_stable'=>$this->input->post('date_stable'),
            'date_relaps'=>$this->input->post('date_relaps'),
            'date_progresif'=>$this->input->post('date_progresif'),
            'rumah_sakit'=>$this->input->post('rumah_sakit'),
            'tindakan'=>$this->input->post('tindakan'),
            'sebab_kematian'=>$this->input->post('sebab_kematian'),
            'ket_lainnya'=>$this->input->post('ket_lainnya'),
            'user_insert'=>$this->session->userdata('username'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );

        return $this->db->insert('luaran', $data);
    }

    public function updateluaran($id){
        $data = array(
            'registrasiid'=>$this->input->post('registrasiid'),
            'tgl_abstraksi'=>$this->input->post('tgl_abstraksi'),
            'status'=>$this->input->post('status'),
            'status2'=>$this->input->post('status2'),
            'date_loss'=>$this->input->post('date_loss'),
            'date_meninggal'=>$this->input->post('date_meninggal'),
            'date_complete'=>$this->input->post('date_complete'),
            'date_stable'=>$this->input->post('date_stable'),
            'date_relaps'=>$this->input->post('date_relaps'),
            'date_progresif'=>$this->input->post('date_progresif'),
            'rumah_sakit'=>$this->input->post('rumah_sakit'),
            'tindakan'=>$this->input->post('tindakan'),
            'sebab_kematian'=>$this->input->post('sebab_kematian'),
            'ket_lainnya'=>$this->input->post('ket_lainnya')
        );
        $this->db->where('id',$id);
        return $this->db->update('luaran', $data);
    }

    public function deleteluaran($id){
       
        $this->db->where('id', $id);
        return $this->db->update('luaran', array(
            'deleted' => 'y',
            'user_delete'=>$this->session->userdata('username'),
            'tgl_delete'=>date('Y-m-d H:i:s')
        ));
    }

    public function simpankuratif($detail1,$detail2){

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        $data = array(
            'register_spesifikid'=>$this->input->post('register_spesifikid',true),
            'fase_kemo'=>$this->input->post('fase_kemo',true),
            'protokol'=>ltrim($this->input->get('optprotokol',true),','),
            'tgl_mulai'=>$this->input->post('tgl_mulai',true),
            'tgl_selesai'=>$this->input->post('tgl_selesai',true),
            'jenis_obat'=>ltrim($this->input->get('optjenis',true),','),
            'tempat_kemoterapi'=>$this->input->post('tempat_kemoterapi',true),
            'komplikasi_kemo_lainnya'=>$this->input->post('komplikasi_kemo_lainnya',true),
            'obat_komplikasi_lain'=>$this->input->post('obat_komplikasi_lain',true),
            'alergi_obat'=>$this->input->post('alergi_obat',true),
            'nama_alergi_obat'=>$this->input->post('nama_alergi_obat',true),
            'hasil_evaluasi'=>$this->input->post('hasil_evaluasi',true),
            'parsial_persen'=>$this->input->post('parsial_persen',true),
            'tgl_remisi'=>$this->input->post('tgl_remisi',true),
            'tgl_periksa_tulang'=>$this->input->post('tgl_periksa_tulang',true),
            'selularitas'=>$this->input->post('selularitas',true),
            'eritopoiesis'=>$this->input->post('eritopoiesis',true),
            'granulopoeisis'=>$this->input->post('granulopoeisis',true),
            'tromobopoeisis'=>$this->input->post('tromobopoeisis',true),
            'mieloblas'=>$this->input->post('mieloblas',true),
            'limfoblas'=>$this->input->post('limfoblas',true),
            'tgl_periksa_mrd'=>$this->input->post('tgl_periksa_mrd',true),
            'status_mrd'=>$this->input->post('status_mrd',true),
            'kelengkapan_kemo'=>$this->input->post('kelengkapan_kemo',true),
            'tambahan_pengobatan'=>$this->input->post('tambahan_pengobatan',true),
            'nama_pengobatan_tambahan'=>$this->input->post('nama_pengobatan_tambahan',true),
            'user_insert'=>$this->session->userdata('username'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );

        $this->db->insert('manajemen_kuratif', $data);
        $kuratifid = $this->db->insert_id();
        //return true;
        if(count($detail1)!=0){
            $result=array();
            for($i=0;$i<count($detail1);$i++){
                
                $result[] = array(
                    'kuratifid'=>$kuratifid,
                    'nama_komplikasi'=>$detail1[$i]['nama_komplikasi'],
                    'nama_obat'=>$detail1[$i]['nama_obat'],
                );
            }
            $this->db->insert_batch('komplikasi_kemo', $result);
        }

        if(count($detail2)!=0){

            $result2=array();
            for($x=0;$x<count($detail2);$x++){
                $result2[] = array(
                    'kuratifid'=>$kuratifid,
                    'jenis_terapi'=>$detail2[$x]['nama_options'],
                    'dosis'=>isset($detail2[$x]['dosis']) ? $detail2[$x]['dosis'] : '',
                    'minggu'=>isset($detail2[$x]['minggu']) ? $detail2[$x]['minggu'] : '',
                );
            }
            $this->db->insert_batch('terapi_suportif', $result2);
        }

        // $this->db->where('id', $this->input->post('registrasiid',true));
        // $this->db->update('registrasi', array('spesifik' => 'y'));

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }

    public function updatekuratif($id,$detail1,$detail2){

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        $data = array(
            'register_spesifikid'=>$this->input->post('register_spesifikid',true),
            'fase_kemo'=>$this->input->post('fase_kemo',true),
            'protokol'=>ltrim($this->input->get('optprotokol',true),','),
            'tgl_mulai'=>$this->input->post('tgl_mulai',true),
            'tgl_selesai'=>$this->input->post('tgl_selesai',true),
            'jenis_obat'=>ltrim($this->input->get('optjenis',true),','),
            'tempat_kemoterapi'=>$this->input->post('tempat_kemoterapi',true),
            'komplikasi_kemo_lainnya'=>$this->input->post('komplikasi_kemo_lainnya',true),
            'obat_komplikasi_lain'=>$this->input->post('obat_komplikasi_lain',true),
            'alergi_obat'=>$this->input->post('alergi_obat',true),
            'nama_alergi_obat'=>$this->input->post('nama_alergi_obat',true),
            'hasil_evaluasi'=>$this->input->post('hasil_evaluasi',true),
            'parsial_persen'=>$this->input->post('parsial_persen',true),
            'tgl_remisi'=>$this->input->post('tgl_remisi',true),
            'tgl_periksa_tulang'=>$this->input->post('tgl_periksa_tulang',true),
            'selularitas'=>$this->input->post('selularitas',true),
            'eritopoiesis'=>$this->input->post('eritopoiesis',true),
            'granulopoeisis'=>$this->input->post('granulopoeisis',true),
            'tromobopoeisis'=>$this->input->post('tromobopoeisis',true),
            'mieloblas'=>$this->input->post('mieloblas',true),
            'limfoblas'=>$this->input->post('limfoblas',true),
            'tgl_periksa_mrd'=>$this->input->post('tgl_periksa_mrd',true),
            'status_mrd'=>$this->input->post('status_mrd',true),
            'kelengkapan_kemo'=>$this->input->post('kelengkapan_kemo',true),
            'tambahan_pengobatan'=>$this->input->post('tambahan_pengobatan',true),
            'nama_pengobatan_tambahan'=>$this->input->post('nama_pengobatan_tambahan',true),
            'user_insert'=>$this->session->userdata('username'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('manajemen_kuratif', $data);
        //return true;
        if(count($detail1)!=0){
            $this->db->where('kuratifid', $id);
            $this->db->delete('komplikasi_kemo');
            $result=array();
            for($i=0;$i<count($detail1);$i++){
                
                $result[] = array(
                    'kuratifid'=>$id,
                    'nama_komplikasi'=>$detail1[$i]['nama_komplikasi'],
                    'nama_obat'=>$detail1[$i]['nama_obat'],
                );
            }
            $this->db->insert_batch('komplikasi_kemo', $result);
        }

        if(count($detail2)!=0){
            $this->db->where('kuratifid', $id);
            $this->db->delete('terapi_suportif');
            $result2=array();
            for($x=0;$x<count($detail2);$x++){
                $result2[] = array(
                    'kuratifid'=>$id,
                    'jenis_terapi'=>$detail2[$x]['nama_options'],
                    'dosis'=>isset($detail2[$x]['dosis']) ? $detail2[$x]['dosis'] : '',
                    'minggu'=>isset($detail2[$x]['minggu']) ? $detail2[$x]['minggu'] : '',
                );
            }
            $this->db->insert_batch('terapi_suportif', $result2);
        }

        // $this->db->where('id', $this->input->post('registrasiid',true));
        // $this->db->update('registrasi', array('spesifik' => 'y'));

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }

    public function get_kuratif($offset,$limit,$id)
    {
        $where = '';        
        $sql="SELECT K.* FROM manajemen_kuratif K where K.deleted = 'n' AND K.register_spesifikid = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if($limit){
            $sql .=" LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function get_followup($offset,$limit,$id)
    {
        $where = '';        
        $sql="SELECT F.* FROM followup F where F.deleted = 'n' AND F.register_spesifikid2 = '$id' $where ";

        $result['count'] = $this->db->query($sql)->num_rows();
        if($limit){
            $sql .=" LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }


    public function simpanfollowup($detail1,$detail2){

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        $data = array(
            'register_spesifikid2'=>$this->input->post('register_spesifikid2',true),
            'tgl_abstraksi'=>$this->input->post('tgl_abstraksi',true),
            'tgl_periksa_darah'=>$this->input->post('tgl_periksa_darah',true),
            'tgl_periksa_tulang'=>$this->input->post('tgl_periksa_tulang',true),
            'selularitas2'=>$this->input->post('selularitas2',true),
            'eritopoiesis2'=>$this->input->post('eritopoiesis2',true),
            'granulopoeisis2'=>$this->input->post('granulopoeisis2',true),
            'tromobopoeisis2'=>$this->input->post('tromobopoeisis2',true),
            'mieloblas2'=>$this->input->post('mieloblas2',true),
            'limfoblas2'=>$this->input->post('limfoblas2',true),
            'user_insert'=>$this->session->userdata('username'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );

        $this->db->insert('followup', $data);
        $followupid = $this->db->insert_id();
        //return true;
        if(count($detail1)!=0){
            $result=array();
            for($i=0;$i<count($detail1);$i++){
                
                $result[] = array(
                    'followupid'=>$followupid,
                    'darah'=>$detail1[$i]['nama_options'],
                    'jml'=>isset($detail1[$i]['jml']) ? $detail1[$i]['jml'] : '',
                    'ket'=>$detail1[$i]['ket'],
                );
            }
            $this->db->insert_batch('followup_darah', $result);
        }

        if(count($detail2)!=0){

            $result2=array();
            for($x=0;$x<count($detail2);$x++){
                $result2[] = array(
                    'followupid'=>$followupid,
                    'jenis'=>$detail2[$x]['nama_options'],
                    'jml'=>isset($detail2[$x]['jml']) ? $detail2[$x]['jml'] : '',
                    'ket'=>$detail2[$x]['ket'],
                );
            }
            $this->db->insert_batch('followup_jenis', $result2);
        }

        // $this->db->where('id', $this->input->post('registrasiid',true));
        // $this->db->update('registrasi', array('spesifik' => 'y'));

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }

    public function updatefollowup($id,$detail1,$detail2){

        $this->db->trans_begin();

        // $nounit = $this->session->userdata('nounit');
        $data = array(
            'register_spesifikid2'=>$this->input->post('register_spesifikid2',true),
            'tgl_abstraksi'=>$this->input->post('tgl_abstraksi',true),
            'tgl_periksa_darah'=>$this->input->post('tgl_periksa_darah',true),
            'tgl_periksa_tulang'=>$this->input->post('tgl_periksa_tulang',true),
            'selularitas2'=>$this->input->post('selularitas2',true),
            'eritopoiesis2'=>$this->input->post('eritopoiesis2',true),
            'granulopoeisis2'=>$this->input->post('granulopoeisis2',true),
            'tromobopoeisis2'=>$this->input->post('tromobopoeisis2',true),
            'mieloblas2'=>$this->input->post('mieloblas2',true),
            'limfoblas2'=>$this->input->post('limfoblas2',true),
            'user_update'=>$this->session->userdata('username'),
            'tgl_update'=>date('Y-m-d H:i:s')
        );
        $this->db->where('id',$id);
        $this->db->update('followup', $data);
        //return true;
        if(count($detail1)!=0){
            $this->db->where('followupid', $id);
            $this->db->delete('followup_darah');
            $result=array();
            for($i=0;$i<count($detail1);$i++){
                
                $result[] = array(
                    'followupid'=>$id,
                    'darah'=>$detail1[$i]['nama_options'],
                    'jml'=>isset($detail1[$i]['jml']) ? $detail1[$i]['jml'] : '',
                    'ket'=>$detail1[$i]['ket'],
                );
            }
            $this->db->insert_batch('followup_darah', $result);
        }

        if(count($detail2)!=0){
            $this->db->where('followupid', $id);
            $this->db->delete('followup_jenis');
            $result2=array();
            for($x=0;$x<count($detail2);$x++){
                $result2[] = array(
                    'followupid'=>$id,
                    'jenis'=>$detail2[$x]['nama_options'],
                    'jml'=>isset($detail2[$x]['jml']) ? $detail2[$x]['jml'] : '',
                    'ket'=>$detail2[$x]['ket'],
                );
            }
            $this->db->insert_batch('followup_jenis', $result2);
        }

        // $this->db->where('id', $this->input->post('registrasiid',true));
        // $this->db->update('registrasi', array('spesifik' => 'y'));

        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                return false;
        }
        else
        {
                $this->db->trans_commit();
                return true;
        }
    }

    public function deletefollowup($id){
       
        $this->db->where('id', $id);
        return $this->db->update('followup', array(
            'deleted' => 'y',
            'deleted_by'=>$this->session->userdata('username'),
            'date_deleted'=>date('Y-m-d H:i:s')
        ));
    }

    public function options($type,$q){
        $this->db->where('deleted', 'n');
        $this->db->where('type', $type);
        $query = $this->db->get('options');
            return $query->result();
    }

}