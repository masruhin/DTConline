<?php
    @include '../../config/config.php';

    class setDocs{

        public function ViewDataDokumen($host){

            $sql = mysqli_query($host, "SELECT *FROM dokumen");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function EditDocs($host){

            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $kontak = $_POST['kontak'];

            $sql = mysqli_query($host, "UPDATE dokumen SET nama_perusahaan = '$nama', alamat='$alamat', kontak='$kontak'");

            if($sql){

                return true;

            }else{

                return false;

            }

        }

        public function ViewDocs($host){

            $sql = mysqli_query($host, "SELECT *FROM dokumen");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function ViewTbAplikasi($host){

            $sql = mysqli_query($host, "SELECT *FROM tb_aplikasi");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function getKelas($host, $kd_kls){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE kode_kelas='$kd_kls'");
            
            while($row = mysqli_fetch_array($sql)){

                $rows = $row['nama_kelas'];

            }

            return $rows;

        }

    }

    $setDocs = new setDocs;

    if(isset($_POST['simpan'])){

        if($_POST['nama'] != NULL || $_POST['alamat'] != NULL || $_POST['kontak'] != NULL){

            if($setDocs->EditDocs($host) == true){

                header("location:../SetDocs.php?edit_ok");

            }else{

                echo "Gagal Input";

            }

        }else{

            header("location:../SetDocs.php?fail");

        }

    }
?>