<?php
    @include '../../../administrator/doc/fpdf/writehtml.php';
    @include '../../../config/config.php';
    @include '../../../controller/students/GradeQuiz.php';
    @include '../../../administrator/php/setDocs.php';

    if(isset($_GET['id_quiz']) && isset($_GET['key'])){
        $grade_quiz = new HasilQuiz;
        $setDocs = new setDocs;

        $Header_arr = $setDocs->ViewDataDokumen($host);
        $Tb_App = $setDocs->ViewTbAplikasi($host);
        
        $id_quiz = $_GET['id_quiz'];
        $key = $_GET['key'];

        $Nama_guru_arr = $grade_quiz->Author($host, $key);

        foreach($Header_arr as $view){

            $nama_institusi = $view['nama_perusahaan'];
            $alamat = $view['alamat'];
            $kontak = $view['kontak'];
    
        }
    
        foreach ($Tb_App as $app_view){
    
            $logo = $app_view['logo'];
    
        }

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

        $pdf->Cell(180, 0, $grade_quiz->Namaquiz($host, $id_quiz), 4, 4, 'C');
        $pdf->Ln(7);
        $pdf->Cell(180,0,$Nama_guru_arr[0]." ".$Nama_guru_arr[1],4,4,'C'); 
        $pdf->Ln(10);//Ln = pindah baris

        $pdf->Cell(20,10,'Rank','1');
        $pdf->Cell(50,10,'Nama','1');
        $pdf->Cell(30,10,'Jumlah benar','1');
        $pdf->Cell(30,10,'Jumlah salah','1');
        $pdf->Cell(30,10,'Jumlah kosong','1');
        $pdf->Cell(30,10,'Nilai akhir','1');

        //pindah baris
        $pdf->Ln(10);

        $no = 1;

        $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz WHERE id_quiz='$id_quiz' ORDER BY nilai DESC"); 

        while($data = mysqli_fetch_array($sql)){
            $Nama_siswa_Arr = $grade_quiz->tampil_nama_siswa($host, $data['id_join']);

            $pdf->Cell(20,10, $no, 1);
            $pdf->Cell(50,10, $Nama_siswa_Arr[0]." ".$Nama_siswa_Arr[1] ,1);
            $pdf->Cell(30,10, $data['jwb_benar'],1);
            $pdf->Cell(30,10, $data['jwb_salah'],1);
            $pdf->Cell(30,10, $data['kosong'],1);
            $pdf->Cell(30,10, $data['nilai'],1);

            $pdf->Ln(10);
            $no++;

        }



        //cetak
        $pdf->Output();
?>


<?php }else{
    echo "<h1>Directory access forhibidden</h1>";
} ?>