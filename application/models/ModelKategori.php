<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 21/01/2018
 * Time: 20.24
 */
class ModelKategori extends CI_Model{

    function get_data(){
    	$this->db->order_by('id','asc');
        return $this->db->get('tk_kategori')->result();
    }
    function get_data_edit($id){
        return $this->db->get_where('tk_kategori', array('id'=>$id));
    }

}