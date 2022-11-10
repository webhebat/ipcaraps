<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Desa_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    
    public function get_desa($offset, $limit, $q='')
    {
        $sql="SELECT D.*,K.kecamatan FROM desa D
        LEFT JOIN kecamatan K on D.camatid = K.camatid 
        WHERE 1 AND D.aktif = 'y' ";

        if ($q!=''){
        	$sql .=" AND D.desa like '%$q%' or K.kecamatan like '%$q%' ";	
	    }

	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function GenerateDesaID($camatid){
        $sql="SELECT MAX(RIGHT(desaid,4)) as id FROM desa where camatid='$camatid'
            ORDER BY desaid";       
        $v_id_last = $this->db->query($sql)->row();

        //$v_id_last = $v_result->fields["id"];
      
        $v_id_new = $v_id_last->id + 1;

        
        if($v_id_new<10)
            $v_id = "0".$v_id_new;
        else if($v_id_new<100)
            $v_id = "00".$v_id_new;
        else
            $v_id = $v_id_new; 

        return $camatid.$v_id;
    }


    public function create()
    {
        $desaid = $this->GenerateDesaID($this->input->post('camatid'));
        $data = array(
            'desaid' =>$desaid,
            'desa'=>$this->input->post('desa'),
            'camatid'=>$this->input->post('camatid'),
            'kelurahan'=>$this->input->post('kelurahan'),
            'lat'=>$this->input->post('lat'),
            'lng'=>$this->input->post('lng')
        );
       return $this->db->insert('desa',$data);
    }

    public function update($id)
    {
        $this->db->where('desaid', $id);
        return $this->db->update('desa',array(
            'desa'=>$this->input->post('desa',true),
            'camatid'=>$this->input->post('camatid',true),
            'kelurahan'=>$this->input->post('kelurahan'),
            'lat'=>$this->input->post('lat'),
            'lng'=>$this->input->post('lng')
        ));
    }

    public function delete($id)
    {
        //return $this->db->delete('unit', array('id' => $id));
        $this->db->where('desaid', $id); 
        return $this->db->update('desa', array(
            'aktif' => 'n'
        )); 
    }

    public function getoptions($q){
        $this->db->select('kecamatan.*');
        $this->db->from('kecamatan');
        $this->db->where('kecamatan.aktif', 'y');
        if($q){
            $this->db->like('kecamatan.kecamatan',$q);
        }
        //$this->db->join('gedung', 'gedung.id = menu.gedung_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function optionkecamatan($offset, $limit, $search='',$q){
        $sql="SELECT k.* FROM kecamatan k
            WHERE 1 AND k.aktif = 'y' AND k.kecamatan like '%".$q."%' or k.camatid like '%".$q."%' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    } 
}