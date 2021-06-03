<?php
    @include '../../config/config.php';

    class pesanSiswa{

        public function gettingTotalChat($host, $email_siswa, $username_admin){

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_siswa WHERE email_siswa='$email_siswa' AND username_admin='$username_admin'");

            return mysqli_num_rows($sql);

        }

        public function gettingAdmin($host){

            $sql = mysqli_query($host, "SELECT *FROM admin");

            while($row = mysqli_fetch_array($sql)){

                $username = $row['username'];

            }

            return $username;

        }

        public function gettingDateTime(){

            date_default_timezone_set("Asia/Jakarta");

            return date("Y-m-d H:i:s");

        }

        public function GetIdentitasPengirim($host, $email_siswa){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email = '$email_siswa'");

            while($row = mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $gambar = $row['gambar'];

            }

            return array($first_name, $last_name, $gambar);

        }

        public function CekValidationEmail($host, $email_siswa){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email = '$email_siswa'");

            if(mysqli_num_rows($sql) == 0){

                header("location:./PesanSiswa.php");

            }else{

                return true;

            }

        }

        public function InsertChatting($host){

            $pengirim = "admin";
            $time = $this->gettingDateTime();

            $pesan = $_POST['pesan'];
            $username_admin = $_POST['username_admin'];
            $email_siswa = $_POST['email_siswa'];


            $sql = mysqli_query($host, "INSERT INTO pesan_admin_siswa (pesan, email_siswa, username_admin, date_time, pengirim) VALUES ('$pesan', '$email_siswa', '$username_admin', '$time', '$pengirim')");

            if($sql){

                return true;

            }else{

                echo "Query Error";

            }

        }

        public function ViewChatting($host, $email_siswa, $username_admin){

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_siswa WHERE email_siswa='$email_siswa' AND username_admin='$username_admin'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

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

    $PesanSiswa = new PesanSiswa;

    if(isset($_POST['kirim'])){

        if($_POST['pesan'] != NULL){

            if($PesanSiswa->InsertChatting($host) == true){

                header("location:../HubSiswa.php?terkirim&to=$_POST[email_siswa]");

            }

        }else{

            header("location:../HubSiswa.php?pesan_kosong&to=$_POST[email_siswa]");

        }

    }else if(isset($_GET['id'])){

        if($PesanSiswa->DeletePesan($host) == true){

            header("location:../HubSiswa.php?hapus&to=$_GET[email]");

        }

    }

?>