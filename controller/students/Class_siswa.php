<?php
    include '../../config/config.php';

    class class_siswa{

        public function CountPesertaInKelas($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa INNER JOIN tb_siswa_join_kls ON data_siswa.email=tb_siswa_join_kls.email_siswa WHERE kd_kls='$class_code'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function ShowPesertaInKelas($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa INNER JOIN tb_siswa_join_kls ON data_siswa.email=tb_siswa_join_kls.email_siswa WHERE kd_kls='$class_code'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function CekstatusSiswa($host, $q){

            $sql = mysqli_query($host, "SELECT *FROM sessionsiswa WHERE SessionId='$q'");

            $count = mysqli_num_rows($sql);

            if($count >= 1){

                return true;

            }else{

                return false;

            }

        }

        public function view_class($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE kd_kls = '$class_code'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function cek_jmlh_file($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM file_sesi_kelas WHERE id_sesi_kls='$id_sesi'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function view_file($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM file_sesi_kelas WHERE id_sesi_kls='$id_sesi'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function download_file(){

            $name_file = $_GET['name_file'];
            
            $direktori = "../../dist/assets/file/";

            $file = $direktori.$name_file;

            if(!file_exists($direktori.$name_file)){
                echo "kesalahan saat download file";
            }else{

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);

                exit;

            }

        }

        public function add_view_download($host, $id_file, $nama_siswa){
            date_default_timezone_set('Asia/Jakarta');

            $tgl = date('Y-m-d H:i:s');

            $sql = mysqli_query($host, "INSERT INTO view_file_sesi (nama, id_file, tanggal) VALUES ('$nama_siswa', '$id_file', '$tgl')");
            
        }

        public function download_file_tugas(){

            $name_file = $_GET['name_file_tugas'];

            $direktori = "../../dist/assets/file_tugas/";

            $file = $direktori.$name_file;

            if(!file_exists($direktori.$name_file)){
                echo "kesalahan saat download file";
            }else{

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);

                exit;

            }

        }

        public function get_email_siswa($host, $q){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");
            while($row=mysqli_fetch_array($sql)){
                $email = $row['email'];
            }

            return $email;

        }

        public function get_id_join($host, $q, $class_code){

            $email_siswa = $this->get_email_siswa($host, $q);

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls WHERE email_siswa = '$email_siswa' AND kd_kls='$class_code'");

            while($row = mysqli_fetch_array($sql)){

                $id_join = $row['id_join'];

            }

            return $id_join;

        }

        public function cek_pengumpulantugas($host, $q, $class_code, $id_sesi){

            $id_join = $this->get_id_join($host, $q, $class_code);

            $sql = mysqli_query($host, "SELECT *FROM tb_pengumpulan_tugas WHERE join_id='$id_join' AND id_sesi_kls='$id_sesi'");

            $count = mysqli_num_rows($sql);

            if($count == 0){

                return $count; 

            }else{

                return $count;

            }

        }

        public function tampil_file_terkumpul($host, $q, $class_code, $id_sesi){

            $id_join = $this->get_id_join($host, $q, $class_code);

            $sql = mysqli_query($host, "SELECT *FROM tb_pengumpulan_tugas WHERE join_id='$id_join' AND id_sesi_kls='$id_sesi'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;
            
        }

        public function remmening_time($time_deadline, $day_deadline){

            date_default_timezone_set('Asia/Jakarta');

            $deadline_day = (string)$day_deadline;
            $deadline_time = (string)$time_deadline;

            $expired = "$deadline_day $deadline_time";

            $date = new DateTime($expired);
            $now = new DateTime();

            
            return $now->diff($date)->format('%r%d days, %r%h hours , %r%i minuts');
        }

        public function status_kumpul($time_deadline, $day_deadline){

            date_default_timezone_set('Asia/Jakarta');

            $deadline_day = (string)$day_deadline;
            $deadline_time = (string)$time_deadline;

            $expired = "$deadline_day $deadline_time";

            $date = new DateTime($expired);
            $now = new DateTime();

            if($now < $date){

                return "success";

            }else{

                return "failed";

            }
            
        }

        public function get_time_now(){
            
            date_default_timezone_set('Asia/Jakarta');
            //waktu sekarang

            $time_now = date('H:i:s');

            return $time_now;

            
        }

        public function get_date_now(){

            date_default_timezone_set('Asia/Jakarta');
            //waktu sekarang

            $day_now = date('Y-m-d');

            return $day_now;

        }

        public function cek_ekstensi(){

            $lolos = 0;
            $gagal = 0;

            $allowed = array("png", "jpg", "mp4", "mp3", "txt", "pdf", "docx", "xlsx", "rar", "zip");

            $total_upload = count($_FILES['data_file']['name']);

            for($i=0; $i<$total_upload; $i++) {

                $cek_ekstensi = pathinfo($_FILES['data_file']['name'][$i]);
                $size_file = filesize($_FILES['data_file']['name'][$i]);

                if(in_array($cek_ekstensi['extension'], $allowed)&&$size_file <= 3044070){

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

        public function insert_tugas($host, $q, $class_code){

            $time_deadline = $_POST['time_deadline'];
            $day_deadline = $_POST['day_deadline'];

            $tgl_kumpul = $this->get_date_now();
            $waktu_kumpul = $this->get_time_now();

            $id_join = $this->get_id_join($host, $q, $class_code);
            $time_remaining = $this->remmening_time($time_deadline, $day_deadline);

            $status_kumpul = $this->status_kumpul($time_deadline, $day_deadline);


            $id_sesi = $_POST['id_sesi'];

            if($this->cek_ekstensi() == true){

                //nama direktori
                $nama_direktori = "../../dist/assets/file_tugas/";

                $total_upload = count($_FILES['data_file']['name']);
    
                for($i=0; $i<$total_upload; $i++) {
    
                    $nama_file = $_FILES['data_file']['name'][$i];
    
                    //path direktori
                    $path_file = $nama_direktori . $nama_file;
    
                    if(move_uploaded_file($_FILES['data_file']['tmp_name'][$i], $path_file)) {
    
                        $mysql = mysqli_query($host, "INSERT INTO tb_pengumpulan_tugas (nama_file, join_id, tgl_kumpul, waktu_kumpul, time_remaining, id_sesi_kls, status_kumpul) VALUES ('$nama_file', '$id_join', '$tgl_kumpul', '$waktu_kumpul', '$time_remaining', '$id_sesi', '$status_kumpul')");
    
                    }else{
    
                        echo "file, ada sesuatu yg salah";
    
                    }
    
                }
    
                if($mysql){
    
                    return true;
    
                }else{
    
                    echo "kesalahan saat upload file";
    
                }

            }else{

                return false;

            }

        }

        public function edit_file_kumpul($host, $q, $class_code){

            $time_deadline = $_POST['time_deadline'];
            $day_deadline = $_POST['day_deadline'];

            $tgl_kumpul = $this->get_date_now();
            $waktu_kumpul = $this->get_time_now();

            $id_join = $this->get_id_join($host, $q, $class_code);
            $time_remaining = $this->remmening_time($time_deadline, $day_deadline);

            $status_kumpul = $this->status_kumpul($time_deadline, $day_deadline);


            $id_sesi = $_POST['id_sesi'];

            if($this->cek_ekstensi() == true){

                //nama direktori
                $nama_direktori = "../../dist/assets/file_tugas/";

                $total_upload = count($_FILES['data_file']['name']);
    
                for($i=0; $i<$total_upload; $i++) {
    
                    $nama_file = $_FILES['data_file']['name'][$i];
    
                    //path direktori
                    $path_file = $nama_direktori . $nama_file;
    
                    if(move_uploaded_file($_FILES['data_file']['tmp_name'][$i], $path_file)) {
    
                        $mysql = mysqli_query($host, "UPDATE tb_pengumpulan_tugas SET nama_file = '$nama_file', tgl_kumpul = '$tgl_kumpul', waktu_kumpul = '$waktu_kumpul', time_remaining='$time_remaining', status_kumpul='$status_kumpul' WHERE join_id='$id_join' AND id_sesi_kls='$id_sesi'");
    
                    }else{
    
                        echo "file, ada sesuatu yg salah";
    
                    }
    
                }
    
                if($mysql){
    
                    return true;
    
                }else{
    
                    echo "kesalahan saat upload file";
    
                }

            }else{

                return false;

            }


        }

        public function delete_task($host, $id_file){

            $sql = mysqli_query($host, "DELETE FROM tb_pengumpulan_tugas WHERE id_file='$id_file'");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat hapus file";

            }

        }
    }

    $class_siswa = new class_siswa;

    if(isset($_GET['name_file'])){

        $class_siswa->add_view_download($host, $_GET['id_file'], $_GET['nama_siswa']);
        $class_siswa->download_file();

    }else if(isset($_POST['save_tugas'])){

        $q = $_POST['q'];
        $code_class = $_POST['code_class'];


        if($class_siswa->insert_tugas($host, $q, $code_class) == true){

            header("location:../../dist/students/class.php?class_code=$code_class&kumpul_ok");

        }else{

            header("location:../../dist/students/class.php?class_code=$code_class&exstension_false");

        }

    }else if(isset($_GET['delete_file_kumpul'])){

        $q = $_GET['q'];
        $code_class = $_GET['code_class'];
        $id_file = $_GET['id_file'];

        if($class_siswa->delete_task($host, $id_file) == true){

            header("location:../../dist/students/class.php?class_code=$code_class&dlt_ok");

        }
    }else if(isset($_GET['name_file_tugas'])){

        $class_siswa->download_file_tugas();

    }

?>