<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 21/01/2018
 * Time: 20.24
 */
class ModelJadwal extends CI_Model{

    function get_data(){
        $this->db->join('tmst_paket','tmst_paket.id=td_transaksi.paket_id');
        $this->db->join('tmst_pelanggan','tmst_pelanggan.id=td_transaksi.pelanggan_id');
        $this->db->select('td_transaksi.id as id,nama_depan,nama_belakang,nama_paket,tanggal,jam');
        return $this->db->get('td_transaksi')->result();
    }

}