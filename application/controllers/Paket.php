<?php

class Paket extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelPaket');
        $this->load->library('upload');
    }

    public function index(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "paket/index",
            "paket"=>$this->ModelPaket->get_data()
        );
        $this->load->view('template', $data);
    }
    public function input(){
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "paket/form",
            "body" => "paket/input",
            'kategori' => $this->ModelPaket->get_kategori()
        );
        $this->load->view('template', $data);
    }

    public function insert(){
        $paket = array(
            'nama_paket' => $this->input->post('nama_paket'),
            'harga' => $this->input->post('harga'),
            'jumlah_orang' => $this->input->post('jumlah_orang'),
            'lama_waktu' => $this->input->post('lama_waktu'),
            'keterangan' => $this->input->post('keterangan'),
            'tk_kategori_id' => $this->input->post('kategori_id'),
        );
        $this->db->insert('tmst_paket',$paket);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Tambah Data</div>");
        redirect('paket');
    }

    public function edit(){
        $id = $this->uri->segment(3);
        $paket = $this->ModelPaket->get_data_edit($id)->row_array();
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "paket/form",
            "body" => "paket/edit",
            'paket'=> $paket,
            'kategori' => $this->ModelPaket->get_kategori()
        );
        $this->load->view('template', $data);
    }


    public function update(){
        $id = $this->input->post('id');
        $paket = array(
            'nama_paket' => $this->input->post('nama_paket'),
            'harga' => $this->input->post('harga'),
            'jumlah_orang' => $this->input->post('jumlah_orang'),
            'lama_waktu' => $this->input->post('lama_waktu'),
            'keterangan' => $this->input->post('keterangan'),
            'tk_kategori_id' => $this->input->post('kategori_id'),
        );
        $this->db->where('id',$id);
        $this->db->update('tmst_paket',$paket);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Update Data</div>");
        redirect('paket');
    }

    public function delete(){
        $id = $this->input->post('id');
        if (!isset($id)) {
            $this->session->set_flashdata('message',  "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Data Belum Dipilih</div>");
            redirect('paket');
        }
        $this->db->where_in('tmst_paket_id', $id);
        $hapus_paket = $this->db->delete('tmst_paket');
        if($hapus_paket){
            $this->db->where_in('id', $id);
            if ($this->db->delete('tmst_paket')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('paket');
        }else{
            $this->db->where_in('id', $id);
            if ($this->db->delete('tmst_paket')){
                $this->session->set_flashdata('message',"<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('paket');
        }
    }
     public function paketphoto()
    {
        $id = $this->uri->segment(3);
        $paket = $this->ModelPaket->get_data_edit($id)->row_array();
        $data_gambar = $this->ModelPaket->get_data_gambar($id)->result();
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "paket/paketphoto",
            "gambar" => $data_gambar,
            "paket"=> $paket
        );
        $this->load->view('template', $data);
    }
     public function proses_gambar(){
        if (isset($_POST['upload_gambar'])) {
            $id = $this->input->post('id');
            $config['upload_path'] = './assets/images/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|JPG|PNG|JPEG|BMP|GIF'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
     
            $this->upload->initialize($config);
            if(!empty($_FILES['filefoto']['name'])){
                if ($this->upload->do_upload('filefoto')){
                    $gbr = $this->upload->data();
                    $data_gambar = array(
                        'nama_gambar' => $gbr['file_name'],
                        'tmst_paket_id' => $id = $this->input->post('id')
                    );
                    $this->db->insert('td_gambar',$data_gambar);
                    $this->session->set_flashdata('message',"<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Upload Gambar</div>");
                    redirect('paket/paketphoto/'.$id);
                }else{
                    $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp</div>");
                    redirect('paket/paketphoto/'.$id);
                }         
            }else{
                $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Belum Dipilih!!!</div>");
                redirect('paket/paketphoto/'.$id);
            }
        }else if (isset($_POST['hapus_gambar'])) {
            $id = $this->input->post('id');
            $id_gambar=$this->input->post('id_gambar');
            if (!isset($id_gambar)) {
                $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Belum Dipilih!!!</div>");
                redirect('paket/paketphoto/'.$id);
            }
            foreach ($id_gambar as $value) {
                $data_gambar = $this->ModelPaket->get_data_hapus($value)->row_array();
                $path = $_SERVER['DOCUMENT_ROOT']."/klanrock/assets/images/".$data_gambar['nama_gambar'].'';
                unlink($path);

            }
            $this->db->where_in('id', $id_gambar);
            $hapus_gambar = $this->db->delete('td_gambar');
            if ($hapus_gambar) {
                $this->session->set_flashdata('message',"<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Hapus Gambar Yang Dipilih</div>");
                redirect('paket/paketphoto/'.$id);
            }else{
                $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Gagal Dihapus!!!</div>");
                redirect('paket/paketphoto/'.$id);
            }

        }
        
    }


    public function get_data(){
        $data = $this->ModelPaket->get_data();
        $paket_foto = array();
        foreach ($data as $paket) {
            $p = array(
                "id" => $paket->id,
                "nama_paket" => $paket->nama_paket,
                "harga" => $paket->harga,
                "kategori" => $paket->kategori,

                "gambar" => base_url()."assets/images/".$paket->nama_gambar,
                "keterangan" => htmlspecialchars(strip_tags(stripcslashes(str_replace("\r\n","",$paket->keterangan)))),
            );
            array_push($paket_foto, $p);
        }
        echo json_encode(array("paket"=>$paket_foto));    
    }

}