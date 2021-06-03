<?php
    @include '../../../config/config.php';
    @include '../../../administrator/doc/fpdf/writehtml.php';
    @include '../../../controller/teachers/Class_aksi_guru.php';
    @include '../../../administrator/php/setDocs.php';
    @include '../../../controller/students/GradeQuiz.php';


    if(isset($_GET['key'])&&isset($_GET['class_code'])&&isset($_GET['det_kls'])){

        $setDocs = new setDocs;
        $objek_aksi_guru = new peserta_join;
        $grade_quiz = new HasilQuiz;

        $Header_arr = $setDocs->ViewDataDokumen($host);
        $Tb_App = $setDocs->ViewTbAplikasi($host);

        $key = $_GET['key'];
        $class_code = $_GET['class_code'];
        $iden = $_GET['det_kls'];

        $Nama_guru_arr = $grade_quiz->Author($host, $key);

        foreach($Header_arr as $view){

            $nama_institusi = $view['nama_perusahaan'];
            $alamat = $view['alamat'];
            $kontak = $view['kontak'];
    
        }
    
        foreach ($Tb_App as $app_view){
    
            $logo = $app_view['logo'];
    
        }


        if($objek_aksi_guru->jmlh_siswa_join_per_kls($host, $class_code) == 0){

            echo "Belum ada siswa yang bergabung di kelas ini :)";

        }else{


            $pdf = new PDF_HTML('P','mm','A4');//P atau L = orientasi kertas, mm = ukuran, A4 = jenis kertas

            $pdf->AddPage();
            $pdf->AliasNbPages();
            $pdf->SetFont('Arial','B',14);//Arial = jenis huruf, B = format huruf, 10 = ukuran
            //$pdf->Cell(40,10,'',1);//40 = panjang, 10 = tinggi, 1 = tingkat ketebalan garis
        
            $pdf->Image('../img/'.$logo , 10, 8, 21);
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
        
            $pdf->Cell(180, 0, "Data Siswa Kelas ".$setDocs->getKelas($host, $class_code), 0, 0, 'C');
        
            $pdf->Ln(7);//Ln = pindah baris
    
            $pdf->Cell(20,10,'No','1');
            $pdf->Cell(57,10,'Nama Depan','1');
            $pdf->Cell(57,10,'Nama Belakang','1');
            $pdf->Cell(57,10,'Email aktif','1');
    
            //pindah baris
            $pdf->Ln(10);
    
    
            $no=1;
            $view_siswa_join = $objek_aksi_guru->tampil_siswa_join_per_kls($host, $class_code);
            foreach ($view_siswa_join as $view_siswa){
    
                $pdf->Cell(20,10, $no, 1);
                $pdf->Cell(57,10, $view_siswa['first_name'],1);
                $pdf->Cell(57,10, $view_siswa['last_name'],1);
                $pdf->Cell(57,10, $view_siswa['email'],1);

                $pdf->Ln(10);
                $no++;
    
            }
    
            //cetak
            $pdf->Output();
        }


    }else{

        echo "<h1>Directory access forhibidden</h1>";

    }
?>