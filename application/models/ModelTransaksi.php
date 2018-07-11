<?php

class ModelTransaksi extends CI_Model{

    function get_data($date){
		$this->db->group_start()
						->where(array("tanggal"=>$date))
							->group_start()
								->where(array('status'=>'dp'))
								->or_where(array('status'=>'lunas'))
							->group_end()
					->group_end();
		$this->db->order_by("jam");	
		$this->db->join("tmst_paket","tmst_paket.id=td_transaksi.paket_id");
		$this->db->join("tmst_pelanggan","tmst_pelanggan.id=td_transaksi.pelanggan_id");
		$this->db->select("td_transaksi.id as id,nama_depan,nama_belakang,nama_paket,total,jam,tanggal,status");
        return $this->db->get('td_transaksi')->result();
    }

    function get_full_transaksi(){
    	$this->db->order_by("tanggal","DESC");
		$this->db->where(array('status'=>'dp'));   
		$this->db->or_where(array('status'=>'lunas'));	
		$this->db->join("tmst_paket","tmst_paket.id=td_transaksi.paket_id");
		$this->db->join("tmst_pelanggan","tmst_pelanggan.id=td_transaksi.pelanggan_id");
		$this->db->select("td_transaksi.id as id,nama_depan,nama_belakang,nama_paket,total,jam,tanggal,status");
        return $this->db->get('td_transaksi')->result();
    }

    function get_max(){
    	$this->db->order_by("id","DESC")->select("id");
    	return $this->db->get("td_transaksi",1);
    }
    function get_invoice(){
    	$this->db->order_by("tanggal","DESC");
		$this->db->where(array('status'=>'invoice'));   	
		$this->db->join("tmst_paket","tmst_paket.id=td_transaksi.paket_id");
		$this->db->join("tmst_pelanggan","tmst_pelanggan.id=td_transaksi.pelanggan_id");
		$this->db->select("td_transaksi.id as id,nama_depan,nama_belakang,nama_paket,total,jam,tanggal,status");
        return $this->db->get('td_transaksi')->result();
    }

    function get_detail($id){
		$this->db->where(array('td_transaksi.id'=>$id));	
		$this->db->join("tmst_paket","tmst_paket.id=td_transaksi.paket_id");
		$this->db->join("tmst_pelanggan","tmst_pelanggan.id=td_transaksi.pelanggan_id");
		$this->db->join("detail_transaksi","detail_transaksi.td_transaksi_id=td_transaksi.id");
		$this->db->select("td_transaksi.id as id,detail_transaksi.id as id_detail,harga,nama_depan,nama_belakang,nama_paket,total,no_telp,status,total,tanggal_bayar,jam_bayar,jam,sisa,bayar,jam_tambahan,tambahan_orang");
        return $this->db->get('td_transaksi')->result();
    }
    function get_data_edit($id){
    	$this->db->join("detail_transaksi","detail_transaksi.td_transaksi_id=td_transaksi.id");
    	$this->db->select("td_transaksi.id as id,total,bayar");
    	return $this->db->get_where("td_transaksi",array("td_transaksi.id"=>$id));
    }

    function get_gambar($id_detail){
    	return $this->db->get_where("td_gambar",array("detail_transaksi_id"=>$id_detail));
    }

    function get_data_order($id){
        $this->db->select("td_transaksi.id as id_transaksi,td_transaksi.timestamp as tanggal_transaksi,detail_transaksi.id as id_detail_transaksi,nama_paket,status,harga,total,tmst_paket.id as paket_id,tk_kategori_id,tanggal,jam,jam_tambahan,tambahan_orang");
        $this->db->order_by("id_transaksi","DESC");
        $this->db->join("tmst_paket","tmst_paket.id=td_transaksi.paket_id");
        $this->db->join("detail_transaksi","detail_transaksi.td_transaksi_id=td_transaksi.id","LEFT");
        return $this->db->get_where("td_transaksi",array("pelanggan_id"=>$id))->result();
    }

    function get_gambar_paket($id){
        $this->db->group_by("tmst_paket_id");
        return $this->db->get_where("td_gambar",array("tmst_paket_id"=>$id));
    }
    function get_kategori($id){
        return $this->db->get_where("tk_kategori",array("id"=>$id));
    }

}
   