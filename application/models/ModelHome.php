<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 21/01/2018
 * Time: 20.24
 */
class ModelHome extends CI_Model{

	function get_data_total(){
        return $this->db->get_where('transaksi')->result();
    }
	
    function get_data_today(){
    	$today = date("Y-m-d");
    	$kemarin = date("Y-m-d",mktime(0,0,0,date('Y'),date('m'),date('d')-1));
        return $this->db->get_where('transaksi',array('tanggal'=>$today))->result();
    }
    function get_data_kemarin(){
    	$kemarin = date("Y-m-d",mktime(0,0,0,date('Y'),date('m'),date('d')-1));
        return $this->db->get_where('transaksi',array('tanggal'=>$kemarin))->result();
    }
    function get_data_bulan_ini(){
    	$param = date("Y-m-d");
    	$pecah = explode("-", $param);
        $bln = $pecah[1];
        return $this->db->get_where('transaksi',array('MONTH(tanggal)'=>$bln))->result();
    }
    function get_data_bulan_kemarin(){
    	$param = date("Y-m-d");
    	$pecah = explode("-", $param);
        $bln = $pecah[1]-1;
        return $this->db->get_where('transaksi',array('MONTH(tanggal)'=>$bln))->result();
    }
}