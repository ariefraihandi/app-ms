<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kesekretariatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Pegawai_model');
        // $this->load->model('Disabilitas_model');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $a_date = $bulan[date('m')];
        $lastdate = date("Y-m-t", strtotime($a_date));

        $data['title']      = 'Dashboard Informasi';
        $data['view']       = 'Konten/sekret_index';
        $data['hakim']      = $this->Pegawai_model->hakim();
        $data['pegawai']    = $this->Pegawai_model->pegawai();
        $data['cpns']       = $this->Pegawai_model->cpns();
        $data['ppnpn']      = $this->Pegawai_model->ppnpn();


        $data['awal']       = $a_date;
        $data['akhir']      = $lastdate;
        $data['akhir']      = $lastdate;
        $data['user']       = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['undersub']   = $this->db->get_where('user_under_sub_menu')->result_array();


        $this->load->view('Index/adminheader', $data);
        $this->load->view('index', $data);



        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == true) {
            $name            = $this->input->post('name');
            $whatsapp        = $this->input->post('whatsapp');
            $tgl             = $this->input->post('tgl');
            $kelamin         = $this->input->post('kelamin');
            $pekerjaan       = $this->input->post('pekerjaan');
            $alamat          = $this->input->post('alamat');
            $informasi       = $this->input->post('informasi');
            $tujuan          = $this->input->post('tujuan');

            $data       = [
                'name'          => $name,
                'whatsapp'      => $whatsapp,
                'tanggal'       => $tgl,
                'kelamin'       => $kelamin,
                'pekerjaan'     => $pekerjaan,
                'tujuan'        => $tujuan,
                'alamat'        => $alamat,
                'informasi'     => $informasi,
                'date_created'  =>  time()
            ];

            $added =  $this->db->insert('db_info', $data);
            if ($added) {
                redirect('informasi/index');
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function informasi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $a_date = $bulan[date('m')];
        $lastdate = date("Y-m-t", strtotime($a_date));

        $data['title']      = 'Dashboard Informasi';
        $data['awal']       = $a_date;
        $data['view']      = 'Konten/admin_index';
        $data['akhir']      = $lastdate;
        $data['user']       = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['undersub']   = $this->db->get_where('user_under_sub_menu')->result_array();
        // $data['kerja']      = $this->db->get('tb_pekerjaan')->result_array();
        // $data['kelamin']    = $this->db->get('tb_kelamin')->result_array();
        // $data['informasi']  = $this->db->get('jenis_perkara')->result_array();
        // $data['ikms']       = $this->Info_model->getInfoBul();

        $this->load->view('Index/adminheader', $data);
        $this->load->view('index', $data);


        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == true) {
            $name            = $this->input->post('name');
            $whatsapp        = $this->input->post('whatsapp');
            $tgl             = $this->input->post('tgl');
            $kelamin         = $this->input->post('kelamin');
            $pekerjaan       = $this->input->post('pekerjaan');
            $alamat          = $this->input->post('alamat');
            $informasi       = $this->input->post('informasi');
            $tujuan          = $this->input->post('tujuan');

            $data       = [
                'name'          => $name,
                'whatsapp'      => $whatsapp,
                'tanggal'       => $tgl,
                'kelamin'       => $kelamin,
                'pekerjaan'     => $pekerjaan,
                'tujuan'        => $tujuan,
                'alamat'        => $alamat,
                'informasi'     => $informasi,
                'date_created'  =>  time()
            ];

            $added =  $this->db->insert('db_info', $data);
            if ($added) {
                redirect('informasi/index');
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function disabilitas()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $a_date = $bulan[date('m')];
        $lastdate = date("Y-m-t", strtotime($a_date));

        $data['title']      = 'Dashboard Disabilitas';
        $data['awal']       = $a_date;
        $data['akhir']      = $lastdate;
        $data['user']       = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['kerja']      = $this->db->get('tb_pekerjaan')->result_array();
        $data['kelamin']    = $this->db->get('tb_kelamin')->result_array();
        $data['informasi']  = $this->db->get('jenis_perkara')->result_array();
        $data['ikms']       = $this->Disabilitas_model->getDisaBul();

        $this->load->view('Index/adminheader', $data);
        $this->load->view('Informasi/disa', $data);


        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == true) {
            $name            = $this->input->post('name');
            $whatsapp        = $this->input->post('whatsapp');
            $tgl             = $this->input->post('tgl');
            $kelamin         = $this->input->post('kelamin');
            $pekerjaan       = $this->input->post('pekerjaan');
            $alamat          = $this->input->post('alamat');
            $informasi       = $this->input->post('informasi');
            $tujuan          = $this->input->post('tujuan');

            $data       = [
                'name'          => $name,
                'whatsapp'      => $whatsapp,
                'tanggal'       => $tgl,
                'kelamin'       => $kelamin,
                'pekerjaan'     => $pekerjaan,
                'tujuan'        => $tujuan,
                'alamat'        => $alamat,
                'informasi'     => $informasi,
                'date_created'  =>  time()
            ];

            $added =  $this->db->insert('db_info', $data);
            if ($added) {
                redirect('informasi/index');
            } else {
                redirect('Pelayanan/thanks');
            }
        }
    }

    public function kirim($id)
    {
        $user       = $this->db->get_where('db_disabilitas', ['id' => $id])->row_array();
        $tanggal    = $user['tgl'];
        $jam        = $user['timepicker'];
        $name       = $user['name'];
        $kelamin    = $user['kelamin'];
        $umur       = $user['umur'];
        $umursatu   = $user['umursatu'];
        $satus      = $user['status'];
        $alamat     = $user['alamat'];
        $domisili   = $user['alamatsatu'];
        $layanan    = $user['layanan'];
        $empatbelas = $user['empatbelas'];
        $link       = "https://wa.me/628116944334?text=[*Information%20by%20Sistem*]%0A%0APengunjung%20Disabilitas%20Tanggal%20*$tanggal*,%20Pukul%20*$jam*.%0ANama%20:%20*$name*%0AJenis%20Kelamin%20:%20*$kelamin*%0AUmur%20:%20*$umur*%0AUmur%20Mental%20:%20*$umursatu*%0AStatus%20:%20*$satus*%0AAlamat%20:%20*$alamat*%0AAlamat%20Domisili%20:%20*$domisili*%0ALayanan%20:%20*$layanan*%0AKebutuhan%20:%20*$empatbelas*%0A%0APesan%20Dikirim%20Melalui%20Sistem%20app.ms-lhokseumawe.go.id%20";
        // 		$url        = "https://wa.me/$wa?text=Assalamualaikum%20$panggil%20*$nama*,%0ATerimakasih%20sudah%20berkunjung%20ke%20*Mahakamah%20Syar'iyah%20Lhokseumawe*.%0ADemi%20meningkatkan%20*Mutu%20Pelayanan*%20Kami%20dan%20*Menekan%20Angka%20Korupsi*,%20mohon%20$panggil%20mengisi%20survey%20*Index%20Kepuasan%20Masyarakat%20dan%20Index%20Persepsi%20Korupsi*%20melalui%20link%20Berikut.%0A*$link*%0ATerimakasih%20";
        header("Location: $link");
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

                $url = "https://app.ms-lhokseumawe.go.id/informasi/persyaratan/$id_perkara";
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
        $pesan          = preg_replace('/\s+/', '+', $messs);

        $link       = "https://api.whatsapp.com/send/?phone=6285372002222&text=%5B%2AInformation+by+KRITIS%2A%5D%0A%0ANama+%3A+%2A$name%2A%0ALayanan+%3A+%2A$layanan%2A%0APesan+%3A+%2A$pesan%2A%0A&type=phone_number&app_absent=0";
        header("Location: $link");
    }

    public function kimi($id)
    {
        $user       = $this->db->get_where('tb_kritik', ['id' => $id])->row_array();
        $name       = $user['nama'];
        $layanan    = $user['layanan'];
        $messs      = $user['pesan'];
        $pesan      = preg_replace('/\s+/', '+', $messs);

        $link       = "https://api.whatsapp.com/send/?phone=6281392827658&text=%5B%2AInformation+by+KRITIS%2A%5D%0A%0ANama+%3A+%2A$name%2A%0ALayanan+%3A+%2A$layanan%2A%0APesan+%3A+%2A$pesan%2A%0A&type=phone_number&app_absent=0";
        header("Location: $link");
    }
}
