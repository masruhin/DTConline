<?php
    class Detailsiswa{

        public function Detailsiswaa($host, $pass_siswa){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password = '$pass_siswa'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;
        }

        public function Statussiswa($host, $pass_siswa){

            $sql = mysqli_query($host, "SELECT *FROM sessionsiswa WHERE SessionId='$pass_siswa'");

            $count = mysqli_num_rows($sql);

            if($count >=1){

                return true;

            }else{

                return false;

            }

        }

        public function Detailsiswajoinkls($host, $email_siswa){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN tb_siswa_join_kls ON identitas_kelas.kode_kelas=tb_siswa_join_kls.kd_kls WHERE email_siswa='$email_siswa'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

    }
?>