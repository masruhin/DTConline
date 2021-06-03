<?php
    @include '../../config/config.php';

    class viewKelas{

        public function CekKelas($host, $kd_kls){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas='$kd_kls'");

            return mysqli_num_rows($sql);

        }

        public function CekSesiKelas($host, $kd_kls){

            $sql = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE kd_kls='$kd_kls'");

            return mysqli_num_rows($sql);

        }

        public function ViewSesiKelas($host, $kd_kls){

            $sql = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE kd_kls = '$kd_kls'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function cek_file_sisip($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM file_sesi_kelas WHERE id_sesi_kls = '$id_sesi'");

            return mysqli_num_rows($sql);

        }

        public function ViewFileSisip($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM file_sesi_kelas WHERE id_sesi_kls = '$id_sesi'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;
        }


        public function CekQuiz($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM identitas_quiz WHERE id_sesi_kls = '$id_sesi'");

            return mysqli_num_rows($sql);

        }

        public function ViewQuiz($host, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM identitas_quiz WHERE id_sesi_kls = '$id_sesi'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function WaktuTunggu($day_deadline, $time_deadline){

            date_default_timezone_set('Asia/Jakarta');

            $deadline_day = (string)$day_deadline;
            $deadline_time = (string)$time_deadline;

            $expired = "$deadline_day $deadline_time";

            $date = new DateTime($expired);
            $now = new DateTime();

            if($now < $date){

                return $now->diff($date)->format('%r%d days, %r%h hours , %r%i minuts');

            }else{

                return false;

            }

        }

        public function GetNamaKlsandAuthor($host, $kd_kls){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN data_guru ON identitas_kelas.author = data_guru.email where kode_kelas='$kd_kls'");

            while($row = mysqli_fetch_array($sql)){

                $nama_kelas = $row['nama_kelas'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

            }

            return array($first_name, $last_name, $nama_kelas);

        }


    }
?>