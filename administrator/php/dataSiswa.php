<?php
    @include '../../config/config.php';

    class dataSiswa{

        public function ViewDataInTable($host){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE confirm=1");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function CekJumlahJoinKelas($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas WHERE email_siswa='$email'");

            return mysqli_num_rows($sql);

        }

        public function ShowKelasJoin($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas WHERE email_siswa='$email'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function OnlineChek($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM sessionsiswa WHERE email='$email'");

            return mysqli_num_rows($sql);

        }

        public function ViewDataEditAndDelete($host, $id){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE id='$id'");

            
            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function EditDataWithPass($host, $id){

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $nohp = $_POST['nohp'];
            $password = md5($_POST['password']);

            $sql = mysqli_query($host, "UPDATE data_siswa SET first_name='$first_name', last_name='$last_name', nohp_siswa='$nohp', password='$password' WHERE id='$id'");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

        public function EditNoPassword($host, $id){

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $nohp = $_POST['nohp'];

            $sql = mysqli_query($host, "UPDATE data_siswa SET first_name='$first_name', last_name='$last_name', nohp_siswa='$nohp' WHERE id='$id'");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

        public function HapusAkun($host, $id){

            $sql = mysqli_query($host, "DELETE FROM data_siswa WHERE id='$id'");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

        public function BuatAkunGuru($host){

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $level = "Students";
            $confirm = 1;

            $sql = mysqli_query($host, "INSERT INTO data_siswa (email, password, first_name, last_name, level, confirm) VALUES ('$email', '$password', '$first_name', '$last_name', '$level', '$confirm')");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

        public function CekRedudansi($host, $email, $password){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email' OR password='$password'");

            $count = mysqli_num_rows($sql);

            if($count == 0){

                return true;

            }else{

                return false;

            }

        }

        public function import_to_excle($host){
            
            error_reporting(E_ERROR | E_PARSE);

            @include '../../src/spreadsheet-reader-master/excel_reader2.php';

            $target = basename($_FILES['file_upload']['name']);
            move_uploaded_file($_FILES['file_upload']['tmp_name'], $target);

            $data = new Spreadsheet_Excel_Reader($_FILES['file_upload']['name'], false);

            $baris = $data->rowcount($sheet_index=0);

            $level = "Teachers";

            $confirm = 1;

            for($i=2; $i<=$baris; $i++){

                $first_name = $data->val($i, 1);
                $last_name = $data->val($i, 2);
                $email = $data->val($i, 3);
                $password = md5($data->val($i, 4));

                if($this->CekRedudansi($host, $email, $password) == true){

                    $sql = mysqli_query($host, "INSERT INTO data_siswa (email, password, first_name, last_name, level, confirm) VALUES ('$email', '$password', '$first_name', '$last_name', '$level', '$confirm')");

                }               

            }

            unlink($_FILES['file_upload']['name']);

            if($sql){
            
                return true;
            
            }else{
            
                throw new Exception("<h1 class='text-center'>Sistem Mendeteksi Bahwa Anda Memasukkan File .XLS yang memiliki isi sama dari yang sebelumnya (Solusi : Buat Data yang isinya berbeda dari sebelumnya / data excle yang belum pernah tersimpan pada table) </h1>");
            
            }

        }


        public function cek_ekstensi_xls(){

            $type_file = explode(".", $_FILES['file_upload']['name']);

            if(strtolower(end($type_file)) != 'xls'){

                return false;

            }else{

                return true;

            }

        }
    }

    $CrudSiswa = new dataSiswa;

    if(isset($_POST['update'])){

        if($_POST['password'] == NULL){

            if($CrudSiswa->EditNoPassword($host, $_POST['id']) == true){

                header("location:../DataSiswa.php?edit_ok");

            }else{

                print_r($_POST);

            }

        }else{

            if($CrudSiswa->EditDataWithPass($host, $_POST['id']) == true){

                header("location:../DataSiswa.php?edit_ok");

            }else{

                print_r($_POST);

            }

        }

    }else if(isset($_POST['hapus'])){

        if($CrudSiswa->HapusAkun($host, $_POST['id']) == true){

            header("location:DataSiswa.php?hapus_ok");

        }

    }else if(isset($_POST['save'])){

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        if($CrudSiswa->CekRedudansi($host, $email, $password) == true){

            if($CrudSiswa->BuatAkunGuru($host) == true){

                header("location:../DataSiswa.php?insert_ok");

            }

        }else{

            header("location:../DataSiswa.php?redundan");

        }

    }else if(isset($_POST['import'])){

        if($CrudSiswa->cek_ekstensi_xls() == true){

            try{

                $CrudSiswa->import_to_excle($host);
                header("location:../DataSiswa.php?import_ok");

            }catch(Exception $e){

                echo $e->getMessage();

            }


        }else{

            header("location:../DataSiswa.php?exstensi");

        }

    }

?>