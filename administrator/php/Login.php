<?php
    @include '../../config/config.php';

    class Login{

        private $username, $password;
        private $connect = '';

        public function __construct(){
            
            $this->username = $_POST['username'];
            $this->password = $_POST['password'];
            
        }

        public function Chek($server, $username, $db_name, $password){

            session_start();

            $this->connect = new mysqli($server, $username, $password, $db_name);

            $sql = "SELECT *FROM admin WHERE username=? AND password=?";

            $stmt = $this->connect->prepare($sql);

            $stmt->bind_param('ss', $this->username, $this->password);

            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows > 0){

                $_SESSION['admin'] = $this->username;

                $sess = mysqli_query($this->connect, "UPDATE admin SET session='$this->username' WHERE username='$this->username'");

                return true;

            }else{

                return false;

            }

        }

    }

    $login = new Login;

    if(isset($_POST['login'])){

        if($login->Chek($server, $username, $db_name, $password) == true){

            header("location:../Dashboard.php");

        }else{

            header("location:../index.php?fail");

        }

    }
?>