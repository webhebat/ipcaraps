<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Registrasi_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_no_urut(){
        $sql= $this->db->query("SELECT MAX(RIGHT(no_urut,5)) as kodemax FROM registrasi ");
        $kd = "";
        if($sql->num_rows()>0){
            foreach($sql->result() as $k){
                $tmp = ((int)$k->kodemax)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }else{
            $kd = "00001";
        }

        $data['nourut'] = $kd;

        return $kd;
    }

    public function get_registrasi($offset,$limit,$search,$validasi,$unit,$tgl,$tgl2,$luaran,$subgrupid)
    {

        $unitid = $this->session->userdata('unitid');
        $where = '';
        if ($search){
            $where .= " AND (R.nama like '%".$search."%' or R.nik like '%".$search."%' or R.alamat like '%".$search."%')" ; 
        }

        if($tgl){
            $now = date('Y-m-d');//$tgl;
        }else{
            $now = date('Y-m-d');
        }

        if(($tgl||$tgl2)!=''){
            $where .= " AND DATE(R.tgl_insert) between '$tgl' and '$tgl2' ";
        }
        
        if($validasi){
            $where .= " AND R.validate = '".$validasi."'";
        }

        if($luaran=='y'){
            $where .= " AND L.registrasiid IS NOT NULL ";
        }elseif($luaran=='n'){
            $where .= " AND L.registrasiid IS NULL ";
        }

        if($unit){
            $where .= " AND R.unitid = '".$unit."'";
        }

        if($subgrupid){
             $where .= " AND R.subgrupid = '".$subgrupid."'";
        }

        if($unitid==1){
        $sql="SELECT R.*,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END AS jkelamin,S.kodesubgrup,S.subgrup,S.stagingid as idstaging,M.kodemorfologi,M.morfologi,T.kodetopografi,T.topografi,P.propinsi,K.kabupaten,KEC.kecamatan,DES.desa,U.nama_unit,L.registrasiid FROM registrasi R
            LEFT JOIN subgrup S on S.id = R.subgrupid 
            LEFT JOIN morfologi M on M.id = R.morfologiid 
            LEFT JOIN topografi T on T.id = R.topografiid
            LEFT JOIN propinsi P on P.propid = R.propid 
            LEFT JOIN kabupaten K on K.kabid = R.kabid
            LEFT JOIN kecamatan KEC on KEC.camatid = R.camatid
            LEFT JOIN desa DES on DES.desaid = R.desaid
            LEFT JOIN unit U on U.id = R.unitid
            LEFT JOIN luaran L ON R.id = L.registrasiid
            WHERE 1 AND R.deleted = 'n' $where GROUP BY R.id ORDER BY R.id DESC ";
        }else{
        $sql="SELECT R.*,CONCAT(R.tempat_lahir, ', ', R.tgl_lahir) AS ttl, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END AS jkelamin,S.kodesubgrup,S.subgrup,S.stagingid as idstaging,M.kodemorfologi,M.morfologi,T.kodetopografi,T.topografi,P.propinsi,K.kabupaten,KEC.kecamatan,DES.desa,U.nama_unit,L.registrasiid FROM registrasi R
            LEFT JOIN subgrup S on S.id = R.subgrupid 
            LEFT JOIN morfologi M on M.id = R.morfologiid 
            LEFT JOIN topografi T on T.id = R.topografiid
            LEFT JOIN propinsi P on P.propid = R.propid 
            LEFT JOIN kabupaten K on K.kabid = R.kabid
            LEFT JOIN kecamatan KEC on KEC.camatid = R.camatid
            LEFT JOIN desa DES on DES.desaid = R.desaid
            LEFT JOIN unit U on U.id = R.unitid
            LEFT JOIN luaran L ON R.id = L.registrasiid
            WHERE 1 AND R.deleted = 'n' AND R.unitid =  $unitid $where GROUP BY R.id ORDER BY R.id DESC ";
        }
        
        $result['count'] = $this->db->query($sql)->num_rows();
        if($limit){
            $sql .=" LIMIT {$offset},{$limit} ";
        }
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    function gettgldiagnosis($id){
        $sql="SELECT tgl_diagnosis FROM registrasi_diagnosis WHERE registrasiid = '$id' ORDER BY id DESC LIMIT 1 ";
        $result = $this->db->query($sql)->row();
        
        $sql2 = "SELECT CONCAT(DATE_FORMAT(FROM_DAYS(DATEDIFF('".$result->tgl_diagnosis."', tgl_lahir)), '%Y')+0,  ' tahun, ', MOD(period_diff( date_format('".$result->tgl_diagnosis."', '%Y%m' ) , date_format(tgl_lahir, '%Y%m' ) ),12), ' bulan') as usiadiagnosis FROM registrasi WHERE id = '$id' ";

        $result2 = $this->db->query($sql2)->row();

        return $result2->usiadiagnosis;
    }

    public function simpan($detail,$detail2){
        $this->db->trans_begin();

        $nounit = $this->session->userdata('nounit');
        $jkelamin = $this->input->post('jenis_kelamin');
        if($jkelamin=='l'){
            $j=1;
        }else{
            $j=2;
        }
        $nourut = $this->get_no_urut();
        $noregistrasi = $nounit.$j.$nourut;
        $data = array(
            'no_urut'=>$nourut,
            'noregistrasi'=>$noregistrasi,
            'nama'=>$this->input->post('nama'),
            'nik'=>$this->input->post('nik'),
            'tempat_lahir'=>$this->input->post('tempat_lahir'),
            'tgl_lahir'=>$this->input->post('tgl_lahir'),
            'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
            'alamat'=>$this->input->post('alamat'),
            'rt'=>$this->input->post('rt'),
            'rw'=>$this->input->post('rw'),
            'propid'=>$this->input->post('propid'),
            'kabid'=>$this->input->post('kabid'),
            'camatid'=>$this->input->post('camatid'),
            'desaid'=>$this->input->post('desaid'),
            'alamat_2'=>$this->input->post('alamat_2'),
            'rt_2'=>$this->input->post('rt_2'),
            'rw_2'=>$this->input->post('rw_2'),
            'propid_2'=>$this->input->post('propid_2'),
            'kabid_2'=>$this->input->post('kabid_2'),
            'camatid_2'=>$this->input->post('camatid_2'),
            'desaid_2'=>$this->input->post('desaid_2'),
            'no_rekam'=>$this->input->post('no_rekam'),
            'no_bpjs'=>$this->input->post('no_bpjs'),
            'no_hp'=>$this->input->post('no_hp'),
            'no_hp2'=>$this->input->post('no_hp2'),
            'bb'=>$this->input->post('bb'),
            'tb'=>$this->input->post('tb'),
            'kesimpulan'=>$this->input->post('kesimpulan'),
            'nama_ayah'=>$this->input->post('nama_ayah'),
            'nama_ibu'=>$this->input->post('nama_ibu'),
            'berat_lahir'=>$this->input->post('berat_lahir'),
            'imunisasi'=>$this->input->post('imunisasi'),
            'asi'=>$this->input->post('asi'),
            'riwayat'=>$this->input->post('riwayat'),
            'riwayat_rujukan'=>$this->input->post('riwayat_rujukan'),
            'ppk1'=>$this->input->post('ppk1'),
            'tgl_ppk1'=>$this->input->post('tgl_ppk1'),
            'ppk2'=>$this->input->post('ppk2'),
            'tgl_ppk2'=>$this->input->post('tgl_ppk2'),
            'tgl_konsultasi'=>$this->input->post('tgl_konsultasi'),
            'subgrupid'=>$this->input->post('subgrupid'),
            'topografiid'=>$this->input->post('topografiid'),
            'morfologiid'=>$this->input->post('morfologiid'),
            'tatalaksanaid'=>ltrim($this->input->get('tatalaksanaid'),','),
            'stagingid'=>$this->input->post('stagingid'),
            'unitid'=>$this->session->userdata('unitid'),
            'user_insert'=>$this->session->userdata('username'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );

        $this->db->insert('registrasi', $data);
        $registrasi_id = $this->db->insert_id();
        
        if(count($detail)!=0){
            $result=array();
            for($i=0;$i<count($detail);$i++){
                
                $result[] = array(
                    'registrasiid'=>$registrasi_id,
                    'keluarga'=>$detail[$i]['keluarga'],
                    'jenis_kanker'=>$detail[$i]['jenis_kanker']
                );
            }
            $this->db->insert_batch('registrasi_riwayat', $result);
        }

        $result2=array();
        for($x=0;$x<count($detail2);$x++){
            
            $result2[] = array(
                'registrasiid'=>$registrasi_id,
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

    public function update($id,$detail,$detail2){
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
            'alamat'=>$this->input->post('alamat'),
            'rt'=>$this->input->post('rt'),
            'rw'=>$this->input->post('rw'),
            'propid'=>$this->input->post('propid'),
            'kabid'=>$this->input->post('kabid'),
            'camatid'=>$this->input->post('camatid'),
            'desaid'=>$this->input->post('desaid'),
            'alamat_2'=>$this->input->post('alamat_2'),
            'rt_2'=>$this->input->post('rt_2'),
            'rw_2'=>$this->input->post('rw_2'),
            'propid_2'=>$this->input->post('propid_2'),
            'kabid_2'=>$this->input->post('kabid_2'),
            'camatid_2'=>$this->input->post('camatid_2'),
            'desaid_2'=>$this->input->post('desaid_2'),
            'no_rekam'=>$this->input->post('no_rekam'),
            'no_bpjs'=>$this->input->post('no_bpjs'),
            'no_hp'=>$this->input->post('no_hp'),
            'no_hp2'=>$this->input->post('no_hp2'),
            'bb'=>$this->input->post('bb'),
            'tb'=>$this->input->post('tb'),
            'kesimpulan'=>$this->input->post('kesimpulan'),
            'nama_ayah'=>$this->input->post('nama_ayah'),
            'nama_ibu'=>$this->input->post('nama_ibu'),
            'berat_lahir'=>$this->input->post('berat_lahir'),
            'imunisasi'=>$this->input->post('imunisasi'),
            'asi'=>$this->input->post('asi'),
            'riwayat'=>$this->input->post('riwayat'),
            'riwayat_rujukan'=>$this->input->post('riwayat_rujukan'),
            'ppk1'=>$this->input->post('ppk1'),
            'tgl_ppk1'=>$this->input->post('tgl_ppk1'),
            'ppk2'=>$this->input->post('ppk2'),
            'tgl_ppk2'=>$this->input->post('tgl_ppk2'),
            'tgl_konsultasi'=>$this->input->post('tgl_konsultasi'),
            'subgrupid'=>$this->input->post('subgrupid'),
            'topografiid'=>$this->input->post('topografiid'),
            'morfologiid'=>$this->input->post('morfologiid'),
            'tatalaksanaid'=>ltrim($this->input->get('tatalaksanaid'),','),
            'stagingid'=>$this->input->post('stagingid'),
            'user_update'=>$this->session->userdata('username'),
            'tgl_update'=>date('Y-m-d H:i:s')
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
        return $this->db->update('registrasi', array(
            'deleted' => 'y',
            'user_delete'=>$this->session->userdata('username'),
            'tgl_delete'=>date('Y-m-d H:i:s')
        ));
    }

    public function create($detail,$detail2){
        $nounit = $this->session->userdata('nounit');
        $jkelamin = $this->input->post('jenis_kelamin');
        if($jkelamin=='l'){
            $j=1;
        }else{
            $j=2;
        }
        $nourut = $this->input->post('no_urut');
        $noregistrasi = $nounit.$j.$nourut;
        $data = array(
            'no_urut'=>$this->input->post('no_urut'),
            'noregistrasi'=>$noregistrasi,
            'nama'=>$this->input->post('nama'),
            'nik'=>$this->input->post('nik'),
            'tempat_lahir'=>$this->input->post('tempat_lahir'),
            'tgl_lahir'=>$this->input->post('tgl_lahir'),
            'jenis_kelamin'=>$this->input->post('jenis_kelamin'),
            'alamat'=>$this->input->post('alamat'),
            'rt'=>$this->input->post('rt'),
            'rw'=>$this->input->post('rw'),
            'propid'=>$this->input->post('propid'),
            'kabid'=>$this->input->post('kabid'),
            'camatid'=>$this->input->post('camatid'),
            'desaid'=>$this->input->post('desaid'),
            'alamat_2'=>$this->input->post('alamat_2'),
            'rt_2'=>$this->input->post('rt_2'),
            'rw_2'=>$this->input->post('rw_2'),
            'propid_2'=>$this->input->post('propid_2'),
            'kabid_2'=>$this->input->post('kabid_2'),
            'camatid_2'=>$this->input->post('camatid_2'),
            'desaid_2'=>$this->input->post('desaid_2'),
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
            'tatalaksanaid'=>ltrim($this->input->get('tatalaksanaid'),','),
            'stagingid'=>$this->input->post('stagingid')
        );

        if( $this->db->insert('registrasi', $data)){
            $registrasi_id = $this->db->insert_id();
            if ($this->create_detail($registrasi_id,$detail))
                return true;
                else
                $this->delete_registrasi($registrasi_id);   
                return false;
        }

        return $this->db->insert('registrasi', $data);
    }

    public function create_detail($registrasi_id,$detail){

        $result=array();
        for($i=0;$i<count($detail);$i++){
            
            $result[] = array(
                'registrasiid'=>$registrasi_id,
                'keluarga'=>$detail[$i]['keluarga'],
                'jenis_kanker'=>$detail[$i]['jenis_kanker']
            );
        }
        return $this->db->insert_batch('registrasi_riwayat', $result);
    }

    public function delete_registrasi($id){
        $this->db->where('id',$id);
        $this->db->delete('registrasi');
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

    public function opt_propinsi($offset, $limit, $search='',$q){
         $sql="SELECT * FROM propinsi
            WHERE 1 AND aktif = 'y' AND propinsi like '%".$q."%' OR propid = '".$q."' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function opt_kabupaten($offset, $limit, $search='',$q,$propid){
          $sql="SELECT * FROM kabupaten
            WHERE 1 AND aktif = 'y' AND kabupaten like '%".$q."%' ";

            if($propid!=''){
            	$sql .="AND propid = '$propid' ";
            }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function opt_kecamatan($offset, $limit, $search='',$q,$kabid){
          $sql="SELECT * FROM kecamatan
            WHERE 1 AND aktif = 'y' AND kecamatan like '%".$q."%' ";

            if($kabid!=''){
            	$sql .="AND kabid = '$kabid' ";
            }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    } 

    public function opt_desa($offset, $limit, $search='',$q,$camatid){
          $sql="SELECT * FROM desa
            WHERE 1 AND aktif = 'y' AND desa like '%".$q."%' ";

            if($camatid!=''){
            	$sql .="AND camatid = '$camatid' ";
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

    public function getdatariwayat($registrasiid){
            $sql = "SELECT * FROM registrasi_riwayat where registrasiid = $registrasiid";

            $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
           
            //return $result = $this->db->query($sql)->result();      
    }

    public function getdatadiagnosis($registrasiid){
            $sql = "SELECT * FROM registrasi_diagnosis where registrasiid = $registrasiid";
           
            return $result = $this->db->query($sql)->result();      
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
            'tgl_insert'=>date('Y-m-d H:i:s'),
            'followup' => 'y'
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

    public function optionunit($q){
        $unitid = $this->session->userdata('unitid');

        if($unitid==1){
            $this->db->where('aktif', 'y');
            $query = $this->db->get('unit');
        }else{
            $this->db->where('aktif', 'y');
            $this->db->where('id', $unitid);
            $query = $this->db->get('unit');
        }
        return $query->result();
    }

    public function optionsubgrup($offset, $limit, $search='',$q){
        $sql="SELECT * FROM subgrup
            WHERE 1 AND aktif = 'y' AND subgrup like '%".$q."%' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    } 

    public function optionmorfologi($offset, $limit, $search='',$q,$kodesubgrup){
        $sql="SELECT M.*,M.id as morfologiid, S.* FROM morfologi M
            LEFT JOIN subgrup S ON S.id = M.subgrupid
            WHERE 1 AND M.aktif = 'y' ";
        if($search){
            $sql.= "AND (M.morfologi like '%".$search."%' or M.kodemorfologi like '%".$search."%' or S.subgrup like '%".$search."%') ";
        }
        if($kodesubgrup){
            $sql.= "AND M.subgrupid = '".$kodesubgrup."'";
        }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function optiontopografi($offset, $limit, $search='',$q,$kodesubgrup){
        $sql="SELECT *,id as topografiid FROM topografi
            WHERE 1 AND aktif = 'y' AND (topografi like '%".$q."%' or kodetopografi like '%".$q."%') ";

        if($kodesubgrup){
            $sql.= "AND subgrupid = '".$kodesubgrup."'";
        }

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    } 


}