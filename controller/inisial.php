<?php
    class inisial{
        private $hasil;

        public function inisilisasi($key, $host){
            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password='$key'");
            $this->hasil = mysqli_num_rows($sql);

            if($this->hasil == 1){
                return true;
            }else{
                return false;
            }
        }

        public function inisialisai_in_session($key, $host, $kd_kls){
            $key_result = $this->inisilisasi($key, $host);
            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas='$kd_kls'");
            
            $class_code_res = mysqli_num_rows($sql);

            if($key_result==true && $class_code_res == 1){

                return true;

            }else{

                return false;

            }

        }

        public function inisialisasi_quizguru($key, $host, $kd_kls, $id_quiz){
            $key_result = $this->inisialisai_in_session($key, $host, $kd_kls);

            $sql = mysqli_query($host, "SELECT *FROM identitas_quiz WHERE id_quiz = '$id_quiz'");
            $quiz_guru_res = mysqli_num_rows($sql);

            if($quiz_guru_res == 1 && $key_result == true){
                return true;
            }else{
                return false;
            }

        }

        public function HalamanGrade_submission($host, $class_code, $key, $sesi){

            $cek_sesi = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE id_sesi = '$sesi'");
            $key_result = $this->inisialisai_in_session($key, $host, $class_code);

            $result_cek_sesi = mysqli_num_rows($cek_sesi);

            if($result_cek_sesi == 1 && $key_result == true){
                return true;
            }else{
                return false;
            }

        }

    }

    class inisial_siswa{

        public function halaman_utama($host, $q){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");
            $count = mysqli_num_rows($sql);

            if($count==1){
                return true;
            }else{
                return false;
            }

        }

        public function halaman_class($host, $class_code, $q){

            $cek_class = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas = '$class_code'");
            $cek_user = $this->halaman_utama($host, $q);

            $count_class = mysqli_num_rows($cek_class);

            if($count_class == 1 && $cek_user == true){

                return true;

            }else{

                return false;

            }

        }

        public function halaman_send_pesan($host, $q, $to){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE email = '$to'");

            $count = mysqli_num_rows($sql);

            if($this->halaman_utama($host, $q) == true && $count > 0){

                return true;

            }else{

                return false;

            }

        }

        public function halaman_send_pesan_antar_siswa($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email'");
            $count = mysqli_num_rows($sql);

            if($count==1){
                return true;
            }else{
                return false;
            }

        }

    }




    function My_chek($key, $host){
        $My_inisial = new inisial;

        if($My_inisial->inisilisasi($key, $host) == true){
            return true;
        }else{
            header("location:../../500.php");
        }

    }

    function chek_sesiguru($key, $host, $kd_kls){
        $inisial_hal_sesi = new inisial;

        if($inisial_hal_sesi->inisialisai_in_session($key, $host, $kd_kls) == true){

            return true;

        }else{
            header("location:../../500.php");
        }

    }

    function chek_quizguru($key, $host, $kd_kls, $id_quiz){
        $My_inisial = new inisial;

        if($My_inisial->inisialisasi_quizguru($key, $host, $kd_kls, $id_quiz)==true){
            return true;
        }else{
            header("location:../../500.php");
        }


    }

    function chek_halaman_grade_guru($key, $host, $kd_kls, $sesi){

        $My_inisial = new inisial;

        if($My_inisial->HalamanGrade_submission($host, $kd_kls, $key, $sesi) == true){
            return true;
        }else{
            header("location:../../500.php");
        }

    }


    function cek_halaman_utama_siswa($host, $q){

        $siswa_inisial = new inisial_siswa;

        if($siswa_inisial->halaman_utama($host, $q) == true){
            return true;
        }else{
            header("location:../../500.php");
        }

    }

    function cek_halaman_class_siswa($host, $class_code, $q){

        $siswa_inisial = new inisial_siswa;

        if($siswa_inisial->halaman_class($host, $class_code, $q) == true){

            return true;

        }else{
            header("location:../../500.php");
        }

    }

    function cek_halaman_send_pesan_siswa($host, $q, $to){

        $siswa_inisial = new inisial_siswa;

        if($siswa_inisial->halaman_send_pesan($host, $q, $to) == true){

            return true;

        }else{

            header("location:../../500.php");


        }

    }

    function cek_halaman_send_pesan_antar_siswa($host, $email_pengirim, $email_penerima){

        $siswa_inisial = new inisial_siswa;

        if($siswa_inisial->halaman_send_pesan_antar_siswa($host, $email_pengirim) == true){

            if($siswa_inisial->halaman_send_pesan_antar_siswa($host, $email_penerima) == true){

                return true;

            }else{

                header("location:../../500.php");


            }

        }else{

            header("location:../../500.php");

        }

    }

?>