<?php
    @include '../../config/config.php';
    @include '../../controller/teachers/Quiz.php';
    @include '../../controller/app/Aplikasi.php';

    session_start();

    if(isset($_SESSION['q'])){

    $q = $_POST['q'];
    $class_code = $_POST['class_code'];
    $id_quiz = $_POST['id_quiz'];
    $id_sesi_kls = $_POST['id_sesi_kls'];
    $id_join = $_POST['id_join'];

    $day_finished = $_POST['hari_selesai'];
    $time_finished = $_POST['waktu_selesai'];

    $layout_quiz = new Quiz_Layout;
    $Identitas_app = new Aplikasi;

    $iden_app_arr = $Identitas_app->Viewapp($host);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz time</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="../js/ColorMultiplate.js"></script>
    <script src="../js/TimeQuizConfig.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

<style>
    .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}

.hidden{
        display: none;
    }
</style>

</head>
<body onload="Configuration_quiz()">
    
<nav class="navbar navbar-dark bg-dark fixed-top">
  <span class="navbar-text"> 
    Quiz Time 
  </span>
  <span class="navbar-text mx-auto" id="waktu_tunggu">
  </span>
</nav>

<form action="../../controller/students/GradeQuiz.php" method="post">

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


<!-- get all id_soal -->
<?php
    $Tot_soal = $layout_quiz->Soaltotal($host, $id_quiz);
    $All_id_soal = $layout_quiz->get_All_id_soal($host, $id_quiz);
    $Tot_essay = $layout_quiz->essay_count($host, $id_quiz);
    $Tot_pilgan = $layout_quiz->pilgan_count($host, $id_quiz);
    foreach ($All_id_soal as $id_soal){

?>

<input type="hidden" name="id_soal[]" value=<?php echo $id_soal['id_soal'] ?>>

<?php } ?>
<!-- end get all id_soal -->

<!-- get total soal -->
<input type="hidden" name="total_soal" id="total_soal" value=<?php echo $Tot_soal ?>>
<!-- end get total soal -->

<!-- send time deadline to js -->
<input type="hidden" id="day_deadline" value=<?php echo $day_finished ?>>
<input type="hidden" id="time_deadline" value=<?php echo $time_finished ?>>

<input type="hidden" id="tot_pilgan" value=<?php echo $Tot_pilgan ?>>
<input type="hidden" id="tot_essay" value=<?php echo $Tot_essay ?>>
<!-- end send time deadline to js -->

<!-- key -->
<input type="hidden" id="q" name="q" value=<?php echo $q ?>>
<input type="hidden" id="id_quiz" name="id_quiz" value=<?php echo $id_quiz ?>>
<input type="hidden" id="id_sesi" name="id_sesi" value=<?php echo $id_sesi_kls ?>>
<input type="hidden" id="id_join" name="id_join" value=<?php echo $id_join ?>>
<input type="hidden" id="class_code" name="class_code" value=<?php echo $class_code ?>>
<!-- end key -->
<div style="margin-top: 85px;">
        
</div>
<?php
    if($layout_quiz->pilgan_count($host, $id_quiz)!=0){
?>

        <?php
            $tampil_pilgan = $layout_quiz->tampilquiz_pilgan($host, $id_quiz);
            $i=1;
            foreach ($tampil_pilgan as $soal_pilgan){
                        
        ?>
 

            <div class="card mb-4 col-lg-10 hidden" id="<?php echo "nav_pilgann".$i ?>">
                <div class="card-body">
                    <!-- Question view  -->
                    
                    <h5 style="color: black;">Question no <span class="badge badge-primary"><?php echo $i; ?></span></h5>
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

                                        <label class='input-group-text' style='background-color: white;' <?php echo "id='pil_a$i'" ?> ><b style="color: black;">A.</b>&nbsp<input type='radio' onclick="mouse_click(id)" <?php echo "id='pil_a$i'" ?> name="pil[<?php echo $soal_pilgan['id_soal'] ?>]" value="pilihan_a"></label>        
                                                                                      
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_a'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <label class='input-group-text' style='background-color: white;' <?php echo "id='pil_b$i'" ?> ><b style="color: black;">B.</b>&nbsp<input type='radio' onclick="mouse_click(id)" <?php echo "id='pil_b$i'" ?> name="pil[<?php echo $soal_pilgan['id_soal'] ?>]" value="pilihan_b"></label>        
                                                                                      
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_b'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <label class='input-group-text' style='background-color: white;' <?php echo "id='pil_c$i'" ?> ><b style="color: black;">C.</b>&nbsp<input type='radio' onclick="mouse_click(id)" <?php echo "id='pil_c$i'" ?> name="pil[<?php echo $soal_pilgan['id_soal'] ?>]" value="pilihan_c"></label>        
                                                                                      
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_c'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <label class='input-group-text' style='background-color: white;' <?php echo "id='pil_d$i'" ?> ><b style="color: black;">D.</b>&nbsp<input type='radio' onclick="mouse_click(id)" <?php echo "id='pil_d$i'" ?> name="pil[<?php echo $soal_pilgan['id_soal'] ?>]" value="pilihan_d"></label>        
                                                                                      
                                        <div class='card border-0'>
                                                <div class='card-body'>
                                                <p class="card-text lead"><?php echo $soal_pilgan['pil_d'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mt-4">
                                    <div class="input-group-prepend">

                                        <label class='input-group-text' style='background-color: white;' <?php echo "id='pil_e$i'" ?> ><b style="color: black;">E.</b>&nbsp<input type='radio' onclick="mouse_click(id)" <?php echo "id='pil_e$i'" ?> name="pil[<?php echo $soal_pilgan['id_soal'] ?>]" value="pilihan_e"></label>        
                                                                                      
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
            <?php
                $k=1;
                $tampil_essay = $layout_quiz->tampilquiz_essay($host, $id_quiz);
                foreach ($tampil_essay as $soal_essay){
            ?>

                <div class="card mb-4 col-xl-10 hidden" id="<?php echo "nav_essayy".$k ?>">
                    <div class="card-body">
                        <h5 style="color: black;">Question no <span class="badge badge-primary"><?php echo $k ?></span></h5>
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
                            
                    <div class="input-group mt-4">
                        <div class="input-group-prepend">
                            <label class='input-group-text' style='background-color: white;'>Answered</label>        
                                <div class='card border-0'>
                                    <div class='card-body'>
                                    
                                    <textarea  rows="3" cols="300" class="form-control" name="pil[<?php echo $soal_essay['id_soal'] ?>]"></textarea>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
    <?php $k++; } ?>
                    
<?php } ?>


<div class="card mb-2 col-xl-10">
        <div class="card-body">
            <?php
                if($layout_quiz->pilgan_count($host, $id_quiz)!=0){
                    $soal_pilgan = $layout_quiz->pilgan_count($host, $id_quiz);
            ?>
            <p class="card-text">Soal pilihan ganda
                <a href="javascript:void(0)" data-toggle="tooltip" title="tampilkan semua soal pilgan" style="float: right;" onclick="view_all_pilgan()"><i class="fas fa-eye" style="font-size: 20px; margin-right:10px;"></i></a>
            </p>

            <hr>
            <h4>
            <?php
                for($pilgan=1; $pilgan<=$soal_pilgan; $pilgan++){
            ?>

            <a href="javascript:void(0)" class="badge badge-info" <?php echo "id=nav_pilgan".$pilgan ?>  onclick="click_nav(id)"><?php echo $pilgan ?></a>

            <?php } ?>
            </h4>
            <?php } ?>


            <?php
                if($layout_quiz->essay_count($host, $id_quiz)!=0){
                    $soal_essay = $layout_quiz->essay_count($host, $id_quiz);
            ?>
            <hr>
            <p class="card-text">Soal essay
                <a href="javascript:void(0)" data-toggle="tooltip" title="tampilkan semua soal essay" style="float: right;" onclick="view_all_essay()"><i class="fas fa-eye" style="font-size: 20px; margin-right:10px;"></i></a>
            </p><hr>
            <h4>
            <?php
                for($essay=1; $essay<=$soal_essay; $essay++){
            ?>

            <a href="javascript:void(0)" <?php echo "id=nav_essay".$essay ?> onclick="click_nav(id)" class="badge badge-success"><?php echo $essay ?></a>

            <?php } ?>
            </h4>
            <?php } ?>

            <hr>
            <button type="submit" class="btn btn-success" name="tombol" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')" >Submit</button>
            <button type="submit" hidden id="tombol_submit_otomatis" name="tombol"></button>
        </div>
    </div>

</form>

<?php } ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        click_nav("nav_pilgan"+1).click();
</script>

</body>
</html>
<?php }else{
    header("location:../../index.php");

} ?>