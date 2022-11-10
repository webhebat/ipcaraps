<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Petasebaran_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    function countfollowup($id){
        $sql="SELECT tgl_insert FROM luaran WHERE registrasiid = '$id' ORDER BY id DESC LIMIT 1 ";
        $result = $this->db->query($sql)->row();
        
        $sql2 = "SELECT CONCAT(DATE_FORMAT(FROM_DAYS(DATEDIFF('".$result->tgl_diagnosis."', tgl_lahir)), '%Y')+0,  ' tahun, ', MOD(period_diff( date_format('".$result->tgl_diagnosis."', '%Y%m' ) , date_format(tgl_lahir, '%Y%m' ) ),12), ' bulan') as usiadiagnosis FROM registrasi WHERE id = '$id' ";

        $result2 = $this->db->query($sql2)->row();

        return $result2->usiadiagnosis;
    }

    public function countdashboard($kategori=null,$subgrupid=null,$jtanggal=null,$tgl1=null,$tgl2=null){
        $unitid = $this->session->userdata('unitid');

        $where = '';

        if($subgrupid!=''){
            $where .= "AND subgrupid = '$subgrupid' ";
        }

        if($jtanggal=='by_tglinput'){
            if(($tgl1||$tgl2)!=''){
                $where .= "AND DATE(tgl_insert) BETWEEN '$tgl1' AND '$tgl2' ";
            }
        }

        if($jtanggal=='by_tgldiagnosis'){
            if(($tgl1||$tgl2)!=''){
                $where .= "AND id IN (SELECT R.id  FROM registrasi_diagnosis D LEFT JOIN registrasi R ON R.id = D.registrasiid  GROUP BY R.id HAVING max(D.tgl_diagnosis) BETWEEN '$tgl1' AND '$tgl2') ";
            }
        }

        if($unitid==1){
            $query=$this->db->query("SELECT id FROM registrasi WHERE deleted = 'n' $where");
            $query2=$this->db->query("SELECT id FROM registrasi where validate='y' AND deleted = 'n' $where");
            $query3=$this->db->query("SELECT id FROM registrasi where validate='n' AND deleted = 'n' $where");
            //$query4=$this->db->query("SELECT R.id, L.registrasiid FROM registrasi R LEFT JOIN luaran L ON R.id = L.registrasiid WHERE R.deleted = 'n' $where AND L.registrasiid IS NULL GROUP BY R.id ");
        }else{
            $query=$this->db->query("SELECT id FROM registrasi where deleted = 'n' AND unitid =  $unitid $where");
            $query2=$this->db->query("SELECT id FROM registrasi where validate='y' AND deleted = 'n' AND unitid =  $unitid $where");
            $query3=$this->db->query("SELECT id FROM registrasi where validate='n' AND deleted = 'n' AND unitid =  $unitid $where");
            //$query4=$this->db->query("SELECT R.id ,L.registrasiid FROM registrasi R LEFT JOIN luaran L ON R.id = L.registrasiid WHERE R.deleted = 'n' $where AND R.unitid =  $unitid AND L.registrasiid IS NULL GROUP BY R.id ");
        }
        
        return $data = array('jmlpasien'=>$query->num_rows(),'validate'=>$query2->num_rows(),'notvalidate'=>$query3->num_rows());//,'unfollowup'=>$query4->num_rows());
    }

    public function getdashboard($kategori,$subgrupid,$jtanggal,$tgl1,$tgl2){
        $where = '';
        $unitid = $this->session->userdata('unitid');

        //$sql= '';
        if($unitid!='1'){
            $where .= "AND R.unitid = '$unitid' "; 
        }
      

        if($jtanggal=='by_tglinput'){
            if(($tgl1||$tgl2)!=''){
                $where .= "AND DATE(R.tgl_insert) BETWEEN '$tgl1' AND '$tgl2' ";
            }
        }

        if($jtanggal=='by_tgldiagnosis'){
            if(($tgl1||$tgl2)!=''){
                $where .= "AND R.id IN (SELECT R.id  FROM registrasi_diagnosis D LEFT JOIN registrasi R ON R.id = D.registrasiid  GROUP BY R.id HAVING max(D.tgl_diagnosis) BETWEEN '$tgl1' AND '$tgl2') ";
            }
        }

        if($subgrupid!=''){
            $where .= "AND R.subgrupid = '$subgrupid' ";
        }

        switch ($kategori) {
            case 'propinsi':
                  $sql ="SELECT P.propid id, IFNULL(P.propinsi,'Belum Diketahui') kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                LEFT JOIN propinsi P ON P.propid = R.propid
                WHERE 1 AND R.deleted = 'n' $where 
                GROUP BY R.propid 
                ORDER BY COUNT(R.id) DESC";
                break;

            case 'subgrup':
                $sql ="SELECT S.id, IFNULL(S.subgrup,'Belum Diketahui') kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                LEFT JOIN subgrup S ON S.id = R.subgrupid
                WHERE 1 AND R.deleted = 'n' $where 
                GROUP BY S.id 
                ORDER BY COUNT(R.id) DESC";
                break;

            case 'jkelamin':
               echo  $sql ="SELECT R.jenis_kelamin id, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                WHERE 1 AND R.deleted = 'n' $where 
                GROUP BY R.jenis_kelamin 
                ORDER BY COUNT(R.id) DESC";
                break;
            
            default:
                 $sql ="SELECT R.jenis_kelamin id, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                WHERE 1 AND R.deleted = 'n' $where 
                GROUP BY R.jenis_kelamin 
                ORDER BY COUNT(R.id) DESC";
                break;
        }

        $result = $this->db->query($sql)->result();

        return $result;    
        
    }

    public function getmarker($kategori=null,$subgrupid=null){

        $where = '';

        $unitid = $this->session->userdata('unitid');

        if($unitid!='1'){
            $where .= "AND r.unitid = '$unitid' "; 
        }

        if($subgrupid!=''){
            $where .= "AND r.subgrupid = '$subgrupid' "; 
        }

        switch ($kategori) {
            case 'kabupaten':
                $sql="SELECT r.id_kab,count(r.id_kab) as jml, k.nama, k.lat,k.lng FROM registrasi r join kabupaten k on k.id_kab = r.id_kab WHERE 1 AND r.deleted = 'n' $where GROUP by k.nama   ";
                break;
            default:
                $sql="SELECT r.id_prov,count(r.id_prov) as jml, p.nama, p.lat, p.lng FROM registrasi r join provinsi p on p.id_prov = r.id_prov WHERE 1 AND r.deleted = 'n' $where  GROUP by p.nama   ";
                break;
        }

        
        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function getmarker2(){
        $sql="SELECT r.id_prov,count(r.id_prov) as jml, p.nama, p.lat, p.lng FROM registrasi r join provinsi p on p.id_prov = r.id_prov WHERE 1 AND r.deleted = 'n' GROUP by p.nama   ";
        $result = $this->db->query($sql)->result();

        return $result;
    }
}