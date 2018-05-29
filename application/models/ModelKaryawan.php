<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 21/01/2018
 * Time: 20.24
 */
class ModelKaryawan extends CI_Model{

    function get_data(){
       $this->db->join("tk_jabatan",'tk_jabatan.id=karyawan.tk_jabatan_id');
        $this->db->order_by('id','asc');
        $this->db->select("karyawan.id as id,jabatan,nama_karyawan,no_hp,alamat,status");

        return $this->db->get('karyawan')->result();
        
    }
    function get_data_edit($id){
        return $this->db->get_where('karyawan', array('id'=>$id));

    }
    function get_jabatan(){
       $this->db->order_by('id','asc');
        return $this->db->get('tk_jabatan')->result();
        
    }
    function total_rows() {
         return $this->db->get('karyawan')->num_rows();
    }

}