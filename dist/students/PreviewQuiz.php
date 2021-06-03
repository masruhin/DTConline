<?php
    @include '../../config/config.php';
    @include '../../controller/teachers/Quiz.php';
    @include '../../controller/students/GradeQuiz.php';
    @include '../../controller/app/Aplikasi.php';

    session_start();

    if(isset($_SESSION['q']) || isset($_SESSION['key'])){

    $id_quiz = $_POST['id_quiz'];
    $id_join = $_POST['id_join'];

    $layout_quiz = new Quiz_Layout;
    $Quiz_detail = new GradeQuiz;
    $Identitas_app = new Aplikasi;

    $iden_app_arr = $Identitas_app->Viewapp($host);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Preview</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
<style>
    .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>

</head>
<body>
    
<nav class="navbar navbar-dark bg-dark fixed-top">
  <span class="navbar-text"> 
    Preview Quiz
  </span>
  <span class="navbar-text mx-auto" id="waktu_tunggu">
  </span>
</nav>

<form action="#" method="post">

<?php
    if($layout_quiz->totalsoal($host, $id_quiz) == 0){
?>
    <div class="card mb-4">
        <div class="card-body">
            <!-- Question view null -->
                <p class="card-text">Question has not been created.</p>                    
        </div>
    </div>
<?php }else{ ?>

<?php
    if($layout_quiz->tampilquiz_pilgan($host, $id_quiz)!=0){
?>

    <div class="card col-lg-10" style="margin-top: 80px;">
        <div class="card-body">

        <?php
            $Nama_siswaArr = $Quiz_detail->get_NamaSiswa($host, $id_join);
            $Detail_nilai_Arr = $Quiz_detail->Detail_hasil_quiz($host, $id_join, $id_quiz);

            foreach ($Detail_nilai_Arr as $detailNilai){

                $tot_benar = $detailNilai['jwb_benar'];
                $tot_salah = $detailNilai['jwb_salah'];
                $tot_kosong = $detailNilai['kosong'];
                $nilai = $detailNilai['nilai'];

            }
        ?>

        <h6 style="margin-bottom:30px;">Quiz dikerjakan oleh <span class="badge badge-primary"><?php echo $Nama_siswaArr[0]." ".$Nama_siswaArr[1]; ?></span></h6>

        <table class="table table-hover">
        <tbody>
            <tr>
                <td>Total Benar</td>
                <td><?php echo $tot_benar; ?></td>
            </tr>
            <tr>
                <td>Total Salah</td>
                <td><?php echo $tot_salah; ?></td>
            </tr>
            <tr>
                <td>Total Tidak dijawab</td>
                <td><?php echo $tot_kosong; ?></td>
            </tr>
            <tr>
                <td>Nilai anda</td>
                <td><?php echo $nilai; ?></td>
            </tr>
        </tbody>
        </table>


        </div>
    </div>

        <div class="card col-lg-10" style="margin-top: 20px;">
            <div class="card-body">
                <h5>Multiplate choice <span class="badge badge-success"><?php echo $layout_quiz->pilgan_count($host, $id_quiz) ?></span></h5>
            </div>
        </div>


        <?php
            $tampil_pilgan = $layout_quiz->tampilquiz_pilgan($host, $id_quiz);
            $i=1;
            foreach ($tampil_pilgan as $soal_pilgan){
                        
        ?>
 

            <div class="card mb-4 col-lg-10">
                <div class="card-body">
                    <!-- Question view  -->
                    
                    <?php

                        $Cek_jawaban_pilgan = $Quiz_detail->cek_jawaban_siswa($host, $soal_pilgan['id_soal'], $id_join, $id_quiz);

                    ?>

                    <?php
                        if($soal_pilgan['jawaban'] == $Cek_jawaban_pilgan[0]){
                    ?>
                    <h5 style="color: black;"><i class="fas fa-check-square" style="color: green; font-size:20px;"></i> Question no <span class="badge badge-primary"><?php echo $i; ?></span></h5>
                    
                    <?php }else{ ?>
                    
                        <h5 style="color: black;"><i class="fas fa-times-circle" style="color: red; font-size:20px;"></i> Question no <span class="badge badge-primary"><?php echo $i; ?></span></h5>
                    <?php } ?>
                    
                    <hr>
                                
                        <?php
                            $cek_file_pilgan=$layout_quiz->cek_gambar($host, $soal_pilgan['id_soal']);
                            if($cek_file_pilgan == 0){
                                        
                            // no file upload

                            }else{
                                    
                            $tampilgambar=$layout_quiz->tampilgambar($host, $soal_pilgan['id_soal']);

                            ?>

                            <!-- view file  -->
                            <?php
                                if($cek_file_pilgan == 1){
                                foreach ($tampilgambar as $one){
                            ?>
                                <div class="text-center">
                                    <figure class="figure">
                                        <img class="img-fluid" src="<?php echo "../assets/file_quiz/".$one['nama_filesoal']; ?>" alt="Responsive image" width="600" height="600">
                                        <figcaption class="figure-caption"><?php echo $one['nama_filesoal'] ?></figcaption>
                                    </figure>
                                </div>
                            <?php }} ?>

                            <?php
                                if($cek_file_pilgan == 2){
                                foreach ($tampilgambar as $two){                                    
                            ?>
                                <figure class="figure">
                                    <img class="img-fluid mt-3" src="<?php echo "../assets/file_quiz/".$two['nama_filesoal']; ?>" alt="Responsive image" width="500" height="500" style="margin-left: 6px;">
                                        <figcaption class="figure-caption"><?php echo $two['nama_filesoal'] ?></figcaption>
                                    </figure>
                            <?php }} ?>

                            <?php
                                if($cek_file_pilgan == 3){
                                $j=3;
                                foreach ($tampilgambar as $there){
                            ?>
                                        
                            <?php
                                if($j==3){
                            ?>
                                     
                            <div class="text-center">
                                <figure class="figure">
                                    <img class="img-fluid mt-3" src="<?php echo "../assets/file_quiz/".$there['nama_filesoal']; ?>" alt="Responsive image" width="600" height="600">
                                    <figcaption class="figure-caption"><?php echo $there['nama_filesoal'] ?></figcaption>
                                </figure>
                            </div>
                                                            
                            <?php }else if($j<=2){ ?>
                                <figure class="figure">
                                    <img class="img-fluid mt-0" src="<?php echo "../assets/file_quiz/".$there['nama_filesoal']; ?>" alt="Responsive image" width="510" height="600">
                                    <figcaption class="figure-caption"><?php echo $there['nama_filesoal'] ?></figcaption>
                                </figure>
                            <?php }?>

                            <?php $j--;}} ?>                                   
                                    
                            <?php } ?>
                        
                            <p class="card-text lead"><?php echo $soal_pilgan['isi_soal'] ?></p>
                            
                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <?php
                                            if($soal_pilgan['jawaban'] == "pilihan_a"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #66ff66;' ><b style="color: black;">A.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php
                                            }else if($Cek_jawaban_pilgan[0] == "pilihan_a"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #ff8080;' ><b style="color: black;">A.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;' ><b style="color: black;">A.</b>&nbsp<input type='radio' disabled></label>        

                                        <?php } ?>
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_a'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <?php
                                            if($soal_pilgan['jawaban'] == "pilihan_b"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #66ff66;' ><b style="color: black;">B.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php
                                            }else if($Cek_jawaban_pilgan[0] == "pilihan_b"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #ff8080;' ><b style="color: black;">B.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;' ><b style="color: black;">B.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php } ?>
                                        
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_b'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <?php
                                            if($soal_pilgan['jawaban'] == "pilihan_c"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #66ff66;' ><b style="color: black;">C.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php
                                            }else if($Cek_jawaban_pilgan[0] == "pilihan_c"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #ff8080;' ><b style="color: black;">C.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;' ><b style="color: black;">C.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php } ?>                                             
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_c'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <?php
                                            if($soal_pilgan['jawaban'] == "pilihan_d"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #66ff66;' ><b style="color: black;">D.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php
                                            }else if($Cek_jawaban_pilgan[0] == "pilihan_d"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #ff8080;' ><b style="color: black;">D.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;' ><b style="color: black;">D.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php } ?>                                  
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_d'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <?php
                                            if($soal_pilgan['jawaban'] == "pilihan_e"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #66ff66;' ><b style="color: black;">E.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php
                                            }else if($Cek_jawaban_pilgan[0] == "pilihan_e"){
                                        ?>
                                            <label class='input-group-text' style='background-color: #ff8080;' ><b style="color: black;">E.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;' ><b style="color: black;">E.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php } ?>                                  
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_e'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
        <?php $i++; } ?>

    <?php } ?>



    <?php if($layout_quiz->essay_count($host, $id_quiz)!=0){ ?>
        <br>
            <div class="card mb-2 col-xl-10">
                <div class="card-body">
                    <h5>Essay choice <span class="badge badge-success"><?php echo $layout_quiz->essay_count($host, $id_quiz); ?></span></h5>
                </div>
            </div>
                        
            <?php
                $k=1;
                $tampil_essay = $layout_quiz->tampilquiz_essay($host, $id_quiz);
                foreach ($tampil_essay as $soal_essay){
            ?>

                <?php
                    $Jawaban_siswa_essay = $Quiz_detail->cek_jawaban_siswa($host, $soal_essay['id_soal'], $id_join, $id_quiz);
                ?>

                <div class="card mb-4 col-xl-10">
                    <div class="card-body">
                    <?php
                        if($soal_essay['jawaban'] == $Jawaban_siswa_essay[0]){
                    ?>
                    <h5 style="color: black;"><i class="fas fa-check-square" style="color: green; font-size:20px;"></i> Question no <span class="badge badge-primary"><?php echo $k; ?></span></h5>
                    
                    <?php }else{ ?>
                    
                        <h5 style="color: black;"><i class="fas fa-times-circle" style="color: red; font-size:20px;"></i> Question no <span class="badge badge-primary"><?php echo $k; ?></span></h5>
                    <?php } ?>
                            <hr>
                            
                            <?php
                                $cek_file_essay=$layout_quiz->cek_gambar($host, $soal_essay['id_soal']);
                                if($cek_file_essay== 0){
                                        
                                    // no file upload

                                }else{
                                    
                                $tampilgambar=$layout_quiz->tampilgambar($host, $soal_essay['id_soal']);

                                ?>

                                <!-- view file  -->
                                <?php
                                if($cek_file_essay == 1){
                                    foreach ($tampilgambar as $one){
                                ?>
                                <div class="text-center">
                                    <figure class="figure">
                                        <img class="img-fluid" src="<?php echo "../assets/file_quiz/".$one['nama_filesoal']; ?>" alt="Responsive image" width="600" height="600">
                                        <figcaption class="figure-caption"><?php echo $one['nama_filesoal'] ?></figcaption>
                                    </figure>
                                </div>
                                <?php }} ?>

                                <?php
                                if($cek_file_essay == 2){
                                    foreach ($tampilgambar as $two){                                    
                                ?>
                                <figure class="figure">
                                    <img class="img-fluid mt-3" src="<?php echo "../assets/file_quiz/".$two['nama_filesoal']; ?>" alt="Responsive image" width="500" height="500" style="margin-left: 6px;">
                                        <figcaption class="figure-caption"><?php echo $two['nama_filesoal'] ?></figcaption>
                                </figure>
                                <?php }} ?>

                                <?php
                                    if($cek_file_essay == 3){
                                        $j=3;
                                        foreach ($tampilgambar as $there){
                                    ?>
                                        
                                <?php
                                    if($j==3){
                                ?>
                                     
                                <div class="text-center">
                                    <figure class="figure">
                                        <img class="img-fluid mt-3" src="<?php echo "../assets/file_quiz/".$there['nama_filesoal']; ?>" alt="Responsive image" width="600" height="600">
                                        <figcaption class="figure-caption"><?php echo $there['nama_filesoal'] ?></figcaption>
                                    </figure>
                                </div>
                                                            
                                <?php }else if($j<=2){ ?>
                                    <figure class="figure">
                                        <img class="img-fluid mt-0" src="<?php echo "../assets/file_quiz/".$there['nama_filesoal']; ?>" alt="Responsive image" width="510" height="600">
                                        <figcaption class="figure-caption"><?php echo $there['nama_filesoal'] ?></figcaption>
                                    </figure>
                                <?php }?>

                                <?php $j--;}} ?>                                   
                                    
                            <?php } ?>
                                                   
                        <p class="card-text lead"><?php echo $soal_essay['isi_soal'] ?></p>
                    


                    <?php
                        if($Jawaban_siswa_essay[0] == $soal_essay['jawaban']){
                    ?>

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <label class='input-group-text' style='background-color: #66ff66;'>Your Answered</label>        
                                <div class='card border-0'>
                                    <div class='card-body'>
                                    
                                    <textarea  rows="3" cols="300" class="form-control" readonly style="background-color: white;"><?php echo $Jawaban_siswa_essay[0]; ?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else if($Jawaban_siswa_essay[0] != $soal_essay['jawaban'] && $Jawaban_siswa_essay[0] != "null"){ ?>

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <label class='input-group-text' style='background-color: #66ff66;'>Answered True</label>        
                                <div class='card border-0'>
                                    <div class='card-body'>
                                    
                                    <textarea  rows="3" cols="300" class="form-control" readonly style="background-color: white;"><?php echo $soal_essay['jawaban']; ?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>   
                    

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <label class='input-group-text' style='background-color: #ff8080;'>Your Answered</label>        
                                <div class='card border-0'>
                                    <div class='card-body'>
                                    
                                    <textarea  rows="3" cols="300" class="form-control" readonly style="background-color: white;"><?php echo $Jawaban_siswa_essay[0]; ?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else if($Jawaban_siswa_essay[0] == "null"){ ?>

                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <label class='input-group-text' style='background-color: white;'>Answered</label>        
                                <div class='card border-0'>
                                    <div class='card-body'>
                                    
                                    <textarea  rows="3" cols="300" class="form-control" readonly style="background-color: white;"><?php echo $soal_essay['jawaban'] ?></textarea>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>
    <?php $k++; } ?>
                    
<?php } ?>


</form>

<?php } ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php
    }else{
        header("location:../../index.php");
    }
?>