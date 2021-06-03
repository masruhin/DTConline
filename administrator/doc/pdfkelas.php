<?php
    @include '../../config/config.php';
    @include '../php/setDocs.php';
    @include './fpdf/writehtml.php';
    @include '../php/dataKelas.php';
    @include '../php/dashboard.php';

    $setDocs = new setDocs;
    $dataKelas = new dataKelas;
    $dashboard = new dashboard;

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

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(1, 0, 0);
    //Document Body

    $pdf->Ln(5);//Ln = pindah baris

    $pdf->Cell(180, 0, "DATA KELAS AKTIF", 0, 0, 'C');

    $pdf->Ln(7);//Ln = pindah baris

    if($dataKelas->JumlahKelas($host) == 0){

        $pdf->WriteHTML("Data Kelas Kosong");

    }else{

        $pdf->SetFont('Arial','B',11);

        $pdf->Cell(20,10,'No','1');
        $pdf->Cell(70,10,'Nama Kelas','1');
        $pdf->Cell(70,10,'Wali Kelas/Author','1');
        $pdf->Cell(35,10,'Total Siswa','1');

        $pdf->SetFont('Arial', '', 11);

        $no = 1;

        //pindah baris
        $pdf->Ln(10);

        $DataKelasArr = $dataKelas->ShowKelas($host);
        foreach ($DataKelasArr as $view):

            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(20,10, $no, 1);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(70,10, substr($view['nama_kelas'], 0, 30) ,1);
            $pdf->Cell(70,10, substr($view['first_name']." ".$view['last_name'], 0, 30) ,1);
            $pdf->Cell(35, 10, $dataKelas->JumlahSiswaJoinKelas($host, $view['kode_kelas'])." Siswa" ,1);


            $pdf->Ln(10);
            $no++;

        endforeach;

    }

    $pdf->Output();

?>