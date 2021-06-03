<?php
    @include './config.php';

    class restart{

        public function Drop($host){

            $dlt1 = mysqli_query($host, "DELETE FROM identitas_kelas");
            $dt2 = mysqli_query($host, "DELETE FROM pesan");
            $dt3 = mysqli_query($host, "DELETE FROM pesan_siswa");
            $dt4 = mysqli_query($host, "DELETE FROM tb_siswa_join_kls");
            $dt5 = mysqli_query($host, "DELETE FROM sessionsiswa");
            $dt6 = mysqli_query($host, "DELETE FROM sessionguru");

            return true;

        }

    }

    $restart = new restart;

    if(isset($_GET['restart'])){

        $restart->Drop($host);

        header("location:../administrator/Restart.php?ok");

    }

?>