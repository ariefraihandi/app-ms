<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $url = $this->session->flashdata('url');
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title']    = 'Login';
            $data['url']    = $url;
            $data['view']      = 'Konten/index_auth';
            $this->load->view('Index/adminheader', $data);
            $this->load->view('main', $data);
        } else {
            // validasi
            $this->_login();
        }
    }


    private function _login()
    {

        $username    = $this->input->post('username');
        $password    = $this->input->post('password');
        $url         = $this->input->post('url');

        $user        = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    // $rul = $user['role_id'];
                    // echo $rul;
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                    ];
                    $this->session->set_userdata($data);
                    if (!empty($url)) {
                        header("Location: $url");
                    } else {
                        if ($user['role_id'] == 1) {
                            redirect('http://localhost/app/admin');
                        }
                        if ($user['role_id'] == 2) {
                            redirect('informasi');
                        }
                        if ($user['role_id'] == 3) {
                            redirect('pendaftaran');
                        }
                        if ($user['role_id'] == 4) {
                            redirect('absensi');
                        }
                        if ($user['role_id'] == 5) {
                            redirect('absensi');
                        }
                        if ($user['role_id'] == 6) {
                            redirect('absensi');
                        }
                        if ($user['role_id'] == 7) {
                            redirect('absensi');
                        }
                        if ($user['role_id'] == 8) {
                            redirect('user');
                        }
                        if ($user['role_id'] == 9) {
                            redirect('admin');
                        }
                        if ($user['role_id'] == 10) {
                            redirect('absensi');
                        }
                        if ($user['role_id'] == 12) {
                            redirect('kepegawaian');
                        }
                        if ($user['role_id'] == 13) {
                            redirect('produk');
                        }
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" 
						role="alert">Username Atau Password Salah. Coba Lagi Atau Klik Lupa Password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
					role="alert">Wow! Akun anda belum aktif. Mohon Aktifkan!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
			role="alert">Wow! Akun anda belum terdaftar. Mohon Buat Akun</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username has already registered BOSS!',
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email has already registered BOSS!',
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match BOSS!',
            'min_length' => 'Password too short BOSS!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['title']    = 'Registration';

            $this->load->view('Index/adminheader', $data);
            $this->load->view('Login/registration');
            $this->load->view('Index/adminscript');
        } else {
            $email = $this->input->post('email');
            $data = [
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'kelamin'       => $this->input->post('kelamin'),
                'username'      => htmlspecialchars($this->input->post('username', true)),
                'email'         => htmlspecialchars($this->input->post('email', true)),
                'image'         => 'bm.png',
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'       =>  3,
                'is_active'     =>  0,
                'desc'          =>  'Saya Orang Baik :)',
                'igusername'    =>  'username',
                'fbusername'    =>  'username',
                'twusername'    =>  'username',
                'date_created'  =>  time()

            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Activate Your Account</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $this->load->library('email');
        $data = [
            'name'         => $this->input->post('name'),
            'email'     => $this->input->post('email'),
            'token'        => $token,
        ];

        $config = [
            'protocol'     => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'bossmakalah@gmail.com', // change it to yours
            'smtp_pass' => 'aspldbefixzkcqcj', // change it to yours
            'mailtype'     => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n"
        ];
        $mesg = $this->load->view('Email/verify.php', $data, true);

        $this->email->initialize($config);

        $this->email->from('admin@bossmakalah.com', 'Verify Boss Makalah');
        $this->email->to($this->input->post('email'));
        if ($type == 'verify') {
            $this->email->subject('Accout Verification');

            $this->email->message($mesg);
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user    = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been Activated. Please Login</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token Invalid!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Email!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message_logout', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }

    public function registermagang()
    {
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $data['title']    = 'Registrasi Mahasiswa Magang';

        $this->load->view('Index/adminheader', $data);
        $this->load->view('Login/magang');
        $this->load->view('Index/adminscript');

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == true) {
            $data = [
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'username'      => $this->input->post('username'),
                'email'         => $this->input->post('email'),
                'image'         => 'default.png',
                'umur'          => 'default',
                'whatsapp'      => $this->input->post('whatsapp'),
                'kode_pegawai'  => $this->input->post('nim'),
                'instansi'      => $this->input->post('universitas'),
                'jabatan'       => 'Magang',
                'tempat_lahir'  => 'default',
                'tgl_lahir'     => 'default',
                'jenis_kelamin' => $this->input->post('kelamin'),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'       => 11,
                'is_active'     => 0,
                'desc'          => 'Saya Orang Baik :)',
                'fakultas'      => $this->input->post('fakultas'),
                'jurusan'       => $this->input->post('jurusan'),
                'igusername'    => $this->input->post('igusername'),
                'fbusername'    => 'username',
                'twusername'    => 'username',
                'date_created'  => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                    role="alert">New Pegawai ADDED!</div>');
            redirect('auth');
        }
    }

    public function blocked()
    {

        $data['title']    = 'Access Blocked !!';

        $this->load->view('Index/header', $data);
        $this->load->view('auth/blocked');
        $this->load->view('Index/script');
    }
}
