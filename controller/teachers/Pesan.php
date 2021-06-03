<?php
    class PesanEmail{

        public function getEmailpengirim($host, $key){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password='$key'");

            while($row = mysqli_fetch_array($sql)){

                $email = $row['email'];

            }

            return $email;

        }

    }

    if(isset($_POST['kirim_email'])){

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $email_pengirim = $_POST['email_pengirim'];
        $email_tujuan = $_POST['email_tujuan'];
        $subjek = $_POST['subject'];
        $pesan = $_POST['pesan'];
        $header = "Email (Siswa from Guru) dari ".$email_pengirim;

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];

        mail($email_tujuan, $subjek, $pesan, $header);

        header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&emailok");

    }
?>