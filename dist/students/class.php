<?php
    @include '../../controller/inisial.php';
    @include '../../config/config.php';
    @include '../../controller/students/Dashboard_siswa.php';
    @include '../../controller/students/Class_siswa.php';
    @include '../../controller/teachers/Class.php';
    @include '../../controller/teachers/Quiz.php';
    @include '../../controller/teachers/Grade_tugas.php';
    @include '../../controller/students/GradeQuiz.php';
    @include '../../controller/app/Aplikasi.php';
    @include '../../controller/students/Pesan.php';
    @include '../../controller/teachers/KumpulTugas.php';

    session_start();

    if(isset($_SESSION['q'])){

    if(isset($_GET['class_code'])){

        $q = $_SESSION['q'];
        $class_code = $_GET['class_code'];

        if(cek_halaman_class_siswa($host, $class_code, $q) == true){

            //class view
            $view = new view;
            //class siswa
            $class_siswa = new class_siswa;
            //class Class =>in file guru
            $objek_general = new general;

            //objek pengumpulan tugas
            $objek_kumpulTugas = new pengumpulan_tugas;

            //objek quizz view
            $quiz_objek = new quiz;

            $Identitas_app = new Aplikasi;

            $iden_app_arr = $Identitas_app->Viewapp($host);

            $quiz_objek_layout = new Quiz_Layout; //objek quiz layout

            $objek_grade_quiz = new GradeQuiz;

            $pesan = new Pesan;

            $kumpultugas = new KumpulTugas;

            $id_join = $class_siswa->get_id_join($host, $q, $class_code);

            $name_siswa = $view->view_nama_siswa($host, $q);

            $full_nama_siswa = $name_siswa[0]." ".$name_siswa[1];

            $email = $pesan->GetEmail_siswa($host, $q);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Class - Students</title>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="../js/siswa_kumpulTugas.js"></script>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

    </head>
    <body  class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

        <a class="navbar-brand" href="javscript:void(0)">
                <h6>
                    <?php
                        if($view->Cekisigambar($host, $q) == NULL){
                    ?>
                        <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo $name_siswa[0]." ".$name_siswa[1] ?>
                    <?php
                        }else{
                            $mygambar = $view->Cekisigambar($host, $q);
                            echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> ".$name_siswa[0]." ".$name_siswa[1]."" ;

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
                        <a class="dropdown-item" href="../../DestroyedSiswa.php">Logout</a>
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
                                <a class="nav-link" href="<?php echo "index.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard</a>
                                <a class="nav-link" href="<?php echo "../../index.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home</a>

                                <div class="sb-sidenav-menu-heading">Control Class</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Modul Class
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo"<a class='nav-link' href='#join_class' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-plus-circle'></i></div>Join Class</a>";?></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo "<a class='nav-link' href='#set_akun' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-user-cog'></i></div>Setting Accocunt</a>";?></nav>
                                </div>
                                <?php
                                    if($kumpultugas->CekJoinKelas($host, $email) == 0){
                                ?>
                                <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas </a>
                                <?php }else{ ?>
                                <?php if($kumpultugas->Validation($host, $email) == true){ ?>
                                    <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas  &nbsp; <span class='badge badge-danger'>New</span></a>
                                <?php }else{ ?>
                                    <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas </a>
                                <?php } ?>
                                <?php } ?>
                                <div class="sb-sidenav-menu-heading">Communication</div>
                                <?php
                                    if($pesan->JumlahPesanBelumTerbaca($host, $email) == 0){
                                ?>
                                <a class="nav-link" href="<?php echo "pesan.php" ?>"><div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange</a>
                                <?php
                                    }else{
                                ?>
                                <a class="nav-link" href="<?php echo "pesan.php" ?>"><div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange &nbsp; <span class='badge badge-danger'>New</span></a>

                                <?php } ?>
                            </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login Sebagai:</div>
                            Siswa
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3">
                            <?php 
                                echo "Homepage Kelas ".$view->view_nama_kelas($host, $class_code);
                            ?>
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><?php echo"<a href='index.php'>Dashboard</a>";?></li>
                            <li class="breadcrumb-item active"><?php echo $view->view_nama_kelas($host, $class_code); ?></li>
                        </ol>

                        <?php
                            if(isset($_GET['kumpul_ok'])) {
                        ?>
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                            <strong>Success</strong> Your task successfully submited
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['exstension_false'])) {
                        ?>
                        
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                            <strong>Wrong</strong> Exstensi salah, atau ukuran file anda terlalu besar
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['dlt_ok'])) {
                        ?>
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                            <strong>Success</strong> Deelete file submission completed
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['edit_ok'])) {
                        ?>
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                            <strong>Success</strong> Edit file successfully
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['quiz_ok'])) {
                        ?>
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                            <strong>Success</strong> anda berhasil mengerjakan quiz
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <div class="card mb-2">

                            <div class="card-body">
                                <h5 class="text-muted">
                                    <a href="javascript:void(0)">
                                        <i class="fas fa-school"></i> 
                                        <?php echo "Kelas ".$view->view_nama_kelas($host, $class_code); ?>
                                    </a>
                                    <a href="javascript:void(0)"><span href="#top" toggle="#password-field" data-toggle="collapse" class="fa fa-fw fa-eye field_icon toggle-password" style="float:right; font-size:17px;"></span></a>
                                </h5>

                                <div class="collapse show" id="top">
                                <hr>
                                <h5 class="text-muted">
                                  <?php echo "<a href='Detailpeserta.php?class_code=$class_code' style='text-decoration:none;'>";?><i class='fas fa-users'></i> Total Peserta <span class="badge badge-primary"><?php echo $class_siswa->CountPesertaInKelas($host, $class_code); ?></span></a>
                                </h5><hr>
                                <p class="card-text">
                                    <h5 class="text-muted"><a href='#multiCollapseExample1' data-toggle='collapse'><i class='fas fa-bullhorn'></i> Pengumuman Kelas </a></h5>

                                   <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <?php echo $view->view_caption($host, $class_code); ?>
                                            </div>
                                        </div>
                                    </div>
                                </p>
                                </div>
                            </div>
                        </div>

                        <?php
                            $count_sess = $view->cek_jmlh_sesi_kls($host, $class_code);

                            if($count_sess == 0){
                        ?>
                        <footer class="text-center blockquote-footer" style="font-size: 20px;">Session in not found</footer>
                        <?php }else{ ?>

                        <?php
                            $view_sesi = $class_siswa->view_class($host, $class_code);
                            $hide = 1;
                            foreach (array_reverse($view_sesi) as $lihat_sesi){
                                $tgl_buat = $lihat_sesi['tgl_posting'];
                                $waktu_buat = $lihat_sesi['waktu_posting'];
                        ?>  

                        <div class="card mb-2">
                            <div class="card-header">
                                <h5>
                                    <?php echo"<a href='javascript:void(0)'><i class='fas fa-bars'></i> $lihat_sesi[title]</a>";?>
                                    <a href="javascript:void(0)"><span <?php echo "href='#body".$hide."'";?> toggle="#password-field" data-toggle="collapse" class="fa fa-fw fa-eye field_icon toggle-password" style="float:right; font-size:17px; margin-right:7px;"></span></a>
                                </h5>
                            </div>

                            <?php echo "<div class='collapse show' id='body".$hide."'>";?>
                            <div class="card-body">                            
                            
                            <h6 class="mb-3">Deskripsi sesi : </h6>
                            <?php echo $lihat_sesi['deskripsi'] ?>


                            <!-- file lampiran -->
                            <?php
                                if($class_siswa->cek_jmlh_file($host, $lihat_sesi['id_sesi']) == 0){
                            ?>
                            <!-- gk ada file -->

                            <?php }else{

                                //ada file
                                echo "<hr>";
                                echo "<h6 class='card-text mb-3'>File yang dilampirkan: </h6> ";

                                $file_lampir = $class_siswa->view_file($host, $lihat_sesi['id_sesi']);

                                foreach($file_lampir as $lampir_file){
                                    echo "<a href='../../controller/students/Class_siswa.php?name_file=$lampir_file[nama_file]&nama_siswa=$full_nama_siswa&id_file=$lampir_file[id_file]'><i class='far fa-file-alt'></i> $lampir_file[nama_file]</a><br>";
                                }
                            }?>

                            <!-- Assigment of task code -->
                            <?php
                                if($lihat_sesi['waktu_deadline']=="00:00:00" && $lihat_sesi['tgl_deadline']=="0000-00-00"){
                                    //no tugas
                                }else{
                            ?>
                                <!-- ada tugas menanti -->
                                <hr>
                                <h6 class="mb-3 text-blue">Pengumpulan Tugas : </h6>

                                <table class="table table-responsive">
                                <thead>
                                    <tr>
                                    <th scope="col" style="font-weight:normal;">Deadline</th>
                                    <th scope="col" style="font-weight:normal;">Remaining time</th>
                                    <th scope="col" style="font-weight:normal;">Status</th>
                                    <th scope="col" style="font-weight:normal;">Your submission</th>
                                    <th scope="col" style="font-weight:normal;">Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $lihat_sesi['tgl_deadline']." / ".$lihat_sesi['waktu_deadline'] ?></span></td>
                                        <td>

                                            <!-- time remaining logic -->
                                            <?php
                                            $time_deadline = $lihat_sesi['waktu_deadline'];
                                            $tgl_deadline = $lihat_sesi['tgl_deadline'];
                                            ?>
                                            
                                            
                                            <?php
                                            if($objek_general->time_remmening($time_deadline, $tgl_deadline) == "Time expired"){
                                            ?>
                                                
                                            <span class="badge badge-pill badge-danger"><?php echo $objek_general->time_remmening($time_deadline, $tgl_deadline); ?></span>
                                                
                                            <?php }else{ ?>
                                                
                                            <span class="badge badge-pill badge-primary"><?php echo $objek_general->time_remmening($time_deadline, $tgl_deadline); ?></span>
                                                
                                            <?php } ?>

                                        </td>
                                        <td>
                                            <?php
                                
                                                if($class_siswa->cek_pengumpulantugas($host, $q, $class_code, $lihat_sesi['id_sesi']) == 0){
                                            ?>
                                                 <span class="badge badge-pill badge-danger"><?php echo $class_siswa->cek_pengumpulantugas($host, $q, $class_code, $lihat_sesi['id_sesi'])." file submitted"; ?></span>
                                            <?php }else{  ?>

                                                <span class="badge badge-pill badge-success"><?php echo $class_siswa->cek_pengumpulantugas($host, $q, $class_code, $lihat_sesi['id_sesi'])." file submitted" ?></span>

                                            <?php } ?>
                                        </td>
                                        <td><?php echo"<a href='#add_submission' data-toggle='modal' data-id_sesi='".$lihat_sesi['id_sesi']."' class='badge badge-primary'>chek submission</a>";?></td>
                                        <td>
                                            <center>
                                                <?php
                                                    if($class_siswa->cek_pengumpulantugas($host, $q, $class_code, $lihat_sesi['id_sesi']) == 0){
                                                        echo "anda belum ngumpulin tugas";
                                                    }else{
                                                        if($objek_kumpulTugas->grade_tugas($host, $lihat_sesi['id_sesi'], $id_join) == false){
                                                    ?>
                                                        <span class='badge badge-pill badge-secondary'>Belum dinilai</span>
                                                    <?php }else{ ?>
                                                    
                                                        <span class='badge badge-pill badge-success'><?php echo $objek_kumpulTugas->grade_tugas($host, $lihat_sesi['id_sesi'], $id_join); ?></span>
                                                        
                                                    <?php } ?>
                                                <?php } ?>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>

                            <?php } ?>

                            <!-- cek ada quiz -->
                            <?php
                                if($quiz_objek->cek_quiz($host, $lihat_sesi['id_sesi']) == false){

                                }else{
                            ?>

                                <!-- logic application quiz is true -->
                                <hr>
                                <h6 class="mb-3 text-blue">Waktunya Quiz : </h6>

                                <table class="table mt-4 table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="font-weight:normal;">Title</th>
                                            <th scope="col" style="font-weight:normal;">Status</th>
                                            <th scope="col" style="font-weight:normal;">Nilai anda</th>
                                            <th scope="col" style="font-weight:normal;">Mulai Quiz</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                        $view_quiz = $quiz_objek->tampil_quiz($host, $lihat_sesi['id_sesi']);

                                        foreach ($view_quiz as $tampil_identitas_quiz){
                                            $id_quiz=$tampil_identitas_quiz['id_quiz'];
                                            $tgl_selesai = $tampil_identitas_quiz['tgl_selesai'];
                                            $waktu_selesai=$tampil_identitas_quiz['waktu_selesai'];

                                            $tgl_mulai_quiz = $tampil_identitas_quiz['tgl_mulai'];
                                            $waktu_mulai_quiz = $tampil_identitas_quiz['waktu_mulai'];
                                    ?>
                                        <tr>
                                            <td><span class="badge badge-pill badge-primary"><?php echo $tampil_identitas_quiz['title_quiz'] ?></span></td>
                                            <td>
                                                <?php
                                                    if($quiz_objek_layout->status_quiz($tgl_selesai, $waktu_selesai)=="Quiz open"){
                                                ?>

                                                    <span class="badge badge-pill badge-success"><?php echo $quiz_objek_layout->status_quiz($tgl_selesai, $waktu_selesai) ?></span>

                                                <?php }else{ ?>

                                                    <span class="badge badge-pill badge-danger"><?php echo $quiz_objek_layout->status_quiz($tgl_selesai, $waktu_selesai) ?></span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <center>
                                                <?php
                                                    if($objek_grade_quiz->cek_status_quiz_forSiswa($host, $id_join, $tampil_identitas_quiz['id_quiz']) == 0){
                                                        echo "anda belum ngerjain quiz";
                                                    }else{
                                                ?>

                                                    <span class="badge badge-pill badge-success"><?php echo $objek_grade_quiz->nilai_siswa_Forsiswa($host, $id_join, $tampil_identitas_quiz['id_quiz']);?></span>

                                                <?php } ?>
                                                </center>
                                            </td>
                                            <td><?php echo "<a href='#detail_quiz' data-toggle='modal' data-id_quiz='$tampil_identitas_quiz[id_quiz]' data-id_sesi='$lihat_sesi[id_sesi]' data-title_sesi='$lihat_sesi[title]' data-id_join='$id_join' data-tgl_selesai=$tgl_selesai data-waktu_selesai=$waktu_selesai data-tgl_mulai=$tgl_mulai_quiz data-waktu_mulai=$waktu_mulai_quiz class='badge badge-primary'>click here</a>";  ?></td>
                                        </tr>
                                    
                                    <?php } ?>
                                    </tbody>
                                </table>
                            

                            <?php } ?>                            
                            </div>

                            <div class="card-footer text-muted text-center">
                                <?php echo "Modify on ".$tgl_buat." - ".$waktu_buat ?>
                            </div>

                        </div>
                        </div>

                        <?php $hide++; } ?>

                        <?php } ?>

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


        <?php echo"<input type='hidden' id='q' value='$q'>";?>
        <?php echo"<input type='hidden' id='code_class' value='$class_code'>";?>

        <!--  modal add task -->
        <div class="modal fade" id="add_submission" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Submit your task</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_add_submission"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal add task-->

        
        <!--  modal detail quizzzz -->
        <div class="modal fade" id="detail_quiz" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Quiz detail</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_detail_quiz"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal detail quizzzzzzzzzzzz-->

                <!-- modal join class -->
                <div class="modal fade" id="join_class" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Join class</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_join_class"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal join class -->

        <!-- modal setting akun -->
        <div class="modal fade" id="set_akun" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Setting your accocunt</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_set_akun"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal seting akun -->

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        
        <script>

            $(document).on('click', '.toggle-password', function() {

                $(this).toggleClass("fa-eye fa-eye-slash");

            });

            //ajax kumpulin tugas
            $(document).ready(function(){
                $('#add_submission').on('show.bs.modal', function(e){
                    var id_sesi = $(e.relatedTarget).data('id_sesi');
                    var q = $("#q").val();
                    var class_code = $("#code_class").val();
                    var time_deadline = $("#time_deadline").val();
                    var tgl_deadline = $("#tgl_deadline").val();
                    
                    $.ajax({
                        url : '../../controller/students/ajax/ajax_kumpulTugas.php',
                        type : 'POST',
                        data : {'q':q, 'class_code':class_code, 'id_sesi':id_sesi},
                        success : function(data){
                            $('.modal_add_submission').html(data);
                        }
                    });
                });
            });
            //end ajax ngumpulin tugas


            //ajax detail quiz
            $(document).ready(function(){
                $('#detail_quiz').on('show.bs.modal', function(e){
                    var id_sesi = $(e.relatedTarget).data('id_sesi');
                    var q = $("#q").val();
                    var class_code = $("#code_class").val();
                    var id_quiz = $(e.relatedTarget).data('id_quiz');
                    var title_sesi = $(e.relatedTarget).data('title_sesi');
                    var id_join = $(e.relatedTarget).data('id_join');
                    var tgl_selesai = $(e.relatedTarget).data('tgl_selesai');
                    var waktu_selesai = $(e.relatedTarget).data('waktu_selesai');
                    var tgl_mulai = $(e.relatedTarget).data('tgl_mulai');
                    var waktu_mulai = $(e.relatedTarget).data('waktu_mulai');

                    $.ajax({
                        url : '../../controller/students/ajax/ajax_detailQuiz.php',
                        type : 'POST',
                        data : {'q':q, 'class_code':class_code, 'id_sesi':id_sesi, 'id_quiz':id_quiz, 'title_sesi':title_sesi, 'id_join':id_join, 'tgl_selesai':tgl_selesai, 'waktu_selesai':waktu_selesai, 'tgl_mulai':tgl_mulai, 'waktu_mulai':waktu_mulai},
                        success : function(data){
                            $('.modal_detail_quiz').html(data);
                        }
                    });
                });
            });
            //end ajax detail quiz

        // ajax modal join class
        $(document).ready(function(){
            $('#join_class').on('show.bs.modal', function(e){
                var q = $(e.relatedTarget).data('q');
                $.ajax({
                    url : '../../controller/students/ajax/ajax_joinClass.php',
                    type : 'POST',
                    data : {'q':q},
                    success : function(data){
                        $('.modal_join_class').html(data);
                    }
                });
            });
        });
        //end ajax modal join class

        // ajax modal update profile
        $(document).ready(function(){
            $('#set_akun').on('show.bs.modal', function(e){
                var q = $(e.relatedTarget).data('q');
                $.ajax({
                    url : '../../controller/students/ajax/ajax_set_akun.php',
                    type : 'POST',
                    data : {'q':q},
                    success : function(data){
                        $('.modal_set_akun').html(data);
                    }
                });
            });
        });
        //end ajax update profile

        </script>

    </body>
</html>

<?php }}else{
    echo "directory access forhibdeen";
} ?>

<?php
    }else{
        header("location:../../index.php");
    }
?>