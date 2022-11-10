<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Topografi_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_topografi($offset, $limit, $q='')
    {
         $sql="SELECT s.*, g.subgrup,g.kodesubgrup FROM topografi s 
        left join subgrup g on s.subgrupid = g.id WHERE 1 AND s.aktif = 'y' ";

        if ($q!=''){
        	 $sql .=" AND s.topografi like '%$q%' or s.id like '%$q%' or s.kodetopografi like '%$q%' or g.kodesubgrup like '%$q%' or g.subgrup like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function cekkode(){
        $cekkode = $this->db->get_where('topografi', array(
            'kodetopografi'=>$this->input->post('kodetopografi',true)
        ));
        if($cekkode->num_rows()>0) 
        return true;
    }

    public function cekkodeupdate($kode){
        $query = $this->db->query("SELECT kode FROM topografi WHERE kode = $kode and aktif= 'y' ");

        if($query->num_rows()>0) 
            return $query->row()->kode;
        // else
        //     return 0;
        //return true;

        // $this->db->select('kode');
        // $this->db->from('topografi');
        // $this->db->where('kode',$kode);
        // return $this->db->get()->row()->kode;
    }

    public function create()
    {
        $data = array(
            'subgrupid'=>$this->input->post('subgrupid',true),
            'kodetopografi'=>$this->input->post('kodetopografi',true),
            'topografi'=>$this->input->post('topografi',true)
        );

        $this->db->insert('topografi',$data);
        if ($this->db->affected_rows() > 0 ) {
            return true;
        } 
    }

    public function update($id)
    {
        $data = array(
            'subgrupid'=>$this->input->post('subgrupid',true),
            'kodetopografi'=>$this->input->post('kodetopografi',true),
            'topografi'=>$this->input->post('topografi',true)
        );
        $this->db->where('id', $id);
        return $this->db->update('topografi',$data);
    }

    public function delete($id)
    {
        //return $this->db->delete('topografi', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('topografi', array(
            'aktif' => 'n'
        )); 
    }

    public function getoptions($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('topografi');
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