<?php
    @include '../../config/config.php';

    class peserta_join{

        public function Cek_SiswaOnline($host, $pass_siswa){

            $sql = mysqli_query($host, "SELECT *FROM sessionsiswa WHERE SessionId='$pass_siswa'");

            $count = mysqli_num_rows($sql);

            if($count >= 1){

                return true;

            }else{

                return false;

            }

        }

        public function jmlh_siswa_join_per_kls($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN data_siswa ON tb_siswa_join_kls.email_siswa=data_siswa.email WHERE kd_kls='$class_code'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function tampil_siswa_join_per_kls($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN data_siswa ON tb_siswa_join_kls.email_siswa=data_siswa.email WHERE kd_kls='$class_code'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function save_Datasiswa($host, $class_code){

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $level = "Students";

            $password_md5 = md5($password);

            $sql = mysqli_query($host, "INSERT INTO data_siswa (first_name, last_name, email, password, level) VALUES ('$first_name', '$last_name', '$email', '$password_md5', '$level')");

            if($sql){

                return true;

            }else{
                return false;
            }

        }

        public function Make_Join_Datasiswa_toClass($host, $class_code, $email){

            $id_join = $this->acak_id(50);

            $sql = mysqli_query($host, "INSERT INTO tb_siswa_join_kls (id_join, email_siswa, kd_kls) VALUES ('$id_join', '$email', '$class_code')");

            if($sql){

                return true;

            }else{

                echo "kesalahan saat men joinkan data";

            }

        }

        public function acak_id($length){

            $str        = "";
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz12345678xsdfwQWKJ00HVcMSMSNMSj9Xpc';
            $max        = strlen($characters) - 1;

            for ($i = 0; $i < $length; $i++) {

                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];

            }

            return $str;            

        }

        public function cek_EmailandPass($email, $password, $host){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email = '$email' OR password='$password'");

            $count = mysqli_num_rows($sql);

            if($count == 0){

                return true;

            }else{

                return false;

            }

        }

        public function delete_siswa($host, $id_join){

            $sql = mysqli_query($host, "DELETE FROM tb_siswa_join_kls WHERE id_join = '$id_join'");

            if($sql){

                return true;

            }else{

                echo "gagal hapus siswa";

            }

        }

        public function edit_siswa($host, $email){

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];

            $sql = mysqli_query($host, "UPDATE data_siswa SET first_name='$first_name', last_name='$last_name' WHERE email='$email'");

            if($sql){
                return true;
            }else{
                echo "kesalahan";
            }

        }


    }

    class import_siswa_excle{

        public function import_siswa_to_excle($host, $class_code){

            @include '../../src/spreadsheet-reader-master/excel_reader2.php';

            //create objek from class peserta join
            $join_peserta = new peserta_join;

            $target = basename($_FILES['file_upload']['name']);
            move_uploaded_file($_FILES['file_upload']['tmp_name'], $target);

            $data = new Spreadsheet_Excel_Reader($_FILES['file_upload']['name'], false);

            $baris = $data->rowcount($sheet_index=0);

            $level = "Students";

            for($i=2; $i<=$baris; $i++){

                $first_name = $data->val($i, 1);
                $last_name = $data->val($i, 2);
                $email = $data->val($i, 3);
                $password = md5($data->val($i, 4));

                if($join_peserta->cek_EmailandPass($email, $password, $host) == true){

                    $sql = mysqli_query($host, "INSERT INTO data_siswa (first_name, last_name, email, password, level) VALUES ('$first_name', '$last_name', '$email', '$password', '$level')");

                    if($sql){

                        $id_join = $join_peserta->acak_id(50);

                        $sqli = mysqli_query($host, "INSERT INTO tb_siswa_join_kls (id_join, email_siswa, kd_kls) VALUES ('$id_join', '$email', '$class_code')");

                    }

                }               

            }

            unlink($_FILES['file_upload']['name']);

            if($sqli){
            
                return true;
            
            }else{
            
                return false;
            
            }

        }

        public function cek_ekstensi_xls(){

            $type_file = explode(".", $_FILES['file_upload']['name']);

            if(strtolower(end($type_file)) != 'xls'){

                return "ekstensi_salah";

            }else{

                return "ekstensi_benar";

            }

        }

    }

    $obj_join_peserta = new peserta_join;
    $obj_import_to_excle = new import_siswa_excle;

    if(isset($_POST['save_siswa'])){

        $class_code = $_POST['class_code'];
        $key = $_POST['key'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        

    if($obj_join_peserta->cek_EmailandPass($email, $password, $host) == true){
        if($obj_join_peserta->save_Datasiswa($host, $class_code) == true){

            if($obj_join_peserta->Make_Join_Datasiswa_toClass($host, $class_code, $email) == true){

                header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&save_ok");

            }

        }else{

            header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&email_or_password");

        }

    }else{

        header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&email_or_password");

    }
}else 
    
    if(isset($_POST['import_data_siswa_to_excle'])){

    $class_code = $_POST['class_code'];
    $key = $_POST['key'];

  if($obj_import_to_excle->cek_ekstensi_xls() == "ekstensi_benar"){

    if($obj_import_to_excle->import_siswa_to_excle($host, $class_code) == true){

        header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&import_ok");

    }else{

        header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&email_or_password");

    }

  }else{

        header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&ekstensi");

  }

}else
    if(isset($_POST['delete_siswa'])){

        $key = $_POST['key'];
        $class_code = $_POST['code_class'];
        $id_join =$_POST['id_join'];

        if($obj_join_peserta->delete_siswa($host, $id_join) == true){

            header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&dlt_ok");

        }
    }else

    if(isset($_POST['update_siswa'])){

        $key = $_POST['key'];
        $class_code = $_POST['code_class'];
        $id_join =$_POST['id_join'];
        $email = $_POST['email'];

        if($obj_join_peserta->edit_siswa($host, $email) == true){

            header("location:../../dist/guru/classDetail_siswa.php?class_code=$class_code&edit_ok");

        }

    }


?>