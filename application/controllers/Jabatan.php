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
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Tambah Data</div>");
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
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Update Data</div>");
        redirect('jabatan');
    }

    public function delete(){
        $id = $this->input->post('id');
        if (!isset($id)) {
            $this->session->set_flashdata('message',  "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Data Belum Dipilih</div>");
            redirect('jabatan');
        }
        $this->db->where_in('tk_jabatan_id', $id);
        $hapus_karyawan = $this->db->delete('karyawan');
        if($hapus_karyawan){
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_jabatan')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('jabatan');
        }else{
            $this->db->where_in('id', $id);
            if ($this->db->delete('tk_jabatan')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('jabatan');
        }
    }

}