<?php
    @include '../../config/config.php';

    class dashboard{

        public function DataProfil($host){

            $sql = mysqli_query($host, "SELECT *FROM admin");

            while ($row = mysqli_fetch_array($sql)){

                $nama = $row['nama'];
                $gambar = $row['gambar'];

            }

            return array(

                'nama'=>$nama,
                'gambar'=>$gambar

            );

        }

        public function TotalUserGuru($host){

            $sql = mysqli_query($host, "SELECT *FROM data_guru");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function TotalUserSiswa($host){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE confirm=1");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function TotalKelas($host){


            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas");

            $count = mysqli_num_rows($sql);

            return $count;
        }
        
        public function TotalSiswaOnline($host){

            $sql = mysqli_query($host, "SELECT DISTINCT email FROM sessionsiswa ");

            return mysqli_num_rows($sql);

        }

        public function TotalSiswaOffline($host){

            return $this->TotalUserSiswa($host) - $this->TotalSiswaOnline($host);

        }

        public function RangeSiswaOnline($host){

            return ($this->TotalSiswaOnline($host) / $this->TotalUserSiswa($host)) * 100;

        }

        public function RangeSiswaOfline($host){

            return ($this->TotalSiswaOffline($host) / $this->TotalUserSiswa($host)) * 100;

        }

        public function TotalGuruOnline($host){

            $sql = mysqli_query($host, "SELECT  DISTINCT email FROM sessionguru");

            return mysqli_num_rows($sql);

        }

        public function TotalGuruOffline($host){

            return $this->TotalUserGuru($host) - $this->TotalGuruOnline($host);

        }

        public function RangeGuruOnline($host){

            return ($this->TotalGuruOnline($host) / $this->TotalUserGuru($host)) * 100;

        }

        public function RangeGuruOfline($host){

            return ($this->TotalGuruOffline($host) / $this->TotalUserGuru($host)) * 100;

        }

        public function TotalUser($host){

            return $this->TotalUserGuru($host) + $this->TotalUserSiswa($host);

        }

        public function queryBrowser($host, $browser){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE browser='$browser'");

            $sqli = mysqli_query($host, "SELECT *FROM data_siswa WHERE browser='$browser'");

            return mysqli_num_rows($sql) + mysqli_num_rows($sqli);

        }

        public function GoggleChrome($host){

            return $this->queryBrowser($host, "Google Chrome");

        }

        public function Mozila($host){

            return $this->queryBrowser($host, "Mozilla Firefox");

        }

        public function Opera($host){

            return $this->queryBrowser($host, "Opera");

        }

        public function Safari($host){

            return $this->queryBrowser($host, "Apple Safari");

        }

        public function Explore($host){

            return $this->queryBrowser($host, "Internet Explorer");

        }

        public function GetDay(){

            // Change the line below to your timezone!
            date_default_timezone_set('Asia/Jakarta');

            return date("Y-m-d H:i:s");

        }

        public function JumlahSiswaBelumKonfirmasi($host){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE confirm IS NULL");

            return mysqli_num_rows($sql);

        }

        public function ViewSiswaBelumKonfirmasi($host){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE confirm IS NULL");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function TerimaAkun($host, $id){

            $sql = mysqli_query($host, "UPDATE data_siswa SET confirm = 1 WHERE id='$id'");

            if($sql){

                return true;

            }else{

                echo "error";

            }

        }

        public function TolakAkun($host, $id){

            $sql = mysqli_query($host, "DELETE FROM data_siswa WHERE id='$id'");

            if($sql){

                return true;

            }else{

                echo "error";

            }

        }

        
        public function ViewSessionGuruOnline($host){

            $sql = mysqli_query($host, "SELECT DISTINCT email FROM sessionguru");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;
        }

        public function ViewSessionSiswaOnline($host){

            $sql = mysqli_query($host, "SELECT *FROM sessionsiswa ");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function ViewGuruOnline($host, $email){
            
            $sql  = mysqli_query($host, "SELECT *FROM data_guru WHERE email='$email'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function ViewSiswaOnline($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function GetViewSiswaOnline($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email'");

            return mysqli_num_rows($sql);

        }

    }

    $ConfigDashboard = new dashboard;

    if(isset($_POST['terima_akun'])){

        $id = $_POST['id'];

        if($ConfigDashboard->TerimaAkun($host, $id) == true){

            header("location:../Dashboard.php?terima");
        }

    }else if(isset($_POST['tolak_akun'])){

        $id = $_POST['id'];

        if($ConfigDashboard->TolakAkun($host, $id) == true){

            header("location:../Dashboard.php?tolak");
        }

    }
?>