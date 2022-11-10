<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Propinsi_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_propinsi($offset, $limit, $q='')
    {
        $sql="SELECT * FROM propinsi WHERE 1 AND aktif = 'y' ";

        if ($q!=''){
        	$sql .=" AND propinsi like '%$q%' or ibukota like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }
}