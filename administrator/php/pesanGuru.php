<?php
    @include '../../config/config.php';

    class pesanGuru{

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


        public function GetIdentitasPengirim($host, $email_guru){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE email = '$email_guru'");

            while($row = mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $gambar = $row['gambar'];

            }

            return array($first_name, $last_name, $gambar);

        }

        public function CekValidationEmail($host, $email_guru){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE email = '$email_guru'");

            if(mysqli_num_rows($sql) == 0){

                header("location:./PesanGuru.php");

            }else{

                return true;

            }

        }

        public function InsertChatting($host){

            $pengirim = "admin";
            $time = $this->gettingDateTime();

            $pesan = $_POST['pesan'];
            $username_admin = $_POST['username_admin'];
            $email_guru = $_POST['email_guru'];


            $sql = mysqli_query($host, "INSERT INTO pesan_admin_guru (pesan, email_guru, username_admin, date_time, pengirim) VALUES ('$pesan', '$email_guru', '$username_admin', '$time', '$pengirim')");

            if($sql){

                return true;

            }else{

                echo "Query Error";

            }

        }

        public function ViewChatting($host, $email_guru, $username_admin){

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_guru WHERE email_guru='$email_guru' AND username_admin='$username_admin'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function gettingTotalChat($host, $email_guru, $username_admin){

            $sql = mysqli_query($host, "SELECT *FROM pesan_admin_guru WHERE email_guru='$email_guru' AND username_admin='$username_admin'");

            return mysqli_num_rows($sql);

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

    $PesanGuru = new pesanGuru;

    if(isset($_POST['kirim'])){

        if($_POST['pesan'] != NULL){

            if($PesanGuru->InsertChatting($host) == true){

                header("location:../HubGuru.php?terkirim&to=$_POST[email_guru]");
            
            }

        }else{

            header("location:../HubGuru.php?pesan_kosong&to=$_POST[email_guru]");


        }


    }else if(isset($_GET['id'])){

        if($PesanGuru->DeletePesan($host) == true){

            header("location:../HubGuru.php?hapus&to=$_GET[email]");

        }
    }


?>