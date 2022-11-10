<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Options_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_options($offset, $limit, $q='')
    {
        $sql="SELECT K.* FROM options K 
        WHERE 1 AND K.deleted = 'n' "; 

        if ($q!=''){
        	$sql .=" AND K.nama_options like '%$q%' or K.type like '%$q%' ";	
	    }
        $sql.="ORDER BY id DESC";

	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function create()
    {
        return $this->db->insert('options',array(
            'nama_options'=>$this->input->post('nama_options',true),
            'type'=>$this->input->post('type',true),
            'ket'=>$this->input->post('ket',true)
        ));
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('options',array(
            'nama_options'=>$this->input->post('nama_options',true),
            'type'=>$this->input->post('type',true),
            'ket'=>$this->input->post('ket',true)
        ));
    }

    public function delete($id)
    {
        //return $this->db->delete('options', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('options', array(
            'deleted' => 'y'
        )); 
    }
}