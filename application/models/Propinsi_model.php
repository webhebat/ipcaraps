<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Propinsi_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_propinsi($offset, $limit, $q='')
    {
        $sql="SELECT * FROM provinsi  where 1 ";

        if ($q!=''){
        	$sql .=" AND nama like '%$q%' or ibukota like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }
}