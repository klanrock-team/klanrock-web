<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 19.34
 */
class Pelanggan extends CI_Controller{

   public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelPelanggan');
    }
    public function register(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek_exist = $this->ModelPelanggan->cek_username($username); 
        if ($cek_exist->num_rows()>0) {
            echo "Username telah digunakan";
        }else{    
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $no_telp = $this->input->post('no_telp');
            $cek_data = $this->ModelPelanggan->cek_data_pelanggan($nama_depan,$nama_belakang,$no_telp);
            if ($cek_data->num_rows()>0) {
                echo "Data diri dan No telepon telah digunakan";
            }else{
                $data_pelanggan = array(
                    'nama_depan' => $nama_depan,
                    'nama_belakang' => $nama_belakang,
                    'no_telp' => $no_telp,
                    'alamat' => "Alamat anda"
                ); 
                $simpan_data = $this->db->insert('tmst_pelanggan',$data_pelanggan);
                if ($simpan_data) {
                    $ambil_data =  $this->ModelPelanggan->cek_data_pelanggan($nama_depan,$nama_belakang,$no_telp)->row_array();
                    $id_pelanggan = $ambil_data['id'];
                    $pw_hash = password_hash($password,PASSWORD_DEFAULT,array('cost'=>10));
                    $data_login = array(
                        'username' => $username,
                        'password' => $pw_hash,
                        'tmst_pelanggan_id' => $id_pelanggan,
                    );
                    $save = $this->db->insert('users',$data_login);
                    $img_profil = array(
                        "nama_gambar" => "user.png",
                        "pelanggan_id" => $id_pelanggan
                    );
                    $ins = $this->db->insert("td_gambar",$img_profil);
                    if ($save) {
                        echo "Berhasil register,Silahkan login";
                    }else{
                        $this->db->where_in('id', $id_pelanggan);
                        $hapus_paket = $this->db->delete('tmst_pelanggan');
                        echo "Gagal register";
                    }
                }else{
                    echo "Gagal register";
                }   
            }
        }
    }

    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $cek_username = $this->ModelPelanggan->cek_username($username);
        if ($cek_username->num_rows()>0) {
            $data_login = $this->ModelPelanggan->cek_username($username)->row_array();
            $pw_valid = $data_login['password'];
            $id_login = $data_login['id'];
            $id_pelanggan = $data_login['tmst_pelanggan_id'];
            if (password_verify($password,$pw_valid)) {
                $data_pelanggan = $this->ModelPelanggan->get_data_pelanggan($id_pelanggan)->row_array();
                $data_verif_login = array(
                    'id_login' => $id_login,
                    'id_pelanggan' => $id_pelanggan,
                    'message' => "Berhasil login",
                    'success' => 1,
                    'username' => $username,
                    'nama' => $data_pelanggan['nama_depan']." ".$data_pelanggan['nama_belakang'],
                );
                echo json_encode($data_verif_login);
            }else{
                $data_verif_login = array(
                    'message' => "Password anda salah",
                    'success' => 0,
                );
                echo json_encode($data_verif_login);
            }
        }else{
            $data_verif_login = array(
                    'message' => "Username Tidak Terdaftar",
                    'success' => 0,
                );
                echo json_encode($data_verif_login);
        }
    }

    public function get_profil(){
        $id_pelanggan = $this->input->post("id_pelanggan");
        $data_pelanggan = $this->ModelPelanggan->get_data_pelanggan($id_pelanggan)->row_array();
        $gambar = $this->ModelPelanggan->get_profil($id_pelanggan)->row_array();
        $data = array(
            "full_name" => $data_pelanggan['nama_depan']." ".$data_pelanggan['nama_belakang'],
            "nama_depan" => $data_pelanggan['nama_depan'],
            "nama_belakang" => $data_pelanggan['nama_belakang'],
            "no_tlp" => $data_pelanggan['no_telp'],
            "alamat" => $data_pelanggan['alamat'],
            "profil" => base_url()."assets/images/".$gambar['nama_gambar']
        );
        echo json_encode($data);
    }

    public function save_profil(){
        $id_pelanggan = $this->input->post("id_pelanggan");
        $nm_depan = $this->input->post("nama_depan");
        $nm_blkng = $this->input->post("nama_belakang");
        $alamat = $this->input->post("alamat");
        $no_telp = $this->input->post("no_telp");
        $data_pelanggan = array(
            "nama_depan" => $nm_depan,
            "nama_belakang" => $nm_blkng,
            "alamat" => $alamat,
            "no_telp" => $no_telp
        );
        $this->db->where('id',$id_pelanggan);
        $edit_data = $this->db->update('tmst_pelanggan',$data_pelanggan);
        if ($edit_data) {
            $data = array(
                "respone" => 1,
                "message" => "Berhasil memperbarui profil"
            );
        }else{
            $data = array(
                "respone" => 0,
                "message" => "Gagal memperbarui profil"
            );
        }
        echo json_encode($data);
        
    }

}