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
            "jadwal"=>$this->ModelJadwal->get_data()
        );
        $this->load->view('template', $data);
    }

    public function test(){
        $data = $this->ModelJadwal->get_data();
        $event = array();
        foreach ($data as $dataku) 
        {
            $e = array();
            $e['id'] = $dataku->id;
            $e['title'] = 'Birthday Party';
            $e['start'] =  $dataku->tanggal;
                // 'end'            => $dataku->tanggal,
            $e['allDay']         = false;
            $e['backgroundColor']= '#00a65a';
            $e['borderColor']    = '#00a65a'; 
            array_push($event, $e);
        }
        echo json_encode($event);
    }
}