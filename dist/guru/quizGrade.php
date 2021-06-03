<?php
    @include '../../config/config.php';
    @include '../../controller/inisial.php';
    @include '../../controller/teachers/Class.php';
    @include '../../controller/teachers/Quiz.php';
    @include '../../controller/students/GradeQuiz.php';
    @include '../../controller/app/Aplikasi.php';
    @include '../../controller/teachers/Dashboard.php';
    @include '../../controller/students/Class_siswa.php';
    @include '../../controller/teachers/Messange.php';

    session_start();

    if(isset($_SESSION['key'])){

    if(isset($_GET['class_code']) && isset($_GET['id_quiz'])){
        
        $key = $_SESSION['key'];
        $class_code = $_GET['class_code'];
        $id_quiz = $_GET['id_quiz'];
        $chek_class = new statistic;

        //inisialissasi
        chek_quizguru($key, $host, $class_code, $id_quiz);
        $general_objek = new general; //objek general
        $quiz_objek = new Quiz_Layout; //objek quiz layout
        $grade_quiz = new HasilQuiz; //objek grade quiz
        $Identitas_app = new Aplikasi;
        $class_siswa = new class_siswa;
        $email_get = new ajax_input_kelas;
        $messange = new Messange;

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
        <title>Quiz grade - Teachers</title>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="../js/import.js"></script>
        <script src="../js/gradeControl.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
        <script src="../assets/ckeditor/ckeditor.js"></script>

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
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo"quizEditsoal.php?class_code=$class_code&id_quiz=$id_quiz" ?>"><div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>Edit question</a></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo"<a class='nav-link' href='#import_soal' data-toggle='modal' data-id_quiz=''><div class='sb-nav-link-icon'><i class='fas fa-file-excel'></i></div>Import question</a>";?></nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Modul Participant
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                 <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="javascript:void(0)"><div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>Grade participant</a></nav>
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

                    <?php
                        $namakelas=$objek_general->this_name_class($host, $class_code);
                        $namasesi=$quiz_objek->get_namesession($host, $id_quiz);

                        foreach($namakelas as $class_name){
                            $classname = $class_name['nama_kelas'];
                        }

                        foreach($namasesi as $sesion_name){
                            $sesionname = $sesion_name['title'];
                            $id_sesi = $sesion_name['id_sesi'];
                        }

                    ?>

                    <div class="container-fluid">
                        <h4 class="mt-3">
                            Data Nilai Quiz Kelas <?php echo $classname ?> Sesi <?php echo $sesionname; ?>
                        </h4>

                        <ol class="breadcrumb mb-4">

                            <li class="breadcrumb-item"><a href=<?php echo"index.php"; ?>>Dashboard</a></li>
                            <li class="breadcrumb-item"><a href=<?php echo"class.php?class_code=$class_code"; ?>><?php echo $classname; ?></a></li>
                            <li class="breadcrumb-item"><a href=<?php echo"quiz.php?class_code=$class_code&id_quiz=$id_quiz"; ?>><?php echo "Quiz home"; ?></a></li>
                            <li class="breadcrumb-item active">Show grade</li>
                        </ol>

                        <?php
                            if(isset($_GET['dlt_nilai_quiz'])) {
                        ?>
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Nilai berhasil di hapus
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['emailok'])) {
                        ?>
                        
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Email berhasil dikirim
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <div class="card mb-4">
                            <div class="card-body">
                            <h5 class="card-text mb-4" style="color: black" id="infosudahquiz">Total finished quiz <span class="badge badge-primary"><?php echo $grade_quiz->total_siswa_sudah_quiz($host, $id_quiz)." siswa"; ?></span></h5>
                            <h5 class="card-text mb-4 hidden" style="color: black" id="infobelumquiz">Total belum quiz <span class="badge badge-danger"><?php echo $grade_quiz->total_siswa_belum_kuis($host, $class_code)." siswa"; ?></span></h5>

                            <hr>

                            <?php
                                if($grade_quiz->total_siswa_sudah_quiz($host, $id_quiz) != 0){
                            ?>
                                <?php echo "<a href='../assets/export/excle.php?id_quiz=$id_quiz' type='button' class='btn btn-outline-primary'>Export excle</a>"?>
                                <?php echo "<a href='../assets/export/gradePdf.php?id_quiz=$id_quiz&key=$key' type='button' class='btn btn-outline-success'>Export pdf</a>"?>

                                <?php } ?>

                                <a href="javascript:void(0)" type="button" class="btn btn-info" id="tampilsudahquiz" onclick="Sudahquiz()">Sudah Quiz</a>
                                <a href="javascript:void(0)" type="button" class="btn btn-outline-danger" id="tampilbelumquiz" onclick="Belumquiz()">Belum Quiz</a>
                        
                            </div>
                        </div>

                        <div class="card mb-4" id="view_sudahquiz">
                            <div class="card-body">

                            <h5 class="card-text mb-4" style="color: black">Data Nilai Peserta Quiz </h5>
                            <hr>

                            <?php
                                if($grade_quiz->total_siswa_sudah_quiz($host, $id_quiz) == 0){
                                    echo "belum ada siswa yang ngumpulin kuis";
                                }else{
                            ?>

                            <table id="nilai" class="table table-bordered dt-responsive nowrap" style="width:100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><center>Rank</center></th>
                                        <th><center>Name</center></th>
                                        <th><center>Total Benar</center></th>
                                        <th><center>Total Salah</center></th>
                                        <th><center>Total kosong</center></th>
                                        <th><center>Nilai</center></th>
                                        <th><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                        $Tampil_siswa_Arr = $grade_quiz->tampil_siswa_sudah_quiz($host, $id_quiz);
                                        $rank=1;
                                        foreach($Tampil_siswa_Arr as $tampil_siswa){                                        
                                    ?>
                                    <tr>
                                        <td><center><?php echo $rank; ?></center></td>
                                        <td>
                                            <?php
                                                $Nama_siswa_Arr = $grade_quiz->tampil_nama_siswa($host, $tampil_siswa['id_join']);                                            
                                            ?>

                                            <?php
                                                if($Nama_siswa_Arr[3] == NULL){
                                            ?>
                                                <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                            <?php echo $Nama_siswa_Arr[0]." ".$Nama_siswa_Arr[1]; ?>
                                                        
                                            <?php
                                                }else{
                                            ?>
                                                <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$Nama_siswa_Arr[3]" ?>">
                                            <?php echo $Nama_siswa_Arr[0]." ".$Nama_siswa_Arr[1];  ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <center>
                                                <?php
                                                    echo $tampil_siswa['jwb_benar'];
                                                ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <?php
                                                    echo $tampil_siswa['jwb_salah'];
                                                ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <?php
                                                    echo $tampil_siswa['kosong'];
                                                ?>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <?php
                                                    echo $tampil_siswa['nilai'];
                                                ?>      
                                            </center>
                                        </td>
                                        <td>                                        
                                            <center>
                                                <?php echo"<a href='#preview_quiz' data-toggle='modal' data-id_quiz = '$tampil_siswa[id_quiz]' data-id_join='$tampil_siswa[id_join]' class='badge badge-primary'>Preview</a>"?>
                                                <?php echo"<a href='#delete_grade' data-toggle='modal' data-id_quiz = '$tampil_siswa[id_quiz]' data-id_join='$tampil_siswa[id_join]' data-key='$key' data-class_code='$class_code' class='badge badge-danger'>Delete</a>"?>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php $rank++; } ?>
                                </tbody>
                            </table>
                            
                            <?php } ?>
                            </div>                            
                        </div>

                        
                        <div class="card mb-4 hidden" id="view_belumquiz">
                            <div class="card-body">
                                <h5 class="card-text mb-4" style="color: red">Data Peserta Belum Quiz </h5>
                                <hr>
                                <?php
                                    if($grade_quiz->total_siswa_belum_kuis($host, $class_code) == 0){
                                        echo "semua siswa sudah mengerjakan quiz";
                                    }else{                                    

                                ?>
                                <table id="belumquiz" class="table table-bordered dt-responsive nowrap" style="width:100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><center>No</center></th>
                                        <th><center>Nama</center></th>
                                        <th><center>Email</center></th>
                                        <th><center>Whatsapp Number</center></th>
                                        <th><center>Status</center></th>
                                        <th><center>Kirim Pesan</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php
                                    $nomor=1;                                        
                                    $Tampilsiswa_blmquiz = $grade_quiz->tampil_siswa_belum_kuis($host, $class_code);                                        
                                    foreach($Tampilsiswa_blmquiz as $siswablm_quiz){
                                ?>
                                <tr>
                                    <?php
                                        $Nama_siswa_Arr = $grade_quiz->tampil_nama_siswa($host, $siswablm_quiz['id_join']);                                            
                                    ?>
                                    <td><center><?php echo $nomor; ?></center></td>
                                    <td>
                                        <?php
                                            $Nama_siswa_Arrr = $grade_quiz->tampil_nama_siswa($host, $siswablm_quiz['id_join']);                            
                                        ?>

                                        <?php
                                            if($Nama_siswa_Arr[3] == NULL){
                                        ?>
                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                        <?php echo $Nama_siswa_Arrr[0]." ".$Nama_siswa_Arrr[1]; ?>
                                                    
                                        <?php
                                            }else{
                                        ?>
                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$Nama_siswa_Arr[3]" ?>">
                                        <?php echo $Nama_siswa_Arrr[0]." ".$Nama_siswa_Arrr[1];  ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <center>
                                            <?php   
                                                echo $siswablm_quiz['email_siswa'];
                                            ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php

                                                if($grade_quiz->cekNohp($host, $siswablm_quiz['email_siswa']) == 0){

                                                    echo "<span class='badge badge-success'>Belum melengkapi</span>";

                                                }else{

                                                    echo $grade_quiz->getNohp($host, $siswablm_quiz['email_siswa']);

                                                }
                                            ?>
                                        </center>
                                    </td>
                                            <td>
                                                <center>
                                                    <?php
                                                        if($class_siswa->CekstatusSiswa($host, $Nama_siswa_Arr[2]) == true){
                                                    ?>
                                                        <span class="badge badge-success">Online</span>     
                                                    <?php }else{ ?>                                                    
                                                        <span class="badge badge-danger">Offline</span>
                                                    <?php } ?>
                                                </center>
                                            </td>                                    
                                    <td>
                                        <center>
                                            <?php echo "<a href='#kirim_wa' data-key='$key' data-pass_siswa='$Nama_siswa_Arrr[2]' data-toggle='modal' data-tootlip='tooltip' title='Hubungi via whatsapp'><i class='fab fa-whatsapp' style='font-size:20px;'></i></a>";?>
                                            <?php echo "<a href='#kirim_email' data-key='$key' data-id_quiz='$id_quiz' data-pass_siswa='$Nama_siswa_Arrr[2]' data-sesi='$id_sesi' data-class_code='$class_code' data-toggle='modal' data-tootlip='tooltip' title='Hubungi via email'><i class='fas fa-envelope-open-text' style='font-size:20px;'></i></a>";?>
                                            <?php echo "<a href='#pesan' data-tootlip='tooltip' title='Pesan Aplikasi'><i class='fab fa-facebook-messenger' style='font-size:20px;'></i></a>";?>                                                
                                        </center>
                                    </td>
                                </tr>
                                <?php $nomor++; } ?>
                                </tbody>
                                </table>
                            <?php } ?>
                            </div>
                        </div>

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
    
        <!-- modal preview quiz-->
        <div class="modal fade" id="preview_quiz" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Preview Confirm</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_preview_quiz"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal preview quiz-->

        <!-- modal hapus data siswa yg sudah quiz-->
        <div class="modal fade" id="delete_grade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete Confirm</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_delete_grade"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal hapus data siswa yg sudah quiz-->

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

        <!-- kirim pesan via whatsapp -->
        <div class="modal fade" id="kirim_wa" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Notification via Whatsapp</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_kirim_wa"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end kirim pesan via whatsapp-->

        <!-- kirim pesan via email -->
        <div class="modal fade" id="kirim_email" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Notification via Email</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_kirim_email"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end kirim pesan via email-->

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/import.js"></script>
        
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
        $(document).ready(function() {
            $('#nilai').DataTable();
        });

        $(document).ready(function() {
            $('#belumquiz').DataTable();
        });
        $(function () {
            $('[data-tootlip="tooltip"]').tooltip()
        })
        //ajax confirm prev
        $(document).ready(function(){
            $('#preview_quiz').on('show.bs.modal', function(e){

                var id_quiz = $(e.relatedTarget).data('id_quiz');
                var id_join = $(e.relatedTarget).data('id_join');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/confirm_preview_quiz.php',
                    type : 'POST',
                    data : {'id_quiz':id_quiz, 'id_join':id_join},
                    success : function(data){
                        $('.modal_preview_quiz').html(data);
                    }
                });
            });
        });
        //end ajax confirm prev

        //ajax delete grade user
        $(document).ready(function(){
            $('#delete_grade').on('show.bs.modal', function(e){

                var id_quiz = $(e.relatedTarget).data('id_quiz');
                var id_join = $(e.relatedTarget).data('id_join');
                var key       = $(e.relatedTarget).data('key');
                var class_code = $(e.relatedTarget).data('class_code');
                
                $.ajax({
                    url : '../../controller/teachers/ajax/confirm_delete_grade.php',
                    type : 'POST',
                    data : {'id_quiz':id_quiz, 'id_join':id_join, 'key':key, 'class_code':class_code},
                    success : function(data){
                        $('.modal_delete_grade').html(data);
                    }
                });
            });
        });
        //end ajax delete grade

        $(document).ready(function(){
            $('#kirim_wa').on('show.bs.modal', function(e){
                var key = $(e.relatedTarget).data('key');
                var passsiswa = $(e.relatedTarget).data('pass_siswa');

                $.ajax({
                    url : '../../controller/teachers/ajax/NotifWaSubmision.php',
                    type : 'POST',
                    data : {'key':key, 'pass_siswa':passsiswa},
                    success : function(data){
                        $('.modal_kirim_wa').html(data);
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#kirim_email').on('show.bs.modal', function(e){
                var key = $(e.relatedTarget).data('key');
                var passsiswa = $(e.relatedTarget).data('pass_siswa');
                var class_code = $(e.relatedTarget).data('class_code');
                var sesi = $(e.relatedTarget).data('sesi');
                var id_quiz = $(e.relatedTarget).data('id_quiz');

                $.ajax({
                    url : '../../controller/teachers/ajax/notifEmailquiz.php',
                    type : 'POST',
                    data : {'key':key, 'pass_siswa':passsiswa, 'class_code':class_code, 'sesi':sesi, 'id_quiz':id_quiz},
                    success : function(data){
                        $('.modal_kirim_email').html(data);
                    }
                });
            });
        });

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