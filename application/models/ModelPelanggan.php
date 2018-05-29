<?php

class ModelPelanggan extends CI_Model{

    function cek_username($username){
        return $this->db->get_where('users', array('username'=>$username));
    }

    function cek_data_pelanggan($nm_depan,$nm_blkng,$tlp){
    	return $this->db->get_where('tmst_pelanggan',array('nama_depan'=>$nm_depan,'nama_belakang'=>$nm_blkng,'no_telp'=>$tlp));
    }

    function get_data_pelanggan($id){
    	return $this->db->get_where('tmst_pelanggan',array('id'=>$id));
    }
}
   