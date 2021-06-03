<?php
    @include '../../config/config.php';

    class PesanAdmin{

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

        public function ViewChatting($host, $email_guru){

            $username_admin = $this->gettingAdmin($host);

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_guru WHERE email_guru='$email_guru' AND username_admin='$username_admin'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function CekPesanKosong($host, $email_guru){

            $username_admin = $this->gettingAdmin($host);

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_guru WHERE email_guru='$email_guru' AND username_admin='$username_admin'");

            return mysqli_num_rows($sql);

        }

        public function InsertChatting($host){

            $pengirim = "guru";
            $time = $this->gettingDateTime();

            $pesan = $_POST['pesan'];
            $username_admin = $this->gettingAdmin($host);
            $email_guru = $_POST['email_guru'];


            $sql = mysqli_query($host, "INSERT INTO pesan_admin_guru (pesan, email_guru, username_admin, date_time, pengirim) VALUES ('$pesan', '$email_guru', '$username_admin', '$time', '$pengirim')");

            if($sql){

                return true;

            }else{

                echo "Query Error";

            }

        }

        public function DeletePesan($host){

            $id = $_GET['id'];

            $sql = mysqli_query($host, "DELETE FROM pesan_admin_guru WHERE id_pesan='$id'");

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

                header("location:../../dist/guru/Pesan.php?terkirim");
            
            }

        }else{

            header("location:../../dist/guru/Pesan.php?pesan_kosong");


        }


    }else if(isset($_GET['id'])){

        if($pesanAdminSiswa->DeletePesan($host) == true){

            header("location:../../dist/guru/Pesan.php?terhapus");        

        }

    }

?>