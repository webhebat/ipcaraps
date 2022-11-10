<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Kecamatan_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function get_kecamatan($offset, $limit, $q='')
    {
        $sql="SELECT k.*, kab.nama as kabupaten FROM kecamatan k 
        LEFT JOIN kabupaten kab on k.id_kab = kab.id_kab 
        WHERE 1 ";

        if ($q!=''){
        	$sql .=" AND k.nama like '%$q%' or kab.nama like '%$q%' ";	
	    }

	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function GenerateDesaID($kabid){
        $sql="SELECT MAX(RIGHT(camatid,4)) as id FROM kecamatan where kabid='$kabid'
            ORDER BY kabid";       
        $v_id_last = $this->db->query($sql)->row();

        //$v_id_last = $v_result->fields["id"];
      
        $v_id_new = $v_id_last->id + 1;

        
        if($v_id_new<10)
            $v_id = "0".$v_id_new;
        else if($v_id_new<100)
            $v_id = "00".$v_id_new;
        else
            $v_id = $v_id_new; 

        return $kabid.$v_id;
    }


    public function create()
    {
        $camatid = $this->GenerateDesaID($this->input->post('kabid'));
        $data = array(
            'camatid' =>$camatid,
            'kecamatan'=>$this->input->post('kecamatan'),
            'kabid'=>$this->input->post('kabid'),
            'kodepos'=>$this->input->post('kodepos'),
            'lat'=>$this->input->post('lat'),
            'lng'=>$this->input->post('lng')
        );
       return $this->db->insert('kecamatan',$data);
    }

    public function update($id)
    {
        $this->db->where('camatid', $id);
        return $this->db->update('kecamatan',array(
            'kecamatan'=>$this->input->post('kecamatan'),
            'kabid'=>$this->input->post('kabid'),
            'kodepos'=>$this->input->post('kodepos'),
            'lat'=>$this->input->post('lat'),
            'lng'=>$this->input->post('lng')
        ));
    }

    public function delete($id)
    {
        //return $this->db->delete('unit', array('id' => $id));
        $this->db->where('camatid', $id); 
        return $this->db->update('kecamatan', array(
            'aktif' => 'n'
        )); 
    }

    public function optionkabupaten($offset, $limit, $search='',$q){
        $sql="SELECT k.* FROM kabupaten k
            WHERE 1 AND k.aktif = 'y' AND k.kabupaten like '%".$q."%' or k.kabid like '%".$q."%' ";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    } 
}