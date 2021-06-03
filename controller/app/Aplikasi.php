<?php
    @include '../../config/config.php';

    class Aplikasi{

        public function Viewapp($host){

            $sql = mysqli_query($host, "SELECT *FROM tb_aplikasi");

            while ($row = mysqli_fetch_array($sql)){
        
                $nama_aplikasi = $row['nama_app'];
                $favicon = $row['favicon'];
                $logo = $row['logo'];
                $copyright = $row['copyright'];
        
            }
        
            return array($nama_aplikasi, $favicon, $logo, $copyright);

        }

        public function Getnamaguru($host, $key){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password='$key'");

            while($row = mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

                return array(
                    $first_name, $last_name
                );

            }

        }

        public function Getnamasiswa($host, $q){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");

            while($row = mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

                return array(
                    $first_name, $last_name
                );

            }

        }

        public function ViewLayoutDepan($host){

            $sql = mysqli_query($host, "SELECT *FROM breadcrumb");

            while($row = mysqli_fetch_array($sql)){
                
                $rows[] = $row;

            }

            return $rows;

        }

    }

?>