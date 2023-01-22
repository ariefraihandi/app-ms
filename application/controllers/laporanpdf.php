<?php
class Laporanpdf extends CI_Controller
{

    public function index() {
        $this->load->library('pdf');
        $data = [
            'title' => 'Test',
            'data'  => [
                'nama'  => 'Arief',
            ],
        ];
        $this->load->view('testpdf', $data);
    }
}
