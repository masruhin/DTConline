<?php
    class KumpulTugas{

        public function JumlahSeluruhSesiKelas($host, $email){

            $sql = mysqli_query($host, "SELECT identitas_kelas.nama_kelas, identitas_kelas.kode_kelas, sesi_kelas.id_sesi, sesi_kelas.tgl_deadline, sesi_kelas.waktu_posting, sesi_kelas.waktu_deadline, sesi_kelas.title,
            identitas_quiz.id_quiz, identitas_quiz.tgl_mulai, identitas_quiz.tgl_selesai, identitas_quiz.waktu_mulai,
            identitas_quiz.waktu_selesai FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas
            INNER JOIN sesi_kelas ON identitas_kelas.kode_kelas = sesi_kelas.kd_kls LEFT JOIN identitas_quiz ON sesi_kelas.id_sesi = identitas_quiz.id_sesi_kls WHERE email_siswa='$email'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function TampilkanJumlahSeluruhSesiKelas($host, $email){

            $sql = mysqli_query($host, "SELECT identitas_kelas.nama_kelas, identitas_kelas.kode_kelas, sesi_kelas.tgl_deadline, sesi_kelas.id_sesi, sesi_kelas.waktu_posting, sesi_kelas.waktu_deadline, sesi_kelas.title,
            identitas_quiz.id_quiz, identitas_quiz.tgl_mulai, identitas_quiz.tgl_selesai, identitas_quiz.waktu_mulai,
            identitas_quiz.waktu_selesai FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls = identitas_kelas.kode_kelas
            INNER JOIN sesi_kelas ON identitas_kelas.kode_kelas = sesi_kelas.kd_kls LEFT JOIN identitas_quiz ON sesi_kelas.id_sesi = identitas_quiz.id_sesi_kls WHERE email_siswa='$email'");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;


        }

        public function JumlahSiswaBelumKumpulTugas($host, $email, $id_sesi){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls LEFT JOIN tb_pengumpulan_tugas ON tb_siswa_join_kls.id_join = tb_pengumpulan_tugas.join_id WHERE email_siswa='$email' AND id_sesi_kls = '$id_sesi'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function JumlahSiswaBelumQuiz($host, $email, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls LEFT JOIN tb_grade_quiz ON tb_siswa_join_kls.id_join = tb_grade_quiz.id_join WHERE email_siswa='$email' AND id_quiz='$id_quiz'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function Validation($host, $email){

            $Array_Data = $this->TampilkanJumlahSeluruhSesiKelas($host, $email);

            foreach($Array_Data as $Data){

                if($this->JumlahSiswaBelumKumpulTugas($host, $email, $Data['id_sesi']) == 0 || $this->JumlahSiswaBelumKumpulTugas($host, $email, $Data['id_sesi']) == 0){

                    return true;

                }else{

                    return false;

                }

            }

        }

        public function CekJoinKelas($host, $email){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls WHERE email_siswa='$email'");

            return mysqli_num_rows($sql);

        }

    }
?>