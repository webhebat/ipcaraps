<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Staging_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_staging($offset, $limit, $q='')
    {
        $sql="SELECT *, (CASE when jenis = 1 then 'Toronto' else 'TNM' END) as jenis, (CASE when tingkat = 1 then 'Pertama' when tingkat = 2 then 'Kedua' else '' END) as tingkat  FROM staging WHERE 1 AND aktif = 'y' ";

        if ($q!=''){
        	$sql .=" AND staging like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function create()
    {
        return $this->db->insert('staging',array(
            'jenis'=>$this->input->post('jenis',true),
            'tingkat'=>$this->input->post('tingkat',true),
            'staging'=>$this->input->post('staging',true)
        ));
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('staging',array(
            'jenis'=>$this->input->post('jenis',true),
            'tingkat'=>$this->input->post('tingkat',true),
            'staging'=>$this->input->post('staging',true)
        ));
    }

    public function delete($id)
    {
        //return $this->db->delete('staging', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('staging', array(
            'aktif' => 'n'
        )); 
    }

     public function getoptions($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('staging');
            return $query->result();
    }   
	
}