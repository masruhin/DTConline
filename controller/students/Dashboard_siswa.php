<?php
    @include '../../config/config.php';

    class view{

        public function view_nama_kelas($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas = '$class_code'");

            while($row=mysqli_fetch_array($sql)){

                $nama_kelas = $row['nama_kelas'];

            }

            return $nama_kelas;

        }

        public function cek_jmlh_sesi_kls($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE kd_kls='$class_code'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function view_nama_guru($host, $class_code){

            $kls_join = new join_kelas;

            $get_email_guru = $kls_join->get_email_guru($host, $class_code);

            foreach ($get_email_guru as $guru_email){

                $email_guru = $guru_email['author'];

            }

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE email='$email_guru'");

            while($row=mysqli_fetch_array($sql)){

                $nama_awal = $row['first_name'];
                $nama_akhir = $row['last_name'];
            }

            return $nama_awal." ".$nama_akhir;

        }

        public function view_nama_siswa($host, $q){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");

            while($row=mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

            }

            return array(
                $first_name, $last_name
            );

        }

        public function view_caption($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas='$class_code'");

            while($row=mysqli_fetch_array($sql)){

                $caption = $row['caption'];

            }

            return $caption;

        }

        public function cek_jmlh_kls_join($host, $q){

            $kls_join = new join_kelas;

            $email_arr = $kls_join->get_email($host, $q);

            foreach ($email_arr as $arr_email){

                $email_siswa = $arr_email['email'];

            }

            $sql = mysqli_query($host,"SELECT *FROM tb_siswa_join_kls WHERE email_siswa = '$email_siswa'");
            $count = mysqli_num_rows($sql);

            if($count == 0){

                return false;

            }else{

                return true;

            }

        }

        public function view_class_join($host, $q){

            $kls_join = new join_kelas;

            $email_arr = $kls_join->get_email($host, $q);

            foreach ($email_arr as $arr_email){

                $email_siswa = $arr_email['email'];

            }

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls=identitas_kelas.kode_kelas WHERE email_siswa='$email_siswa'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;
            }

            return $rows;

        }

        public function leave_class($host, $id_join){

            $sql = mysqli_query($host, "DELETE FROM tb_siswa_join_kls WHERE id_join='$id_join'");

            if($sql){
            
                return true;
            
            }else{

                echo "gagal keluar dari kelas";

            }

        }

        public function tampilkanIdentitasSiswa($host, $q){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function UpdateProfileWithPass($host, $id){

            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $nohp = $_POST['nohp'];

            $sql = mysqli_query($host, "UPDATE data_siswa SET first_name='$first_name', last_name='$last_name', email='$email', password='$password', nohp_siswa='$nohp' WHERE id='$id'");

            if($sql){

                return true;

            }else{

                echo "error";

            }

        }

        public function UpdateProfileNoPass($host, $id){

            $first_name = $_POST['firstname'];
            $last_name = $_POST['lastname'];
            $email = $_POST['email'];
            $nohp = $_POST['nohp'];

            $sql = mysqli_query($host, "UPDATE data_siswa SET first_name='$first_name', last_name='$last_name', email='$email', nohp_siswa='$nohp' WHERE id='$id'");

            if($sql){

                return true;

            }else{

                echo "error";

            }

        }

        public function Cek_ekstensi(){

            $Allowed = array("jpg", "png");

            $Getexstension = pathinfo($_FILES['gambar']['name']);

            if(in_array($Getexstension['extension'], $Allowed)){

                return true;

            }else{

                return false;

            }

        }

        public function Editgambar($host, $id){

            //nama direktori
            $nama_direktori = "../../dist/assets/userprofil/";

            $filegambar = $_FILES['gambar']['name'];

            $pathfile = $nama_direktori . $filegambar;

            if(move_uploaded_file($_FILES['gambar']['tmp_name'], $pathfile)){

                $sql = mysqli_query($host, "UPDATE data_siswa SET gambar = '$filegambar' WHERE id='$id'");

                if($sql){
    
                    return true;
    
                }else{
    
                    echo "failed insert filegambar";
    
                }

            }else{

                echo "system erroe 404";

            }

        }

        public function Cekisigambar($host, $q){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password = '$q'");

            while($row = mysqli_fetch_array($sql)){

                $picture = $row['gambar'];

            }

            return $picture;

        }

    }

    class join_kelas{

        public function get_email($host, $q){

            $sql = mysqli_query($host, "SELECT email FROM data_siswa WHERE password='$q'");

            while($row = mysqli_fetch_array($sql)){
                $rows[] = $row;
            }

            return $rows;
        }

        public function get_email_guru($host, $class_code){

            $sql = mysqli_query($host, "SELECT author FROM identitas_kelas WHERE kode_kelas = '$class_code'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function acak_id($lenght){

            $characthers = "012345678910abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $characthers_lenghth = strlen($characthers);

            $random_string = "";

            for($i=0; $i<$lenght; $i++){

                $random_string .=$characthers[rand(0, $characthers_lenghth-1)];

            }

            return $random_string;

        }

        public function cek_kode_kls($host, $inputan_siswa){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas = '$inputan_siswa'");
            $result=mysqli_num_rows($sql);

            if($result == 1){

                return true;

            }else{

                return false;

            }

        }

        public function cekrechord($host, $q, $kode_kelas){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa INNER JOIN tb_siswa_join_kls ON data_siswa.email=tb_siswa_join_kls.email_siswa WHERE password='$q' AND kd_kls='$kode_kelas'");

            $count = mysqli_num_rows($sql);

            return $count;

        }


        public function siswa_join_kelas($host, $inputan_siswa, $q){
            
            if($this->cek_kode_kls($host, $inputan_siswa)==true && $this->cekrechord($host, $q, $inputan_siswa) == 0){

                $id_join = $this->acak_id(50);

                $email_siswa = $this->get_email($host, $q);

                foreach ($email_siswa as $siswa_email){

                    $emailsiswa = $siswa_email['email'];

                }

                $sql = mysqli_query($host, "INSERT INTO tb_siswa_join_kls (id_join, email_siswa, kd_kls) VALUES ('$id_join', '$emailsiswa', '$inputan_siswa')");

                if($sql){

                    return true;

                }else{

                    echo "kesalahan sistem";

                }


            }else{

                return false;

            }

        }

    }


    //controller class join class
    $objek_join_class = new join_kelas;
    $objek_view = new view;


    if(isset($_POST['inputan_kd_kls_siswa'])){

        $q = $_POST['q'];
        $inputan_siswa = $_POST['inputan_codeclass'];

        if($objek_join_class->siswa_join_kelas($host, $inputan_siswa, $q) == true){

            header("location:../../dist/students/index.php?join_ok");

        }else{

            header("location:../../dist/students/index.php?failed");
            
        }


    }else if(isset($_POST['leave_class'])){

        $q = $_POST['q'];
        $id_join = $_POST['id_join'];

        if($objek_view->leave_class($host, $id_join) == true){

            header("location:../../dist/students/index.php?leave_ok");

        }

    }else if(isset($_POST['update_profile'])){

        $pass = $_POST['password'];
        $gambar = $_FILES['gambar']['name'];
        $q = $_POST['q'];

        if($pass == NULL){  //update profile no password

            if($objek_view->UpdateProfileNoPass($host, $_POST['id']) == true){    //hanya profil yang terupdate

                if($gambar == NULL){

                    header("location:../../DestroyedSiswa.php?edit_profile_ok");

                }else{

                    if($objek_view->Cek_ekstensi() == true){

                        if($objek_view->Editgambar($host, $_POST['id']) == true){

                            header("location:../../DestroyedSiswa.php?edit_profile_ok");

                        }else{

                            echo "system not responding";

                        }

                    }else{

                        header("location:../../dist/students/index.php?exstensionfailed");

                    }

                }

            }

        }else{  //update profile with password

            if($objek_view->UpdateProfileWithPass($host, $_POST['id']) == true){   //hanya profile yang terupdate

                if($gambar == NULL){

                    header("location:../../DestroyedSiswa.php?edit_profile_ok");

                }else{

                    if($objek_view->Cek_ekstensi() == true){

                        if($objek_view->Editgambar($host, $_POST['id']) == true){

                            header("location:../../DestroyedSiswa.php?edit_profile_ok");

                        }else{

                            echo "system not responding";

                        }

                    }else{

                        header("location:../../dist/students/index.php?exstensionfailed");

                    }

                }

            }

        }

    }

?>