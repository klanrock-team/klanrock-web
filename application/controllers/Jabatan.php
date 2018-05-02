<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 22.39
 */
class Jabatan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelJabatan');
    }

    public function index(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "jabatan/index",
            "jabatan"=>$this->ModelJabatan->get_data()
        );
        $this->load->view('template', $data);
    }
    public function input(){
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "jabatan/form",
            "body" => "jabatan/input",
        );
        $this->load->view('template', $data);
    }

    public function insert(){
        $jabatan = array(
            'jabatan' => $this->input->post('jabatan'),
        );
        $this->db->insert('tk_jabatan',$jabatan);
        $this->session->set_flashdata('message', "Berhasil Tambah Data");
        redirect('jabatan');
    }

    public function edit(){
        $id = $this->uri->segment(3);
        $jabatan = $this->ModelJabatan->get_data_edit($id)->row_array();
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "jabatan/form",
            "body" => "jabatan/edit",
            "jabatan" => $jabatan,
        );
        $this->load->view('template', $data);
    }


    public function update(){
        $id = $this->input->post('id');
        $jabatan = array(
            'jabatan' => $this->input->post('jabatan'),
        );
        $this->db->where('id',$id);
        $this->db->update('tk_jabatan',$jabatan);
        $this->session->set_flashdata('message', "Berhasil Update Data");
        redirect('jabatan');
    }

    public function delete(){
        $id = $this->input->post('id');
        if (!isset($id)) {
            $this->session->set_flashdata('message', "Hapus gagal!! Data belum dipilih");
            redirect('jabatan');
        }
        $this->db->where_in('id', $id);
        $hapus_jabatan = $this->db->delete('tk_jabatan');
        if($hapus_jabatan){
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_jabatan')){
                $this->session->set_flashdata('message', "Berhasil Delete Data");
            }
            redirect('jabatan', $data);
        }else{
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_jabatan')){
                $this->session->set_flashdata('message', "Berhasil Delete Data");
            }
            redirect('jabatan', $data);
        }
    }

}