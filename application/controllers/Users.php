<?php

class Users extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelUsers');
        $this->load->model('ModelLogin');
    }

    public function input(){
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "users/form",
            "body" => "users/input",
        );
        $this->load->view('template', $data);
    }

    public function insert(){
        $id = $this->input->post('id');
        $pw = $this->input->post('password');
        $cek = $this->ModelLogin->cek_username($this->input->post('username'))->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('message', "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Username telah digunakan</div>");
            redirect('users/input/'.$id);
        }else{
            $pw_hash = password_hash($pw,PASSWORD_DEFAULT,array("cost"=>10));
            $users = array(
                'username' => $this->input->post('username'),
                'password' => $pw_hash,
                'karyawan_id' => $id,
                'level' => $this->input->post('level')
            );
            $this->db->insert('users',$users);
            $karyawan = array(
                'status' => 1
            );
            $this->db->where('id',$id);
            $this->db->update('karyawan',$karyawan);
            $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,User Login Berhasil Dibuat</div>");
            redirect('karyawan');
        }
    }

    public function edit(){
        $id = $this->uri->segment(3);
        $users = $this->ModelUsers->get_data_edit($id)->row_array();
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "users/form",
            "body" => "users/edit",
            'users'=>$users
        );
        $this->load->view('template', $data);
    }


    public function update(){
        $id = $this->input->post('id');
        $pw = $this->input->post('password');
        $pw_hash = password_hash($pw,PASSWORD_DEFAULT,array("cost"=>10));
        $users = array(
            'username' => $this->input->post('username'),
            'password' => $pw_hash,
            'level' => $this->input->post('level')
        );
        $this->db->where('karyawan_id',$id);
        $this->db->update('users',$users);
        $this->session->set_flashdata('message',"<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,User Login Berhasil Diupdate</div>");
        redirect('karyawan');
    }

    public function delete(){
        $id = $this->uri->segment(3);
        $this->db->where_in('karyawan_id', $id);
        $hapus_user_login = $this->db->delete('users');
        if($hapus_user_login){
            $karyawan = array(
                'status' => 0
            );
            $this->db->where('id',$id);
            $this->db->update('karyawan',$karyawan);
            $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete User Login</div>");
            redirect('karyawan');
        }
    }


}