<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 22.39
 */
class Transaksi extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model("ModelTransaksi");
        $this->load->model("ModelJadwal");
    }


    public function index(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "transaksi/index",
        );
        $this->load->view('template', $data);
    }
    public function invoice(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "transaksi/invoice",
        );
        $this->load->view('template', $data);
    }
    public function booking(){
        $data_transaksi = array(
            'tanggal' => $this->input->post('tanggal'),
            'jam' => $this->input->post('jam'),
            'pelanggan_id' => $this->input->post('id_pelanggan'),
            'paket_id' => $this->input->post('id_paket'),
            'status' => $this->input->post('status'),
            "jam_tambahan" => $this->input->post('jam_tambah'),
            "tambahan_orang"=> $this->input->post('orang_tambah')
        );
        $input_data = $this->db->insert('td_transaksi',$data_transaksi);
        if ($input_data) {
            $response = array(
                "message" => "Permintaan Berhasil Di Proses",
                "succes" => 1
            );
            echo json_encode($response);
        }else{

            $response = array(
                "message" => "Permintaan Gagal Di Proses",
                "succes" => 0
            );
            echo json_encode($response);
        }
    }

    public function get_transaksi(){
        $param = $this->input->post("param");
        if (isset($param)) {
            if ($param==null) {
                $transaksi = $this->ModelTransaksi->get_full_transaksi();    
            }else{
                $transaksi = $this->ModelTransaksi->get_data($param);
            } 
        }else{
            $transaksi = $this->ModelTransaksi->get_data(date("Y-m-d"));
        }
        $data_transaksi = array();
        foreach ($transaksi as $data) {
            $dt = array(
                "id" => $data->id,
                "nama_pelanggan" => $data->nama_depan." ".$data->nama_belakang,
                "paket" => $data->nama_paket,
                "tanggal" => $this->ModelJadwal->format_tanggal($data->tanggal,false),
                "jam" => $this->ModelJadwal->pecah_jam($data->jam),
                "total"=> "Rp.".number_format($data->total,2,",","."),
                "status"=> $data->status,
            );
            array_push($data_transaksi,$dt);
        }
        echo json_encode($data_transaksi);
    }

    public function get_invoice(){
        $transaksi = $this->ModelTransaksi->get_invoice();    
        $data_transaksi = array();
        foreach ($transaksi as $data) {
            $dt = array(
                "id" => $data->id,
                "nama_pelanggan" => $data->nama_depan." ".$data->nama_belakang,
                "paket" => $data->nama_paket,
                "tanggal" => $this->ModelJadwal->format_tanggal($data->tanggal,false),
                "jam" => $this->ModelJadwal->pecah_jam($data->jam),
                "total"=> "Rp.".number_format($data->total,2,",","."),
                "status"=> $data->status,
            );
            array_push($data_transaksi,$dt);
        }
        echo json_encode($data_transaksi);
    }


    public function get_detail(){
        $id = $this->input->post("id");
        $transaksi = $this->ModelTransaksi->get_detail($id);
        $data_transaksi = array();
        
        foreach ($transaksi as $data) {
            $date = date("Y/m/d",strtotime($data->tanggal_bayar));
            if ($data->status=="dp") {
                    $status = "Belum Lunas";
            }else{
                    $status = "Lunas";
            }
            if ($data->jam_tambahan>1 AND $data->tambahan_orang>0) {
                $ket = ($data->jam_tambahan-1)." jam tambahan, ".$data->tambahan_orang." orang tambahan";
            }else if ($data->tambahan_orang > 0) {
                $ket = $data->tambahan_orang." orang tambahan";
            }else if($data->jam_tambahan > 1 ){
                $ket = ($data->jam_tambahan-1)." jam tambahan";
            }else{
                $ket = "-";
            }
            
            $dt = array(
                "id" => $data->id,
                "nama_pelanggan" => $data->nama_depan." ".$data->nama_belakang,
                "paket" => $data->nama_paket,
                "keterangan" => $ket,
                "tanggal" => $date,
                "tlp" => $data->no_telp,
                "total"=> "Rp.".number_format($data->total,2,",","."),
                "status"=> $status,
                "harga" => "Rp.".number_format($data->harga,2,",","."),
                "bayar" => "Rp.".number_format($data->bayar,2,",","."),
                "sisa" => "Rp.".number_format($data->sisa,2,",","."),
                "tanggal_bayar" => $data->tanggal_bayar,
                "jam_bayar" => $this->ModelJadwal->pecah_jam($data->jam_bayar),

            );
            array_push($data_transaksi,$dt);
        }
        echo json_encode($data_transaksi);
    }

    public function get_detail_invoice(){
        $id = $this->input->post("id");
        $transaksi = $this->ModelTransaksi->get_detail($id);
        $data_transaksi = array();
        foreach ($transaksi as $data) {
            if ($data->jam_tambahan>1 AND $data->tambahan_orang>0) {
                $ket = ($data->jam_tambahan-1)." jam tambahan, ".$data->tambahan_orang." orang tambahan";
            }else if ($data->tambahan_orang > 0) {
                $ket = $data->tambahan_orang." orang tambahan";
            }else if($data->jam_tambahan > 1 ){
                $ket = ($data->jam_tambahan-1)." jam tambahan";
            }else{
                $ket = "-";
            }
            $date = date("Y/m/d",strtotime($data->tanggal_bayar));
            $data_gambar = $this->ModelTransaksi->get_gambar($data->id_detail)->row_array();
            $url_gambar = base_url()."assets/images/".$data_gambar['nama_gambar'];
            
            $dt = array(
                "id" => $data->id,
                "nama_pelanggan" => $data->nama_depan." ".$data->nama_belakang,
                "paket" => $data->nama_paket,
                "keterangan" => $ket,
                "tanggal" => $date,
                "tlp" => $data->no_telp,
                "total"=> "Rp.".number_format($data->total,2,",","."),
                "harga" => "Rp.".number_format($data->harga,2,",","."),
                "bayar" => "Rp.".number_format($data->bayar,2,",","."),
                "sisa" => "Rp.".number_format($data->sisa,2,",","."),
                "url_gambar" =>$url_gambar ,
                "tanggal_bayar" => $data->tanggal_bayar,
                "jam_bayar" => $this->ModelJadwal->pecah_jam($data->jam_bayar),

            );
            array_push($data_transaksi,$dt);
        }
        echo json_encode($data_transaksi);
    }

    public function bayar_sisa(){
        $id = $this->uri->segment(3);
        $data_edit = $this->ModelTransaksi->get_data_edit($id)->row_array();
        $bayar = array(
            'bayar' => $data_edit['total'],
            'sisa' => 0
        );
        $this->db->where('td_transaksi_id',$id);
        $this->db->update('detail_transaksi',$bayar);
        $change_status = array(
            'status' => 'lunas'
        );
        $this->db->where('id',$id);
        $this->db->update('td_transaksi',$change_status);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Pembayaran berhasil dilakukan</div>");
        redirect('transaksi');
    }

    public function accept(){
        $id = $this->uri->segment(3);
        $data_transaksi = $this->ModelTransaksi->get_data_edit($id)->row_array();
        $total = $data_transaksi['total'];
        $bayar = $data_transaksi['bayar'];
        if ($bayar>=$total) {
            $status = "lunas";
        }else{
            $status="dp";
        }
        $change_status = array(
            'status' => $status
        );
        $this->db->where('id',$id);
        $this->db->update('td_transaksi',$change_status);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Transaksi berhasil di verifikasi</div>");
        redirect('transaksi/invoice');
    }

}