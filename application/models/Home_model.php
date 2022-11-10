<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

function getmenu(){
       // echo $this->ion_auth->get_users_groups($user->id)->result();
        $html = $function = "";
        /*if ($_SESSION->apps){
            $id_apps_group_default = $_SESSION->id_apps_group_default;
            $result = json_decode($_SESSION->apps,true);
    
            if (is_array($result)){
                foreach ($result as $row) {
                    $id_apps_group[]=$row->id_apps_group;
                } // user id 2 adalah userid milik superadmin
            }*/$where ='';
                $username = $this->session->userdata("username");
                $user_id = $this->session->userdata("user_id");
                $sqlr2 = "SELECT UG.user_id,G.name,G.menu_id FROM users_groups UG LEFT JOIN groups G on UG.group_id = G.id WHERE G.deleted = 'n' AND UG.user_id = '$user_id' ";
                $r_sql2 = $this->db->query($sqlr2)->row(); 
                if ($r_sql2->menu_id){
                    if($username != 'superadmin'){
                        $sqlr3 = "SELECT
                                 a.id, a.nama_menu, a.level_menu, a.nama_file, a.keterangan, a.id_parent,a.sort,a.icon FROM menu a WHERE
                                a.deleted='n' and a.id in (".$r_sql2->menu_id.") ORDER BY a.sort ASC";
                    }else{
                        $sqlr3 = "SELECT
                                a.id, a.nama_menu, a.level_menu, a.nama_file, a.keterangan, a.id_parent,a.sort,a.icon FROM menu a WHERE
                                a.deleted='n' ORDER BY a.sort ASC";
                    }
                           
                            
                $r_sql3 = $this->db->query($sqlr3);
                $html .= "<div class=\"easyui-accordion\" data-options=\"fit:true,border:false,plain:true\">";
                $root = 0;
                $i=0;

                foreach ($r_sql3->result() as $row){
                    if ($row->nama_file) $nama_file[] = $row->nama_file;
                    if ($row->level_menu=='function') $function[] = $row->nama_menu;

                    if ($row->level_menu=='utama'){
                        if ($root==1) {$html .= "</ul></div>"; $root==0;}       
                        $root = 1;
                        $html .= "<div title=\"".$row->nama_menu."\" data-options=\"iconCls:'".$row->icon."'\" style=\"overflow:auto;\">
                                        <ul class=\"menu_body4\" style=\"display: block;\">";
                    }       
                    if ($row->level_menu=='submenu'){
                        $style = "";
                        if ($i%2==0) $style = "class=\"alt\"";
                        $html .= "<li $style><a href=\"#\" data-options=\"iconCls:'".$row->icon."'\" onclick=\"addTab('".$row->nama_menu."','".$row->nama_file."')\">".$row->nama_menu."</a> </li>";
                    }
                    $i++;
                }
                if ($root==1) {$html .= "</ul></div>"; $root==0;}       
                $html .= "</div>"; 
            //}           
        //}
        /*if ($r_sql3) {
            $_SESSION->access[$this->alias] = NULL;
            $_SESSION->access[$this->alias] = $nama_file;

            $_SESSION->function[$this->alias] = NULL;
            $_SESSION->function[$this->alias] = $function;
        }*/
        echo $html; 
    }
    }
   }