<?php
    @include '../../config/config.php';

    class dataKelas{

        public function JumlahKelas($host){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN data_guru ON identitas_kelas.author = data_guru.email");

            return mysqli_num_rows($sql);

        }

        public function ShowKelas($host){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN data_guru ON identitas_kelas.author = data_guru.email");

            while($row = mysqli_fetch_array($sql)){

                $rows [] = $row;

            }

            return $rows;

        }

        public function JumlahSiswaJoinKelas($host, $kd_kelas){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN data_siswa ON tb_siswa_join_kls.email_siswa = data_siswa.email WHERE kd_kls = '$kd_kelas'");

            return mysqli_num_rows($sql);

        }

        public function Deletekelas($host, $kd_kelas){

            $sql = mysqli_query($host, "DELETE FROM identitas_kelas WHERE kode_kelas='$kd_kelas'");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

    }

    $CrudDataKelas = new dataKelas;

    if(isset($_POST['hapus_kelas'])){

        $kode_kelas = $_POST['kode_kelas'];

        if($CrudDataKelas->Deletekelas($host, $kode_kelas) == true){

            header("location:../DataKelas.php?hapus_ok");

        }

    }

?>