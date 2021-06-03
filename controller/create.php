<?php
    include '../config/config.php';

    class buat_akun{
        var $input;

        public function tambah_data_guru($first_name, $last_name, $email, $password, $level, $host){
            $this->input = mysqli_query($host, "INSERT INTO data_guru (first_name, last_name, email, password, level) VALUES ('$first_name', '$last_name', '$email', '$password', '$level')");
            
            if($this->input){
                header("location:../dist/register.php?success");
            }else{
                header("location:../dist/register.php?email_fail");
            }
        }

        public function tambah_data_siswa($first_name, $last_name, $email, $password, $level, $host){
            $this->input = mysqli_query($host, "INSERT INTO data_siswa (first_name, last_name, email, password, level) VALUES ('$first_name', '$last_name', '$email', '$password', '$level')");
        
            if($this->input){
                header("location:../dist/register.php?success");
            }else{
                header("location:../dist/register.php?email_fail");
            }
        }
    }

    function main($host){
        $buat_akun = new buat_akun;

        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];

        $level = $_POST['level'];

        if($level == "Teachers"){
            $buat_akun->tambah_data_guru($first_name, $last_name, $email, $password, $level, $host);
        }else{
            $buat_akun->tambah_data_siswa($first_name, $last_name, $email, $password, $level, $host);
        }

    }

    function cek($host){
        $password = $_POST['password'];
        $password_confirm = $_POST['confirm_password'];

        if($password == $password_confirm)
        main($host);
        else
        header("location:../dist/register.php?password_fail");
    }

    cek($host);
?>