<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Reminder_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function getjmlkunjungan(){
        $unitid = $this->session->userdata('unitid');

        if($unitid==1){
            $query=$this->db->query("SELECT K.registrasiid, DATEDIFF(DATE_ADD(MAX(K.tgl_kunjungan), INTERVAL 28 DAY), CURDATE()) as selisih FROM rekam_medik K LEFT JOIN registrasi R ON R.id=K.registrasiid WHERE 1 AND K.deleted = 'n' AND K.reminder_status = 'y' GROUP BY K.registrasiid HAVING selisih > 7 " );

            $query2=$this->db->query("SELECT K.registrasiid, DATEDIFF(DATE_ADD(MAX(K.tgl_kunjungan), INTERVAL 28 DAY), CURDATE()) as selisih FROM rekam_medik K LEFT JOIN registrasi R ON R.id=K.registrasiid WHERE 1 AND K.deleted = 'n' AND K.reminder_status = 'y' GROUP BY K.registrasiid HAVING selisih BETWEEN 0 AND 8 ");

            $query3=$this->db->query("SELECT K.registrasiid, DATEDIFF(DATE_ADD(MAX(K.tgl_kunjungan), INTERVAL 28 DAY), CURDATE()) as selisih FROM rekam_medik K LEFT JOIN registrasi R ON R.id=K.registrasiid WHERE 1 AND K.deleted = 'n' AND K.reminder_status = 'y' GROUP BY K.registrasiid HAVING selisih < 1 ");
        }else{
            // $query=$this->db->query("SELECT id FROM registrasi where validate='y' AND deleted = 'n' AND unitid =  $unitid ");
            // $query2=$this->db->query("SELECT id FROM registrasi where validate='n' AND deleted = 'n' AND unitid =  $unitid ");
        }
        
        return $data = array('jml'=>$query->num_rows(),'jml2'=>$query2->num_rows(),'jml3'=>$query3->num_rows());
    }

    public function get_reminder($offset, $limit, $q='', $followup, $hari,$tgl1,$tgl2,$subgrupid)
    {
        $where = '';

        $whereadm1 =  '';

        $unitid = $this->session->userdata('unitid');
        $grupid = $this->session->userdata('grupid');

            //jika login pusat grup admin
        if($unitid=='1' && $grupid=='1'){ 
            $whereadm1 = '' ; 
            //jika login pusat grup super
        }elseif($unitid=='1' && $grupid=='3'){
            $whereadm1 = '' ; 
        }else{
            $whereadm1 = " AND R.unitid = '$unitid' ";
        }

        if ($q!=''){
            $where .=" AND R.nama like '%$q%'"; 
        }

        if ($followup=='y'){
            $where .="AND K.followup = 'y' ";   
        }else if($followup=='n'){
            $where .="AND K.followup = 'n' ";   
        }

        if(($tgl1||$tgl2)!=''){
            $where .= "AND tgl_kunjungan between '$tgl1' and '$tgl2' ";
        }
        if($subgrupid){
             $where .= " AND R.subgrupid = '".$subgrupid."'";
        }

        $sql="SELECT max(K.id) as id, K.registrasiid,R.noregistrasi,R.nama, MAX(K.tgl_kunjungan) as tgl_kunjungan, DATE_ADD(MAX(K.tgl_kunjungan), INTERVAL 28 DAY) as tgl_kunjungan_berikutnya, DATEDIFF(DATE_ADD(MAX(K.tgl_kunjungan), INTERVAL 28 DAY), CURDATE()) as selisih, max(K.reminder_status) as reminder_status, R.no_hp,R.no_hp2,R.subgrupid, S.subgrup, R.unitid, U.nama_unit FROM rekam_medik K 
        LEFT JOIN registrasi R ON R.id = K.registrasiid
        LEFT JOIN subgrup S ON S.id = R.subgrupid 
        LEFT JOIN unit U ON U.id = R.unitid 
        WHERE 1 AND K.deleted = 'n' AND K.reminder_status = 'y' $where $whereadm1 GROUP BY K.registrasiid  "; 

        if($hari=='hijau'){
            $sql .=" HAVING selisih > 7 ORDER BY K.registrasiid DESC ";
        }

        if($hari=='kuning'){
            $sql .=" HAVING selisih BETWEEN 1 AND 7 ORDER BY K.registrasiid DESC ";
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

    function jmlkunjungan($id){
        $query = $this->db->query("SELECT id FROM rekam_medik where registrasiid = $id and deleted = 'n' ");
        return $query->num_rows();
    }

    function followup($id){
        $query = $this->db->query("SELECT followup FROM rekam_medik where id = $id and deleted = 'n' ");
       
        $row = $query->row();
        return $row->followup;
    }
    
    function keterangan($id){
        $query = $this->db->query("SELECT keterangan_reminder FROM rekam_medik where id = $id and deleted = 'n' ");
       
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
        return $this->db->update('rekam_medik',array(
            'keterangan_reminder'=>$this->input->post('keterangan_reminder',true),
            'followup'=>$this->input->post('followup',true)
        ));
    }

    public function delete($id)
    {
        //return $this->db->delete('reminder', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('rekam_medik', array(
            'reminder_status' => 'n'
        )); 
    }

    public function optionsubgrup($offset, $limit, $search='',$q){
        $sql="SELECT * FROM subgrup
            WHERE 1 AND aktif = 'y' AND subgrup like '%".$q."%' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    } 
}