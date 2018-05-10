<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 22.39
 */
class Jadwal extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelJadwal');
    }

    public function index(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "jadwal/index",
            "hari_ini" => $this->ModelJadwal->format_tanggal(date("Y-m-d"),true)
        );
        $this->load->view('template', $data);
    }

    public function get_event(){
        $param_tgl = $this->input->post("param");
        if (isset($param_tgl)) {
            $data = $this->ModelJadwal->get_data_event($param_tgl);
        }else{
            $data = $this->ModelJadwal->get_data_event(date("Y-m-d"));
        }
        $event = array();
        foreach ($data as $dataku) 
        {
            $event[] = array(
            'title' => $dataku->nama_depan." ".$dataku->nama_belakang." (".$dataku->nama_paket." - ".$dataku->kategori.") ",
            'tanggal' =>  $this->ModelJadwal->format_tanggal($dataku->tanggal,true),
            "jam"  => $this->ModelJadwal->pecah_jam($dataku->jam)
            );
        }
        echo json_encode($event);
        exit();
    }

}