<?php
class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}
 
	function index(){
		$this->load->view('v_login');
	}
 
	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			);
		$cek = $this->m_login->cek_login($where)->num_rows();
		$cek2 = $this->m_login->cek_login($where)->row();
		if($cek > 0){
			 $this->load->library('encrypt'); 
            $key = 'uus1234';
            $password_encrypt =  $this->encrypt->decode($cek2->password, $key);
            if ($password==$password_encrypt) {
                $data_session = array(
                    'id'       => $cek2->id,
                    'username' => $cek2->username,
                    'password' => $cek2->password,
                    'tmst_pelanggan_id' => $cek2->tmst_pelanggan_id,
                );
         
                $this->session->set_userdata($data_session);
         
                redirect(login);
 
		
		}else{
			 $this->session->set_flashdata("alert", "<script>
                    $.notify({
                        icon: 'report',
                        title: '<strong>Gagal Login!!</strong><br>',
                        message: 'Password tidak valid!!',
                    },{
                        type: 'danger',
                        timer: 3000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                    });
                </script>");
                redirect(base_url());
            }
        }else{
            $this->session->set_flashdata("alert", "<script>
                $.notify({
                    icon: 'report',
                    title: '<strong>Gagal Login!!</strong><br>',
                    message: 'Username tidak terdaftar!!',
                },{
                    type: 'danger',
                    timer: 3000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                });
            </script>");
            redirect(base_url());
        }
    }
			//echo "Username dan password salah !";
		//}
	//}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}