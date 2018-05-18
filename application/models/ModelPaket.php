<?php

class ModelPaket extends CI_Model{

    function get_data(){
    	$this->db->join('tk_kategori','tk_kategori.id=tmst_paket.tk_kategori_id');
        $this->db->select("tmst_paket.id as id,nama_paket,harga,jumlah_orang,lama_waktu,keterangan,kategori");
        return $this->db->get('tmst_paket')->result();
    }
    function get_data_edit($id){
        return $this->db->get_where('tmst_paket', array('id'=>$id));
    }
    function get_kategori(){
        $this->db->order_by('id','asc');
        return $this->db->get('tk_kategori')->result();
    }

}