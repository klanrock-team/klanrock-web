<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 19.34
 */
class Home extends CI_Controller{

   public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelHome');
        $this->load->model('ModelKaryawan');
        $this->load->model('ModelPaket');
        $this->load->model('ModelGalery');
        $this->load->model('ModelUsers');
        
    }
    public function index(){
        $jml_karyawan = $this->ModelKaryawan->total_rows();
        $jml_paket = $this->ModelPaket->total_rows();
        $jml_galery= $this->ModelGalery->total_rows();
        $jml_users= $this->ModelUsers->total_rows();
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "home/index",
            'jml_karyawan'   => $jml_karyawan,
            'jml_paket'      => $jml_paket,
            'jml_galery'     => $jml_galery,
            'jml_users'      => $jml_users,

            // "country" => file("http://api.hostip.info/country.php?ip=".$_SERVER['REMOTE_ADDR']),
            // "today" => $this->ModelHome->get_data_today(),
            // "kemarin" => $this->ModelHome->get_data_kemarin(),
            // "total" => $this->ModelHome->get_data_total(),
            // "bulan_ini" => $this->ModelHome->get_data_bulan_ini(),
            // "bulan_kemarin" => $this->ModelHome->get_data_bulan_kemarin()
        );
        
        $this->load->view('template', $data);
    }

}