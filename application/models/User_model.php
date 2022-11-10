<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

    public function saveuser(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $additional_data = array(
                                'unitid' => $this->input->post('unitid'),
                                'first_name' => $this->input->post('first_name'),
                                'active' => $this->input->post('active'),
                                );
        //cek user name yang udah daftar
        if (!$this->ion_auth->username_check($username))
        {
            $group = array($this->input->post('group'));// Sets user to admin.

            if($this->ion_auth->register($username, $password, $email, $additional_data, $group)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function updateuser($id){
        $id = $id;
        $data = array(
                    'unitid' => $this->input->post('unitid'),
                    'username' => $this->input->post('username'),
                    'first_name' => $this->input->post('first_name'),
                    'email' => $this->input->post('email'),
                     );
        // source these things from anywhere you like (eg., a form)
                    // if($this->input->post('group')){
                    //     $group_id = $this->input->post('group');
                    //     $this->ion_auth->update_group($group_id, '', '');
                    // };

        // pass the right arguments and it's done
        if($this->ion_auth->update($id, $data)){
            return true;
        }
    }

	public function get_user($offset, $limit, $q='')
    {
        $sql="SELECT U.*,G.id as idgrup,G.name,if(U.active=1,'yes','No') as aktif,UN.nama_unit  FROM users_groups UG 
        LEFT JOIN users U on UG.user_id = U.id
        LEFT JOIN unit UN on UN.id = U.unitid
        LEFT JOIN groups G on UG.group_id = G.id where U.active = 1 AND U.username !='superadmin'";

        if ($q!=''){
        	$sql .=" AND U.username like '%$q%' or U.id like '%$q%' or U.first_name like '%$q%'";	
	    }
	    $result['count'] = $this->db->query($sql)->num_rows();
	    $sql .=" LIMIT {$offset},{$limit} ";
	    $result['data'] = $this->db->query($sql)->result();

	    return $result; 
    }

    public function create()
    {
        $data = array(
            'nama_user'=>$this->input->post('nama_user'),
            'gedung_id'=>$this->input->post('gedung_id'),
            'alamat'=>$this->input->post('alamat'),
            'jabatan'=>$this->input->post('jabatan'),
            'level_jabatan'=>$this->input->post('level_jabatan'),
            'mulai_bekerja'=>$this->input->post('mulai_bekerja'),
            'status_sipil'=>$this->input->post('status_sipil'),
            'no_telp'=>$this->input->post('no_telp'),
            'email'=>$this->input->post('email'),
            'user_insert'=>$this->session->userdata('nama'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );
        return $this->db->insert('user',$data);
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        $data = array(
            'nama_user'=>$this->input->post('nama_user'),
            'gedung_id'=>$this->input->post('gedung_id'),
            'alamat'=>$this->input->post('alamat'),
            'jabatan'=>$this->input->post('jabatan'),
            'level_jabatan'=>$this->input->post('level_jabatan'),
            'mulai_bekerja'=>$this->input->post('mulai_bekerja'),
            'status_sipil'=>$this->input->post('status_sipil'),
            'no_telp'=>$this->input->post('no_telp'),
            'email'=>$this->input->post('email'),
            'user_insert'=>$this->session->userdata('nama'),
            'tgl_insert'=>date('Y-m-d H:i:s')
        );
        return $this->db->update('user',$data);
    }

    public function delete($id)
    {
        //return $this->db->delete('user', array('id' => $id));
        $this->db->where('id', $id);
        $data = array( 
            'active'=> '0'
        );
        return $this->db->update('users', $data); 
    }

    public function nonaktif($id,$active)
    {
        //return $this->db->delete('user', array('id' => $id));
        $this->db->where('id', $id);
        $data = array( 
            'active'=> $active
        );
        return $this->db->update('users', $data); 
    }

     public function getoptions($q){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.deleted', 'n');
        if($q){
            $this->db->like('user.nama_user',$q);
        }
        $this->db->join('gedung', 'gedung.id = user.gedung_id', 'left');
        $query = $this->db->get();
        return $query->result();
    } 

    public function optionuser($offset, $limit, $search='',$q){
        $sql="SELECT K.*,G.outlet FROM user K
            LEFT JOIN gedung G on G.id = K.gedung_id
            WHERE 1 AND K.deleted = 'n' AND (G.outlet like '%".$q."%' or K.nama_user like '%".$q."%')";

        $result['count'] = $this->db->query($sql)->num_rows();
        $sql .=" LIMIT {$offset},{$limit} ";
        $result['data'] = $this->db->query($sql)->result();

        return $result;
    }

    public function groupotion($q){
        $this->db->where('deleted', 'n');
        $this->db->where('name !=', 'superadmin');
        $query = $this->db->get('groups');
            return $query->result();
    } 

    public function optionunit($q){
        $this->db->where('aktif', 'y');
        $query = $this->db->get('unit');
            return $query->result();
    }   
	
}