<?php
@include '../../config/config.php';

class Messange{

        public function GetTime(){

            date_default_timezone_set("Asia/Jakarta");

            return date("Y-m-d H:i:s");

        }

        public function JumlahKontak($host, $emailGuru){

            $sql = mysqli_query($host, "SELECT DISTINCT data_siswa.first_name, data_siswa.last_name, data_siswa.email 
            FROM data_siswa JOIN tb_siswa_join_kls ON
            data_siswa.email=tb_siswa_join_kls.email_siswa JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas WHERE author='$emailGuru'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function GetNamaKelas($host, $emailSiswa){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas WHERE email_siswa = '$emailSiswa'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function GetIdentitasSiswa($host, $emailSiswa){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$emailSiswa'");

            while($row = mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $gambar = $row['gambar'];

            }

            return array(
                $first_name,
                $last_name,
                $gambar
            );

        }

        public function TampilkanKontak($host, $emailGuru){

            $sql = mysqli_query($host, "SELECT DISTINCT data_siswa.first_name, data_siswa.last_name, data_siswa.email, data_siswa.gambar FROM data_siswa JOIN tb_siswa_join_kls ON
            data_siswa.email=tb_siswa_join_kls.email_siswa JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas WHERE author='$emailGuru'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function CekStatusSiswa($host, $emailSiswa){

            $sql = mysqli_query($host, "SELECT *FROM sessionsiswa WHERE email='$emailSiswa'");

            $count = mysqli_num_rows($sql);

            if($count > 0){

                return true;

            }else{

                return false;

            }

        }

        public function CekJumlahPesan($host, $emailGuru, $emailSiswa){

            $sql = mysqli_query($host, "SELECT *FROM pesan WHERE email_siswa='$emailSiswa' AND email_guru='$emailGuru'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function CekJumlaPesanMasukForGuru($host, $emailGuru){

            $sql = mysqli_query($host, "SELECT DISTINCT pesan.email_siswa, data_siswa.first_name, data_siswa.last_name
            FROM pesan INNER JOIN data_siswa ON pesan.email_siswa=data_siswa.email WHERE email_guru='$emailGuru' AND view_guru=0");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function TampilkanPesanMasukForGuru($host, $emailGuru){

            $sql = mysqli_query($host, "SELECT DISTINCT data_siswa.email, data_siswa.first_name, data_siswa.last_name, data_siswa.gambar
            FROM pesan INNER JOIN data_siswa ON pesan.email_siswa=data_siswa.email WHERE email_guru='$emailGuru' AND view_guru=0");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;
        }

        public function JumlahPesanBelumTerbacaPerSiswaForGuru($host, $emailGuru, $emailSiswa){

            $sql = mysqli_query($host, "SELECT *FROM pesan WHERE email_siswa = '$emailSiswa' AND email_guru = '$emailGuru' AND view_guru=0");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function UpdateSudahDibaca($host, $email_guru, $email_siswa){

            $view_guru = 1;

            $sql = mysqli_query($host, "UPDATE pesan SET view_guru='$view_guru' WHERE email_siswa='$email_siswa' AND email_guru='$email_guru' AND pengirim='siswa'");

            if($sql){

                return true;

            }else{

                echo "Query Failed";

            }

        }

        public function SendPesanFromGuruToSiswa($host, $emailGuru, $emailSiswa, $pesan){

            $view_guru = 1;
            $view_siswa = 0;
            $pengirim = "guru";

            $getTime = $this->GetTime();

            $sql = mysqli_query($host, "INSERT INTO pesan (pesan, email_siswa, email_guru, view_siswa, view_guru, date_time, pengirim) VALUES ('$pesan', '$emailSiswa', '$emailGuru', '$view_siswa', '$view_guru', '$getTime', '$pengirim')");

            if($sql){

                return true;

            }else{

                echo "Server Error";

            }

        }

        public function DeletePesan($host, $id_pesan){

            $sql = mysqli_query($host, "DELETE FROM pesan WHERE id_pesan='$id_pesan'");

            if($sql){

                return true;

            }else{

                echo "Server Error";

            }

        }

        //Long polling method started 

        public function CekChatGuruAndSiswa($host, $emailGuru, $emailSiswa){

            $sql = mysqli_query($host, "SELECT *FROM pesan WHERE email_siswa='$emailSiswa' AND email_guru='$emailGuru'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function GetChattingElementGuruAndSiswa($host, $emailGuru, $emailSiswa){

            $sql = mysqli_query($host, "SELECT data_guru.gambar AS gambar_guru, data_siswa.gambar AS gambar_siswa, pesan.pesan, pesan.id_pesan, pesan.pengirim, pesan.date_time 
            FROM data_guru INNER JOIN pesan ON data_guru.email=pesan.email_guru INNER JOIN data_siswa ON pesan.email_siswa = data_siswa.email WHERE 
            email_siswa='$emailSiswa' AND email_guru='$emailGuru'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;
        }

        //End Long polling Method
    }

    $pesan = new Messange;

    if(isset($_POST['kirim_pesan'])){

        $emailGuru = $_POST['email_guru'];
        $emailSiswa = $_POST['email_siswa'];
        $Pesan = $_POST['editor1'];
        $key = $_POST['key'];

        if($Pesan == NULL){

            header("location:../../dist/guru/send.php?to=$emailSiswa&fail");

        }else{

            if($pesan->SendPesanFromGuruToSiswa($host, $emailGuru, $emailSiswa, $Pesan) == true){

                header("location:../../dist/guru/send.php?to=$emailSiswa&yes");

            }

        }

    }else if(isset($_GET['id_pesan'])){

        $key = $_GET['key'];
        $emailSiswa = $_GET['to'];
        $id_pesan = $_GET['id_pesan'];

        if($pesan->DeletePesan($host, $id_pesan) == true){

            header("location:../../dist/guru/send.php?to=$emailSiswa");

        }

    }else if(isset($_GET['update'])){

        $key = $_GET['key'];
        $to = $_GET['to'];
        $email = $_GET['email'];

        if($pesan->UpdateSudahDibaca($host, $email, $to) == true){

            header("location:../../dist/guru/send.php?to=$to");

        }

        // print_r($_GET);

    }
?>