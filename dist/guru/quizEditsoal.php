<?php
    @include '../../config/config.php';
    @include '../../controller/inisial.php';
    @include '../../controller/teachers/Class.php';
    @include '../../controller/teachers/Quiz.php';
    @include '../../controller/app/Aplikasi.php';
    @include '../../controller/teachers/Dashboard.php';
    @include '../../controller/teachers/Messange.php';

    session_start();

    if(isset($_SESSION['key'])){

    if(isset($_GET['class_code']) && isset($_GET['id_quiz'])){
        
        $key = $_SESSION['key'];
        $class_code = $_GET['class_code'];
        $id_quiz = $_GET['id_quiz'];

        //inisialissasi
        chek_quizguru($key, $host, $class_code, $id_quiz);
        $chek_class = new statistic;
        $messange = new Messange;
        $general_objek = new general; //objek general
        $quiz_layout = new Quiz_Layout; //objek quiz layout
        $Identitas_app = new Aplikasi;
        $email_get = new ajax_input_kelas;

        $iden_app_arr = $Identitas_app->Viewapp($host);
        $email = $email_get->email_user($host, $key);
        $My_name = array();
        $My_name = main("Nama", $key, $host);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Quiz-Teachers</title>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">

        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="../assets/ckeditor/ckeditor.js"></script>
        <script src="../js/quizchoose.js"></script>
        <script src="../js/file_editsoal.js"></script>
        <script src="../js/editsoal_file.js"></script>
        <script src="../js/ColorMultiplate.js"></script>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <body class="sb-nav-fixed">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                
            <a class="navbar-brand" href="javscript:void(0)">
                <h6>
                    <?php
                        if($chek_class->Cekisigambar($host, $key) == NULL){
                    ?>
                        <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo substr($My_name[1]." ".$My_name[0], 0, 20)  ?>
                    <?php
                        }else{
                            $mygambar = $chek_class->Cekisigambar($host, $key);
                            echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> ".substr($My_name[1]." ".$My_name[0], 0, 20)."" ;

                        }
                    ?>
                
                </h6>
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button><!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                </form>
                <!-- Navbar-->
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="../../DestroyedGuru.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>
    
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">Core</div>
                                <a class="nav-link" href="<?php echo"quiz.php?class_code=$class_code&id_quiz=$id_quiz" ?>"><div class="sb-nav-link-icon"><i class="fas fa-rocket"></i></div>Quiz Home</a>
                                <a class="nav-link" href="<?php echo "../../index.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home</a>

                                <div class="sb-sidenav-menu-heading">Control Quiz</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Modul Quiz
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo"quizCreatesoal.php?class_code=$class_code&id_quiz=$id_quiz" ?>"><div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>Create question</a></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="javascript:void(0)"><div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>Edit question</a></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo"<a class='nav-link' href='#import_soal' data-toggle='modal' data-id_quiz=''><div class='sb-nav-link-icon'><i class='fas fa-file-excel'></i></div>Import question</a>";?></nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Modul Participant
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                 <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                 <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo"quizGrade.php?class_code=$class_code&id_quiz=$id_quiz" ?>"><div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>Grade participant</a></nav>
                                </div>
                                <div class="sb-sidenav-menu-heading">Communication</div>

                                <?php
                                    if($messange->CekJumlaPesanMasukForGuru($host, $email) == 0){
                                        
                                        echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange</a>";

                                    }else{

                                        echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange&nbsp; <span class='badge badge-danger'>New</span></a>";

                                    }
                                ?>
                            </div>
                        </div>
                        <div class="sb-sidenav-footer">
                        <div class="small">Login Sebagai:</div>
                                Guru
                        </div>
                    </nav>
                </div>
                
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <?php
                            $namakelas=$objek_general->this_name_class($host, $class_code);
                            $namasesi=$quiz_layout->get_namesession($host, $id_quiz);

                            foreach($namakelas as $class_name){
                                $classname = $class_name['nama_kelas'];
                            }

                            foreach($namasesi as $sesion_name){
                                $sesionname = $sesion_name['title'];
                            }

                        ?>

                        <h4 class="mt-3">
                            Edit Soal Quiz Kelas <?php echo $classname ?> Sesi <?php echo $sesionname ?>
                        </h4>
                        <ol class="breadcrumb mb-4 mt-3">
                            <li class="breadcrumb-item"><a href=<?php echo"index.php"; ?>>Dashboard</a></li>
                            <li class="breadcrumb-item"><a href=<?php echo"class.php?class_code=$class_code"; ?>><?php echo $classname; ?></a></li>
                            <li class="breadcrumb-item"><a href=<?php echo"quiz.php?class_code=$class_code&id_quiz=$id_quiz"; ?>><?php echo "Quiz home"; ?></a></li>
                            <li class="breadcrumb-item active">Edit Question</li>
                        </ol>

                        <?php
                            if(isset($_GET['edit_ok'])) {
                        ?>
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Question was successfully edited
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['dlt'])) {
                        ?>
                        
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Question was successfully deleted
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['exstension_false'])) {
                        ?>
                        
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Error</strong> Exstension failed
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        
                        <?php 
                            if($quiz_layout->totalsoal($host, $id_quiz) == 0){
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Question view null -->
                                <p class="card-text">Soal belum dibuat, click <a href=<?php echo"quizCreatesoal.php?key=$key&class_code=$class_code&id_quiz=$id_quiz"; ?>>disini</a> untuk membuat soal.</p>
                    
                            </div>
                        </div>

                        <?php }else{ ?>

                            <?php
                                $Tot_pilgan = $quiz_layout->pilgan_count($host, $id_quiz);
                                $Tot_essay = $quiz_layout->essay_count($host, $id_quiz);
                            ?>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <?php
                                        if($quiz_layout->pilgan_count($host, $id_quiz)!=0){
                                            $soal_pilgan = $quiz_layout->pilgan_count($host, $id_quiz);
                                    ?>
                                    <p class="card-text">Navigasi Soal pilihan ganda
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
                                    <hr>
                                    <?php } ?>


                                    <?php
                                        if($quiz_layout->essay_count($host, $id_quiz)!=0){
                                            $soal_essay = $quiz_layout->essay_count($host, $id_quiz);
                                    ?>

                                    <p class="card-text">Navigasi Soal essay
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

                                </div>
                            </div>

                            <input type="hidden" id="tot_pilgan" value=<?php echo $Tot_pilgan ?>>
                            <input type="hidden" id="tot_essay" value=<?php echo $Tot_essay ?>>

                        <?php
                            if($quiz_layout->pilgan_count($host, $id_quiz)!=0){
                        ?>

                        <?php
                            $tampil_pilgan = $quiz_layout->tampilquiz_pilgan($host, $id_quiz);
                            $i=1;
                            foreach ($tampil_pilgan as $soal_pilgan){
                        
                        ?>
 

                        <div class="card mb-4 hidden" id="<?php echo "nav_pilgann".$i ?>">
                            <div class="card-body">
                                <!-- Question view  -->
                                <?php echo"<a href='#delete_soal_pilgan' data-toggle='modal' style='float: right;' data-tootlip='tooltip' data-id_soal_pilgan='$soal_pilgan[id_soal]' data-nomor_pilgan='$i' data-placement='top' title='Delete question'><i class='fas fa-trash-alt' style='font-size: 16px; color:red;'></i></a>";?>
                                <h5 style="color: black;">Pertanyaan no <span class="badge badge-primary"><?php echo $i; ?></span></h5>
                                <hr>
                                
                                <?php
                                    $cek_file_pilgan=$quiz_layout->cek_gambar($host, $soal_pilgan['id_soal']);
                                    if($cek_file_pilgan == 0){
                                        
                                        // no file upload

                                    }else{
                                    
                                    $tampilgambar=$quiz_layout->tampilgambar($host, $soal_pilgan['id_soal']);

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

                                <?php echo"<a href='#edit_soal_pilgan' data-toggle='modal' style='float: right;' data-id_soal_pilgan='$soal_pilgan[id_soal]' data-nomor_pilgan='$i' data-tootlip='tooltip' data-placement='top' title='edit question'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                                <p class="card-text lead"><?php echo $soal_pilgan['isi_soal'] ?></p>
                            
                                <?php echo"<a href='#edit_a' data-toggle='modal' style='float: right;' data-id_soal_pilgan='$soal_pilgan[id_soal]' data-nomor_pilgan='$i' data-tootlip='tooltip' data-placement='top' title='edit multiplate A'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                                    <div class="input-group mt-4">
                                        <div class="input-group-prepend">
                                            <?php
                                                if($soal_pilgan['jawaban'] == 'pilihan_a'){
                                            ?>
                                            <label class='input-group-text' style='background-color: #339cff;'><b style="color: black;">A.</b>&nbsp<input type='radio' checked></label>        
                                            <?php }else{ ?>
                                                <label class='input-group-text' style='background-color: white;'><b style="color: black;">A.</b>&nbsp<input type='radio' disabled></label>        
                                            <?php } ?>
                                            
                                            <div class='card border-0'>
                                                    <div class='card-body'>
                                                    <p class="card-text lead"><?php echo $soal_pilgan['pil_a'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php echo"<a href='#edit_b' data-toggle='modal' style='float: right;' data-id_soal_pilgan='$soal_pilgan[id_soal]' data-nomor_pilgan='$i' data-tootlip='tooltip' data-placement='top' title='edit multiplate B'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                                    <div class="input-group mt-4">
                                        <div class="input-group-prepend">
                                        <?php
                                            if($soal_pilgan['jawaban'] == 'pilihan_b'){
                                        ?>
                                            <label class='input-group-text' style='background-color: #339cff;'><b style="color: black;">B.</b>&nbsp<input type='radio' checked></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;'><b style="color: black;">B.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php } ?>

                                                <div class='card border-0'>
                                                    <div class='card-body'>
                                                    <p class="card-text lead"><?php echo $soal_pilgan['pil_b'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php echo"<a href='#edit_c' data-toggle='modal' style='float: right;' data-id_soal_pilgan='$soal_pilgan[id_soal]' data-nomor_pilgan='$i' data-tootlip='tooltip' data-placement='top' title='edit multiplate C'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                                    <div class="input-group mt-4">
                                        <div class="input-group-prepend">
                                        <?php
                                            if($soal_pilgan['jawaban'] == 'pilihan_c'){
                                        ?>
                                            <label class='input-group-text' style='background-color: #339cff;'><b style="color: black;">C.</b>&nbsp<input type='radio' checked></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;'><b style="color: black;">C.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php } ?>
                                                <div class='card border-0'>
                                                    <div class='card-body'>
                                                    <p class="card-text lead"><?php echo $soal_pilgan['pil_c'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php echo"<a href='#edit_d' data-toggle='modal' style='float: right;' data-id_soal_pilgan='$soal_pilgan[id_soal]' data-nomor_pilgan='$i' data-tootlip='tooltip' data-placement='top' title='edit multiplate D'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                                    <div class="input-group mt-4">
                                        <div class="input-group-prepend">
                                        <?php
                                            if($soal_pilgan['jawaban'] == 'pilihan_d'){
                                        ?>
                                            <label class='input-group-text' style='background-color: #339cff;'><b style="color: black;">D.</b>&nbsp<input type='radio' checked></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;'><b style="color: black;">D.</b>&nbsp<input type='radio' disabled></label>        
                                        <?php } ?>
                                                <div class='card border-0'>
                                                    <div class='card-body'>
                                                    <p class="card-text lead"><?php echo $soal_pilgan['pil_d'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php echo"<a href='#edit_e' data-toggle='modal' style='float: right;' data-id_soal_pilgan='$soal_pilgan[id_soal]' data-nomor_pilgan='$i' data-tootlip='tooltip' data-placement='top' title='edit multiplate E'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                                    <div class="input-group mt-4">
                                        <div class="input-group-prepend">
                                        <?php
                                            if($soal_pilgan['jawaban'] == 'pilihan_e'){
                                        ?>
                                            <label class='input-group-text' style='background-color: #339cff;'><b style="color: black;">E.</b>&nbsp<input type='radio' checked></label>        
                                        <?php }else{ ?>
                                            <label class='input-group-text' style='background-color: white;'><b style="color: black;">E.</b>&nbsp<input type='radio' disabled></label>        
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



                        <?php if($quiz_layout->essay_count($host, $id_quiz)!=0){ ?>
                            <br>
                        
                        <?php
                            $k=1;
                            $tampil_essay = $quiz_layout->tampilquiz_essay($host, $id_quiz);
                            foreach ($tampil_essay as $soal_essay){
                        ?>

                        <div class="card mb-4 hidden" style="margin-top: -22px;" id="<?php echo "nav_essayy".$k ?>">
                            <div class="card-body">
                            <?php echo"<a href='#delete_soal_essay' data-toggle='modal' style='float: right;' data-tootlip='tooltip' data-nomor_essay='$k' data-id_soal_essay='$soal_essay[id_soal]' data-placement='top' title='Delete question'><i class='fas fa-trash-alt' style='font-size: 16px; color:red;'></i></a>";?>
                            <h5 style="color: black;">Pertanyaan no <span class="badge badge-success"><?php echo $k ?></span></h5>
                            <hr>
                            
                                <?php
                                    $cek_file_essay=$quiz_layout->cek_gambar($host, $soal_essay['id_soal']);
                                    if($cek_file_essay== 0){
                                        
                                        // no file upload

                                    }else{
                                    
                                    $tampilgambar=$quiz_layout->tampilgambar($host, $soal_essay['id_soal']);

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
                            
                            <?php echo"<a href='#edit_soal_essay' data-toggle='modal' data-id_soal_essay='$soal_essay[id_soal]' data-nomor_essay='$k' style='float: right;' data-tootlip='tooltip' data-placement='top' title='edit question'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                            <p class="card-text lead"><?php echo $soal_essay['isi_soal'] ?></p>


                            <?php echo"<a href='#edit_jwb_essay' data-toggle='modal' style='float: right;' data-id_soal_essay='$soal_essay[id_soal]' data-nomor_essay='$k' data-tootlip='tooltip' data-placement='top' title='edit answered'><i class='fas fa-edit' style='font-size: 16px;'></i></a>";?>
                            <div class="input-group mt-4">
                                <div class="input-group-prepend">
                                    <label class='input-group-text' style='background-color: #339cff;'><b style="color: white;">Answered</b></label>        
                                        <div class='card border-0'>
                                            <div class='card-body'>
                                            <p class="card-text"><?php echo $soal_essay['jawaban'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            </div>
                        </div>
                        <?php $k++; } ?>
                    
                        <?php } ?>

                    <?php } ?>

                </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"><?php echo $iden_app_arr[3]; ?> </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <?php echo"<input type='hidden' id='key' value='$key'>";?>
        <?php echo"<input type='hidden' id='code_class' value='$class_code'>";?>
        <?php echo"<input type='hidden' id='id_quiz' value='$id_quiz'>";?>

        <!-- modal dlt question pilgan-->
        <div class="modal fade" id="delete_soal_pilgan" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm delete Question multiple choice</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_delete_soal_pilgan"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal dlt question pilgan-->

        <!-- modal dlt question essay-->
        <div class="modal fade" id="delete_soal_essay" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm delete Question essay</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_delete_soal_essay"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal dlt question essay-->

        <!-- modal edit question pilgan A-->
        <div class="modal fade" id="edit_a" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Question multiple choice A</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_a"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit question pilgan A-->

        <!-- modal edit question pilgan B-->
        <div class="modal fade" id="edit_b" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Question multiple choice B</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_b"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit question pilgan B-->

        <!-- modal edit question pilgan C-->
        <div class="modal fade" id="edit_c" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Question multiple choice C</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_c"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit question pilgan C-->

        <!-- modal edit jawaban essay-->
        <div class="modal fade" id="edit_jwb_essay" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Answered essay choice</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_jwb_essay"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit jawban essay-->

        <!-- modal edit pilihan d-->
        <div class="modal fade" id="edit_d" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Question multiple choice D</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_d"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit pilihan d-->

        <!-- modal edit pilihan e-->
        <div class="modal fade" id="edit_e" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Question multiple choice E</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_e"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit pilihan e-->


        <!-- modal edit question essay-->
        <div class="modal fade" id="edit_soal_essay" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Question Essay</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_soal_essay"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit question essay-->

        <!-- modal edit soal pilgan-->
        <div class="modal fade" id="edit_soal_pilgan" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm Edit Question multiple choice</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_edit_soal_pilgan"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit soal pulgan-->


        <?php echo"<input type='hidden' id='key' value='$key'>";?>
        <?php echo"<input type='hidden' id='code_class' value='$class_code'>";?>
        <?php echo"<input type='hidden' id='id_quiz' value='$id_quiz'>";?>

        <!-- modal import soal from excle-->
        <div class="modal fade" id="import_soal" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Import Question</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_import_soal"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal import soal from excle-->

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/import.js"></script>
        <?php
            if(isset($_GET['exstension_false'])){
        ?>
        <script>
            swal({
            title: "Exstension failed !",
            text: "Im sorry!",
            icon: "warning",
            button: "Ok!",
            });
        </script>
        <?php } ?>


        <script>
        //ajax import soal
        $(document).ready(function(){
            $('#import_soal').on('show.bs.modal', function(e){

                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                
                $.ajax({
                    url : '../../controller/teachers/ajax/ajax_import_soal.php',
                    type : 'POST',
                    data : {'key':key, 'class_code':class_code, 'id_quiz':id_quiz},
                    success : function(data){
                        $('.modal_import_soal').html(data);
                    }
                });
            });
        });
        //end ajax import soal
        </script>

        <script>

        //ajax delete soal pilgan
        $(document).ready(function(){
            $('#delete_soal_pilgan').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_pilgan');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_pilgan');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_delete_pilgan.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_delete_soal_pilgan').html(data);
                    }
                });
            });
        });
        //end ajax delete soal pilgan

        //ajax delete soal essay
        $(document).ready(function(){
            $('#delete_soal_essay').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_essay');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_essay');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_delete_essay.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_delete_soal_essay').html(data);
                    }
                });
            });
        });
        //end ajax delete soal essay


        //ajax edit pil_a
        $(document).ready(function(){
            $('#edit_a').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_pilgan');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_pilgan');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_edit_a.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_a').html(data);
                    }
                });
            });
        });
        //end ajax edit pil_a

        //ajax edit pil_b
        $(document).ready(function(){
            $('#edit_b').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_pilgan');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_pilgan');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_edit_b.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_b').html(data);
                    }
                });
            });
        });
        //end ajax edit pil_b

        //ajax edit pil_c
        $(document).ready(function(){
            $('#edit_c').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_pilgan');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_pilgan');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_edit_c.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_c').html(data);
                    }
                });
            });
        });
        //end ajax edit pil_c

        //ajax edit pil_d
        $(document).ready(function(){
            $('#edit_d').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_pilgan');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_pilgan');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_edit_d.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_d').html(data);
                    }
                });
            });
        });
        //end ajax edit pil_d

        //ajax edit pil_e
        $(document).ready(function(){
            $('#edit_e').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_pilgan');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_pilgan');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_edit_e.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_e').html(data);
                    }
                });
            });
        });
        //end ajax edit pil_e

        //ajax edit jwb essay
        $(document).ready(function(){
            $('#edit_jwb_essay').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_essay');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_essay');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_edit_jwb_essay.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_jwb_essay').html(data);
                    }
                });
            });
        });
        //end ajax jwb essay

        //ajax edit soal pilgan
        $(document).ready(function(){
            $('#edit_soal_pilgan').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_pilgan');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_pilgan');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_editSoal_pilgan.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_soal_pilgan').html(data);
                    }
                });
            });
        });
        //end edit soal pilgan


        
        //ajax edit soal essay
        $(document).ready(function(){
            $('#edit_soal_essay').on('show.bs.modal', function(e){
                var id_soal = $(e.relatedTarget).data('id_soal_essay');
                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                var nomor = $(e.relatedTarget).data('nomor_essay');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/quizNomor_editSoal_essay.php',
                    type : 'POST',
                    data : {'id_soal':id_soal, 'key':key, 'class_code':class_code, 'id_quiz':id_quiz, 'nomor':nomor},
                    success : function(data){
                        $('.modal_edit_soal_essay').html(data);
                    }
                });
            });
        });
        //end edit soal essay


        $(document).ready(function(){
            $('[data-tootlip="tooltip"]').tooltip();   
        });
        </script>

<script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        click_nav("nav_pilgan"+1).click();
</script>
    </body>
</html>
    <?php }else{
        echo "directory access forhibidden";
    } ?>

<?php
    }else{
        header("location:../../index.php");
    }
?>