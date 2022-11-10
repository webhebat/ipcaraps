<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kabupaten_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_kabupaten($offset, $limit, $q='')
    {
        $sql="SELECT k.*, P.propinsi FROM kabupaten K 
        LEFT JOIN propinsi P on k.propid = P.propid 
        WHERE 1 AND K.aktif = 'y' ";

        if ($q!=''){
        	$sql .=" AND k.kabupaten like '%$q%' or k.ibukota like '%$q%' or p.propinsi like '%propinsi%'";	
	    }

	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }
}