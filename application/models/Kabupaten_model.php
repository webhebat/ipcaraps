<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kabupaten_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_kabupaten($offset, $limit, $q='')
    {
        $sql="SELECT K.*, P.nama as propinsi FROM kabupaten K 
        LEFT JOIN provinsi P on K.id_prov = P.id_prov 
        WHERE 1 ";

        if ($q!=''){
        	$sql .=" AND K.nama like '%$q%' or K.ibukota like '%$q%' or P.nama like '%$q%'";	
	    }

	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }
}