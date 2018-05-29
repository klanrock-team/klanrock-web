<?php
/**
 * Created by PhpStorm.
 * User: Fendrik
 * Date: 26/01/2018
 * Time: 22.39
 */
class Galery extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('ModelGalery');
        $this->load->library('upload');
    }

    public function index(){
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "galery/index",
            "galery"=>$this->ModelGalery->get_data()
        );
        $this->load->view('template', $data);
    }
    public function input(){
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "galery/form",
            "body" => "galery/input",
        );
        $this->load->view('template', $data);
    }

    public function insert(){
        $galery = array(
            'nama_galery' => $this->input->post('galery'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $this->db->insert('galery',$galery);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Tambah Data</div>");
        redirect('galery');
    }

    public function edit(){
        $id = $this->uri->segment(3);
        $galery = $this->ModelGalery->get_data_edit($id)->row_array();
        $data = array(
            "menu" => "MenuAdmin",
            "form" => "galery/form",
            "body" => "galery/edit",
            "galery" => $galery,
        );
        $this->load->view('template', $data);
    }


    public function update(){
        $id = $this->input->post('id');
        $galery = array(
            'nama_galery' => $this->input->post('galery'),
            'keterangan' => $this->input->post('keterangan'),
        );
        $this->db->where('id',$id);
        $this->db->update('galery',$galery);
        $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Update Data</div>");
        redirect('galery');
    }

    public function delete(){
        $id = $this->input->post('id');
        if (!isset($id)) {
            $this->session->set_flashdata('message', "<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Data Belum Dipilih</div>");
            redirect('galery');
        }
        $data = $this->ModelGalery->get_data_hapus_2($id);
        foreach ($data as $value) {
            $path = $_SERVER['DOCUMENT_ROOT']."/klanrock/assets/images/".$value->nama_gambar;
            unlink($path);

        }
        $this->db->where_in('galery_id', $id);
        $hapus_gambar = $this->db->delete('td_gambar');
        if($hapus_gambar){
            $this->db->where_in('id', $id);
            if ($this->db->delete('galery')){
                $this->session->set_flashdata('message',"<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('galery');
        }else{
            $this->db->where_in('id', $id);
            if ($this->db->delete('galery')){
                $this->session->set_flashdata('message', "<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Delete Data</div>");
            }
            redirect('galery');
        }
    }

    public function galeryphoto()
    {
        $id = $this->uri->segment(3);
        $galery = $this->ModelGalery->get_data_edit($id)->row_array();
        $data_gambar = $this->ModelGalery->get_data_gambar($id)->result();
        $data = array(
            "menu" => "MenuAdmin",
            "body" => "galery/galeryphoto",
            "gambar" => $data_gambar,
            "galery" => $galery
        );
        $this->load->view('template', $data);
    }
    public function proses_gambar(){
        if (isset($_POST['upload_gambar'])) {
            $id = $this->input->post('id');
            $config['upload_path'] = './assets/images/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|JPG|PNG|JPEG|BMP|GIF'; //type yang dapat diakses bisa anda sesuaikan
            $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
     
            $this->upload->initialize($config);
            if(!empty($_FILES['filefoto']['name'])){
                if ($this->upload->do_upload('filefoto')){
                    $gbr = $this->upload->data();
                    $data_gambar = array(
                        'nama_gambar' => $gbr['file_name'],
                        'galery_id' => $id = $this->input->post('id')
                    );
                    $this->db->insert('td_gambar',$data_gambar);
                    $this->session->set_flashdata('message',"<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Upload Gambar</div>");
                    redirect('galery/galeryphoto/'.$id);
                }else{
                    $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Gagal Upload. Gambar harus bertipe gif|jpg|png|jpeg|bmp</div>");
                    redirect('galery/galeryphoto/'.$id);
                }         
            }else{
                $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Belum Dipilih!!!</div>");
                redirect('galery/galeryphoto/'.$id);
            }
        }else if (isset($_POST['hapus_gambar'])) {
            $id = $this->input->post('id');
            $id_gambar=$this->input->post('id_gambar');
            if (!isset($id_gambar)) {
                $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Belum Dipilih!!!</div>");
                redirect('galery/galeryphoto/'.$id);
            }
            foreach ($id_gambar as $value) {
                $data_gambar = $this->ModelGalery->get_data_hapus($value)->row_array();
                $path = $_SERVER['DOCUMENT_ROOT']."/klanrock/assets/images/".$data_gambar['nama_gambar'].'';
                unlink($path);

            }
            $this->db->where_in('id', $id_gambar);
            $hapus_gambar = $this->db->delete('td_gambar');
            if ($hapus_gambar) {
                $this->session->set_flashdata('message',"<div class=\"alert alert-success alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Success,Berhasil Hapus Gambar Yang Dipilih</div>");
                redirect('galery/galeryphoto/'.$id);
            }else{
                $this->session->set_flashdata('message',"<div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Error,Gambar Gagal Dihapus!!!</div>");
                redirect('galery/galeryphoto/'.$id);
            }

        }
        
    }

    public function get_data(){
        $data = $this->ModelGalery->get_galery();
        $galeryku = array();
        foreach ($data as $galery) {
            $g = array(
                "id" => $galery->id,
                "nama_galery" => $galery->nama_galery,
                "url_gambar" => base_url()."assets/images/".$galery->nama_gambar,
                "keterangan" => htmlspecialchars(strip_tags(stripcslashes(str_replace("\r\n","",$galery->keterangan)))),
                "jumlah_foto" => $this->ModelGalery->get_count($galery->id)
            );
            array_push($galeryku, $g);
        }
        echo json_encode(array("galery"=>$galeryku));    
    }

}