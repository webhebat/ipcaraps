<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Grupuser_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_grupuser($offset, $limit, $q='')
    {
        $username = $this->session->userdata("username");

        $sql="SELECT G.* FROM groups G 
        WHERE 1 AND G.deleted = 'n' AND G.name !='superadmin' ";

        if ($q!=''){
        	$sql .=" AND G.name like '%$q%' or G.id like '%$q%' or G.description like '%$q%'";	
	    }

	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function create()
    {
        $data = array(
            'name'=>$this->input->post('name'),
            'description'=>$this->input->post('description'),
            'menu_id'=>$this->input->get('menu_id')
        );
        return $this->db->insert('groups',$data);
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        $data = array(
            'name'=>$this->input->post('name'),
            'description'=>$this->input->post('description'),
            'menu_id'=>$this->input->get('menu_id')
        );
        return $this->db->update('groups',$data);
    }

    public function delete($id)
    {
        //return $this->db->delete('groups', array('id' => $id));
        $this->db->where('id', $id);
        $data = array( 
            //'user_delete'=>$this->session->userdata('nama'),
            //'tgl_delete'=>date('Y-m-d H:i:s'),
            'deleted'=> 'y'
        );
        return $this->db->update('groups', $data); 
    }

     public function getoptions($q){
        $this->db->select('groups.*');
        $this->db->from('groups');
        $this->db->where('groups.deleted', 'n');
        $this->db->where('groups.level_groups', 'utama');
        if($q){
            $this->db->like('groups.nama_groups',$q);
        }
        //$this->db->join('gedung', 'gedung.id = groups.gedung_id', 'left');
        $query = $this->db->get();
        return $query->result();
    } 

    public function optiongroups($offset, $limit, $search='',$q){
        $sql="SELECT K.*,G.outlet FROM groups K
            LEFT JOIN gedung G on G.id = K.gedung_id
            WHERE 1 AND K.deleted = 'n' AND (G.outlet like '%".$q."%' or K.nama_groups like '%".$q."%')";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }  
	
}