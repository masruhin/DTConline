<?php
    @include '../../config/config.php';
    @include '../php/setDocs.php';
    @include './fpdf/writehtml.php';

    $setDocs = new setDocs;
    $Header_arr = $setDocs->ViewDataDokumen($host);
    $Tb_App = $setDocs->ViewTbAplikasi($host);

    foreach($Header_arr as $view){

        $nama_institusi = $view['nama_perusahaan'];
        $alamat = $view['alamat'];
        $kontak = $view['kontak'];

    }

    foreach ($Tb_App as $app_view){

        $logo = $app_view['logo'];

    }

    $pdf=new PDF_HTML('p', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',14);//Arial = jenis huruf, B = format huruf, 10 = ukuran
    //$pdf->Cell(40,10,'',1);//40 = panjang, 10 = tinggi, 1 = tingkat ketebalan garis

    $pdf->Image('../../dist/assets/img/'.$logo , 10, 8, 21);
    $pdf->Cell(180,0, $nama_institusi,0,0,'C'); 
    $pdf->Ln(8);//Ln = pindah baris
    $pdf->SetFont('');

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(190,0, $alamat,4,4,'C'); 
    $pdf->Ln(7);//Ln = pindah baris

    $pdf->SetTextColor(50, 156, 253);

    $pdf->Cell(190,0, $kontak,4,4,'C'); 
    $pdf->Ln(5);//Ln = pindah baris
    $pdf->WriteHTML("<hr>");
    $pdf->Output();

?>