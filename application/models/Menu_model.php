<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Menu_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	public function get_menu($offset, $limit, $search='')
    {
        $where = '';
        if ($search!=''){
            $where .= "AND (M.nama_menu like '%".$search."%' or M.keterangan like '%".$search."%')" ; 
        }

        $sql="SELECT M.*,P.nama_menu as parent FROM menu M 
        LEFT JOIN menu P on M.id = P.id_parent 
        WHERE 1 AND M.deleted = 'n' $where group by M.id order by M.sort ";

        /*if ($q!=''){
        	$sql .=" AND M.nama_menu like '%$q%' or M.id like '%$q%' or M.keterangan like '%$q%'";	
	    }*/
	    $result['count'] = $this->db->query($sql)->num_rows();
	   // $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function get_menu2($offset, $limit, $search='')
        {
            $where = '';
            $username = $this->session->userdata("username");
            if ($search!=''){
                $where .= "AND (M.nama_menu like '%".$search."%' or M.keterangan like '%".$search."%')"; 
            }

            if($username != 'superadmin'){
                $where .= "AND M.id !='16' "; //16 adalah menu menu :D 
            }

            $sql="SELECT M.*,P.nama_menu as parent FROM menu M 
            LEFT JOIN menu P on M.id = P.id_parent 
            WHERE 1 AND M.deleted = 'n' $where group by M.id order by M.sort ";

            /*if ($q!=''){
                $sql .=" AND M.nama_menu like '%$q%' or M.id like '%$q%' or M.keterangan like '%$q%'";  
            }*/

            $result['count'] = $this->db->query($sql)->num_rows();
           // $sql .=" LIMIT {$offset},{$limit} ";
            $result['data'] = $this->db->query($sql)->result();

            return $result; 
        }

    public function create()
    {
        $data = array(
            'nama_menu'=>$this->input->post('nama_menu'),
            'level_menu'=>$this->input->post('level_menu'),
            'nama_file'=>$this->input->post('nama_file'),
            'keterangan'=>$this->input->post('keterangan'),
            'id_parent'=>$this->input->post('id_parent'),
            'icon'=>$this->input->post('icon'),
            'sort'=>$this->generateid(),
            'user_insert'=>$this->session->userdata('nama'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );
        return $this->db->insert('menu',$data);
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        $data = array(
            'nama_menu'=>$this->input->post('nama_menu'),
            'level_menu'=>$this->input->post('level_menu'),
            'nama_file'=>$this->input->post('nama_file'),
            'keterangan'=>$this->input->post('keterangan'),
            'id_parent'=>$this->input->post('id_parent'),
            'icon'=>$this->input->post('icon'),
            'user_insert'=>$this->session->userdata('nama'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );
        return $this->db->update('menu',$data);
    }

    public function generateid(){
        $this->db->select_max('sort');
        $query = $this->db->get('menu');
        if($query->num_rows() > 0) {
         return $query->row()->sort+1;
        }
        return false;
    }

    public function delete($id)
    {
        //return $this->db->delete('menu', array('id' => $id));
        $this->db->where('id', $id);
        $data = array( 
            //'user_delete'=>$this->session->userdata('nama'),
            //'tgl_delete'=>date('Y-m-d H:i:s'),
            'deleted'=> 'y'
        );
        return $this->db->update('menu', $data); 
    }

     public function getoptions($q){
        $this->db->select('menu.*');
        $this->db->from('menu');
        $this->db->where('menu.deleted', 'n');
        $this->db->where('menu.level_menu', 'utama');
        if($q){
            $this->db->like('menu.nama_menu',$q);
        }
        //$this->db->join('gedung', 'gedung.id = menu.gedung_id', 'left');
        $query = $this->db->get();
        return $query->result();
    } 

    public function optionmenu($offset, $limit, $search='',$q){
        $sql="SELECT K.*,G.outlet FROM menu K
            LEFT JOIN gedung G on G.id = K.gedung_id
            WHERE 1 AND K.deleted = 'n' AND (G.outlet like '%".$q."%' or K.nama_menu like '%".$q."%')";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function MenuAppsDown(){
        $v_sql3 = "UPDATE menu set sort='0' where sort='".$this->input->post('sort_from')."' ";
        $v_result3 = $this->db->query($v_sql3);      
        
        $v_sql4 = "UPDATE menu set sort='".$this->input->post('sort_from')."' where sort='".$this->input->post('sort_to')."' ";
        $v_result4 = $this->db->query($v_sql4);         

        $v_sql5 = "UPDATE menu set sort='".$this->input->post('sort_to')."' where sort='0' ";
        $v_result5 = $this->db->query($v_sql5);     

        if ($v_result5){
            return true;
        } else {
            return false;
        }   
    }  
	
}