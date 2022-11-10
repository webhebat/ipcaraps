<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Subgrup_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_subgrup($offset, $limit, $q='')
    {
        $sql="SELECT sg.*, g.grupdiagnostik FROM subgrup sg 
        left join grupdiagnostik g on sg.grupdiagnostikid = g.id WHERE 1 AND sg.aktif = 'y' ";

        if ($q!=''){
        	$sql .=" AND sg.subgrup like '%$q%' or sg.id like '%$q%' or sg.kodesubgrup like '%$q%' or g.grupdiagnostik like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function get_staging($offset, $limit, $search='',$jenis,$tingkat){
        $where = '';

        $sql="SELECT *, (CASE when jenis = 1 then 'Toronto' else 'TNM' END) as jenis, (CASE when tingkat = 1 then 'Pertama' when tingkat = 2 then 'Kedua' else '' END) as tingkat  FROM staging WHERE 1 AND aktif = 'y' ";
        if ($search!=''){
            $sql .= "AND (staging like '%".$search."%')"; 
        }
        if ($jenis!=''){
            $sql .= "AND (jenis like '%".$jenis."%')"; 
        }
        if ($tingkat!=''){
            $sql .= "AND (tingkat like '%".$tingkat."%')"; 
        }

        $result['count'] = $this->db->query($sql)->num_rows();
       // $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result; 
    }

    public function cekkode(){
        $cekkode = $this->db->get_where('subgrup', array(
            'kodesubgrup'=>$this->input->post('kodesubgrup',true)
        ));
        if($cekkode->num_rows()>0) 
        return true;
    }

    public function cekkodeupdate($kode){
        $query = $this->db->query("SELECT kode FROM subgrup WHERE kode = $kode and aktif= 'y' ");

        if($query->num_rows()>0) 
            return $query->row()->kode;
        // else
        //     return 0;
        //return true;

        // $this->db->select('kode');
        // $this->db->from('subgrup');
        // $this->db->where('kode',$kode);
        // return $this->db->get()->row()->kode;
    }

    public function create()
    {
        $data = array(
            'grupdiagnostikid'=>$this->input->post('grupdiagnostikid',true),
            'kodesubgrup'=>$this->input->post('kodesubgrup',true),
            'subgrup'=>$this->input->post('subgrup',true),
            'stagingid'=>$this->input->get('staging_id',true)
        );

        $this->db->insert('subgrup',$data);
        if ($this->db->affected_rows() > 0 ) {
            return true;
        } 
    }

    public function update($id)
    {
        $data = array(
            'grupdiagnostikid'=>$this->input->post('grupdiagnostikid',true),
            'kodesubgrup'=>$this->input->post('kodesubgrup',true),
            'subgrup'=>$this->input->post('subgrup',true),
            'stagingid'=>$this->input->get('staging_id',true)
        );
        $this->db->where('id', $id);
        return $this->db->update('subgrup',$data);
    }

    public function delete($id)
    {
        //return $this->db->delete('subgrup', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('subgrup', array(
            'aktif' => 'n'
        )); 
    }

    public function getoptions($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('subgrup');
            return $query->result();
    }

    public function optgrup($offset, $limit, $search='',$q){
        $sql="SELECT k.* FROM grupdiagnostik k
            WHERE 1 AND k.aktif = 'y' AND k.grupdiagnostik like '%".$q."%' or k.id like '%".$q."%' or k.kode like '%".$q."%' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }    
	
}