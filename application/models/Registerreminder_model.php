<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registerreminder_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function getjmlkunjungan(){
        $unitid = $this->session->userdata('unitid');

        if($unitid==1){
            $query=$this->db->query("SELECT K.registrasiid, DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 28 DAY), CURDATE()) as selisih FROM luaran K LEFT JOIN registrasi R ON R.id=K.registrasiid WHERE 1 AND K.deleted = 'n' AND K.reminder_status = 'y' GROUP BY K.registrasiid HAVING selisih > 7 " );

            $query2=$this->db->query("SELECT K.registrasiid, DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 28 DAY), CURDATE()) as selisih FROM luaran K LEFT JOIN registrasi R ON R.id=K.registrasiid WHERE 1 AND K.deleted = 'n' AND K.reminder_status = 'y' GROUP BY K.registrasiid HAVING selisih BETWEEN 0 AND 8 ");

            $query3=$this->db->query("SELECT K.registrasiid, DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 28 DAY), CURDATE()) as selisih FROM luaran K LEFT JOIN registrasi R ON R.id=K.registrasiid WHERE 1 AND K.deleted = 'n' AND K.reminder_status = 'y' GROUP BY K.registrasiid HAVING selisih < 1 ");
        }else{
            // $query=$this->db->query("SELECT id FROM registrasi where validate='y' AND deleted = 'n' AND unitid =  $unitid ");
            // $query2=$this->db->query("SELECT id FROM registrasi where validate='n' AND deleted = 'n' AND unitid =  $unitid ");
        }
        
        return $data = array('jml'=>$query->num_rows(),'jml2'=>$query2->num_rows(),'jml3'=>$query3->num_rows());
    }

    public function get_reminder($offset, $limit, $q='', $followup, $hari,$tgl1,$tgl2)
    { 
        $where = '';
        if ($q!=''){
            $where .=" AND R.nama like '%$q%'"; 
        }

        if ($followup=='y'){
            $where .="AND K.followup = 'y' ";   
        }else if($followup=='n'){
            $where .="AND K.followup = 'n' ";   
        }

        if(($tgl1||$tgl2)!=''){
            $where .= "AND tgl_insert between '$tgl1' and '$tgl2' ";
        }

        $sql="SELECT max(K.id) as id, 
        K.registrasiid, R.noregistrasi,R.nama, 
        MAX(date(K.tgl_insert)) as tgl_followup, 
        MAX(date(K.tgl_insert)) + INTERVAL 3 MONTH as tgl_3bln, 
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 28 DAY), CURDATE()) as selisih, 
        DATE_ADD(MAX(K.tgl_insert), INTERVAL 28 DAY) as tgl_kunjungan_berikutnya, 
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 3 MONTH), CURDATE()) as 3bln, 
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 6 MONTH), CURDATE()) as 6bln,  
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 1 YEAR), CURDATE()) as 1thn, 
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 2 YEAR), CURDATE()) as 2thn, 
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 3 YEAR), CURDATE()) as 3thn, 
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 4 YEAR), CURDATE()) as 4thn, 
        DATEDIFF(DATE_ADD(MAX(K.tgl_insert), INTERVAL 5 YEAR), CURDATE()) as 5thn, 
        max(K.reminder_status) as reminder_status, R.no_hp,R.no_hp2 
        FROM luaran K 
        LEFT JOIN registrasi R ON R.id=K.registrasiid 
        WHERE 1 AND K.deleted = 'n' AND R.deleted = 'n' AND K.reminder_status = 'y' $where GROUP BY K.registrasiid  "; 

        if($hari=='hijau'){
            $sql .=" HAVING selisih > 7 ORDER BY K.registrasiid DESC ";
        }

        if($hari=='kuning'){
            $sql .=" HAVING selisih BETWEEN 0 AND 7 ORDER BY K.registrasiid DESC ";
        }

        if($hari=='merah'){
            $sql .=" HAVING selisih < 1 ORDER BY K.registrasiid DESC ";
        }

        //$sql.="GROUP BY K.registrasiid ORDER BY K.registrasiid DESC ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function get_reminder1($offset, $limit, $q='', $followup, $hari,$tgl1,$tgl2,$interval='',$subgrupid,$status)
    { 
        $having3='';
        $where = '';
        $having = '';
        $havingstatus = '';

        $whereadm1 =  '';

        $unitid = $this->session->userdata('unitid');
        $grupid = $this->session->userdata('grupid');

        //jika login selain admin pusat
        if($unitid=='1' && $grupid=='1'){ 
            $whereadm1 = '' ; 
        }elseif($unitid=='1' && $grupid=='3'){
            $whereadm1 = '' ; 
        }else{
            $whereadm1 = " AND R.unitid = '$unitid' ";
        }

        if ($q!=''){
            $where .=" AND R.nama like '%$q%'"; 
        }

        if ($subgrupid!=''){
            $where .=" AND R.subgrupid = $subgrupid"; 
        }

        if ($followup=='y'){
            $where .="AND K.followup = 'y' ";   
        }else if($followup=='n'){
            $where .="AND K.followup = 'n' ";   
        }

        if(($tgl1||$tgl2)!=''){
            $where .= "AND DATE(R.tgl_insert) between '$tgl1' and '$tgl2' ";
        }

        if($hari=='hijau'){
              $having .=" AND selisih > 7  ";
              $having3.="HAVING selisih > 7 ORDER BY R.id DESC";
        }
        if($hari=='kuning'){
             $having .=" AND selisih BETWEEN 1 AND 7 ";
             $having3.="HAVING selisih BETWEEN 1 AND 7 ORDER BY R.id DESC";
        }
        if($hari=='merah'){
             $having .=" AND selisih < 1  ";
              $having3.="HAVING selisih < 1 ORDER BY R.id DESC";
        }

        if($status=='satu'){
              $havingstatus.=" AND status = 1  ";
        }else if($status=='dua'){
             $havingstatus.=" AND status = 2  ";
        }else if($status=='tiga'){
             $havingstatus.=" AND status = 3  ";
        }else{
            $havingstatus.=" AND status != 3  ";
        }

        // dihitung dari sejak tgl_insert dan data sudah di validasi
        if($interval == '3bln'){
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 3 MONTH';

            $sql = "SELECT max(R.id) as id, R.id as registerid, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD(MAX(DATE(R.tgl_insert)), INTERVAL 3 MONTH) as tgl_followup, 
            DATEDIFF(DATE_ADD(MAX(DATE(R.tgl_insert)), INTERVAL 3 MONTH), CURDATE()) as selisih, 
            R.no_hp, R.no_hp2, R.subgrupid, R.unitid, R.nama, S.subgrup, L.reminder_status, L.status, L.followup, L.registrasiid, U.nama_unit
            FROM registrasi R 
            LEFT JOIN luaran L ON L.registrasiid = R.id
            LEFT JOIN subgrup S ON S.id = R.subgrupid 
            LEFT JOIN unit U ON U.id = R.unitid 
            WHERE  1 
            AND R.deleted = 'n'
            AND R.validate='y'
            AND L.registrasiid  IS NULL
            $where $whereadm1
            GROUP BY R.id  $having3 "; 
        }else if($interval == '6bln'){
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 6 MONTH';

             $sql = "SELECT max(L.id) as id, count(L.id) as jml, R.id as registerid, L.registrasiid, max(L.status) as status, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD($interval) as tgl_followup, 
            DATEDIFF(DATE_ADD($interval), CURDATE()) as selisih, 
            max(L.reminder_status) as reminder_status, R.no_hp, R.no_hp2, R.subgrupid, R.unitid, R.nama, S.subgrup, R.unitid, U.nama_unit 
             FROM luaran L 
             LEFT JOIN registrasi R ON R.id = L.registrasiid
             LEFT JOIN subgrup S ON S.id = R.subgrupid
             LEFT JOIN unit U ON U.id = R.unitid  
             WHERE 1 
             AND R.deleted = 'n' 
             AND L.deleted = 'n' 
             AND L.reminder_status = 'y' 
             $where $whereadm1
             GROUP BY L.registrasiid 
             HAVING jml = 1 $having $havingstatus ORDER BY L.tgl_insert DESC "; 

        }else if($interval == '1thn'){
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 1 YEAR';

            $sql = "SELECT max(L.id) as id, count(L.id) as jml, R.id as registerid, L.registrasiid, max(L.status) as status, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD($interval) as tgl_followup, 
            DATEDIFF(DATE_ADD($interval), CURDATE()) as selisih, 
            max(L.reminder_status) as reminder_status, R.no_hp, R.no_hp2, R.subgrupid, R.unitid, R.nama, S.subgrup, R.unitid, U.nama_unit 
             FROM luaran L 
             LEFT JOIN registrasi R ON R.id = L.registrasiid
             LEFT JOIN subgrup S ON S.id = R.subgrupid
             LEFT JOIN unit U ON U.id = R.unitid  
             WHERE 1 
             AND R.deleted = 'n' 
             AND L.deleted = 'n' 
             AND L.reminder_status = 'y' 
             $where $whereadm1
             GROUP BY L.registrasiid  
             HAVING jml = 2 $having $havingstatus ORDER BY L.tgl_insert DESC "; 

        }else if($interval == '2thn'){
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 2 YEAR';

             $sql = "SELECT max(L.id) as id, count(L.id) as jml, R.id as registerid, L.registrasiid, max(L.status) as status, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD($interval) as tgl_followup, 
            DATEDIFF(DATE_ADD($interval), CURDATE()) as selisih, 
            max(L.reminder_status) as reminder_status, R.no_hp, R.no_hp2, R.subgrupid, R.unitid,R.nama, S.subgrup, R.unitid, U.nama_unit 
             FROM luaran L 
             LEFT JOIN registrasi R ON R.id = L.registrasiid
             LEFT JOIN subgrup S ON S.id = R.subgrupid
             LEFT JOIN unit U ON U.id = R.unitid  
             WHERE 1 
             AND R.deleted = 'n' 
             AND L.deleted = 'n' 
             AND L.reminder_status = 'y' 
             $where $whereadm1
             GROUP BY L.registrasiid  
             HAVING jml = 3 $having $havingstatus ORDER BY L.tgl_insert DESC "; 
        }else if($interval == '3thn'){
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 3 YEAR';

             $sql = "SELECT max(L.id) as id, count(L.id) as jml, R.id as registerid, L.registrasiid, max(L.status) as status, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD($interval) as tgl_followup, 
            DATEDIFF(DATE_ADD($interval), CURDATE()) as selisih, 
            max(L.reminder_status) as reminder_status, R.no_hp, R.no_hp2, R.subgrupid, R.unitid, R.nama, S.subgrup, R.unitid, U.nama_unit 
             FROM luaran L 
             LEFT JOIN registrasi R ON R.id = L.registrasiid
             LEFT JOIN subgrup S ON S.id = R.subgrupid
             LEFT JOIN unit U ON U.id = R.unitid  
             WHERE 1 
             AND R.deleted = 'n' 
             AND L.deleted = 'n' 
             AND L.reminder_status = 'y'   
             $where $whereadm1
             GROUP BY L.registrasiid  
             HAVING jml = 4 $having $havingstatus ORDER BY L.tgl_insert DESC "; 
        }else if($interval == '4thn'){
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 4 YEAR';

             $sql = "SELECT max(L.id) as id, count(L.id) as jml, R.id as registerid, L.registrasiid, max(L.status) as status, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD($interval) as tgl_followup, 
            DATEDIFF(DATE_ADD($interval), CURDATE()) as selisih, 
            max(L.reminder_status) as reminder_status, R.no_hp, R.no_hp2, R.subgrupid, R.unitid, R.nama, S.subgrup, R.unitid, U.nama_unit 
             FROM luaran L 
             LEFT JOIN registrasi R ON R.id = L.registrasiid
             LEFT JOIN subgrup S ON S.id = R.subgrupid
             LEFT JOIN unit U ON U.id = R.unitid  
             WHERE 1 
             AND R.deleted = 'n' 
             AND L.deleted = 'n' 
             AND L.reminder_status = 'y' 
             $where $whereadm1
             GROUP BY L.registrasiid  
             HAVING jml = 5 $having $havingstatus ORDER BY L.tgl_insert DESC "; 
        }else if($interval == '5thn'){
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 5 YEAR';

             $sql = "SELECT max(L.id) as id, count(L.id) as jml, R.id as registerid, L.registrasiid, max(L.status) as status, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD($interval) as tgl_followup, 
            DATEDIFF(DATE_ADD($interval), CURDATE()) as selisih, 
            max(L.reminder_status) as reminder_status, R.no_hp, R.no_hp2, R.subgrupid, R.unitid, R.nama, S.subgrup, R.unitid, U.nama_unit 
             FROM luaran L 
             LEFT JOIN registrasi R ON R.id = L.registrasiid
             LEFT JOIN subgrup S ON S.id = R.subgrupid
             LEFT JOIN unit U ON U.id = R.unitid  
             WHERE 1 
             AND R.deleted = 'n' 
             AND L.deleted = 'n' 
             AND L.reminder_status = 'y' 
             $where $whereadm1
             GROUP BY L.registrasiid  
             HAVING jml = 6 $having $havingstatus ORDER BY L.tgl_insert DESC "; 
        }else{
            $interval = 'MAX(DATE(R.tgl_insert)), INTERVAL 3 MONTH';

            $sql = "SELECT max(R.id) as id, R.id as registerid, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD(MAX(DATE(R.tgl_insert)), INTERVAL 3 MONTH) as tgl_followup, 
            DATEDIFF(DATE_ADD(MAX(DATE(R.tgl_insert)), INTERVAL 3 MONTH), CURDATE()) as selisih, 
            R.no_hp, R.no_hp2, R.subgrupid, R.unitid, R.nama, S.subgrup, L.reminder_status, L.status, L.followup, L.registrasiid, U.nama_unit
            FROM registrasi R 
            LEFT JOIN luaran L ON L.registrasiid = R.id
            LEFT JOIN subgrup S ON S.id = R.subgrupid
            LEFT JOIN unit U ON U.id = R.unitid 
            WHERE  1 
            AND R.deleted = 'n'
            AND R.validate='y'
            AND L.registrasiid  IS NULL
            $where $whereadm1
            GROUP BY R.id  $having3"; 
        }

//      SELECT max(L.id) as id, L.registrasiid, R.noregistrasi, R.nama, DATE(R.tgl_insert) as tgl_insert, DATE_ADD($interval) as tgl_followup, 
//             DATEDIFF(DATE_ADD($interval), CURDATE()) as selisih, 
//             max(L.reminder_status) as reminder_status, R.no_hp, R.no_hp2, R.subgrupid, S.subgrup 
//             FROM luaran L 
//             LEFT JOIN registrasi R ON R.id = L.registrasiid
//             LEFT JOIN subgrup S ON S.id = R.subgrupid 
//             WHERE 1 
//             AND R.deleted = 'n' 
//             AND L.deleted = 'n' 
//             AND L.reminder_status = 'y' 
//             AND L.followup = 'n' 
//             AND R.validate='y'  
//             $where 
//             GROUP BY L.registrasiid

        //$sql.="GROUP BY K.registrasiid ORDER BY K.registrasiid DESC ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    function jmlkunjungan($id){
        $query = $this->db->query("SELECT id FROM luaran where registrasiid = $id and deleted = 'n' ");
        return $query->num_rows();
    }

    function followup($id){
        $query = $this->db->query("SELECT followup FROM luaran where id = $id and deleted = 'n' ");

        $row = $query->row();
        return $row->followup;
    }
    function keterangan($id){
        $query = $this->db->query("SELECT keterangan_reminder FROM luaran where id = $id and deleted = 'n' ");

        $row = $query->row();
        return $row->keterangan_reminder;
    }

    public function create()
    {
        return $this->db->insert('reminder',array(
            'nama_reminder'=>$this->input->post('nama_reminder',true),
            'type'=>$this->input->post('type',true),
            'ket'=>$this->input->post('ket',true)
        ));
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('luaran',array(
            'keterangan_reminder'=>$this->input->post('keterangan_reminder',true),
            //'followup'=>$this->input->post('followup',true)
        ));
    }

    public function delete($id)
    {
        //return $this->db->delete('reminder', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('luaran', array(
            'reminder_status' => 'n'
        )); 
    }
}