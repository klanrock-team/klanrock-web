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
            'pelanggan' => $dataku->nama_depan,
            'tanggal' =>  $this->ModelJadwal->format_tanggal($dataku->tanggal,true),
            "jam"  => $this->ModelJadwal->pecah_jam($dataku->jam)." - ".$this->ModelJadwal->akhir_jam($dataku->jam,$dataku->jam_tambahan),
            'paket' => $dataku->nama_paket,
            'kategori' => $dataku->kategori
            );
        }
        echo json_encode($event);
        exit();
    }

    public function get_jadwal(){
        $tanggal = $this->input->post("tanggal");
        $date = date("Y-m-d");
        if ($tanggal==$date) {
            $label_tanggal = "Hari Ini";
        }else{
            $label_tanggal = $this->ModelJadwal->format_tanggal($tanggal,true);
        }
        $data_jawal = $this->ModelJadwal->get_data_event($tanggal);
        $jadwal = array();
        foreach ($data_jawal as $data) {
            $id = $data->pelanggan_id;
            $data_gambar = $this->ModelJadwal->get_image($id)->row_array();
            $jdwl = array(
                "pelanggan" => $data->nama_depan." ".$data->nama_belakang,
                "tanggal" => $this->ModelJadwal->format_tanggal($data->tanggal,true),
                "jam"  => $this->ModelJadwal->pecah_jam($data->jam)." - ".$this->ModelJadwal->akhir_jam($data->jam,$data->jam_tambahan),
                'paket' => $data->nama_paket,
                'kategori' => $data->kategori,
                "image_url" => base_url()."assets/images/".$data_gambar["nama_gambar"]
            );
            array_push($jadwal, $jdwl);
        }
        $label = array();
        $lbl = array(
            "label_tanggal"=>$label_tanggal,
        );
        array_push($label,$lbl);
        echo json_encode(array("data_jadwal"=>$jadwal,"label"=>$label));

    }

}