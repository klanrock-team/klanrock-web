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
        $this->session->set_flashdata('message', "Berhasil Tambah Data");
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
        $this->session->set_flashdata('message', "Berhasil Update Data");
        redirect('kategori');
    }

    public function delete(){
        $id = $this->input->post('id');
        if (!isset($id)) {
            $this->session->set_flashdata('message', "Hapus gagal!! Data belum dipilih");
            redirect('kategori');
        }
        $this->db->where_in('id', $id);
        $hapus_kategori = $this->db->delete('tk_kategori');
        if($hapus_kategori){
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_kategori')){
                $this->session->set_flashdata('message', "Berhasil Delete Data");
            }
            redirect('kategori', $data);
        }else{
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_kategori')){
                $this->session->set_flashdata('message', "Berhasil Delete Data");
            }
            redirect('kategori', $data);
        }
    }

}