<?php
    @include '../../config/config.php';

    class dataGuru{

        public function ViewDataInTable($host){

            $sql = mysqli_query($host, "SELECT *FROM data_guru");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function TotalKelas($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author='$email'");

            return mysqli_num_rows($sql);

        }

        public function ViewKelas($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author='$email'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function OnlineChek($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM sessionguru WHERE email='$email'");

            return mysqli_num_rows($sql);

        }

        public function GetDetailGuru($host, $id){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE id='$id'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function EditwithPass($host, $id){

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $nohp = $_POST['nohp'];
            $password = md5($_POST['password']);

            $sql = mysqli_query($host, "UPDATE data_guru SET first_name='$first_name', last_name='$last_name', nohp_guru='$nohp', password='$password' WHERE id='$id'");

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

            $sql = mysqli_query($host, "UPDATE data_guru SET first_name='$first_name', last_name='$last_name', nohp_guru='$nohp' WHERE id='$id'");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

        public function HapusAkun($host, $id){

            $sql = mysqli_query($host, "DELETE FROM data_guru WHERE id='$id'");

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

            $level = "Teachers";

            $sql = mysqli_query($host, "INSERT INTO data_guru (email, password, first_name, last_name, level) VALUES ('$email', '$password', '$first_name', '$last_name', '$level')");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

        public function CekRedudansi($host, $email, $password){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE email='$email' OR password='$password'");

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

            for($i=2; $i<=$baris; $i++){

                $first_name = $data->val($i, 1);
                $last_name = $data->val($i, 2);
                $email = $data->val($i, 3);
                $password = md5($data->val($i, 4));

                if($this->CekRedudansi($host, $email, $password) == true){

                    $sql = mysqli_query($host, "INSERT INTO data_guru (email, password, first_name, last_name, level) VALUES ('$email', '$password', '$first_name', '$last_name', '$level')");

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

    $CrudGuru = new dataGuru;

    if(isset($_POST['update'])){

        if($_POST['password'] == NULL){

            if($CrudGuru->EditNoPassword($host, $_POST['id']) == true){

                header("location:../Dataguru.php?edit_ok");

            }else{

                print_r($_POST);

            }

        }else{

            if($CrudGuru->EditwithPass($host, $_POST['id']) == true){

                header("location:../Dataguru.php?edit_ok");

            }else{

                print_r($_POST);

            }

        }

    }else if(isset($_POST['hapus'])){

        if($CrudGuru->HapusAkun($host, $_POST['id']) == true){

            header("location:Dataguru.php?hapus_ok");

        }

    }else if(isset($_POST['save'])){

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        if($CrudGuru->CekRedudansi($host, $email, $password) == true){

            if($CrudGuru->BuatAkunGuru($host) == true){

                header("location:../Dataguru.php?insert_ok");

            }

        }else{

            header("location:../Dataguru.php?redundan");

        }

    }else if(isset($_POST['import'])){

        if($CrudGuru->cek_ekstensi_xls() == true){
            
            try{

                $CrudSiswa->import_to_excle($host);
                header("location:../DataGuru.php?import_ok");

            }catch(Exception $e){

                echo $e->getMessage();

            }


        }else{

            header("location:../Dataguru.php?exstensi");

        }

    }

?>