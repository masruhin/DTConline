<?php
    @include '../../config/config.php';

    class pesanadmin{

        public function StatusAdmin($host){

            $sql = mysqli_query($host, "SELECT *FROM admin WHERE session IS NOT NULL");

            return mysqli_num_rows($sql);

        }

        public function gettingDateTime(){

            date_default_timezone_set("Asia/Jakarta");

            return date("Y-m-d H:i:s");

        }

        public function gettingAdmin($host){

            $sql = mysqli_query($host, "SELECT *FROM admin");

            while($row = mysqli_fetch_array($sql)){

                $username = $row['username'];

            }

            return $username;

        }

        public function gettingGambarAdmin($host){

            $sql = mysqli_query($host, "SELECT *FROM admin");

            while($row = mysqli_fetch_array($sql)){

                $gambar = $row['gambar'];

            }

            return $gambar;

        }

        public function ViewChatting($host, $email_siswa){

            $username_admin = $this->gettingAdmin($host);

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_siswa WHERE email_siswa='$email_siswa' AND username_admin='$username_admin'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function CekPesanKosong($host, $email_siswa){

            $username_admin = $this->gettingAdmin($host);

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_siswa WHERE email_siswa='$email_siswa' AND username_admin='$username_admin'");

            return mysqli_num_rows($sql);

        }

        public function InsertChatting($host){

            $pengirim = "siswa";
            $time = $this->gettingDateTime();

            $pesan = $_POST['pesan'];
            $username_admin = $this->gettingAdmin($host);
            $email_siswa = $_POST['email_siswa'];


            $sql = mysqli_query($host, "INSERT INTO pesan_admin_siswa (pesan, email_siswa, username_admin, date_time, pengirim) VALUES ('$pesan', '$email_siswa', '$username_admin', '$time', '$pengirim')");

            if($sql){

                return true;

            }else{

                echo "Query Error";

            }

        }

        public function DeletePesan($host){

            $id = $_GET['id'];

            $sql = mysqli_query($host, "DELETE FROM pesan_admin_siswa WHERE id_pesan='$id'");

            if($sql){

                return true;

            }else{

                echo "Query Error";

            }

        }


    }
    
    $pesanAdminSiswa = new PesanAdmin;

    if(isset($_POST['kirim'])){

        if($_POST['pesan'] != NULL){

            if($pesanAdminSiswa->InsertChatting($host) == true){

                header("location:../../dist/students/Pesan.php?terkirim");
            
            }

        }else{

            header("location:../../dist/students/Pesan.php?pesan_kosong");


        }


    }else if(isset($_GET['id'])){

        if($pesanAdminSiswa->DeletePesan($host) == true){

            header("location:../../dist/students/Pesan.php?terhapus");        

        }

    }
?>