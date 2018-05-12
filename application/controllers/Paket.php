<?php

class Paket extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelPaket');
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

}