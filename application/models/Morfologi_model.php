<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Morfologi_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_morfologi($offset, $limit, $q='')
    {
         $sql="SELECT s.*, g.subgrup,g.kodesubgrup FROM morfologi s 
        left join subgrup g on s.subgrupid = g.id WHERE 1 AND s.aktif = 'y' ";

        if ($q!=''){
        	 $sql .=" AND s.morfologi like '%$q%' or s.id like '%$q%' or s.kodemorfologi like '%$q%' or g.kodesubgrup like '%$q%' or g.subgrup like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function cekkode(){
        $cekkode = $this->db->get_where('morfologi', array(
            'kodemorfologi'=>$this->input->post('kodemorfologi',true)
        ));
        if($cekkode->num_rows()>0) 
        return true;
    }

    public function cekkodeupdate($kode){
        $query = $this->db->query("SELECT kode FROM morfologi WHERE kode = $kode and aktif= 'y' ");

        if($query->num_rows()>0) 
            return $query->row()->kode;
        // else
        //     return 0;
        //return true;

        // $this->db->select('kode');
        // $this->db->from('morfologi');
        // $this->db->where('kode',$kode);
        // return $this->db->get()->row()->kode;
    }

    public function create()
    {
        $data = array(
            'subgrupid'=>$this->input->post('subgrupid',true),
            'kodemorfologi'=>$this->input->post('kodemorfologi',true),
            'morfologi'=>$this->input->post('morfologi',true)
        );

        $this->db->insert('morfologi',$data);
        if ($this->db->affected_rows() > 0 ) {
            return true;
        } 
    }

    public function update($id)
    {
        $data = array(
            'subgrupid'=>$this->input->post('subgrupid',true),
            'kodemorfologi'=>$this->input->post('kodemorfologi',true),
            'morfologi'=>$this->input->post('morfologi',true)
        );
        $this->db->where('id', $id);
        return $this->db->update('morfologi',$data);
    }

    public function delete($id)
    {
        //return $this->db->delete('morfologi', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('morfologi', array(
            'aktif' => 'n'
        )); 
    }

    public function getoptions($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('morfologi');
            return $query->result();
    }

    public function optgrup($offset, $limit, $search='',$q){
        $sql="SELECT k.* FROM subgrup k
            WHERE 1 AND k.aktif = 'y' AND k.subgrup like '%".$q."%' or k.id like '%".$q."%' or k.kodesubgrup like '%".$q."%' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }    
	
}