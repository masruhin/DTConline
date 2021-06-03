<?php
    @include '../../config/config.php';

    class Identitas{

        public function nama_kelas($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas='$class_code'");

            while($row=mysqli_fetch_array($sql)){

                $nama_kelas = $row['nama_kelas'];

            }

            return $nama_kelas;

        }

        public function sesi_kelas($host, $id_sesi, $class_code){

            $nama_kelas = $this->nama_kelas($host, $class_code);

            $sql = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE id_sesi='$id_sesi'");

            while($row=mysqli_fetch_array($sql)){

                $nama_sesi = $row['title'];

            }

            return array(
                $nama_kelas,
                $nama_sesi
            );

        }

    }

    class pengumpulan_tugas{

        public function Jmlh_siswa_kumpul($host, $id_sesi, $class_code){

            $sql = mysqli_query($host, "SELECT DISTINCT join_id FROM tb_siswa_join_kls INNER JOIN tb_pengumpulan_tugas ON tb_siswa_join_kls.id_join=tb_pengumpulan_tugas.join_id WHERE kd_kls='$class_code' AND id_sesi_kls='$id_sesi'");
            $count = mysqli_num_rows($sql);

            return $count;

        }


        public function Tb_pengumpulan_tgs($host, $id_sesi){

            $sql = "SELECT DISTINCT data_siswa.first_name, data_siswa.last_name, tb_pengumpulan_tugas.join_id
            FROM data_siswa JOIN tb_siswa_join_kls ON data_siswa.email = tb_siswa_join_kls.email_siswa JOIN tb_pengumpulan_tugas ON 
            tb_siswa_join_kls.id_join = tb_pengumpulan_tugas.join_id WHERE id_sesi_kls='$id_sesi'"; 

            $Mysql = mysqli_query($host, $sql);

            while ($row = mysqli_fetch_array($Mysql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function hitung_Jmlh_Tgs_PerSiswa($host, $id_sesi, $id_join){

            $sql = mysqli_query($host, "SELECT *FROM tb_pengumpulan_tugas WHERE id_sesi_kls='$id_sesi' AND join_id='$id_join'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function grade_tugas($host, $id_sesi, $id_join){

            $sql = mysqli_query($host, "SELECT DISTINCT nilai FROM tb_pengumpulan_tugas WHERE id_sesi_kls='$id_sesi' AND join_id='$id_join'");

            while($row=mysqli_fetch_array($sql)){

                $nilai = $row['nilai'];

            } 

            if($nilai == null){

                return false;

            }else{

                return $nilai;

            }
        
        }

        public function UbahNilai($host, $id_join, $id_sesi){

            $nilai = $_POST['grade_siswa'];

            $sql = mysqli_query($host, "UPDATE tb_pengumpulan_tugas SET nilai='$nilai' WHERE join_id='$id_join' AND id_sesi_kls='$id_sesi'");

            if($sql){

                return true;

            }else{

                echo "kesalahan update nilai";

            }

        }

        public function Tb_pengumpulan_tugasDetail($host, $id_join, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM tb_pengumpulan_tugas WHERE id_sesi_kls='$id_sesi' AND join_id='$id_join'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function DeleteTugasFromGuru($host, $id_sesi, $id_join){

            $sql = mysqli_query($host, "DELETE FROM tb_pengumpulan_tugas WHERE id_sesi_kls='$id_sesi' AND join_id='$id_join'");

            if($sql){

                return true;

            }else{

                echo "error delete submission :))";

            }


        }

        public function SiswabelumkumpulCount($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls LEFT JOIN tb_pengumpulan_tugas ON tb_siswa_join_kls.id_join = tb_pengumpulan_tugas.join_id WHERE kd_kls = '$class_code' AND nama_file IS NULL");

            $count = mysqli_num_rows($sql);

            return $count;

        
        }

        public function SiswabelumkumpulView($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls LEFT JOIN tb_pengumpulan_tugas ON tb_siswa_join_kls.id_join = tb_pengumpulan_tugas.join_id WHERE kd_kls = '$class_code' AND nama_file IS NULL");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function Getnamasiswa($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email'");

            while ($row = mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $nohp_siswa = $row['nohp_siswa'];
                $password_siswa = $row['password'];

            }

            return array($first_name, $last_name, $nohp_siswa, $password_siswa);

        }

    }

    $objek_Pengumpulan_tgs = new pengumpulan_tugas;

    if(isset($_POST['grade'])){

        $key = $_POST['key'];
        $class_code = $_POST['class_code'];
        $id_sesi = $_POST['id_sesi'];
        $id_join = $_POST['id_join'];

        if($objek_Pengumpulan_tgs->UbahNilai($host, $id_join, $id_sesi) == true){

            header("location:../../dist/guru/classGrade_submission.php?class_code=$class_code&sesi=$id_sesi&nilai_ok");

        }

    }else if(isset($_POST['delete_tugas'])){

        $class_code = $_POST['code_class'];
        $key = $_POST['key'];
        $id_join = $_POST['id_join'];
        $id_sesi = $_POST['id_sesi'];

        if($objek_Pengumpulan_tgs->DeleteTugasFromGuru($host, $id_sesi, $id_join) == true){

            header("location:../../dist/guru/classGrade_submission.php?class_code=$class_code&sesi=$id_sesi&nilai_dlt");

        }

    }else if(isset($_POST['kirim_WA'])){

        $pesan = $_POST['pesan'];
        $nohp = $_POST['numberwa'];

        header("location:https://api.whatsapp.com/send?phone=$nohp&text=$pesan");

    }else if(isset($_POST['kirim_Email'])){

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $email_pengirim = $_POST['email_pengirim'];
        $email_tujuan = $_POST['email_tujuan'];
        $subjek = $_POST['subject'];
        $pesan = $_POST['pesan'];
        $header = "Email (Guru From Siswa) dari ".$email_pengirim;

        $key = $_POST['key'];
        $sesi = $_POST['sesi'];
        $class_code = $_POST['class_code'];

        mail($email_tujuan, $subjek, $pesan, $header);

        header("location:../../dist/guru/classGrade_submission.php?class_code=$class_code&sesi=$sesi&emailok");

    }
?>