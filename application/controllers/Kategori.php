<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 22.39
 */
class Kategori extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelKategori');
    }

    public function index(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "kategori/index",
            "kategori"=>$this->ModelKategori->get_data()
        );
        $this->load->view('template', $data);
    }
    public function input(){
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "kategori/form",
            "body" => "kategori/input",
        );
        $this->load->view('template', $data);
    }

    public function insert(){
        $kategori = array(
            'kategori' => $this->input->post('kategori'),
        );
        $this->db->insert('tk_kategori',$kategori);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Tambah Data</div>");
        redirect('kategori');
    }

    public function edit(){
        $id = $this->uri->segment(3);
        $kategori = $this->ModelKategori->get_data_edit($id)->row_array();
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "kategori/form",
            "body" => "kategori/edit",
            "kategori" => $kategori,
        );
        $this->load->view('template', $data);
    }


    public function update(){
        $id = $this->input->post('id');
        $kategori = array(
            'kategori' => $this->input->post('kategori'),
        );
        $this->db->where('id',$id);
        $this->db->update('tk_kategori',$kategori);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Update Data</div>");
        redirect('kategori');
    }

    public function delete(){
        $id = $this->input->post('id');
        if (!isset($id)) {
            $this->session->set_flashdata('message',  "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Data Belum Dipilih</div>");
            redirect('kategori');
        }
        $this->db->where_in('tk_kategori_id', $id);
        $hapus_paket = $this->db->delete('tmst_paket');
        if($hapus_paket){
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_kategori')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('kategori');
        }else{
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_kategori')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('kategori');
        }
    }

}