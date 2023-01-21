<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Was_model');
        // $this->load->model('Disabilitas_model');
    }

    public function index()
    { {
            $data['title']    = 'Daftar Panduan';
            $data['user'] = $this->db->get_where('user', ['username' =>
            $this->session->userdata('username')])->row_array();

            $data['syarat'] = $this->db->get_where('db_pandua')->result_array();

            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('Index/adminheader', $data);
                $this->load->view('Pandu/Index');
                $this->load->view('Index/adminscript');
            } else {
                $this->db->insert('db_pandua', [
                    'name' => $this->input->post('name'),
                    'subname' => $this->input->post('subname'),
                    'logo' => $this->input->post('logo'),
                    'bg' => $this->input->post('bg')
                ]);

                $this->session->set_flashdata('message', '<div class="alert alert-success" 
    						role="alert">New Panduan ADDED!</div>');
                redirect('pandu');
            }
        }
    }

    public function siapid()
    {
        $data['title']      = 'SIAPID';
        $data['subtitle']   = '';
        $data['user']       = $this->db->get_where('user', ['username' =>  $this->session->userdata('username')])->row_array();
        $data['view']       = 'Konten/aplikasi_siapid';
        $data['ikms']       = $this->Was_model->getWas();
        $data['total']      = $this->Was_model->data_responden();
        $data['tindak']     = $this->Was_model->data_tindak();
        $this->load->view('Index/adminheader', $data);
        $this->load->view('index', $data);

        $this->form_validation->set_rules('bidang', 'Bidang', 'required|trim');

        if ($this->form_validation->run() == true) {
            $tgl             = $this->input->post('tgl');
            $bidang          = $this->input->post('bidang');
            $subbidang       = $this->input->post('subbidang');
            $pengawas         = $this->input->post('pengawas');
            $kondisi         = $this->input->post('kondisi');

            $upload_image = $_FILES['image']['name'];
            echo $upload_image;
            if ($upload_image) {
                $config['allowed_types']    = 'gif|jpg|jpeg|png|heic|heif|heics|avci';
                $config['max_size']         = '0';
                $config['upload_path']      = './assets/img/pengawasan/';
                $config['encrypt_name']     = true;
                $config['max_width']            = 6000; // 6000px you can set the value you want
                $config['max_height']           = 6000; // 6000px


                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_image  = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $data       = [
                'tgl'             => $tgl,
                'bidang'         => $bidang,
                'subbidang'        => $subbidang,
                'kondisi'        => $kondisi,
                'pengawas'         => $pengawas,
                'eviden'         => $new_image,
                'date_created'  =>  time()
            ];

            $added =  $this->db->insert('db_pengawasan', $data);
            if ($added) {
                redirect('pengawasan/index');
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function tambahtahapan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == true) {
            $name               = $this->input->post('name');
            $img                = $this->input->post('img');
            $url                = $this->input->post('url');
            $idpandu            = $this->input->post('idpandu');

            $data       = [
                'name'             => $name,
                'img'            => $img,
                'url'            => $url,
                'idpandu'         => $idpandu,
            ];

            $added =  $this->db->insert('db_pandub', $data);
            if ($added) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New Syarat ADDED!</div>');
                $url = "https://app.ms-lhokseumawe.go.id/pandu/tahapan/$idpandu";
                header("Location: $url");
                // redirect('informasi/perkara');
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function tahapan($id)
    {
        $data['title']    = 'Tahapan';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['panduan']    = $this->db->get_where('db_pandub', ['idpandu' => $id])->result_array();
        $data['pandu']        = $this->db->get_where('db_pandua', ['id' => $id])->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('Pandu/tambah', $data);
            $this->load->view('Index/adminscript');
        } else {
            $this->db->insert('user_menu', [
                'menu' => $this->input->post('menu'),
                'idcoll' => $this->input->post('idcoll')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New Tahapan ADDED!</div>');
            redirect('menu');
        }
    }

    public function edittahapan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == true) {
            $name       = $this->input->post('name');
            $img        = $this->input->post('img');
            $id         = $this->input->post('id');
            $idpandu    = $this->input->post('idpandu');

            $data       = [
                'name'             => $name,
                'img'             => $img,
            ];

            $this->db->set('name', $name);
            $this->db->set('img', $img);
            $this->db->where('id', $id);

            $added = $this->db->update('db_pandub');

            if ($added) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">Tahapan Berhasil Dirubah!</div>');
                $url = "https://app.ms-lhokseumawe.go.id/pandu/tahapan/$idpandu";
                header("Location: $url");
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function deleteth($id)
    {
        $options         = array('id' => $id);
        $idbank          = $this->db->get_where('db_pandub', $options)->row_array();
        $namabank        = $idbank['idpandu'];

        $this->db->delete('db_pandub', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tahapan Sudah Dihapus.!</div>');
        $url = "https://app.ms-lhokseumawe.go.id/pandu/tahapan/$namabank";
        header("Location: $url");
    }

    public function perkara()
    {
        $data['title']    = 'Jenis Perkara';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['syarat'] = $this->db->get_where('jenis_perkara')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('Informasi/syarat');
            $this->load->view('Index/adminscript');
        } else {
            $this->db->insert('user_menu', [
                'menu' => $this->input->post('menu'),
                'idcoll' => $this->input->post('idcoll')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New menu ADDED!</div>');
            redirect('menu');
        }
    }

    public function kritis()
    {
        $data['title']    = 'Laporan Kritik & Saran Otomatis';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['kritis'] = $this->db->get_where('tb_kritik')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('Informasi/kritis');
            $this->load->view('Index/adminscript');
        } else {
            $this->db->insert('user_menu', [
                'menu' => $this->input->post('menu'),
                'idcoll' => $this->input->post('idcoll')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New menu ADDED!</div>');
            redirect('menu');
        }
    }

    public function persyaratan($id)
    {
        $data['title']    = 'Persyaratan';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        // $data['syarat'] = $this->db->get_where('jenis_perkara')->result_array();
        $data['syarat']        = $this->db->get_where('db_syarat', ['id_perkara' => $id])->result_array();
        $data['perkara']    = $this->db->get_where('jenis_perkara', ['id' => $id])->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Index/adminheader', $data);
            $this->load->view('Informasi/anuanu', $data);
            $this->load->view('Index/adminscript');
        } else {
            $this->db->insert('user_menu', [
                'menu' => $this->input->post('menu'),
                'idcoll' => $this->input->post('idcoll')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New menu ADDED!</div>');
            redirect('menu');
        }
    }

    public function tambahsyarat()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == true) {
            $name             = $this->input->post('name');
            $subname          = $this->input->post('subname');
            $url              = $this->input->post('url');
            $id_perkara       = $this->input->post('id_perkara');

            $data       = [
                'name'             => $name,
                'subname'         => $subname,
                'url'            => $url,
                'id_perkara'     => $id_perkara,
            ];

            $added =  $this->db->insert('db_syarat', $data);
            if ($added) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">New Syarat ADDED!</div>');
                $url = "https://app.ms-lhokseumawe.go.id/informasi/persyaratan/$id_perkara";
                header("Location: $url");
                // redirect('informasi/perkara');
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function editsyarat()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == true) {
            $name             = $this->input->post('name');
            $subname          = $this->input->post('subname');
            $url              = $this->input->post('url');
            $id_perkara       = $this->input->post('id_perkara');
            $id               = $this->input->post('id');

            $data       = [
                'name'             => $name,
                'subname'         => $subname,
                'url'            => $url,
                'id_perkara'     => $id_perkara,
            ];

            $this->db->set('name', $name);
            $this->db->set('subname', $subname);
            $this->db->set('url', $url);
            $this->db->where('id', $id);

            $added = $this->db->update('db_syarat');

            if ($added) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" 
						role="alert">Syarat Berhasil Dirubah!</div>');

                $url = "https://app.ms-lhokseumawe.go.id/informasi/persyaratan/$id";
                header("Location: $url");
                // redirect('informasi/persyaratan/');
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function deletesy($id)
    {
        $options         = array('id' => $id);
        $idbank          = $this->db->get_where('db_syarat', $options)->row_array();
        $namabank        = $idbank['id_perkara'];

        $this->db->delete('db_syarat', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Syarat Sudah Dihapus.!</div>');
        $url = "https://app.ms-lhokseumawe.go.id/informasi/persyaratan/$namabank";
        header("Location: $url");
    }

    // //     public function wapp($id)
    // //     {
    // //         $user       = $this->db->get_where('tb_kritik', ['id' => $id])->row_array();
    // // 		$name       = $user['nama'];
    // // 		$layanan    = $user['layanan'];
    // // 		$pesan      = $user['pesan'];

    // // // 		$tiny       = "https://wa.me/6281392827658?text=[*Information%20by%20Sistem%20KRITIS*]%0A%0AKritik%20Saran%20Otomatis%0ANama%20:%20*$name*%0ALayanan%20:%20*$layanan*%0APesan%20:%20*$pesan*%0A%0A[*End%20Of%20Information*]%20%0A%0APesan%20Dikirim%20Melalui%20Sistem%20app.ms-lhokseumawe.go.id%20";
    // // 		$tin       = "https://wa.me/6281392827658?text=[*Information%20by%20Sistem%20KRITIS*]%0A%0AKritik%20Saran%20Otomatis%0ANama%20:%20*$name*%0ALayanan%20:%20*$layanan*%0APesan%20:%20*$pesan*%0A%0A[*End%20Of%20Information*]%20%0A%0APesan%20Dikirim%20Melalui%20Sistem%20KRITIS%20";
    // // 				header("Location: $tin");
    // //     }

    //     public function WA($id)
    //     {
    //         $user       = $this->db->get_where('tb_kritik', ['id' => $id])->row_array();
    // 		$name       = $user['nama'];
    // 		$layanan    = $user['layanan'];
    // 		$pesan      = $user['pesan'];

    // // 		$link       = "https://wa.me/6285372002222?text=";
    // 		$URL       = "https://wa.me/6285372002222?text=[*Information%20by%20Sistem%20KRITIS*]%0A%0AKritik%20Saran%20Otomatis%0ANama%20:%20*$name*%0ALayanan%20:%20*$layanan*%0APesan%20:%20*$pesan*%0A%0A[*End%20Of%20Information*]%20%0A%0APesan%20Dikirim%20Melalui%20Sistem%20KRITIS%20";
    // 		header("Location: $URL");
    //     }

    public function kir($id)
    {
        $user       = $this->db->get_where('tb_kritik', ['id' => $id])->row_array();
        $name       = $user['nama'];
        $layanan    = $user['layanan'];
        $messs      = $user['pesan'];


        $link       = "https://api.whatsapp.com/send/?phone=6285372002222&text=%5B%2AInformation+by+KRITIS%2A%5D%0A%0ANama+%3A+%2A$name%2A%0ALayanan+%3A+%2A$layanan%2A%0A&type=phone_number&app_absent=0";
        header("Location: $link");
    }

    public function kimi($id)
    {
        $user       = $this->db->get_where('tb_kritik', ['id' => $id])->row_array();
        $name       = $user['nama'];
        $layanan    = $user['layanan'];
        $messs      = $user['pesan'];


        $link       = "https://api.whatsapp.com/send/?phone=6281392827658&text=%5B%2AInformation+by+KRITIS%2A%5D%0A%0ANama+%3A+%2A$name%2A%0ALayanan+%3A+%2A$layanan%2A%0A&type=phone_number&app_absent=0";
        header("Location: $link");
    }
}
