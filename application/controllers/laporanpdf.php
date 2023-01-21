<?php
class Laporanpdf extends CI_Controller
{

    // function __construct()
    // {
    //     parent::__construct();
    //     $this->load->library('pdf');
    // }

    public function pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('laporan_pdf', [], true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
        //$mpdf->Output('invoice.pdf','Dt will work as normal download
    }
}
