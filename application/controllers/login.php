<?php
class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('ModelLogin');
 
	}
 
	function index(){
		$this->load->view('v_login');
	}
 
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek = $this->ModelLogin->cek_username($username)->num_rows();
		    if($cek > 0){
    		    $data_login = $this->ModelLogin->cek_username($username)->row_array();
            $pw_valid = $data_login['password'];
            if (password_verify($password,$pw_valid)) {
                $id_login = $data_login['id'];
                $id_karyawan = $data_login['karyawan_id'];
                $get_data_karyawan = $this->ModelLogin->get_data($id_karyawan)->row_array();
                $data_session = array(
                    'id_login' => $id_login,
                    'username' => $data_login['username'],
                    'karyawan' => $get_data_karyawan['nama_karyawan'],
                    'level' => $data_login['level'],
                    'jabatan' => $get_data_karyawan['jabatan']
                );
                $this->session->set_userdata($data_session);
                redirect(base_url());
                // echo "error";
                // die("berhasil login");      
    		    }else{
    			    $this->session->set_flashdata("message", "Password salah");
              redirect('Login');
              // die("password salah");
            }
        }else{
            $this->session->set_flashdata("message","Username tidak terdaftar");
            redirect('Login');
            // die("username tidak ditemukan");
        }
			//echo "Username dan password salah !";
		//}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect("login");
	}
}