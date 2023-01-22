<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pegawai_model');
        $this->load->library('Pdf');
        // $this->load->model('Magang_model');
    }

    public function index()
    {
        $data['user']      = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title']     = 'Dashboard';
        $data['view']      = 'Konten/admin_index';
        $data['hakim']     = $this->Pegawai_model->hakim();
        $this->load->view('Index/adminheader', $data);
        $this->load->view('index', $data);
    }

    public function menu()
    {
        $menu               = '2';
        $data['title']      = 'Menu';
        $data['subtitle']   = 'Management';
        $data['view']       = 'Konten/admin_menu';
        $data['user']       = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['menu']       = $this->db->get_where('user_menu')->result_array();
        $data['undersub']   = $this->db->get_where('user_menu')->result_array();

        $data['topik']      = $this->db->get_where('user_under_sub_menu', ['id_submenu' => $menu])->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('index', $data);
        } else {
            $this->db->insert('user_menu', [
                'menu' => $this->input->post('menu'),
                'collid' => $this->input->post('idcoll')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New menu ADDED!</div>');
            redirect('admin/menu');
        }
    }

    public function changeMenu()
    {
        $menu       =   $this->input->post('menu');
        $collid     =   $this->input->post('collid');
        $menu_id    =   $this->input->post('menuid');

        $this->db->set('menu', $menu);
        $this->db->set('collid', $collid);
        $this->db->where('id', $menu_id);
        $this->db->update('user_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">Your Menu has been updated!</div>');

        redirect('admin/menu');
    }

    public function deletemenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu Sudah Dihapus.!</div>');
        redirect('admin/menu');
    }

    public function submenu()
    {
        $menu               = '2';
        $data['title']      = 'Sub Menu';
        $data['subtitle']   = 'Management';
        $data['view']       = 'Konten/admin_submenu';
        $data['user']       = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['submenu']    = $this->db->get_where('user_sub_menu')->result_array();
        $data['menu']       = $this->db->get('user_menu')->result_array();
        $data['topik']      = $this->db->get_where('user_under_sub_menu', ['id_submenu' => $menu])->result_array();

        $this->form_validation->set_rules('url', 'Url', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('index', $data);
        } else {
            $this->db->insert('user_sub_menu', [
                'menu_id'   => $this->input->post('menu_id'),
                'title'     => $this->input->post('title'),
                'url'       => $this->input->post('url'),
                'icon'      => $this->input->post('icon'),
                'itemsub'   => $this->input->post('itemsub'),
                'inemu'   => $this->input->post('inemu'),
                'is_active' => $this->input->post('is_active'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New Sub Menu ADDED!</div>');
            redirect('admin/submenu');
        }
    }

    public function changesubmenu()
    {
        $menu_id       =   $this->input->post('menu_id');
        $title         =   $this->input->post('title');
        $url           =   $this->input->post('url');
        $icon          =   $this->input->post('icon');
        $itemsub       =   $this->input->post('itemsub');
        $is_active     =   $this->input->post('is_active');
        $id            =   $this->input->post('id');

        $this->db->set('menu_id', $menu_id);
        $this->db->set('title', $title);
        $this->db->set('url', $url);
        $this->db->set('icon', $icon);
        $this->db->set('itemsub', $itemsub);
        $this->db->set('is_active', $is_active);
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">Your Submenu has been updated!</div>');

        redirect('admin/submenu');
    }

    public function deletesubmenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Menu Sudah Dihapus.!</div>');
        redirect('admin/submenu');
    }

    // submenu_under

    public function subnu()
    {
        $data['title']      = 'Under Sub Menu';
        $data['subtitle']   = '/ Management';
        $data['view']       = 'Konten/admin_under';
        $data['user']       = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['susubmenu']  = $this->db->get_where('user_under_sub_menu')->result_array();
        $data['submenu']    = $this->db->get_where('user_sub_menu')->result_array();
        $data['menu']       = $this->db->get('user_menu')->result_array();
        $menu               = '2';
        $data['topik']      = $this->db->get_where('user_under_sub_menu', ['id_submenu' => $menu])->result_array();
        $this->form_validation->set_rules('url', 'Url', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('index', $data);
        } else {
            $this->db->insert('user_under_sub_menu', [
                'id_submenu'   => $this->input->post('id_submenu'),
                'title'        => $this->input->post('title'),
                'url'          => $this->input->post('url'),
                'is_active'    => $this->input->post('is_active'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New Under Sub Menu ADDED!</div>');
            redirect('admin/subnu');
        }
    }

    public function changesubnu()
    {
        $id_submenu    =   $this->input->post('id_submenu');
        $title         =   $this->input->post('title');
        $url           =   $this->input->post('url');
        $is_active     =   $this->input->post('is_active');
        $id            =   $this->input->post('id');

        $this->db->set('id_submenu', $id_submenu);
        $this->db->set('title', $title);
        $this->db->set('url', $url);
        $this->db->set('is_active', $is_active);
        $this->db->where('id', $id);
        $this->db->update('user_under_sub_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">Your Submenu has been updated!</div>');

        redirect('admin/subnu');
    }

    public function deleteundersubmenu($id)
    {
        $this->db->delete('user_under_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Under Sub Menu Sudah Dihapus.!</div>');
        redirect('admin/subnu');
    }

    // role
    public function role()
    {
        $data['title']    = 'Role';
        $data['subtitle'] = '';
        $data['user']     = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['view']     = 'Konten/admin_role';
        $data['role']     = $this->db->get('user_role')->result_array();
        $data['menu']     = $this->db->get('user_menu')->result_array();
        $menu             = '2';
        $data['topik']    = $this->db->get_where('user_under_sub_menu', ['id_submenu' => $menu])->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('index', $data);
        } else {
            $this->db->insert('user_role', [
                'role'   => $this->input->post('role'),
                'is_active' => $this->input->post('is_active'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New Role ADDED!</div>');
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['title']    = 'Role Access';
        $data['subtitle'] = '';
        $data['user']     = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['view']     = 'Konten/admin_access';
        $data['role']     = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu']     = $this->db->get('user_menu')->result_array();
        $data['submenu']     = $this->db->get('user_sub_menu')->result_array();
        $data['undersub']     = $this->db->get('user_under_sub_menu')->result_array();

        $this->load->view('Index/adminheader', $data);
        $this->load->view('index', $data);
    }

    public function changeAccess()
    {
        $menu_id    =   $this->input->post('menuID');
        $role_id    =   $this->input->post('roleID');

        $data       =   [
            'role_id'   =>  $role_id,
            'menu_id'   =>  $menu_id
        ];

        $result     =   $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">Access Changed!</div>');
    }

    public function changesubAccess()
    {
        $submenu_id    =   $this->input->post('submenuID');
        $role_id       =   $this->input->post('roleID');

        $data          =   [
            'role_id'      =>  $role_id,
            'submenu_id'   =>  $submenu_id
        ];

        $result        =   $this->db->get_where('user_access_submenu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_submenu', $data);
        } else {
            $this->db->delete('user_access_submenu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">Access Submenu Changed!</div>');
    }

    public function changeundersubaccess()
    {
        $submenu_id    =   $this->input->post('undersubmenuID');
        $role_id       =   $this->input->post('roleID');

        $data          =   [
            'role_id'      =>  $role_id,
            'under_id'   =>  $submenu_id
        ];

        $result        =   $this->db->get_where('user_access_undersub', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_undersub', $data);
        } else {
            $this->db->delete('user_access_undersub', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">Access Under Submenu Changed!</div>');
    }

    public function deleterole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role Sudah Dihapus.!</div>');
        redirect('admin/role');
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


    public function pdf()
    {
        $data['pegawai'] = $this->db->get('user')->result();
        $this->load->view('v_laporan', $data);
    }
}
