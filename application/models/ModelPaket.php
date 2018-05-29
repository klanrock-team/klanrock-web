<?php

class ModelPaket extends CI_Model{

    function get_data(){
        $this->db->join('tk_kategori','tk_kategori.id=tmst_paket.tk_kategori_id');
        $this->db->select("tmst_paket.id as id,nama_paket,harga,jumlah_orang,lama_waktu,keterangan,kategori");
        return $this->db->get('tmst_paket')->result();
    }

    function get_data_paket(){
    	$this->db->join('tk_kategori','tk_kategori.id=tmst_paket.tk_kategori_id');
        $this->db->join('td_gambar','td_gambar.tmst_paket_id=tmst_paket.id');
        $this->db->select("tmst_paket.id as id,nama_paket,harga,jumlah_orang,lama_waktu,keterangan,kategori,nama_gambar");
        $this->db->group_by('nama_paket');
        return $this->db->get('tmst_paket')->result();
    }
    function get_data_edit($id){
        return $this->db->get_where('tmst_paket', array('id'=>$id));
    }
    function get_kategori(){
        $this->db->order_by('id','asc');
        return $this->db->get('tk_kategori')->result();
    }
    function get_data_hapus($id){
        return $this->db->get_where('td_gambar',array('id'=>$id));
    }
    function get_data_gambar($id){
        return $this->db->get_where('td_gambar', array('tmst_paket_id'=>$id));
    }


}