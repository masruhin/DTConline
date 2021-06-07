<?php
    @include '../../config/config.php';

    //======================================
    // Code By : Ardhika Restu Yoviyanto
    //======================================

    class general{
        public function this_name_class($host, $class_code){
            $sql=mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas='$class_code'");
            while($row=mysqli_fetch_array($sql)){
                $rows[]=$row;
            }
            return $rows;
        }

        public function cek_jmlh_sesi($host, $class_code) {
            $sql=mysqli_query($host, "SELECT *FROM sesi_kelas WHERE kd_kls='$class_code'");
            $tot=mysqli_num_rows($sql);

            return $tot;
        }

        public function durasi($day_start, $time_start, $day_finish, $time_finish){

            $start_day = (string)$day_start;
            $start_time = (string)$time_start;

            $finish_day = (string)$day_finish;
            $finish_time = (string)$time_finish;

            $start = $start_day." ".$start_time;
            $finish = $finish_day." ".$finish_time;

            $date_start = new DateTime($start);
            $date_finish = new DateTime($finish);

            $val = $date_start->diff($date_finish);

            return $val->format('%r%d days,  %r%h hours , %r%i minuts');

        }

        public function time_remmening($time_deadline, $day_deadline){
            date_default_timezone_set('Asia/Jakarta');

            $deadline_day = (string)$day_deadline;
            $deadline_time = (string)$time_deadline;

            $expired = "$deadline_day $deadline_time";

            $date = new DateTime($expired);
            $now = new DateTime();

            if($now < $date){

                return $now->diff($date)->format('%r%d days, %r%h hours , %r%i minuts');

            }else{

                return "Time expired";

            }

            
        }

        public function cek_add_menu($host, $class_code, $id_sesi){

            $sql=mysqli_query($host, "SELECT *FROM sesi_kelas WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function update_waktu($host, $kd_kls, $id_sesi){

            date_default_timezone_set('Asia/Jakarta');
            //waktu sekarang

            $time_now = date('H:i:s');
            $day_now = date('Y-m-d');


            $sql = mysqli_query($host, "UPDATE sesi_kelas SET tgl_posting='$day_now', waktu_posting='$time_now' WHERE kd_kls='$kd_kls' AND id_sesi='$id_sesi'");

            if($sql){

                return true;

            }else{

                echo "kesalahan update waktu";

            }

        }
        
        public function cek_status_tugas($tgl_selesai_tgs, $waktu_selesai_tgs){

            date_default_timezone_set('Asia/Jakarta');

            $selesai_tgltgs = (string)$tgl_selesai_tgs;
            $selesai_timetgs = (string)$waktu_selesai_tgs;

            $expired = "$selesai_timetgs $selesai_tgltgs";

            $date_deadline = new DateTime($expired);
            $date_now = new DateTime();

            if($date_now < $date_deadline){

                return "Submission open";

            }else{

                return "Submission closed";

            }

        }

        
    }

    //clas model berisi method menginputkan data sesi yang baru
    class model{

        public function acak_id($length) {
            $str        = "";
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz12345678xsdfwQWKJ00HVcMSMSNMSj9Xpc';
            $max        = strlen($characters) - 1;

            for ($i = 0; $i < $length; $i++) {

                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];

            }

            return $str;
        }

        public function cek_file(){
            
            $lolos = 0;
            $gagal = 0;

            $allowed = array("png", "jpg", "mp4", "mp3", "txt", "pdf", "docx", "xlsx", "rar", "zip");

            $total_upload = count($_FILES['data_file']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $cek_ekstensi = pathinfo($_FILES['data_file']['name'][$i]);
                $size = filesize($_FILES['data_file']['name'][$i]);

                if(in_array($cek_ekstensi['extension'], $allowed) && $size <= 3044070){

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

        public function insert_file($host, $id_sesi) {

            //nama direktori
            $nama_direktori = "../../dist/assets/file/";

            $total_upload = count($_FILES['data_file']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $nama_file = $_FILES['data_file']['name'][$i];

                //path direktori
                $path_file = $nama_direktori . $nama_file;

                if(move_uploaded_file($_FILES['data_file']['tmp_name'][$i], $path_file)) {

                    $mysql = mysqli_query($host, "INSERT INTO file_sesi_kelas (id_sesi_kls, nama_file) VALUES ('$id_sesi', '$nama_file')");

                    echo $nama_file;

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

        public function sesi_input($host){

            date_default_timezone_set('Asia/Jakarta');
            //waktu sekarang

            $time_now = date('H:i:s');
            $day_now = date('Y-m-d');

            //required field
            $title = $_POST['title'];
            $description = $_POST['deskripsi'];
            $kd_kls = $_POST['kode_kelas'];
            //end required file

            //due date
            $time_deadline = $_POST['time_deadline']; //time posting
            $due_date = $_POST['due_date']; //tgl posting
            //end_due date

            //id sesi
            $id_sesi = $this->acak_id(10);

            $mysql = mysqli_query($host, "INSERT INTO sesi_kelas (id_sesi, title, deskripsi, tgl_posting, tgl_deadline, waktu_posting, waktu_deadline, kd_kls) VALUES ('$id_sesi','$title', '$description', '$day_now', '$due_date', '$time_now', '$time_deadline', '$kd_kls')");

            if($mysql) {
            
                return $id_sesi;
            
            }else{
            
                echo "inputan , ada sesuatu yg salah";
            
            }
            
        }


    }

    //fungsi ini untuk menginputkan dengan file <method diluar class model>
    function input($host) {
        $objek_model = new model;

        $key = $_POST['key'];
        $class_code = $_POST['kode_kelas'];

        //insert file
        if($objek_model->cek_file() == true){
           
            if($id_sesi = $objek_model->sesi_input($host)) {

                if($objek_model->insert_file($host, $id_sesi)) {

                    header("location:../../dist/guru/class.php?class_code=$class_code&sesi_ok");
                }

            }

        }else {
            header("location:../../dist/guru/class.php?class_code=$class_code&exstension_false");
        }
        //end insert file
    }

    function input_nofile($host) {
        $objek_model = new model;

        $key = $_POST['key'];
        $class_code = $_POST['kode_kelas'];

        //input sesi
        if($objek_model->sesi_input($host)) {

            header("location:../../dist/guru/class.php?class_code=$class_code&sesi_ok");

        }else {

            echo "ada sesuatu yang nge bug";
        
        }
    }


    //control utama class model

    if(isset($_POST['create_session'])){

        input_nofile($host);

    }


    //class model view berisi informasi data sesi kelas
    class model_view{

        public function getviewfile($host, $id_file){
            $sql = mysqli_query($host, "SELECT nama, tanggal, COUNT(id_file) AS dilihat, id_file FROM view_file_sesi GROUP BY id_file HAVING id_file=$id_file");

            while ($row = mysqli_fetch_array($sql)){
                $data[] = $row;
            }

            return $data;
        }

        public function totalviewfile($host, $id_file){
            $sql = mysqli_query($host, "SELECT *FROM view_file_sesi WHERE id_file = '$id_file'");

            $total = mysqli_num_rows($sql);

            return $total;
        }

        public function tampil_file($host, $id_sesi) {
            $sql = mysqli_query($host, "SELECT *FROM file_sesi_kelas WHERE id_sesi_kls='$id_sesi'");

            while($row=mysqli_fetch_array($sql)){
                $file[] = $row;
            }

            return $file;
        }

        public function jmlh_file($host, $id_sesi) {
            $sql = mysqli_query($host, "SELECT *FROM file_sesi_kelas WHERE id_sesi_kls='$id_sesi'");

            $jmlh_file=mysqli_num_rows($sql);

            if($jmlh_file == 0){
                
                return false;
            
            }else{

                $file_view = $this->tampil_file($host, $id_sesi);

                return $file_view;

            }
            
        }

        public function lihat_sesi($host, $class_code) {
            $sql = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE kd_kls='$class_code' ORDER BY id_sesi_kls ASC");

            while($row=mysqli_fetch_array($sql)) {

                $sesi_kls[] = $row;

            }

            return $sesi_kls;

        }

    }

    //class model crud berisi crud data sesi kelas satu satu
    class model_crud{

        public function update_tgl($host, $class_code, $id_sesi){

            date_default_timezone_set('Asia/Jakarta');
            //waktu sekarang

            $time_now = date('H:i:s');
            $day_now = date('Y-m-d');

            $sql = mysqli_query($host, "UPDATE sesi_kelas SET tgl_posting='$day_now', waktu_posting='$time_now' WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");

            if($sql){

                return true;

            }else{

                echo "update tgl bug";

            }
            

        }

        public function edit_title($host, $class_code){

            date_default_timezone_set('Asia/Jakarta');
            //waktu sekarang

            $time_now = date('H:i:s');
            $day_now = date('Y-m-d');

            $title = $_POST['title'];
            $id_sesi = $_POST['id_sesi'];

            $sql = mysqli_query($host, "UPDATE sesi_kelas SET title='$title', tgl_posting='$day_now', waktu_posting='$time_now' WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");

            if($sql){
                
                return true;
            
            }else{

                echo "edit title nge bug";
            
            }

        }

        public function edit_deskripsi($host, $class_code){

            date_default_timezone_set('Asia/Jakarta');
            //waktu sekarang

            $time_now = date('H:i:s');
            $day_now = date('Y-m-d');

            $deskripsi = $_POST['deskripsi'];
            $id_sesi = $_POST['id_sesi'];

            $sql = mysqli_query($host, "UPDATE sesi_kelas SET deskripsi='$deskripsi', tgl_posting='$day_now', waktu_posting='$time_now' WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");

            if($sql){

                return true;

            }else{

                echo "edit deskripsi nge bug";

            }

        }

        public function hapus_file($host, $class_code){

            $id_file = $_GET['id_file'];
            $id_sesi = $_GET['id_sesi'];

            $sql = mysqli_query($host, "DELETE FROM file_sesi_kelas WHERE id_sesi_kls = '$id_sesi' AND id_file = '$id_file'");

            if($sql){

                $updateDate = $this->update_tgl($host, $class_code, $id_sesi);

                return $updateDate;

            }else{

                echo "hapus file bug";

            }

        }

        public function Extension_edit(){

            $lolos = 0;
            $gagal = 0;

            $allowed = array("png", "jpg", "mp4", "mp3", "txt", "pdf", "docx", "xlsx", "rar", "zip");

            $total_upload = count($_FILES['data_edit']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $cek_ekstensi = pathinfo($_FILES['data_edit']['name'][$i]);
                $size_file = filesize($_FILES['data_edit']['name'][$i]);

                if(in_array($cek_ekstensi['extension'], $allowed) && $size_file <= 3044070){

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

        public function editFile($host){

            $id_sesi = $_POST['id_sesi'];

            //nama direktori
            $nama_direktori = "../../dist/assets/file/";

            $total_upload = count($_FILES['data_edit']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $nama_file = $_FILES['data_edit']['name'][$i];

                //path direktori
                $path_file = $nama_direktori . $nama_file;

                if(move_uploaded_file($_FILES['data_edit']['tmp_name'][$i], $path_file)) {

                    $mysql = mysqli_query($host, "UPDATE file_sesi_kelas SET nama_file='$nama_file' WHERE id_sesi_kls='$id_sesi'");

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

        public function edit_time_deadline($host, $kd_kls){

            $day = $_POST['day_new'];
            $time = $_POST['time_new'];

            //key
            $id_sesi = $_POST['id_sesi'];

            $sql = mysqli_query($host, "UPDATE sesi_kelas SET tgl_deadline='$day', waktu_deadline='$time' WHERE id_sesi='$id_sesi' AND kd_kls='$kd_kls'");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat update tgl dan waktu";

            }

        }

        public function delete_filesisip($host){

            $id_sesi = $_POST['id_sesi'];

            $sql = mysqli_query($host, "DELETE FROM file_sesi_kelas WHERE id_sesi_kls='$id_sesi'");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat dlt filesisip";
            }

        }

        public function delete_tmpt_submit($host, $class_code){

            $id_sesi = $_POST['id_sesi'];
            $waktu="00:00:00";
            $tgl_deadline = "0000-00-00";

            $sql = mysqli_query($host, "UPDATE sesi_kelas SET waktu_deadline='$waktu', tgl_deadline='$tgl_deadline' WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat dlt tmpt submitt";

            }
        }

        public function delete_session($host, $id_sesi){

            $sql = mysqli_query($host, "DELETE FROM sesi_kelas WHERE id_sesi='$id_sesi'");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat dlt sessiiii";

            }

        }

    }



    class quiz{

        public function cek_quiz($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM identitas_quiz WHERE id_sesi_kls = '$id_sesi'");

            $jum = mysqli_num_rows($sql);

            if($jum == 1){

                return true; //ada quiz

            }else{

                return false; //gk ada quiz

            }


        }

        public function delete_quiz($host, $id_sesi){

            $id_quiz = $_POST['id_quiz'];

            $sql = mysqli_query($host, "DELETE FROM identitas_quiz WHERE id_quiz='$id_quiz' AND id_sesi_kls='$id_sesi'");

            if($sql){

                return true;

            }else{

                echo "hapus quiz gagal";

            }

        }


        public function add_quiz($host, $id_sesi){

            $get_id = new model;

            $id_quiz = $get_id->acak_id(14);
            
            
            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_selesai = $_POST['tgl_selesai'];
            $title_quiz = $_POST['title_quiz'];
            $waktu_mulai = $_POST['waktu_mulai'];
            $waktu_selesai = $_POST['waktu_selesai'];


            $sql = mysqli_query($host, "INSERT INTO identitas_quiz (id_sesi_kls, id_quiz, tgl_mulai, tgl_selesai, waktu_mulai, waktu_selesai, title_quiz) VALUES ('$id_sesi', '$id_quiz', '$tgl_mulai', '$tgl_selesai', '$waktu_mulai', '$waktu_selesai', '$title_quiz')");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat insert quiz";

            }

        }

        public function tampil_quiz($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM identitas_quiz WHERE id_sesi_kls = '$id_sesi'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function edit_identitasquiz($host, $id_sesi){

            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_selesai = $_POST['tgl_selesai'];
            $title_quiz = $_POST['title_quiz'];
            $waktu_mulai = $_POST['waktu_mulai'];
            $waktu_selesai = $_POST['waktu_selesai'];

            $id_quiz = $_POST['id_quiz'];

            $sql = mysqli_query($host, "UPDATE identitas_quiz SET tgl_mulai='$tgl_mulai', tgl_selesai='$tgl_selesai', waktu_mulai='$waktu_mulai', waktu_selesai='$waktu_selesai', title_quiz='$title_quiz' WHERE id_sesi_kls='$id_sesi' OR id_quiz='$id_quiz'");

            if($sql){

                return true;

            }else{

                echo "kesalahan";

            }

        }

    }

    //control utama class model crud

    $objek_model_crud = new model_crud; //objek model crud
    $modelmodel = new model; //objek model

    $modelquiz = new quiz; //objek quiz

    $objek_general = new general;//objek general class

    if(isset($_POST['edit_title'])){

        $class_code = $_POST['class_code'];
        $key = $_POST['key'];
        
        if($objek_model_crud->edit_title($host, $class_code) == true){

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");


        }
        

    }else if(isset($_POST['edit_deskripsi'])){

        $class_code = $_POST['class_code'];
        $key = $_POST['key'];

        if($objek_model_crud->edit_deskripsi($host, $class_code) == true){

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }

    }else if(isset($_GET['hapus_file'])){

        $class_code = $_GET['class_code'];
        $key = $_GET['key'];

        if($objek_model_crud->hapus_file($host, $class_code) == true){

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }

    }else if(isset($_POST['edit_insert_file'])){

        $cek = $_POST['val'];

        //key
        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($cek == "yes") {
            //yes add file

            if($modelmodel->cek_file() == true) {

                if($modelmodel->insert_file($host, $id_sesi) == true) {

                    $objek_general->update_waktu($host, $class_code, $id_sesi);
                    
                    header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

                }
                
            }else{

                header("location:../../dist/guru/class.php?class_code=$class_code&exstension_false");

            }

        }else{

            if($objek_model_crud->Extension_edit() == true){

                if($objek_model_crud->editFile($host) == true){

                    $objek_general->update_waktu($host, $class_code, $id_sesi);

                    header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

                }

            }else{

                header("location:../../dist/guru/class.php?class_code=$class_code&exstension_false");

            }

        }

    }else if(isset($_POST['edit_time_deadline'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($objek_model_crud->edit_time_deadline($host, $class_code) == true){

            $objek_general->update_waktu($host, $class_code, $id_sesi);

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }


    }else if(isset($_POST['dlt_filesisip'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];
        
        if($objek_model_crud->delete_filesisip($host) == true){

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }

    }else if(isset($_POST['dlt_tmpsubmit'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($objek_model_crud->delete_tmpt_submit($host, $class_code) == true){

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }

    }
    

    //control setting configurate session
    if(isset($_POST['add_menu_sisipfile'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($modelmodel->cek_file() == true){

            if($modelmodel->insert_file($host, $id_sesi) == true){

                $objek_general->update_waktu($host, $class_code, $id_sesi);

                header("location:../../dist/guru/class.php?class_code=$class_code&menus_add");

            }

        }else{

                header("location:../../dist/guru/class.php?class_code=$class_code&exstension_false");

        }

    }else if(isset($_POST['add_menuinput_task'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];

        if($objek_model_crud->edit_time_deadline($host, $class_code) == true){

            $objek_general->update_waktu($host, $class_code, $id_sesi);

            header("location:../../dist/guru/class.php?class_code=$class_code&menus_add");

        }

    }else if(isset($_POST['quiz_add'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($modelquiz->add_quiz($host, $id_sesi) == true){

            $objek_general->update_waktu($host, $class_code, $id_sesi);

             header("location:../../dist/guru/class.php?class_code=$class_code&menus_add");

        }

    }else if(isset($_POST['edit_quiz'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($modelquiz->edit_identitasquiz($host, $id_sesi) == true){

            $objek_general->update_waktu($host, $class_code, $id_sesi);

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }

    }else if(isset($_POST['delete_quiz'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($modelquiz->delete_quiz($host, $id_sesi) == true){

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }

    }else if(isset($_POST['delete_session'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];

        if($objek_model_crud->delete_session($host, $id_sesi) ==  true){

            header("location:../../dist/guru/class.php?class_code=$class_code&edit_ok");

        }

    }
