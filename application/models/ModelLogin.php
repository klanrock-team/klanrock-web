<?php 
 
class ModelLogin extends CI_Model{	

    function cek_username($username){
        return $this->db->get_where("users",array('username'=>$username));
    }

    function get_data($id){
        $this->db->join('tk_jabatan',"tk_jabatan.id=karyawan.tk_jabatan_id");
        $this->db->select("karyawan.id as id,nama_karyawan,jabatan");
        return $this->db->get_where("karyawan",array("karyawan.id"=>$id));

    }

}
