<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 21/01/2018
 * Time: 20.24
 */
class ModelJadwal extends CI_Model{

    function get_data_event($param_tgl){
        $this->db->order_by("jam","asc");
        $this->db->join('tmst_paket','tmst_paket.id=td_transaksi.paket_id');
        $this->db->join('tmst_pelanggan','tmst_pelanggan.id=td_transaksi.pelanggan_id');
        $this->db->join('tk_kategori','tk_kategori.id=tmst_paket.tk_kategori_id');
        $this->db->select('td_transaksi.id as id,nama_depan,nama_belakang,nama_paket,tanggal,jam,kategori,jam_tambahan');
        return $this->db->get_where('td_transaksi',array('tanggal'=>$param_tgl,'status !='=>'booking'))->result();
    }
    function format_tanggal($tanggal,$cetak_hari=false){
    	$bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    	$hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
    	$tgl = explode("-",$tanggal);
    	$format_indo = $tgl[2]." ".$bulan[(int)$tgl[1]-1]." ".$tgl[0];
    	if ($cetak_hari) {
    		$hr = date('N',strtotime($tanggal));
    		return $hari[$hr].", ".$format_indo;
    	}else{
    		return $format_indo;
    	}

    }
    function pecah_jam($jam){
        $j = explode(":", $jam);
        $ja = array();
        for ($i=0 ; $i < 2  ; $i++ ) { 
            $ja[$i] = $j[$i];
        }
        return implode(":",$ja);
    }
    function akhir_jam($jam,$tambah){
        $j = explode(":", $jam);
        $ja = array();
        for ($i=0 ; $i < 2  ; $i++ ) { 
            $ja[$i] = $j[$i];
        }
        $plus = (int)$ja[0]+$tambah;
        $ja[0] = $plus;
        return implode(":",$ja);
    }

}