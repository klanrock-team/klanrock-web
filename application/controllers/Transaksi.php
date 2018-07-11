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
        $timestamp = date("Y-m-d h:i:s");
        $tambah_jam = $this->input->post('jam_tambah');
        $total_jam = (int)$tambah_jam+1; 
        $total = $this->input->post("total");
        $data_transaksi = array(
            'tanggal' => $this->input->post('tanggal'),
            'jam' => $this->input->post('jam'),
            'pelanggan_id' => $this->input->post('id_pelanggan'),
            'paket_id' => $this->input->post('id_paket'),
            'status' => $this->input->post('status'),
            "jam_tambahan" => $total_jam,
            "tambahan_orang"=> $this->input->post('orang_tambah'),
            "total" => $total,
            "timestamp" => $timestamp
        );
        $input_data = $this->db->insert('td_transaksi',$data_transaksi);
        if ($input_data) {
            if ($total>100000) {
                $dp = 100000;
            }else{
                $dp = (int)$total/2;
            }
            $text = "Transaksi berhasil,silahkan lakukan pembayaran sebesar Rp.".number_format($total,2,",",".")." atau dengan dp sebesar Rp.".number_format($dp,2,",",".")." ke no rekening di bawah ini untuk dapat melakukan booking secara penuh.";
            $new_data = $this->ModelTransaksi->get_max()->row_array();
            $response = array(
                "message" => "Permintaan Berhasil Di Proses",
                "succes" => 1,
                "id_transaksi" => $new_data["id"],
                "text" => $text,
                "total" => $total,
                "minim_dp" => $dp
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

    public function konfirmasi_bayar(){
        $timestamp = date("Y-m-d h:i:s");
        $total = $this->input->post("total");
        $bayar = $this->input->post("bayar");
        $sisa = (int)$total-(int)$bayar;
        $id_transaksi = $this->input->post("id_transaksi");
        if ($sisa<0) {
            $sisa=0;
        }
        $data_trans = array(
            "jam_bayar" => $this->input->post("jam_bayar"),
            "tanggal_bayar" => $this->input->post("tanggal_bayar"),
            "td_transaksi_id" => $id_transaksi,
            "bayar" => $bayar,
            "sisa" => $sisa,
            "time_stamp" => $timestamp
        );
        $input = $this->db->insert("detail_transaksi",$data_trans);
        if ($input) {
            $update_status  = array(
                "status" => "invoice",
            );
            $this->db->where("id",$id_transaksi);
            $this->db->update("td_transaksi",$update_status);
            $respon = array(
                "message" => "konfirmasi pembayaran berhasil di kirim",
                "succes" => 1
            );
            echo json_encode($respon);
        }else{
            $respon = array(
                "message" => "konfirmasi pembayaran gagal di kirim",
                "succes" => 0
            );
            echo json_encode($respon);
        }       
    }

    public function list_order(){
        $id_pelanggan = $this->input->post("id_pelanggan");
        $list_order = $this->ModelTransaksi->get_data_order($id_pelanggan);
        $data_order = array();
            foreach ($list_order as $list) {
                $data_gambar = $this->ModelTransaksi->get_gambar_paket($list->paket_id)->row_array();
                $kat = $this->ModelTransaksi->get_kategori($list->tk_kategori_id)->row_array();
                if ($list->status == "lunas" || $list->status == "dp") {
                    $status = $list->status;
                }else{
                    if ($list->status == "invoice") {
                        $status = "Menunggu konfirmasi";
                    }else{
                        $status = "Belum dibayar";
                    }
                }
                $total = $list->total;
                if ($total>100000) {
                    $dp = 100000;
                }else{
                    $dp = (int)$total/2;
                }
                $text = "Transaksi berhasil,silahkan lakukan pembayaran sebesar Rp.".number_format($total,2,",",".")." atau dengan dp sebesar Rp.".number_format($dp,2,",",".")." ke no rekening di bawah ini untuk dapat melakukan booking secara penuh.";
                $dor = array(
                    "nama_paket" => $list->nama_paket,
                    "kategori" => $kat["kategori"],
                    "tanggal" => $this->ModelJadwal->format_tanggal($list->tanggal,true),
                    "jam"  => $this->ModelJadwal->pecah_jam($list->jam)." - ".$this->ModelJadwal->akhir_jam($list->jam,$list->jam_tambahan),
                    "tmbh_orang" => $list->tambahan_orang,
                    "tmbh_jam" => $list->jam_tambahan,
                    "timestamp" => date("Y/m/d h:i",strtotime($list->tanggal_transaksi)),
                    "status" => $status,
                    "total" => $total,
                    "gambar" => base_url()."assets/images/".$data_gambar["nama_gambar"],
                    "minim_dp" => $dp,
                    "text" => $text,
                    "id_transaksi" => $list->id_transaksi

                );
                array_push($data_order, $dor);
            }    
        echo json_encode(array("list_order"=>$data_order));

    }
}