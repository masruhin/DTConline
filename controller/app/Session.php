<?php
    class Session{

        public function ChekSessionGuru($host, $key){

            $sql = mysqli_query($host, "SELECT *FROM data_guru where password='$key'");
  
            $count = mysqli_num_rows($sql);
  
            return $count;
  
          }
  
          public function ChekSessionSiswa($host, $q){
  
            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");
  
            $count = mysqli_num_rows($sql);
  
            return $count;
  
          }
  
          public function ShowProfileGuru($host, $key){
  
            $sql = mysqli_query($host, "SELECT *FROM data_guru where password='$key'");
  
            while($row = mysqli_fetch_array($sql)){
  
              $rows[] = $row;
  
            }
  
            return $rows;
  
          }
  
          public function ShowProfilSiswa($host, $q){
  
            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE password='$q'");
  
            while($row = mysqli_fetch_array($sql)){
  
              $rows[] = $row;
  
            }
  
            return $rows;
  
          }

          public function DataKelas($host, $id){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE id_kls='$id'");

            $count = mysqli_num_rows($sql);

            if($count > 0){

              return true;
              
            }else{

              return false;

            }

          }

          public function TampilDataKelas($host, $id){

            $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN data_guru ON identitas_kelas.author = data_guru.email WHERE id_kls='$id'");

            while($row = mysqli_fetch_array($sql)){
                
              $rows[] = $row;

            }

            return $rows;

          }

          public function jmlh_siswa_join_per_kls($host, $id){

            $sql = mysqli_query($host, "SELECT identitas_kelas.nama_kelas, identitas_kelas.id_kls, tb_siswa_join_kls.email_siswa, data_siswa.first_name, data_siswa.last_name
            FROM identitas_kelas INNER JOIN tb_siswa_join_kls ON identitas_kelas.kode_kelas = tb_siswa_join_kls.kd_kls INNER JOIN
            data_siswa ON tb_siswa_join_kls.email_siswa = data_siswa.email WHERE id_kls='$id'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

    }

?>