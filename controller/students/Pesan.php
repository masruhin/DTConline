<?php

@include '../../config/config.php';

class Pesan
{

    public function GetTime()
    {

        date_default_timezone_set("Asia/Jakarta");

        return date("Y-m-d H:i:s");
    }

    public function Getemailpengirim($host, $q)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");

        while ($row = mysqli_fetch_array($sql)) {

            $email_pengirim = $row['email'];
        }

        return $email_pengirim;
    }

    public function GetEmail_siswa($host, $q)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");

        while ($row = mysqli_fetch_array($sql)) {

            $email = $row['email'];
        }

        return $email;
    }

    public function Get_Namakelas($host, $email_guru)
    {

        $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author='$email_guru'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function GetStatusGuru($host, $email_guru)
    {

        $sql = mysqli_query($host, "SELECT *FROM sessionguru WHERE email='$email_guru'");

        $count = mysqli_num_rows($sql);

        if ($count > 0) {

            return true;
        } else {

            return false;
        }
    }

    public function GetNamaGuru($host, $email_guru)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE email='$email_guru'");

        while ($row = mysqli_fetch_array($sql)) {

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

    public function JumlahPesan_siswaToGuru($host, $email_guru, $q)
    {

        $email_siswa = $this->GetEmail_siswa($host, $q);

        $sql = mysqli_query($host, "SELECT *FROM pesan WHERE email_siswa='$email_siswa' AND email_guru='$email_guru'");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function Jumlah_Kontak_Guru($host, $q)
    {

        $email = $this->GetEmail_siswa($host, $q);

        $sql = mysqli_query($host, "SELECT DISTINCT data_guru.email, data_guru.first_name, data_guru.last_name, data_guru.gambar AS gambar_guru FROM data_guru
            INNER JOIN identitas_kelas ON data_guru.email = identitas_kelas.author INNER JOIN tb_siswa_join_kls ON identitas_kelas.kode_kelas=
            tb_siswa_join_kls.kd_kls WHERE email_siswa='$email'");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function TampilKontakGuru($host, $q)
    {

        $email = $this->GetEmail_siswa($host, $q);

        $sql = mysqli_query($host, "SELECT DISTINCT data_guru.email, data_guru.first_name, data_guru.last_name, data_guru.gambar AS gambar_guru FROM data_guru
            INNER JOIN identitas_kelas ON data_guru.email = identitas_kelas.author INNER JOIN tb_siswa_join_kls ON identitas_kelas.kode_kelas=
            tb_siswa_join_kls.kd_kls WHERE email_siswa='$email'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function GetChattingElementGuruAndSiswa($host, $emailGuru, $emailSiswa)
    {

        $sql = mysqli_query($host, "SELECT data_guru.gambar AS gambar_guru, data_siswa.gambar AS gambar_siswa, pesan.pesan, pesan.id_pesan, pesan.pengirim, pesan.date_time 
            FROM data_guru INNER JOIN pesan ON data_guru.email=pesan.email_guru INNER JOIN data_siswa ON pesan.email_siswa = data_siswa.email WHERE 
            email_siswa='$emailSiswa' AND email_guru='$emailGuru'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function SendPesanFromSiswaToGuru($host, $emailGuru, $emailSiswa, $pesan)
    {

        $view_guru = 0;
        $view_siswa = 1;
        $pengirim = "siswa";

        $getTime = $this->GetTime();

        $sql = mysqli_query($host, "INSERT INTO pesan (pesan, email_siswa, email_guru, view_siswa, view_guru, date_time, pengirim) VALUES ('$pesan', '$emailSiswa', '$emailGuru', '$view_siswa', '$view_guru', '$getTime', '$pengirim')");

        if ($sql) {

            return true;
        } else {

            echo "Server Error";
        }
    }

    public function DeletePesan($host, $id_pesan)
    {

        $sql = mysqli_query($host, "DELETE FROM pesan WHERE id_pesan='$id_pesan'");

        if ($sql) {

            return true;
        } else {

            echo "Server Error";
        }
    }

    // Message Kontak Teman

    public function GetNamaSiswa($host, $email_siswa)
    {

        $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email_siswa'");

        while ($row = mysqli_fetch_array($sql)) {

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

    public function TotalKontakTeman($host, $q)
    {

        $sql = mysqli_query($host, "SELECT distinct * FROM data_siswa EXCEPT SELECT *FROM data_siswa WHERE PASSWORD='$q'");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function TampilKontakTeman($host, $q)
    {

        $sql = mysqli_query($host, "SELECT distinct *fROM data_siswa EXCEPT SELECT *FROM data_siswa WHERE PASSWORD='$q' ORDER BY first_name ASC");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function GetStatusSiswa($host, $email_siswa)
    {

        $sql = mysqli_query($host, "SELECT *FROM sessionsiswa WHERE email='$email_siswa'");

        $count = mysqli_num_rows($sql);

        if ($count > 0) {

            return true;
        } else {

            return false;
        }
    }

    public function Cek_Jumlah_Kelas_join($host, $email_siswa)
    {

        $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas WHERE email_siswa='$email_siswa'");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function TampilkanKelasSiswa($host, $email_siswa)
    {

        $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas WHERE email_siswa='$email_siswa'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }

    public function Total_Pesan_siswa_to_siswa($host, $email_pengirim, $email_tujuan)
    {

        $sql = mysqli_query($host, "SELECT *FROM pesan_siswa WHERE email_pengirim='$email_pengirim' AND email_tujuan='$email_tujuan' OR email_pengirim='$email_tujuan' AND email_tujuan='$email_pengirim'");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function ShowJumlahPesanSiswaToSiswa($host, $email_pengirim, $email_tujuan)
    {

        $sql = mysqli_query($host, "SELECT *FROM pesan_siswa WHERE email_pengirim='$email_pengirim' AND email_tujuan='$email_tujuan' OR email_pengirim='$email_tujuan' AND email_tujuan='$email_pengirim'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }


    public function InsertPesanSiswaToSiswa($host, $pesan, $email_pengirim, $email_tujuan)
    {

        $view_pengirim = 1;
        $view_tujuan = 0;
        $date_time = $this->GetTime();

        $sql = mysqli_query($host, "INSERT INTO pesan_siswa (pesan, email_pengirim, email_tujuan, view_pengirim, view_tujuan, date_time) VALUES ('$pesan', '$email_pengirim', '$email_tujuan', '$view_pengirim', '$view_tujuan', '$date_time')");

        if ($sql) {

            return true;
        } else {

            echo "SERVER ERROR";
        }
    }

    public function DeletePesanSiswaToSiswa($host, $id_pesan)
    {

        $sql = mysqli_query($host, "DELETE FROM pesan_siswa WHERE id_pesan='$id_pesan'");

        if ($sql) {

            return true;
        } else {

            echo "Server Error";
        }
    }

    public function JumlahSiswaBelumBacaPesan($host, $email_guru, $email_siswa)
    {

        $sql = mysqli_query($host, "SELECT *FROM pesan WHERE email_siswa='$email_siswa' AND email_guru='$email_guru' AND view_siswa=0");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function UpdateSudahDibaca($host, $email_guru, $email_siswa)
    {

        $view_siswa = 1;

        $sql = mysqli_query($host, "UPDATE pesan SET view_siswa='$view_siswa' WHERE email_siswa='$email_siswa' AND email_guru='$email_guru' AND pengirim='guru'");

        if ($sql) {

            return true;
        } else {

            echo "Query Failed";
        }
    }

    public function JumlahPesanBelumTerbaca($host, $email_siswa)
    {

        $view_siswa = 0;

        $sql = mysqli_query($host, "SELECT data_guru.gambar AS gambar_guru, data_guru.email, data_guru.first_name, data_guru.last_name, pesan.id_pesan, pesan.pesan
            FROM data_guru INNER JOIN pesan ON data_guru.email = pesan.email_guru WHERE email_siswa = '$email_siswa' AND view_siswa='$view_siswa'");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function TampilPesanBelumTerbaca($host, $email_siswa)
    {

        $view_siswa = 0;

        $sql = mysqli_query($host, "SELECT data_guru.gambar AS gambar_guru, data_guru.email, data_guru.first_name, data_guru.last_name, pesan.id_pesan, pesan.pesan
            FROM data_guru INNER JOIN pesan ON data_guru.email = pesan.email_guru WHERE email_siswa = '$email_siswa' AND view_siswa='$view_siswa'");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }
}

$control_pesan = new Pesan;

if (isset($_POST['kirim_WA'])) {

    $pesan = $_POST['pesan'];
    $nohp = $_POST['no_tujuan'];

    header("location:https://api.whatsapp.com/send?phone=$nohp&text=$pesan");
} else if (isset($_POST['kirim_email'])) {

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $email_pengirim = $_POST['email_pengirim'];
    $email_tujuan = $_POST['email_tujuan'];
    $subjek = $_POST['subject'];
    $pesan = $_POST['pesan'];
    $header = "Email (Siswa from Siswa) dari " . $email_pengirim;

    $q = $_POST['q'];
    $class_code = $_POST['class_code'];

    mail($email_tujuan, $subjek, $pesan, $header);

    header("location:../../dist/students/Detailpeserta.php?class_code=$class_code&emailok");
} else if (isset($_POST['kirim_pesan'])) {

    $emailGuru = $_POST['email_guru'];
    $emailSiswa = $_POST['email_siswa'];
    $Pesan = $_POST['editor1'];
    $key = $_POST['q'];

    if ($Pesan == NULL) {

        header("location:../../dist/students/send.php?to=$emailGuru&fail");
    } else {

        if ($control_pesan->SendPesanFromSiswaToGuru($host, $emailGuru, $emailSiswa, $Pesan) == true) {

            header("location:../../dist/students/send.php?to=$emailGuru&yes");
        }
    }
} else if (isset($_GET['id_pesan'])) {

    $id_pesan = $_GET['id_pesan'];
    $q = $_GET['q'];
    $to = $_GET['to'];

    if ($control_pesan->DeletePesan($host, $id_pesan) == true) {

        header("location:../../dist/students/send.php?to=$to");
    }
} else if (isset($_POST['kirim_pesan_siswa'])) {

    $email_pengirim = $_POST['email_pengirim'];
    $email_tujuan = $_POST['email_tujuan'];
    $q = $_POST['q'];
    $pesan = $_POST['editor1'];

    if ($pesan == NULL) {

        header("location:../../dist/students/sendTeman.php?to=$email_tujuan&fail");
    } else

        if ($control_pesan->InsertPesanSiswaToSiswa($host, $pesan, $email_pengirim, $email_tujuan) == true) {

        header("location:../../dist/students/sendTeman.php?to=$email_tujuan&yes");
    }
} else if (isset($_GET['hapus_pesan_siswa_to_siswa'])) {

    $q = $_GET['q'];
    $to = $_GET['to'];
    $id_pesan = $_GET['pesan_id'];

    if ($control_pesan->DeletePesanSiswaToSiswa($host, $id_pesan) == true) {

        header("location:../../dist/students/sendTeman.php?to=$to");
    }
} else if (isset($_GET['update'])) {

    $q = $_GET['q'];
    $to = $_GET['to'];
    $email = $_GET['email'];

    if ($control_pesan->UpdateSudahDibaca($host, $to, $email) == true) {

        header("location:../../dist/students/send.php?to=$to");
    }
}
