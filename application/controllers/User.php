<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // $this->load->model('Pegawai_model');
        // $this->load->model('Magang_model');
    }

    public function index()
    {
        $data['title']     = 'User Dashboard';
        $data['view']      = 'Konten/user_index';
        $data['user']      = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['cuti']      = $this->db->get('cuti')->result_array();
        $data['date']      = date('Y-m-d');
        $this->load->view('Index/adminheader', $data);
        $this->load->view('index', $data);
    }

    public function account()
    {
        $data['title']      = 'Dashboard';
        $this->load->view('Index/adminheader', $data);
        $this->load->view('Admin/account', $data);
    }

    public function rapat()
    {
        $data['title']  = 'Dashboard';
        $data['user']   = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('Index/adminheader', $data);
        $this->load->view('Admin/index');
        $this->load->view('Index/adminscript');

        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == true) {
            $data = [
                'name'          => $this->input->post('name'),
                'tempat'        => $this->input->post('tempat'),
                'time'          => $this->input->post('time'),
                'peserta'       => $this->input->post('peserta'),
                'date_created'  => time()
            ];
            $this->db->insert('tb_rapat', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
                            role="alert">New submenu ADDED!</div>');
            redirect('admin/index');
        }
    }

    public function daftar()
    {
        $data['title']    = 'Dashboard Pendaftaran';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->model('Rapat_model');
        $data['rapats'] = $this->Rapat_model->getRapat();
        $this->load->view('Index/adminheader', $data);
        $this->load->view('Admin/rapat', $data);
        $this->load->view('Index/adminscript');
    }

    public function sidara()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        if ($this->form_validation->run() == true) {
            $judul          = $this->input->post('judul');
            $pesan          = $this->input->post('pesan');
            $eviden          = $this->input->post('eviden');

            $judul1         = preg_replace('/\s\s+/', '%0D%0A', $judul);
            $title          = preg_replace('/\s+/', '+', $judul1);

            $pesan1         = preg_replace('/\s\s+/', '%0D%0A', $pesan);
            $pesan2         = preg_replace('/\s\s+/', '%0D%0A%0D%0A', $pesan1);
            $message        = preg_replace('/\s+/', '+', $pesan2);

            $link       = "https://api.whatsapp.com/send/?text=*[Message By SIDARA]*%0D%0A%0D%0A*$title*%0D%0A%0D%0A$message%0D%0A%0D%0AEviden:+$eviden%0D%0A%0D%0ATerimakasih%0D%0A%0D%0A*[End+Message]*";
            header("Location: $link");
        }
    }
}
