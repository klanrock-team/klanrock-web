<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 21/01/2018
 * Time: 20.24
 */
class ModelGalery extends CI_Model{

    function get_data(){
    	$this->db->order_by('id','asc');
        return $this->db->get('galery')->result();
    }
    function get_data_edit($id){
        return $this->db->get_where('galery', array('id'=>$id));
    }
    function get_data_hapus($id){
        return $this->db->get_where('td_gambar',array('id'=>$id));
    }
    function get_data_hapus_2($id){
        $this->db->select("*");
        $this->db->where_in('galery_id',$id);
        return $this->db->get('td_gambar')->result();
    }
    function get_data_gambar($id){
        return $this->db->get_where('td_gambar', array('galery_id'=>$id));
    }
    function total_rows() {
        return $this->db->get('galery')->num_rows();
    }
    function get_galery(){
        $this->db->join("td_gambar","td_gambar.galery_id=galery.id");
        $this->db->select("nama_gambar,galery.id as id,nama_galery,keterangan");
        $this->db->group_by("nama_galery");
        return $this->db->get("galery")->result();
    }
    function get_count($id){
        return $this->db->get_where("td_gambar",array("galery_id"=>$id))->num_rows();
    }

}