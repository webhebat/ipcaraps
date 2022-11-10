<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class grupdiagnostik_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_grupdiagnostik($offset, $limit, $q='')
    {
        $sql="SELECT * FROM grupdiagnostik WHERE 1 AND aktif = 'y' ";

        if ($q!=''){
        	$sql .=" AND grupdiagnostik like '%$q%' or id like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function cekkode(){
        $cekkode = $this->db->get_where('grupdiagnostik', array(
            'kode'=>$this->input->post('kode',true)
        ));
        if($cekkode->num_rows()>0) 
        return true;
    }

    public function cekkodeupdate($kode){
        $query = $this->db->query("SELECT kode FROM grupdiagnostik WHERE kode = $kode and aktif= 'y' ");

        if($query->num_rows()>0) 
            return $query->row()->kode;
        // else
        //     return 0;
        //return true;

        // $this->db->select('kode');
        // $this->db->from('grupdiagnostik');
        // $this->db->where('kode',$kode);
        // return $this->db->get()->row()->kode;
    }

    public function create()
    {
        $data = array(
            'kode'=>$this->input->post('kode',true),
            'grupdiagnostik'=>$this->input->post('grupdiagnostik',true)
        );

        $this->db->insert('grupdiagnostik',$data);
        if ($this->db->affected_rows() > 0 ) {
            return true;
        } 
    }

    public function update($id)
    {
        $data = array(
            'kode'=>$this->input->post('kode',true),
            'grupdiagnostik'=>$this->input->post('grupdiagnostik',true)
        );
        $this->db->where('id', $id);
        return $this->db->update('grupdiagnostik',$data);
    }

    public function delete($id)
    {
        //return $this->db->delete('grupdiagnostik', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('grupdiagnostik', array(
            'aktif' => 'n'
        )); 
    }

     public function getoptions($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('grupdiagnostik');
            return $query->result();
    }   
	
}