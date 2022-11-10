<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Unit_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_no_unit(){
        $sql= $this->db->query("SELECT MAX(RIGHT(no_unit,2)) as kodemax FROM unit ");
        $kd = "";
        if($sql->num_rows()>0){
            foreach($sql->result() as $k){
                $tmp = ((int)$k->kodemax)+1;
                $kd = sprintf("%02s", $tmp);
            }
        }else{
            $kd = "01";
        }

        $data['nourut'] = $kd;

        return $data;
    }

	public function get_unit($offset, $limit, $q='')
    {
        $sql="SELECT * FROM unit WHERE 1 AND aktif = 'y' ";

        if ($q!=''){
        	$sql .=" AND nama_unit like '%$q%' or alamat like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function create()
    {
        return $this->db->insert('unit',array(
            'no_unit'=>$this->input->post('no_unit',true),
            'nama_unit'=>$this->input->post('nama_unit',true),
            'alamat'=>$this->input->post('alamat',true)
            //'kode'=>$this->input->post('kode',true)
        ));
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        return $this->db->update('unit',array(
            'nama_unit'=>$this->input->post('nama_unit',true),
            'alamat'=>$this->input->post('alamat',true),
            'kode'=>$this->input->post('kode',true)
        ));
    }

    public function delete($id)
    {
        //return $this->db->delete('unit', array('id' => $id));
        $this->db->where('id', $id); 
        return $this->db->update('unit', array(
            'aktif' => 'n'
        )); 
    }

     public function getoptions($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('unit');
            return $query->result();
    }   
	
}