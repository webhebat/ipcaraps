<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function countfollowup($id)
    {
        $sql = "SELECT tgl_insert FROM luaran WHERE registrasiid = '$id' ORDER BY id DESC LIMIT 1 ";
        $result = $this->db->query($sql)->row();

        $sql2 = "SELECT CONCAT(DATE_FORMAT(FROM_DAYS(DATEDIFF('" . $result->tgl_diagnosis . "', tgl_lahir)), '%Y')+0,  ' tahun, ', MOD(period_diff( date_format('" . $result->tgl_diagnosis . "', '%Y%m' ) , date_format(tgl_lahir, '%Y%m' ) ),12), ' bulan') as usiadiagnosis FROM registrasi WHERE id = '$id' ";

        $result2 = $this->db->query($sql2)->row();

        return $result2->usiadiagnosis;
    }

    public function countdashboard($kategori = null, $subgrupid = null, $jtanggal = null, $tgl1 = null, $tgl2 = null, $unit = null)
    {

        $where = '';

        $whereadm1 =  '';

        $unitid = $this->session->userdata('unitid');
        $grupid = $this->session->userdata('grupid');

        //jika login selain admin pusat
        if ($unitid == '1' && $grupid == '1') {
            $whereadm1 = '';
        } elseif ($unitid == '1' && $grupid == '3') {
            $whereadm1 = '';
        } else {
            $whereadm1 = " AND unitid = '$unitid' ";
        }

        if ($subgrupid != '') {
            $where .= "AND subgrupid = '$subgrupid' ";
        }

        if ($unit) {
            $where .= " AND unitid = '$unit' ";
        }

        if ($jtanggal == 'by_tglinput') {
            if (($tgl1 || $tgl2) != '') {
                $where .= "AND DATE(tgl_insert) BETWEEN '$tgl1' AND '$tgl2' ";
            }
        }

        if ($jtanggal == 'by_tgldiagnosis') {
            if (($tgl1 || $tgl2) != '') {
                $where .= "AND id IN (SELECT R.id  FROM registrasi_diagnosis D LEFT JOIN registrasi R ON R.id = D.registrasiid  GROUP BY R.id HAVING max(D.tgl_diagnosis) BETWEEN '$tgl1' AND '$tgl2') ";
            }
        }

        $query = $this->db->query("SELECT id,unitid FROM registrasi WHERE deleted = 'n' $where $whereadm1");
        $query2 = $this->db->query("SELECT id,unitid FROM registrasi where validate='y' AND deleted = 'n' $where $whereadm1");
        $query3 = $this->db->query("SELECT id,unitid FROM registrasi where validate='n' AND deleted = 'n' $where $whereadm1");
        //$query4=$this->db->query("SELECT R.id, L.registrasiid FROM registrasi R LEFT JOIN luaran L ON R.id = L.registrasiid WHERE R.deleted = 'n' $where AND L.registrasiid IS NULL GROUP BY R.id ");

        return $data = array('jmlpasien' => $query->num_rows(), 'validate' => $query2->num_rows(), 'notvalidate' => $query3->num_rows()); //,'unfollowup'=>$query4->num_rows());
    }

    public function getdashboard($kategori, $subgrupid, $jtanggal, $tgl1, $tgl2, $unit)
    {

        $where = '';

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

        // $sql= '';

        if ($jtanggal == 'by_tglinput') {
            if (($tgl1 || $tgl2) != '') {
                $where .= "AND DATE(R.tgl_insert) BETWEEN '$tgl1' AND '$tgl2' ";
            }
        }

        if ($jtanggal == 'by_tgldiagnosis') {
            if (($tgl1 || $tgl2) != '') {
                $where .= "AND R.id IN (SELECT R.id  FROM registrasi_diagnosis D LEFT JOIN registrasi R ON R.id = D.registrasiid  GROUP BY R.id HAVING max(D.tgl_diagnosis) BETWEEN '$tgl1' AND '$tgl2') ";
            }
        }

        if ($unit) {
            $where .= " AND R.unitid = '$unit' ";
        }

        if ($subgrupid != '') {
            $where .= "AND R.subgrupid = '$subgrupid' ";
        }

        switch ($kategori) {
            case 'propinsi':
                $sql = "SELECT R.unitid, P.id_prov id, IFNULL(P.nama ,'Belum Diketahui') kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                LEFT JOIN provinsi P ON P.id_prov = R.id_prov
                WHERE 1 AND R.deleted = 'n' $where $whereadm1
                GROUP BY R.id_prov 
                ORDER BY COUNT(R.id) DESC";
                break;

            case 'subgrup':
                $sql = "SELECT R.unitid, S.id, IFNULL(S.subgrup,'Belum Diketahui') kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                LEFT JOIN subgrup S ON S.id = R.subgrupid
                WHERE 1 AND R.deleted = 'n' $where $whereadm1
                GROUP BY S.id 
                ORDER BY COUNT(R.id) DESC";
                break;

            case 'jkelamin':
                $sql = "SELECT R.unitid, R.jenis_kelamin id, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                WHERE 1 AND R.deleted = 'n' $where $whereadm1
                GROUP BY R.jenis_kelamin 
                ORDER BY COUNT(R.id) DESC";
                break;

            default:
                $sql = "SELECT R.unitid, R.jenis_kelamin id, CASE WHEN R.jenis_kelamin = 'l' THEN 'Laki-laki' WHEN R.jenis_kelamin = 'p' THEN 'Perempuan' END kategori, COUNT(R.id) jumlah 
                FROM registrasi R 
                WHERE 1 AND R.deleted = 'n' $where $whereadm1
                GROUP BY R.jenis_kelamin 
                ORDER BY COUNT(R.id) DESC";
                break;
        }

        $result = $this->db->query($sql)->result();

        return $result;
    }

    public function optionsubgrup($offset, $limit, $search = '', $q)
    {
        $sql = "SELECT * FROM subgrup
            WHERE 1 AND aktif = 'y' AND subgrup like '%" . $q . "%' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        //$sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function optionunit($q)
    {

        $unitid = $this->session->userdata('unitid');
        $grupid = $this->session->userdata('grupid');

        //jika login selain admin pusat
        if ($unitid == '1' && $grupid == '1') {
            $this->db->where('aktif', 'y');
        } elseif ($unitid == '1' && $grupid == '3') {
            $this->db->where('aktif', 'y');
        } else {
            $this->db->where('aktif', 'y');
            $this->db->where('id', $unitid);
        }

        $query = $this->db->get('unit');

        return $query->result();
    }
}
