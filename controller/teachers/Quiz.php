<?php
    @include '../../config/config.php';
    @include '../../src/spreadsheet-reader-master/excel_reader2.php';

    class import_excle{

        public function import_pilihanganda($host, $id_quiz){

            //make objek control quiz to get id soal
            $quizControl = new Control_quiz;

            $target = basename($_FILES['file_upload']['name']);
            move_uploaded_file($_FILES['file_upload']['tmp_name'], $target);

            $data = new Spreadsheet_Excel_Reader($_FILES['file_upload']['name'], false);

            $baris = $data->rowcount($sheet_index=0);

            for($i=2; $i<=$baris; $i++){

                $isi_soal = $data->val($i, 1);
                $jwb_a    = $data->val($i, 2);
                $jwb_b    = $data->val($i, 3);
                $jwb_c    = $data->val($i, 4);
                $jwb_d    = $data->val($i, 5);
                $jwb_e    = $data->val($i, 6);

                $jawaban  = $data->val($i, 6);

                $id_soal = $quizControl->acak_id(30);

                if($isi_soal != NULL && $jwb_a != NULL && $jwb_b != NULL && $jwb_c != NULL && $jwb_d != NULL && $jawaban != NULL && $jwb_e != NULL){
                    $query = mysqli_query($host, "INSERT INTO soal (isi_soal, pil_a, pil_b, pil_c, pil_d, jawaban, id_soal, quiz_id, pil_e) VALUES ('$isi_soal', '$jwb_a', '$jwb_b', '$jwb_c', '$jwb_d', '$jawaban', '$id_soal', '$id_quiz', '$jwb_e')");
                }

            }

            unlink($_FILES['file_upload']['name']);

            if($query){

                return true;

            }else{

                return false;

            }

        }

        public function import_essay($host, $id_quiz){

            //make objek control quiz to get id soal
            $quizControl = new Control_quiz;

            $target = basename($_FILES['file_upload']['name']);
            move_uploaded_file($_FILES['file_upload']['tmp_name'], $target);

            $data = new Spreadsheet_Excel_Reader($_FILES['file_upload']['name'], false);

            $baris = $data->rowcount($sheet_index=0);

            for($i=2; $i<=$baris; $i++){

                $isi_soal = $data->val($i, 1);
                $jawaban  = $data->val($i, 2);

                $id_soal = $quizControl->acak_id(30);

                if($isi_soal != NULL && $jawaban != NULL ){
                    $query = mysqli_query($host, "INSERT INTO soal (isi_soal, jawaban, id_soal, quiz_id) VALUES ('$isi_soal', '$jawaban', '$id_soal', '$id_quiz')");
                }

            }

            if($query){

                return true;

            }else{

                return false;

            }

        }

        public function cek_ekstensi_xls(){

            $type_file = explode(".", $_FILES['file_upload']['name']);

            if(strtolower(end($type_file)) != 'xls'){

                return "ekstensi_salah";

            }else{

                return "ekstensi_benar";

            }

        }

    }

    class Quiz_Layout{

        public function get_All_id_soal($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM soal WHERE quiz_id = '$id_quiz'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function get_titlequiz($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM identitas_quiz WHERE id_quiz='$id_quiz'");

            while($row=mysqli_fetch_array($sql)){

                $rows[]=$row;

            }

            return $rows;

        }

        public function get_namesession($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM sesi_kelas LEFT JOIN identitas_quiz ON sesi_kelas.id_sesi = identitas_quiz.id_sesi_kls WHERE id_quiz = '$id_quiz'");

            while($row=mysqli_fetch_array($sql)){
                $rows[]=$row;
            }
            return $rows;
        }

        public function status_quiz($tgl_selesai_quiz, $waktu_selesai_quiz){

            date_default_timezone_set('Asia/Jakarta');

            $selesai_quiztgl = (string)$tgl_selesai_quiz;
            $selesai_quizwaktu = (string)$waktu_selesai_quiz;

            $expired = "$selesai_quizwaktu $selesai_quiztgl";

            $date_deadline = new DateTime($expired);
            $date_now = new DateTime();

            if($date_now < $date_deadline){

                return "Quiz open";

            }else{

                return "Quiz ditutup";

            }

        }

        public function status_quiz_sebelum_buka($tgl_buka_quiz, $waktu_buka_quiz){

            date_default_timezone_set('Asia/Jakarta');

            $mulai_quiztgl = (string)$tgl_buka_quiz;
            $mulai_quizwaktu = (string)$waktu_buka_quiz;

            $expired = "$mulai_quizwaktu $mulai_quiztgl";

            $date_mulai = new DateTime($expired);
            $date_now = new DateTime();

            if($date_now < $date_mulai){

                return "belum buka";

            }else{

                return "quiz buka";

            }

        }



        public function cek_gambar($host, $soal_id){

            $sql = mysqli_query($host, "SELECT *FROM file_soal WHERE soal_id='$soal_id'");
            $count = mysqli_num_rows($sql);
            return $count;
        }

        public function tampilgambar($host, $soal_id){

            $sql=mysqli_query($host, "SELECT * FROM file_soal WHERE soal_id='$soal_id'");
            while($row=mysqli_fetch_array($sql)){
                $rows[]=$row;
            }
            return $rows;
        }

        public function tampilquiz_pilgan($host, $id_quiz){

            $sql = mysqli_query($host,  "SELECT *FROM soal WHERE quiz_id='$id_quiz' AND pil_a IS NOT NULL ORDER BY nomor ASC");

            while($row = mysqli_fetch_array($sql)){
                $rows[] = $row;
            }

            return $rows;

        }

        public function tampilquiz_essay($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM soal WHERE quiz_id='$id_quiz' AND pil_a IS NULL ORDER BY nomor ASC");

            while($row = mysqli_fetch_array($sql)){
                $rows[]=$row;
            }

            return $rows;

        }

        public function pilgan_count($host, $id_quiz){
            $sql = mysqli_query($host,  "SELECT *FROM soal WHERE quiz_id='$id_quiz' AND pil_a IS NOT NULL");
            $count = mysqli_num_rows($sql);
            return $count;
        }

        public function essay_count($host, $id_quiz){
            $sql = mysqli_query($host, "SELECT *FROM soal WHERE quiz_id='$id_quiz' AND pil_a IS NULL");
            $count = mysqli_num_rows($sql);
            return $count;
        }

        public function totalsoal($host, $id_quiz){
            $pilgan = $this->pilgan_count($host, $id_quiz);
            $essay = $this->essay_count($host, $id_quiz);
            $count = $pilgan + $essay;
            return $count." numbers";
        }

        public function Soaltotal($host, $id_quiz){
            $pilgan_soal = $this->pilgan_count($host, $id_quiz);
            $essay_soal = $this->essay_count($host, $id_quiz);
            $count = $pilgan_soal+$essay_soal;
            return $count;
        }

    }
    
    class Control_quiz{

        public function acak_id($length) {
            $str        = "";
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz12345678xsdfwQWKJ00HVcMSMSNMSj9Xc';
            $max        = strlen($characters) - 1;

            for ($i = 0; $i < $length; $i++) {

                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];

            }

            return $str;
        }

        public function cek_ekstensi(){

            $lolos = 0;
            $gagal = 0;

            $allowed = array("png","jpg");

            $total_upload = count($_FILES['data_file']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $cek_ekstensi = pathinfo($_FILES['data_file']['name'][$i]);

                if(in_array($cek_ekstensi['extension'], $allowed)){

                    $lolos = $lolos + 1;
                   
                }else{

                    $gagal = $gagal + 1;

                }
            }

            if($total_upload == $lolos) {

                return true;
            
            }else{
                
                return false;
            
            }


        }

        public function insert_file($host, $soal_id){

            //nama direktori
            $nama_direktori = "../../dist/assets/file_quiz/";

            $total_upload = count($_FILES['data_file']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $nama_file = $_FILES['data_file']['name'][$i];
                $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);

                //path direktori
                $path_file = $nama_direktori . $nama_file;
                    if(move_uploaded_file($_FILES['data_file']['tmp_name'][$i], $path_file)) {

                        $mysql = mysqli_query($host, "INSERT INTO file_soal (nama_filesoal, soal_id, ekstensi) VALUES ('$nama_file', '$soal_id', '$ekstensi')");
    
    
                    }else{
    
                        echo "file, ada sesuatu yg salah";
    
                    }

                }

            if($mysql){

                return true;

            }else{

                echo "kesalahan saat upload file";

            }

        }

        

        public function insert_soal_pilganda($host, $id_quiz){

            $isi_soal = $_POST['pertanyaan_pilgan'];
            $pil_a = $_POST['pilihan_a'];
            $pil_b = $_POST['pilihan_b'];
            $pil_c = $_POST['pilihan_c'];
            $pil_d = $_POST['pilihan_d'];
            $pil_e = $_POST['pilihan_e'];
            $jawaban = $_POST['jwb_true'];

            //id soal
            $id_soal = $this->acak_id(30);

            $sql = mysqli_query($host, "INSERT INTO soal (isi_soal, pil_a, pil_b, pil_c, pil_d, jawaban, quiz_id, id_soal, pil_e) VALUES ('$isi_soal', '$pil_a', '$pil_b', '$pil_c', '$pil_d', '$jawaban', '$id_quiz', '$id_soal', '$pil_e')");

            if($sql){

                return $id_soal;

            }else{

                echo "kesalahan input soal pilihanganda";

            }

        }

        public function insert_soal_essay($host, $id_quiz){

            $isi_soal = $_POST['pertanyaan_essay'];
            $jawaban = $_POST['answer_essay'];

            //id_soal 
            $id_soal = $this->acak_id(30);

            $sql = mysqli_query($host, "INSERT INTO soal (isi_soal, jawaban, quiz_id, id_soal) VALUES ('$isi_soal', '$jawaban', '$id_quiz', '$id_soal')");

            if($sql){

                return $id_soal;

            }else{

                echo "kesalahan input soal essay";

            }

        }


        public function delete_soal($host, $soal_id){

            $sql=mysqli_query($host, "DELETE FROM soal WHERE id_soal = '$soal_id'");

            if($sql){

                return true;

            }else{

                echo "kesalahan hapus soal";

            }

        }

        public function update_isiSoal($host, $soal_id){    //update soal pilgan

            $isi_soal = $_POST['isi_soal'];
            $jwb_benar = $_POST['jwb_benar'];

            $sql=mysqli_query($host, "UPDATE soal SET isi_soal='$isi_soal', jawaban='$jwb_benar' WHERE id_soal = '$soal_id'");

            if($sql){

                return true;

            }else{

                echo "kesalahan update isi soal";

            }

        }

        public function cek_ekstensi_edit_pilgan(){

            $lolos = 0;
            $gagal = 0;

            $allowed = array("png","jpg");

            $total_upload = count($_FILES['data_file_add']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $cek_ekstensi = pathinfo($_FILES['data_file_add']['name'][$i]);

                if(in_array($cek_ekstensi['extension'], $allowed)){

                    $lolos = $lolos + 1;
                   
                }else{

                    $gagal = $gagal + 1;

                }
            }

            if($total_upload == $lolos) {

                return true;
            
            }else{
                
                return false;
            
            }


        }

        public function insert_file_edit_pilgan($host, $soal_id){

            //nama direktori
            $nama_direktori = "../../dist/assets/file_quiz/";

            $total_upload = count($_FILES['data_file_add']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $nama_file = $_FILES['data_file_add']['name'][$i];
                $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);

                //path direktori
                $path_file = $nama_direktori . $nama_file;
                    if(move_uploaded_file($_FILES['data_file_add']['tmp_name'][$i], $path_file)) {

                        $mysql = mysqli_query($host, "INSERT INTO file_soal (nama_filesoal, soal_id, ekstensi) VALUES ('$nama_file', '$soal_id', '$ekstensi')");
    
    
                    }else{
    
                        echo "file, ada sesuatu yg salah";
    
                    }

                }

            if($mysql){

                return true;

            }else{

                echo "kesalahan saat upload file";

            }

        }

        public function update_soal_essay($host, $id_soal){

            $isi_soal = $_POST['isi_soal'];

            $sql=mysqli_query($host, "UPDATE soal SET isi_soal = '$isi_soal' WHERE id_soal='$id_soal'");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat update soal essay";

            }

        }

        public function update_gambar($host, $soal_id){

            //nama direktori
            $nama_direktori = "../../dist/assets/file_quiz/";

            $total_upload = count($_FILES['data_file']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $nama_file = $_FILES['data_file']['name'][$i];
                $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);

                //path direktori
                $path_file = $nama_direktori . $nama_file;
                    if(move_uploaded_file($_FILES['data_file']['tmp_name'][$i], $path_file)) {

                        $mysql = mysqli_query($host, "UPDATE file_soal SET nama_filesoal='$nama_file', ekstensi='$ekstensi' WHERE soal_id = '$soal_id'");
    
    
                    }else{
    
                        echo "file, ada sesuatu yg salah";
    
                    }

                }

            if($mysql){

                return true;

            }else{

                echo "kesalahan saat upload file";

            }

        }

        public function edit_pilA($host, $soal_id){

            $pil_a = $_POST['pil_a'];

            $sql=mysqli_query($host, "UPDATE soal SET pil_a = '$pil_a' WHERE id_soal='$soal_id'");

            if($sql){

                return true;

            }else{

                echo "kesalahan edit pil_a";

            }

        }

        public function edit_pilB($host, $soal_id){

            $pil_b = $_POST['pil_b'];

            $sql=mysqli_query($host, "UPDATE soal SET pil_b='$pil_b' WHERE id_soal='$soal_id'");

            if($sql){

                return true;

            }else{

                echo "kesalahan update pil_b";

            }

        }

        public function edit_pilC($host, $soal_id){

            $pil_c = $_POST['pil_c'];

            $sql=mysqli_query($host, "UPDATE soal SET pil_c='$pil_c' WHERE id_soal='$soal_id'");

            if($sql){

                return true;
                
            }else{

                echo "kesalahan updaye pil_c";

            }

        }

        public function edit_pilD($host, $soal_id){

            $pil_d = $_POST['pil_d'];

            $sql=mysqli_query($host, "UPDATE soal SET pil_d='$pil_d' WHERE id_soal='$soal_id'");

            if($sql){

                return true;

            }else{

                echo "kesalahan upload pil_d";

            }

        }

        public function edit_pilE($host, $soal_id){

            $pil_e = $_POST['pil_e'];

            $sql=mysqli_query($host, "UPDATE soal SET pil_e='$pil_e' WHERE id_soal='$soal_id'");

            if($sql){

                return true;

            }else{

                echo "kesalahan upload pil_d";

            }

        }

        public function edit_jwb_essay($host, $soal_id){

            $jwb=$_POST['jawaban'];

            $sql=mysqli_query($host, "UPDATE soal SET jawaban='$jwb' WHERE id_soal='$soal_id'");

            if($sql){

                return true;

            }else{

                echo "nge-bug";

            }

        }

        public function delete_file($host, $id_file){

            $sql = mysqli_query($host, "DELETE FROM file_soal WHERE id_file='$id_file'");

            if($sql){

                return true;

            }else{

                echo "invalid delete file";

            }

        }



    }

    //create objek class
    $quiz_control = new Control_quiz;

    //create objek import excle
    $excle_import = new import_excle;

    if(isset($_POST['save_pilihanganda'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_quiz = $_POST['id_quiz'];

        //key pilgan with file or not ^.^
        $type = $_POST['file_pilihanganda'];

        if($type == "null"){

            if($quiz_control->insert_soal_pilganda($host, $id_quiz)){

                header("location:../../dist/guru/quizCreatesoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&question_add");

            }

        }else{

            if($quiz_control->cek_ekstensi() == true){

                if($id_soal = $quiz_control->insert_soal_pilganda($host, $id_quiz)){
    
                    if($quiz_control->insert_file($host, $id_soal) == true){
    
                        header("location:../../dist/guru/quizCreatesoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&question_add");
    
                    }
    
                }
    
            }else{
    
                header("location:../../dist/guru/quizCreatesoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");
    
            }

        }

    }else if(isset($_POST['save_essay'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_quiz = $_POST['id_quiz'];

        //key essay with file or not ^.^
        $type = $_POST['file_essay'];
        
        if($type == "null"){

            if($quiz_control->insert_soal_essay($host, $id_quiz)){

                header("location:../../dist/guru/quizCreatesoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&question_add");

            }

        }else{

            if($quiz_control->cek_ekstensi() == true){

                if($id_soal = $quiz_control->insert_soal_essay($host, $id_quiz)){
    
                    if($quiz_control->insert_file($host, $id_soal) == true){
    
                        header("location:../../dist/guru/quizCreatesoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&question_add");
    
                    }
    
                }
    
            }else{
    
                header("location:../../dist/guru/quizCreatesoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");
    
            }

        }

    }else if(isset($_POST['delete_soal'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->delete_soal($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&dlt");
        }

    }else if(isset($_POST['edit_pil_a'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->edit_pilA($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }

    }else if(isset($_POST['edit_pil_b'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->edit_pilB($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }

    }else if(isset($_POST['edit_pil_c'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->edit_pilC($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }

    }else if(isset($_POST['edit_pil_d'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->edit_pilD($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }

    }
    else if(isset($_POST['edit_pil_e'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->edit_pilE($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }

    }
    
    
    else if(isset($_POST['edit_jwb_essay'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->edit_jwb_essay($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }

    }else if(isset($_GET['dltfile_pilgan'])){

        $key=$_GET['key'];
        $class_code=$_GET['class_code'];
        $id_file=$_GET['id_file'];
        $id_quiz=$_GET['id_quiz'];

        if($quiz_control->delete_file($host, $id_file) == true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }

    }else if(isset($_POST['edit_soal_pilgan'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->update_isiSoal($host, $id_soal)==true){
            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
        }
    }else
    if(isset($_POST['update_file_soal_pilgan'])){

        $jumlah_file = $_POST['jum_file'];
    
        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];


        if($jumlah_file < 3){
            $keputusan = $_POST['addfile']; //add file

            if($keputusan == "yes"){

                //add file
                if($quiz_control->cek_ekstensi_edit_pilgan() == true){
    
                    if($quiz_control->insert_file_edit_pilgan($host, $id_soal)==true){
    
                        header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
                    }
    
                }else{
    
                    header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");
    
                }
    
            }else{

                if($quiz_control->cek_ekstensi() == true){

                    if($quiz_control->update_gambar($host, $id_soal)==true){
    
                        header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
    
                    }
    
                }else{
    
                    header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");
    
                }

            }

        }else{

            //edit file

            if($quiz_control->cek_ekstensi() == true){

                if($quiz_control->update_gambar($host, $id_soal)==true){

                    header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");

                }

            }else{

                header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");

            }

            
        }

    }else if(isset($_POST['edit_soal_essay'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];

        if($quiz_control->update_soal_essay($host, $id_soal)==true){

            header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");

        }
        
    }else if(isset($_POST['update_file_soal_essay'])){

        $jumlah_file = $_POST['jum_file'];
    
        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_soal = $_POST['id_soal'];
        $id_quiz=$_POST['id_quiz'];


        if($jumlah_file < 3){
            $keputusan = $_POST['addfile']; //add file

            if($keputusan == "yes"){

                //add file
                if($quiz_control->cek_ekstensi_edit_pilgan() == true){
    
                    if($quiz_control->insert_file_edit_pilgan($host, $id_soal)==true){
    
                        header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
                    }
    
                }else{
    
                    header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");
    
                }
    
            }else{

                if($quiz_control->cek_ekstensi() == true){

                    if($quiz_control->update_gambar($host, $id_soal)==true){
    
                        header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");
    
                    }
    
                }else{
    
                    header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");
    
                }

            }

        }else{

            //edit file

            if($quiz_control->cek_ekstensi() == true){

                if($quiz_control->update_gambar($host, $id_soal)==true){

                    header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&edit_ok");

                }

            }else{

                header("location:../../dist/guru/quizEditsoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&exstension_false");

            }

            
        }

    }else if(isset($_POST['import_pilgan'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_quiz=$_POST['id_quiz'];

        $excle_import->cek_ekstensi_xls();

        if($excle_import->cek_ekstensi_xls()=="ekstensi_benar"){
            if($excle_import->import_pilihanganda($host, $id_quiz) == true){

                header("location:../../dist/guru/quiz.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&import_ok");

            }else{

                echo "gagal import soal pilgan";

            }

        }else{

            header("location:../../dist/guru/quiz.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&import_no");

        }

    }else if(isset($_POST['import_essay'])){

        $key=$_POST['key'];
        $class_code=$_POST['class_code'];
        $id_quiz=$_POST['id_quiz'];

        if($excle_import->cek_ekstensi_xls() == "ekstensi_benar"){

            if($excle_import->import_essay($host, $id_quiz) == true){

                header("location:../../dist/guru/quiz.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&import_ok");

            }else{

                echo "gagal import soal essay";

            }

        }else{

            header("location:../../dist/guru/quiz.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&import_no");

        }

    }

?>