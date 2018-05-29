<?php

class ModelUsers extends CI_Model{

    function get_data_edit($id){
        return $this->db->get_where('users', array('karyawan_id'=>$id));
    }
     function total_rows() {
         return $this->db->get('users')->num_rows();
    }
}
   