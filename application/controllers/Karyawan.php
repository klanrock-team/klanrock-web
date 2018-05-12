<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 22.39
 */
class Karyawan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelKaryawan');
    }

    public function index(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "karyawan/index",
            "karyawan"=>$this->ModelKaryawan->get_data()         
        );
        $this->load->view('template', $data);
    }
    public function input(){
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "karyawan/form",
            "body" => "karyawan/input",
            "jabatan"=>$this->ModelKaryawan->get_jabatan()
        );
        $this->load->view('template', $data);
    }

   public function insert(){
        $karyawan = array(
            'nama_karyawan' => $this->input->post('Nama_Karyawan'),
            'alamat' => $this->input->post('Alamat_Karyawan'),
            'no_hp' => $this->input->post('No_HP_Karyawan'),
            'tk_jabatan_id' => $this->input->post('Id_Jabatan'),
            'status' => 0
        );
        $this->db->insert('karyawan',$karyawan);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Tambah Data</div>");
        redirect('karyawan');
    }

    public function edit(){
        $id = $this->uri->segment(3);
        $karyawan = $this->ModelKaryawan->get_data_edit($id)->row_array();
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "karyawan/form",
            "body" => "karyawan/edit",
            "jabatan"=>$this->ModelKaryawan->get_jabatan(),
             'karyawan' => $this->ModelKaryawan->get_data_edit($id)->row_array()
        );
        $this->load->view('template', $data);
    }


    public function update(){
        $id = $this->input->post('id');
        $karyawan = array(
           // 'karyawan' => $this->input->post('karyawan'),
            'nama_karyawan' => $this->input->post('Nama_Karyawan'),
            'alamat' => $this->input->post('Alamat_Karyawan'),
            'no_hp' => $this->input->post('No_HP_Karyawan'),
            'tk_jabatan_id' => $this->input->post('Id_Jabatan')
        );
        $this->db->where('id',$id);
        $this->db->update('karyawan',$karyawan);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
        redirect('karyawan');
    }

    public function delete(){
        $id = $this->input->post('id');
        if (!isset($id)) {
            $this->session->set_flashdata('message',  "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Data Belum Dipilih</div>");
            redirect('karyawan');
        }
        $this->db->where_in('karyawan_id', $id);
        $hapus_user = $this->db->delete('users');
        if($hapus_user){
            $this->db->where_in('id', $id);
            if ($this->db->delete('karyawan')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('karyawan', $data);
        }else{
            $this->db->where_in('id', $id);
            if ($this->db->delete('karyawan')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('karyawan', $data);
        }
    }

}