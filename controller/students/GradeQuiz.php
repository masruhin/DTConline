<?php
    @include '../../config/config.php';

    class GradeQuiz{

        public function grade_quiz($host){

            $pil = $_POST['pil'];
            $id_soal = $_POST['id_soal'];
            $total_soal = $_POST['total_soal'];

            //user
            $id_join = $_POST['id_join'];
            $id_quiz = $_POST['id_quiz'];

            $benar = 0;
            $salah = 0;
            $kosong = 0;

            for($i=0; $i<$total_soal; $i++){

                //id soal
                $nomor = $id_soal[$i];

                //jika user tdk memilih jawaaban
                if(empty($pil[$nomor])){

                    $kosong ++;

                }else{

                    $jawaban = $pil[$nomor];

                    $sql = mysqli_query($host, "SELECT *FROM soal WHERE id_soal = '$nomor' AND jawaban='$jawaban'");
                    $cek = mysqli_num_rows($sql);

                    $Mysql = mysqli_query($host, "INSERT INTO tb_jawaban_siswa_quiz (id_join, id_soal, id_quiz, jawaban_siswa) VALUES ('$id_join', '$nomor', '$id_quiz', '$jawaban')");
                    
                    if($cek){

                        $benar ++;

                    }else{

                        $salah ++;

                    }

                }

            }

            if($this->hitung_nilai($host, $benar, $salah, $kosong, $total_soal, $id_join, $id_quiz) == true){
                
                return true;
            
            }else{

                echo "kesalahan system";

            }

        }

        public function hitung_nilai($host, $benar, $salah,  $kosong, $jumlah, $id_join, $id_quiz){

            $scoore = $benar * 100 / $jumlah;

            $Mysql = mysqli_query($host, "INSERT INTO tb_grade_quiz (id_join, id_quiz, nilai, jwb_benar, jwb_salah, kosong) VALUES ('$id_join', '$id_quiz', '$scoore', '$benar', '$salah', '$kosong')");

            if($Mysql){

                return true;

            }else{

                echo "esalahan system";

            }

        }


        public function cek_status_quiz_forSiswa($host, $id_join, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz WHERE id_join = '$id_join' AND id_quiz= '$id_quiz'");

            $count = mysqli_num_rows($sql);

            return $count;


        }

        public function nilai_siswa_Forsiswa($host, $id_join, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz WHERE id_join = '$id_join' AND id_quiz= '$id_quiz'");

            while($row=mysqli_fetch_array($sql)){

                $nilai_siswa = $row['nilai'];

            }

            return $nilai_siswa;

        }

        public function Detail_hasil_quiz($host, $id_join, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz WHERE id_join = '$id_join' AND id_quiz= '$id_quiz'");

            while($row=mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function get_NamaSiswa($host, $id_join){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN data_siswa ON tb_siswa_join_kls.email_siswa=data_siswa.email WHERE id_join='$id_join'");
        
            while($row=mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

            }    

            return array(

                $first_name,
                $last_name

            );
        
        }

        public function cek_jawaban_null($host, $id_soal, $id_join, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_jawaban_siswa_quiz WHERE id_soal='$id_soal' AND id_join='$id_join'");

            $count = mysqli_num_rows($sql);

            return $count;

        }


        public function cek_jawaban_siswa($host, $id_soal, $id_join, $id_quiz){

            if($this->cek_jawaban_null($host, $id_soal, $id_join, $id_quiz) == 0){

                $result[] = "null";

                return $result;

            }else{

                $sql = mysqli_query($host, "SELECT *FROM tb_jawaban_siswa_quiz WHERE id_soal='$id_soal' AND id_join='$id_join'");

                while ($row=mysqli_fetch_array($sql)){
    
                    $jawaban_siswa[] = $row['jawaban_siswa'];
    
                }
    
                return $jawaban_siswa;

            }

        }

    }

    class InfoUmumQuiz{

        public function jumlah_soal_pilgan($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM soal WHERE quiz_id = '$id_quiz' AND pil_a IS NOT NULL");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function jumlah_soal_essay($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM soal WHERE quiz_id = '$id_quiz' AND pil_a IS NULL");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function rasio_nilai($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz WHERE id_quiz = '$id_quiz'");

            while($row=mysqli_fetch_array($sql)){

                if($row['nilai'] >= 0 && $row['nilai'] <= 10){

                    $nilai_10_an[] = $row;

                }else if($row['nilai'] >= 11 && $row['nilai'] <= 20){

                    $nilai_20_an[] = $row;

                }else if($row['nilai'] >= 21 && $row['nilai'] <= 30){

                    $nilai_30_an[] = $row;

                }else if($row['nilai'] >= 31 && $row['nilai'] <= 40){

                    $nilai_40_an[] = $row;

                }else if($row['nilai'] >= 41 && $row['nilai'] <=50){

                    $nilai_50_an[] = $row;

                }else if($row['nilai'] >= 51 && $row['nilai'] <=60 ){

                    $nilai_60_an[] = $row;

                }else if($row['nilai'] >= 61 && $row['nilai'] <= 70){

                    $nilai_70_an[] = $row;

                }else if($row['nilai'] >= 71 && $row['nilai'] <= 80){

                    $nilai_80_an[] = $row;

                }else if($row['nilai'] >= 81 && $row['nilai'] <= 90){

                    $nilai_90_an[] = $row;

                }else if($row['nilai'] >=91 && $row['nilai'] <= 100){

                    $nilai_100_an[] = $row;

                }

            }

            if (empty($nilai_10_an)){

                $nilai_10 = 0;

            }else{

                $nilai_10 = count($nilai_10_an);

            }

            if(empty($nilai_20_an)){

                $nilai_20 = 0;

            }else{

                $nilai_20 = count($nilai_20_an);

            }

            if(empty($nilai_30_an)){

                $nilai_30 = 0;

            }else{

                $nilai_30 = count($nilai_30_an);

            }
            
            if(empty($nilai_40_an)){

                $nilai_40 = 0;

            }else{

                $nilai_40 = count($nilai_40_an);

            }

            if(empty($nilai_50_an)){

                $nilai_50 = 0;

            }else{

                $nilai_50 = count($nilai_50_an);

            }

            if(empty($nilai_60_an)){

                $nilai_60 = 0;

            }else{

                $nilai_60 = count($nilai_60_an);

            }

            if(empty($nilai_70_an)){

                $nilai_70 = 0;

            }else{

                $nilai_70 = count($nilai_70_an);

            }

            if(empty($nilai_80_an)){

                $nilai_80 = 0;

            }else{

                $nilai_80 = count($nilai_80_an);

            }

            if(empty($nilai_90_an)){

                $nilai_90 = 0;

            }else{

                $nilai_90 = count($nilai_90_an);

            }

            if(empty($nilai_100_an)){

                $nilai_100 = 0;

            }else{

                $nilai_100 = count($nilai_100_an);

            }

            return array(
                $nilai_10, $nilai_20, $nilai_30, $nilai_40, $nilai_50, 
                $nilai_60, $nilai_70, $nilai_80, $nilai_90, $nilai_100
            );

        }

    }

    class HasilQuiz{

        public function cekNohp($host, $email_siswa){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email_siswa' AND nohp_siswa IS NOT NULL");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function getNohp($host, $email_siswa){

            $sql = mysqli_query($host, "SELECT *FROM data_siswa WHERE email='$email_siswa' AND nohp_siswa IS NOT NULL");

            while ($row = mysqli_fetch_array($sql)){

                $nohp_siswa = $row['nohp_siswa'];

            }

            return $nohp_siswa;

        }

        public function total_siswa_belum_kuis($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz RIGHT JOIN tb_siswa_join_kls ON tb_grade_quiz.id_join=tb_siswa_join_kls.id_join WHERE nilai IS NULL AND kd_kls='$class_code'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function tampil_siswa_belum_kuis($host, $class_code){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz RIGHT JOIN tb_siswa_join_kls ON tb_grade_quiz.id_join=tb_siswa_join_kls.id_join WHERE nilai IS NULL AND kd_kls='$class_code'");

            while ($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;


        }

        public function total_siswa_sudah_quiz($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz WHERE id_quiz='$id_quiz'");

            $count = mysqli_num_rows($sql);

            return $count;

        }

        public function tampil_siswa_sudah_quiz($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM tb_grade_quiz WHERE id_quiz = '$id_quiz' ORDER BY nilai DESC");

            while($row = mysqli_fetch_array($sql)){

                $rows[] = $row;

            }

            return $rows;

        }

        public function tampil_nama_siswa($host, $id_join){

            $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN data_siswa ON tb_siswa_join_kls.email_siswa=data_siswa.email WHERE id_join='$id_join'");

            while($row = mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $pass_siswa = $row['password'];
                $gambar = $row['gambar'];

            }

            return array(
                $first_name,
                $last_name,
                $pass_siswa,
                $gambar
            );
        }


        public function delete_NilaiQuiz($host, $id_join, $id_quiz){

            $sql = mysqli_query($host, "DELETE FROM tb_jawaban_siswa_quiz WHERE id_join='$id_join' AND id_quiz='$id_quiz'");

            if($sql){

                $mysqli = mysqli_query($host, "DELETE FROM tb_grade_quiz WHERE id_join='$id_join' AND id_quiz='$id_quiz'");

                if($mysqli){

                    return true;

                }else{

                    return false;

                }

            }else{

                return false;

            }

        }

        public function Namaquiz($host, $id_quiz){

            $sql = mysqli_query($host, "SELECT *FROM identitas_quiz WHERE id_quiz='$id_quiz'");

            while ($row=mysqli_fetch_array($sql)){

                $nama_quiz = $row['title_quiz'];

            }

            return $nama_quiz;

        }

        public function Author($host, $key){

            $sql = mysqli_query($host, "SELECT *FROM data_guru WHERE password='$key'");

            while ($row=mysqli_fetch_array($sql)){

                $first_name = $row['first_name'];
                $last_name = $row['last_name'];

            }

            return array($first_name, $last_name);

        }
        

    }

    //objek grade quiz
    $objek_gradeQuiz = new GradeQuiz;
    $objek_hasilQuiz = new HasilQuiz;

    if(isset($_POST['tombol'])){

        $q = $_POST['q'];
        $class_code = $_POST['class_code'];

       if($objek_gradeQuiz->grade_quiz($host) == true){

            header("location:../../dist/students/class.php?class_code=$class_code&quiz_ok");

       }

    }else if(isset($_POST['hapus_nilai_quiz'])){

        $id_quiz = $_POST['id_quiz'];
        $id_join = $_POST['id_join'];
        $key = $_POST['key'];
        $class_code = $_POST['class_code'];

        if($objek_hasilQuiz->delete_NilaiQuiz($host, $id_join, $id_quiz) == true){

            header("location:../../dist/guru/quizGrade.php?class_code=$class_code&id_quiz=$id_quiz&dlt_nilai_quiz");

        }else{

            echo "ada yg error";

        }

    }else if(isset($_POST['kirim_Email'])){

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $email_pengirim = $_POST['email_pengirim'];
        $email_tujuan = $_POST['email_tujuan'];
        $subjek = $_POST['subject'];
        $pesan = $_POST['pesan'];
        $header = "Email dari ".$email_pengirim;

        $key = $_POST['key'];
        $sesi = $_POST['sesi'];
        $class_code = $_POST['class_code'];
        $id_quiz = $_POST['id_quiz'];

        mail($email_tujuan, $subjek, $pesan, $header);

        header("location:../../dist/guru/quizGrade.php?class_code=$class_code&id_quiz=$id_quiz&emailok");

    }

?>