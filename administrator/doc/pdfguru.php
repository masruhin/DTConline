<?php
    @include '../../config/config.php';
    @include '../php/setDocs.php';
    @include './fpdf/writehtml.php';
    @include '../php/dataGuru.php';
    @include '../php/dashboard.php';

    $setDocs = new setDocs;
    $dataGuru = new dataGuru;
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

    $pdf->Cell(180, 0, "AKUN GURU AKTIF", 0, 0, 'C');

    $pdf->Ln(7);//Ln = pindah baris

    if($dashboard->TotalUserGuru($host) == 0){

        $pdf->WriteHTML("Data Guru Kosong");

    }else{

        $pdf->SetFont('Arial','B',11);

        $pdf->Cell(20,10,'No','1');
        $pdf->Cell(42,10,'Nama','1');
        $pdf->Cell(59,10,'Email Aktif','1');
        $pdf->Cell(35,10,'No Hp','1');
        $pdf->Cell(33,10,'Kelas Diampu','1');

        $pdf->SetFont('Arial', '', 11);

        $no = 1;

        //pindah baris
        $pdf->Ln(10);

        $DataguruArr = $dataGuru->ViewDataInTable($host);
        foreach ($DataguruArr as $view):

            $pdf->SetFont('Arial','B',11);
            $pdf->Cell(20,10, $no, 1);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(42,10, substr($view['first_name']." ". $view['last_name'], 0, 20) ,1);
            $pdf->Cell(59,10, substr($view['email'], 0, 28),1);

            if($view['nohp_guru'] == NULL){

                $pdf->Cell(35, 10, "Belum Ada", 1);

            }else{

                $pdf->Cell(35,10, $view['nohp_guru'],1);

            }

            if($dataGuru->TotalKelas($host, $view['email']) == 0){

                $pdf->Cell(33, 10, "Belum Ada", 1);

            }else{

                $pdf->Cell(33, 10, $dataGuru->TotalKelas($host, $view['email'])." Kelas" ,1);

            }

            $pdf->Ln(10);
            $no++;

        endforeach;

    }

    $pdf->Output();

?>