
<?php

ob_start();
$pdf = new Pdf('P', 'cm', 'A4', true);
$pdf->SetTitle($title);
$pdf->SetTopMargin(2);
$pdf->setFooterMargin(2);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set font
$pdf->SetFont('times', '', 12, '', true);

$pdf->SetAuthor('Ruhul Islam Anak Bangsa');

$pdf->AddPage();
$header = '<p><img src="vendor/assets/img/kop/kop-surat.png"></img></p>';
$pdf->writeHTML($header, true, false, false, false, '');
$body = '
    
    <table  width="100%" style="padding-left:10px;">
        <tr>
            <td colspan="2" style="text-align: center;"><h2><u>EVIDEN TEMUAN PENGAWASAN BIDANG</u></h2></td>
        </tr>
        <br>
        <tr>
            <td width="160">Nama Hakim</td>
            <td>: '.$data['nama'].'</td>
        </tr>
    </table>

    <table style="padding-left:10px;">
        <tr>
            <td width="290"></td>
            <td>Lhokseumawe, '.date_indo(date("Y-m-d")).'</td>
        </tr>
        <tr>
            <td width="290"></td>
            <td>Hakim Pegawas Bidang Mahkamah Syar’iyah </td>
        </tr>
        <br/>
        <br/>
        <br/>
        <br/>
        <tr>
            <td width="290"></td>
            <td><b>Wafa’, S.Hi., M.H</b></td>
        </tr>
    </table>

';
$pdf->writeHTML($body, true, false, true, false, '');
$pdf->endPage();

$pdf->Output('PSB-RIAB.pdf', 'I');
exit();
?>