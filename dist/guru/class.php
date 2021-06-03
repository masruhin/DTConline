<?php
@include '../../config/config.php';
@include '../../controller/inisial.php';
@include '../../controller/teachers/Dashboard.php';
@include '../../controller/teachers/Class.php';
@include '../../controller/teachers/Quiz.php';
@include '../../controller/teachers/Class_aksi_guru.php';
@include '../../controller/teachers/Grade_tugas.php';
@include '../../controller/students/GradeQuiz.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/teachers/Messange.php';


$inisial = new inisial;
session_start();

if (isset($_SESSION['key'])) {

    if (isset($_GET['class_code'])) {
        $chek_class = new statistic;
        $Objek_general = new general;
        $view_sesi = new model_view;

        $objekquiz = new quiz;
        $objek_tugas = new pengumpulan_tugas;
        $objek_aksi_guru = new peserta_join;
        $hasil_quiz = new HasilQuiz;
        $messange = new Messange;

        $key = $_SESSION['key'];
        $class_code = $_GET['class_code'];

        chek_sesiguru($key, $host, $class_code);

        if (My_chek($key, $host));

        //get email from key
        $email_get = new ajax_input_kelas;
        $email = $email_get->email_user($host, $key);
        //end get email

        $quiz_objek = new Quiz_Layout; //objek quiz layout
        $Identitas_app = new Aplikasi;

        $iden_app_arr = $Identitas_app->Viewapp($host);

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
            <title>Class - Teachers</title>
            <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
            <link href="../../vendor/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../../vendor/assets/css/app.css">
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link href="../css/styles.css" rel="stylesheet" />
            <link rel="stylesheet" href="../../vendor/assets/libs/fontawesome/css/all.min.css">
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
            <script src="../js/file.js"></script>
            <script src="../js/editfile.js"></script>
            <script src="../js/time.js"></script>
            <script src="../js/addfile.js"></script>
            <script src="../assets/ckeditor/ckeditor.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
            <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
            <script src="../../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
            <script src="../assets/ckeditor/ckeditor.js"></script>
            <script src="../assets/ckfinder/ckfinder.js"></script>
        </head>
        <style>
            a {
                font-weight: 500;
            }
        </style>

        <body class="sb-nav-fixed">
            <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #06d2bf; color:white;  box-shadow: 0px 4px 10px #999;">
                <!-- <div class="container"> -->
                <!-- <div class="container-fluid"> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item dropdwon mt-1">
                            <h6 style="color:black; font-weight:normal; font-size:x-small;">
                                <?php
                                if ($chek_class->Cekisigambar($host, $key) == NULL) {
                                ?>
                                    <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 30px; height: 30px; border-radius: 50%; border:2px;"> <br>
                                    <?php echo substr($My_name[1] . " " . $My_name[0], 0, 20)  ?>
                                <?php
                                } else {
                                    $mygambar = $chek_class->Cekisigambar($host, $key);
                                    echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 30px; height: 30px; border-radius: 50%; border:2px;'> <br> " . substr($My_name[1] . " " . $My_name[0], 0, 20) . "";
                                }
                                ?>
                            </h6>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo "../../index.php" ?>"><i class="fa fa-home text-dark"></i>
                                Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php"><i class="fa fa-layer-group text-dark"></i> Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle " id="dropdown-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-ul text-dark"></i> Data Course
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-1">
                                <?php
                                if ($chek_class->chek_class_null($host, $email) == true) {
                                    $row_nav = array();
                                    $row_nav = main("Show_class", $email, $host);

                                    foreach ($row_nav as $nav_class) {
                                ?>
                                        <?php echo "<a class='nav-link' href='class.php?class_code=$nav_class[kode_kelas]'>$nav_class[nama_kelas]</a>"; ?>
                                    <?php } ?>
                                <?php } ?>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php
                                        if ($chek_class->chek_class_null($host, $email) == true) {
                                            $row_nav = array();
                                            $row_nav = main("Show_class", $email, $host);

                                            foreach ($row_nav as $nav_class) {
                                        ?>
                                                <?php echo "<a class='nav-link' href='class.php?class_code=$nav_class[kode_kelas]'>$nav_class[nama_kelas]</a>"; ?>
                                            <?php } ?>
                                        <?php } ?>

                                    </nav>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle " id="dropdown-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users text-dark"></i> Data Participants
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-1">
                                <?php
                                if ($chek_class->chek_class_null($host, $email) == true) {
                                    $row_view_data = array();
                                    $row_view_data = main("Show_class", $email, $host);

                                    foreach ($row_view_data as $row_data_view) {

                                ?>
                                        <?php echo "<a class='nav-link' href='classDetail_siswa.php?class_code=$row_data_view[kode_kelas]'>$row_data_view[nama_kelas]</a>"; ?>
                                    <?php } ?>
                                <?php } ?>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle " id="dropdown-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-database text-dark"></i> My Course</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-1">
                                <a href="#" class="dropdown-item">
                                    <?php echo "<a class='dropdown-item' href='#create_class' data-toggle='modal' data-key='$key'>Create Class</a>"; ?>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <?php echo "<a class='dropdown-item' href='#edit_profile' data-toggle='modal' data-key='$key'>Setting Accocunt </a>"; ?>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <!-- <div class="row"> -->
                        <div class="col-md-12">
                            <form action="">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-link">
                        <?php
                        if ($messange->CekJumlaPesanMasukForGuru($host, $email) == 0) {

                            echo "<a class='nav-link' href='Pesan.php' title='Commuication'><i class='fa fa-comments text-dark' title='Commuication'></i> Message</a>";
                        } else {
                            echo "<a type='button' class='btn position-relative font-weight-bold' href='Pesan.php' title='Commuication'><i class='fa fa-comments text-dark' title='Communication'></i> Message<span class='badge position-absolute top-0 left-100 translate-middle bg-danger badge-pill' style='font-weight: normal; padding-top:0px'>new</span></a>";
                        }
                        ?>
                    </li>
                </ul>
                <ul class="navbar-nav" style="padding-left: 20px;">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdown-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-edit text-dark"></i>
                            Accessor</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-2">
                            <?php echo "<a class='dropdown-item' href='#edit_profile' data-toggle='modal' data-key='$key'>Edit Profile</a>"; ?>
                            <a href='../../login.php' class="dropdown-item">Log-out</a>
                        </div>
                    </li>
                </ul>
                </div>
                </div>
                </div>
            </nav>

            <!-- <body class="sb-nav-fixed">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <a class="navbar-brand" href="javscript:void(0)">
                    <h6>
                        <?php
                        if ($chek_class->Cekisigambar($host, $key) == NULL) {
                        ?>
                            <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo substr($My_name[1] . " " . $My_name[0], 0, 20)  ?>
                        <?php
                        } else {
                            $mygambar = $chek_class->Cekisigambar($host, $key);
                            echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> " . substr($My_name[1] . " " . $My_name[0], 0, 20) . "";
                        }
                        ?>

                    </h6>
                </a>
                <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
                <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                </form>
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <?php echo "<a class='dropdown-item' href='../../DestroyedGuru.php'>Logout</a>"; ?> </div>
                    </li>
                </ul>
            </nav>

            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">

                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">Core</div>
                                <?php echo "<a class='nav-link' href='index.php'><div class='sb-nav-link-icon'><i class='fas fa-tachometer-alt'></i></div>Dashboard</a>"; ?>
                                <a class="nav-link" href="<?php echo "../../index.php" ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home
                                </a>


                                <div class="sb-sidenav-menu-heading">Control class</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>Layouts
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <?php echo "<a class='nav-link' href='#create_class' data-toggle='modal' data-key='$key'>Create class</a>"; ?>
                                        <?php echo "<a href='#edit_profile' class='nav-link' data-toggle='modal' data-key='$key'>Setting accocunt</a>"; ?>
                                    </nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Master Data
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>

                                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Data Course
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>

                                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <?php
                                                if ($chek_class->chek_class_null($host, $email) == true) {
                                                    $row_nav = array();
                                                    $row_nav = main("Show_class", $email, $host);

                                                    foreach ($row_nav as $nav_class) {
                                                ?>
                                                        <?php echo "<a class='nav-link' href='class.php?class_code=$nav_class[kode_kelas]'>$nav_class[nama_kelas]</a>"; ?>
                                                    <?php } ?>
                                                <?php } ?>

                                            </nav>
                                        </div>


                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Data Participants
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <?php
                                                if ($chek_class->chek_class_null($host, $email) == true) {
                                                    $row_view_data = array();
                                                    $row_view_data = main("Show_class", $email, $host);

                                                    foreach ($row_view_data as $row_data_view) {

                                                ?>
                                                        <?php echo "<a class='nav-link' href='classDetail_siswa.php?class_code=$row_data_view[kode_kelas]'>$row_data_view[nama_kelas]</a>"; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </nav>
                                        </div>
                                    </nav>
                                </div>

                                <div class="sb-sidenav-menu-heading">Communication</div>
                                <?php
                                if ($messange->CekJumlaPesanMasukForGuru($host, $email) == 0) {

                                    echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange</a>";
                                } else {

                                    echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange&nbsp; <span class='badge badge-danger'>New</span></a>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Login Sebagai:</div>
                            Accessor
                        </div>
                    </nav> -->
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3 mb-5">
                            <?php
                            $rows = $Objek_general->this_name_class($host, $class_code);

                            foreach ($rows as $row) {
                                $nama_kelas = $row['nama_kelas'];
                                $caption = $row['caption'];

                                echo "Homepage Course " . $nama_kelas;
                            }
                            ?>
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><?php echo "<a href='index.php'>Dashboard</a>"; ?></li>
                            <li class="breadcrumb-item active"><?php echo $nama_kelas ?></li>
                        </ol>

                        <?php
                        if (isset($_GET['edit_ok'])) {
                        ?>

                            <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Success</strong> Class session edited successfully
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['menus_add'])) {
                        ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Success</strong> New menu has been added to this session
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <div class="card mb-2">

                            <div class="card-body">

                                <h5 class="text-muted">
                                    <a href="javascript:void(0)" style="text-decoration: none;">
                                        <i class="fas fa-school"></i> <?php echo "Course " . $nama_kelas ?>
                                    </a>
                                    <a href="javascript:void(0)"><span href="#top" toggle="#password-field" data-toggle="collapse" class="fa fa-fw fa-eye field_icon toggle-password" style="float:right; font-size:17px;"></span></a>

                                </h5>

                                <div class="collapse show" id="top">

                                    <hr>
                                    <h5> <?php echo "<a href='classDetail_siswa.php?class_code=$class_code' style='text-decoration: none;'><i class='fas fa-users'></i>"; ?> Total Participants <span class='badge badge-primary'><?php echo $objek_aksi_guru->jmlh_siswa_join_per_kls($host, $class_code); ?></span></a></h5>
                                    <hr>
                                    <h5><?php echo "<a href='#multiCollapseExample1' data-toggle='collapse'><i class='fas fa-bullhorn'></i> Announcements Course</a>"; ?>
                                        <?php echo "<a href='#update_caption' data-tootlip='tooltip' data-placement='bottom' title='caption edit' data-toggle='modal' data-key='$key' data-class_code='$class_code' style='float:right; font-size:15px;'><i class='fas fa-edit'></i></a>"; ?>
                                    </h5>
                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <?php
                                                echo $caption;
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>

                        <?php
                        $tot_sesi = $Objek_general->cek_jmlh_sesi($host, $class_code);

                        if ($tot_sesi == 0) {
                            echo "<p class='text-center'>Belum ada sesi yang dibuat :)</p>";
                        } else {

                        ?>
                            <!-- Logic kls sesi -->

                            <?php
                            $view_sess = $view_sesi->lihat_sesi($host, $class_code);

                            $hide = 1;

                            foreach (array_reverse($view_sess) as $tampil_sesi) {

                                $id_sesi = $tampil_sesi['id_sesi'];

                                $tgl_buat = $tampil_sesi['tgl_posting'];
                                $waktu_buat = $tampil_sesi['waktu_posting'];
                            ?>


                                <div class="card mb-2">
                                    <div class="card-header">
                                        <h5><?php echo "<a href='#add_menu' data-toggle='modal' data-sesi='$id_sesi' data-tootlip='tooltip' data-placement='right' title='configuration'><i class='fas fa-bars'></i> $tampil_sesi[title]</a>" ?>
                                            <a href="#edit_title" data-toggle="modal" <?php echo "data-sesi='$id_sesi'" ?> data-tootlip="tooltip" data-placement="top" title="edit title" style="float: right; font-size:15px;"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)"><span <?php echo "href='#body" . $hide . "'"; ?> toggle="#password-field" data-toggle="collapse" class="fa fa-fw fa-eye field_icon toggle-password" style="float:right; font-size:17px; margin-right:7px;"></span></a>
                                        </h5>
                                    </div>


                                    <?php echo "<div class='collapse show' id='body" . $hide . "'>"; ?>
                                    <div class="card-body">

                                        <a href="#edit_deskripsi" data-toggle="modal" <?php echo "data-sesi='$id_sesi'" ?> data-tootlip='tooltip' data-placement='top' title='edit deskripsi' style='float: right; font-size:15px;'><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0)" style='text-decoration:none;'>
                                            <h6 class="mb-3">Deskripsi sesi : </h6>
                                        </a>
                                        <?php echo $tampil_sesi['deskripsi'] ?>



                                        <!-- cek lampiran file -->
                                        <?php
                                        if ($view_sesi->jmlh_file($host, $id_sesi) == false) {
                                        } else {

                                            echo "<hr>";

                                            $file_lampir = $view_sesi->tampil_file($host, $id_sesi);
                                            echo "<a href='#edit_file' data-toggle='modal' data-sesi='$id_sesi' data-tootlip='tooltip' data-placement='top' title='edit file' style='float: right; font-size:15px;'><i class='fas fa-edit'></i></a>";
                                            echo "<a href='#delete_filesisip' data-toggle='modal' data-sesi='$id_sesi' data-tootlip='tooltip' data-placement='bottom' title='delete attached file' style='float: right; font-size: 15px; margin-right:7px; color:red;'><i class='fas fa-trash'></i></a>";

                                            echo "<a href='javascript:void(0)' style='text-decoration:none;'><h6 class='card-text mb-3'>File yang terlampir : </h6></a> ";

                                            foreach ($file_lampir as $file_lampiran) {
                                                echo "<a href='#show_viewers' data-toggle='modal' data-id_file='" . $file_lampiran['id_file'] . "' data-tootlip='tooltip' data-placement='top' title='Lihat siapa saja yang download file' style='float: right; font-size: 15px; margin-right:7px; color:green;'><i class='fas fa-search'></i></a>";
                                                print_r("<a target='_blank' href='../assets/file/" . $file_lampiran['nama_file'] . "'><i class='far fa-file-alt'></i> " . $file_lampiran['nama_file'] . "</a><br>");
                                            }
                                        ?>

                                        <?php } ?>


                                        <!-- cek status assigment task -->
                                        <?php
                                        if ($tampil_sesi['waktu_deadline'] == "00:00:00" && $tampil_sesi['tgl_deadline'] == "0000-00-00") {
                                            //gk ada tugas
                                        } else {
                                        ?>
                                            <!-- Assigment of task code -->
                                            <hr>
                                            <?php echo "<a href='#edit_deadline' data-toggle='modal' data-sesi='$id_sesi' data-tootlip='tooltip' data-placement='top' title='edit deadline submission' style='float: right; font-size:15px;'><i class='fas fa-edit'></i></a>"; ?>
                                            <?php echo "<a href='#dlt_submit' data-toggle='modal' data-sesi='$id_sesi' data-tootlip='tooltip' data-placement='bottom' title='delete submission' style='float: right; font-size: 15px; margin-right:7px; color:red;'><i class='fas fa-trash'></i></a>"; ?>
                                            <a href="javscript:void(0)" style='text-decoration:none;'>
                                                <h6 class="mb-3 text-blue">Pengumpulan Tugas: </h6>
                                            </a>

                                            <table class="table mt-4 table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="font-weight:normal;">Deadline Tugas</th>
                                                        <th scope="col" style="font-weight:normal;">Waktu tunggu</th>
                                                        <th scope="col" style="font-weight: normal;">Status</th>
                                                        <th scope="col" style="font-weight: normal;">Total submission</th>
                                                        <th scope="col" style="font-weight:normal;">Detail submission</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge badge-pill badge-primary"><?php echo $tampil_sesi['tgl_deadline'] . " / " . $tampil_sesi['waktu_deadline'] ?></span></td>
                                                        <td>
                                                            <!-- time remaining logic -->
                                                            <?php
                                                            $time_deadline = $tampil_sesi['waktu_deadline'];
                                                            $tgl_deadline = $tampil_sesi['tgl_deadline'];
                                                            ?>
                                                            <?php
                                                            if ($objek_general->time_remmening($time_deadline, $tgl_deadline) == "Time expired") {
                                                            ?>

                                                                <span class="badge badge-pill badge-danger"><?php echo $objek_general->time_remmening($time_deadline, $tgl_deadline); ?></span>

                                                            <?php } else { ?>

                                                                <span class="badge badge-pill badge-primary"><?php echo $objek_general->time_remmening($time_deadline, $tgl_deadline); ?></span>

                                                            <?php } ?>

                                                        </td>

                                                        <td>
                                                            <?php
                                                            if ($objek_general->cek_status_tugas($tgl_deadline, $time_deadline) == "Submission open") {
                                                            ?>
                                                                <span class="badge badge-pill badge-success"><?php echo $objek_general->cek_status_tugas($tgl_deadline, $time_deadline); ?></span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-pill badge-danger"><?php echo $objek_general->cek_status_tugas($tgl_deadline, $time_deadline); ?></span>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <center><span class='badge badge-pill badge-success'><?php echo $objek_tugas->Jmlh_siswa_kumpul($host, $tampil_sesi['id_sesi'], $class_code) . " siswa"; ?></span></center>
                                                        </td>

                                                        <td><?php echo "<a href='classGrade_submission.php?class_code=$class_code&sesi=$tampil_sesi[id_sesi]' class='badge badge-primary'>View Detail</a>"; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        <?php } ?>


                                        <!-- cek ada quiz -->
                                        <?php
                                        if ($objekquiz->cek_quiz($host, $id_sesi) == false) {
                                        ?>


                                        <?php } else { ?>

                                            <!-- logic application quiz is true -->
                                            <hr>
                                            <?php echo "<a href='#edit_quiz' data-toggle='modal' data-sesi='$id_sesi' data-tootlip='tooltip' data-placement='top' title='edit quiz' style='float: right; font-size:15px;'><i class='fas fa-edit'></i></a>"; ?>
                                            <?php echo "<a href='#dlt_quiz' data-toggle='modal' data-sesi='$id_sesi' data-tootlip='tooltip' data-placement='bottom' title='delete quiz' style='float: right; font-size: 15px; margin-right:7px; color:red;'><i class='fas fa-trash'></i></a>"; ?>
                                            <a href="javascript:void(0)" style='text-decoration:none;'>
                                                <h6 class="mb-3 text-blue">Waktunya Quiz : </h6>
                                            </a>

                                            <table class="table mt-4 table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="font-weight: normal;">Quiz Dimulai</th>
                                                        <th scope="col" style="font-weight:normal;">Quiz ditutup</th>
                                                        <th scope="col" style="font-weight:normal;">Status</th>
                                                        <th scope="col" style="font-weight: normal;">Sudah Quiz</th>
                                                        <th scope="col" style="font-weight:normal;">Detail Quiz</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $view_quiz = $objekquiz->tampil_quiz($host, $id_sesi);

                                                    foreach ($view_quiz as $tampil_identitas_quiz) {
                                                        $id_quiz = $tampil_identitas_quiz['id_quiz'];
                                                        $tgl_selesai = $tampil_identitas_quiz['tgl_selesai'];
                                                        $waktu_selesai = $tampil_identitas_quiz['waktu_selesai'];
                                                    ?>
                                                        <tr>
                                                            <td><span class="badge badge-pill badge-primary"><?php echo $tampil_identitas_quiz['tgl_mulai'] . " / " . $tampil_identitas_quiz['waktu_mulai'] ?></span></td>
                                                            <td><span class="badge badge-pill badge-primary"><?php echo $tampil_identitas_quiz['tgl_selesai'] . " / " . $tampil_identitas_quiz['waktu_selesai'] ?></span></td>
                                                            <td>
                                                                <?php
                                                                if ($quiz_objek->status_quiz($tgl_selesai, $waktu_selesai) == "Quiz open") {
                                                                ?>

                                                                    <span class="badge badge-pill badge-success"><?php echo $quiz_objek->status_quiz($tgl_selesai, $waktu_selesai) ?></span>

                                                                <?php } else { ?>

                                                                    <span class="badge badge-pill badge-danger"><?php echo $quiz_objek->status_quiz($tgl_selesai, $waktu_selesai) ?></span>
                                                                <?php } ?>
                                                            </td>

                                                            <td>
                                                                <center><span class="badge badge-pill badge-success"><?php echo $hasil_quiz->total_siswa_sudah_quiz($host, $tampil_identitas_quiz['id_quiz']) . " siswa"; ?></span></center>
                                                            </td>

                                                            <td><?php echo "<a href='quiz.php?class_code=$class_code&id_quiz=$id_quiz' class='badge badge-primary'>click here</a>";  ?></td>
                                                        </tr>

                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        <?php } ?>


                                    </div>

                                    <div class="card-footer text-muted text-center">
                                        <?php echo "Modify on " . $tgl_buat . " - " . $waktu_buat ?>
                                    </div>

                                </div>
                    </div>


                    <!-- end perulangan foreach -->
                <?php $hide++;
                            } ?>

            <?php } ?>

            <?php echo "<p class='text-center blue-text mt-4'><a href='#add_session' data-toggle='modal' data-code='$class_code'><i class='fas fa-plus-circle'></i> Add Session</a></p>"; ?>

                </main>
                <div class="fixed-bottom">
                    <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid">
                            <div class="d-flex align-items-center justify-content-center small">
                                <div class="text-muted"><?php echo $iden_app_arr[3]; ?> </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            </div>


            <?php echo "<input type='hidden' id='key' value='$key'>"; ?>
            <?php echo "<input type='hidden' id='code_class' value='$class_code'>"; ?>

            <!--  modal add session class -->
            <div class="modal fade" id="add_session" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Tambahkan sesi baru</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_add_session"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal add session class -->


            <!-- modal edit title -->
            <div class="modal fade" id="edit_title" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Title</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_edit_title"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal edit title -->


            <!-- modal edit_deskripsi -->
            <div class="modal fade" id="edit_deskripsi" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Deskripsi</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_edit_deskripsi"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal edit_deskripi -->


            <!-- modal edit_file -->
            <div class="modal fade" id="edit_file" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit File</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_edit_file"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal edit_file -->


            <!-- modal edit_task -->
            <div class="modal fade" id="edit_deadline" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit time deadline</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_edit_deadline"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal edit_task -->

            <!-- modal delete pengumpulan file -->
            <div class="modal fade" id="delete_filesisip" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm delete Attached files</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_delete_filesisip"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal delete pengumpulan file -->

            <!-- modal dlt tempat submit -->
            <div class="modal fade" id="dlt_submit" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm delete Submission tasks</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_delete_submit"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal dlt tempat submit -->

            <!-- modal add_menu -->
            <div class="modal fade" id="add_menu" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Session configuration</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_add_menu"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal add_menu -->



            <!-- modal edit_quizz -->
            <div class="modal fade" id="edit_quiz" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Quiz</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_editquiz"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal editquizz -->

            <!-- modal dlt_quizz -->
            <div class="modal fade" id="dlt_quiz" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete Quiz</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_dltquiz"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal dltquizz -->


            <!-- modal detail_siswa -->
            <div class="modal fade" id="detail_siswa" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Detail Students</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_detail_siswa"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal detail_siswa -->


            <!-- Modal edit profil -->
            <div class="modal fade" id="edit_profile" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit your profile</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_edit_profile"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal edit profil -->

            <!-- Modal create class -->
            <div class="modal fade" id="create_class" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Create new class</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_create_class"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal create class -->

            <!-- Modal update caption -->
            <div class="modal fade" id="update_caption" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Update caption kelas</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_update_caption"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal update caption -->

            <!-- Modal update caption -->
            <div class="modal fade" id="show_viewers" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Yang Sudah Download File</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_viewers_file"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal update caption -->

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>

            <!-- Jquery  -->
            <script>
                $(function() {
                    $('[data-tootlip="tooltip"]').tooltip()
                })

                $(document).on('click', '.toggle-password', function() {

                    $(this).toggleClass("fa-eye fa-eye-slash");

                });

                $(document).ready(function() {
                    $('#edit_profile').on('show.bs.modal', function(e) {
                        var key = $(e.relatedTarget).data('key');

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_set_profile.php',
                            type: 'POST',
                            data: {
                                'key': key
                            },
                            success: function(data) {
                                $('.modal_edit_profile').html(data);
                            }
                        });
                    });
                });

                $(document).ready(function() {
                    $('#update_caption').on('show.bs.modal', function(e) {
                        var key = $(e.relatedTarget).data('key');
                        var class_code = $(e.relatedTarget).data('class_code');

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_update_caption.php',
                            type: 'POST',
                            data: {
                                'key': key,
                                'class_code': class_code
                            },
                            success: function(data) {
                                $('.modal_update_caption').html(data);
                            }
                        });
                    });
                });


                $(document).ready(function() {
                    $('#create_class').on('show.bs.modal', function(e) {
                        var key = $(e.relatedTarget).data('key');
                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_create_class.php',
                            type: 'POST',
                            data: {
                                'key': key
                            },
                            success: function(data) {
                                $('.modal_create_class').html(data);
                            }
                        });
                    });
                });

                //ajax add sesi
                $(document).ready(function() {
                    $('#add_session').on('show.bs.modal', function(e) {
                        var code_class = $(e.relatedTarget).data('code');
                        var key = $('#key').val();
                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_add_session.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key
                            },
                            success: function(data) {
                                $('.modal_add_session').html(data);
                            }
                        });
                    });
                });

                //ajax edit title
                $(document).ready(function() {
                    $('#edit_title').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_edit_title.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_edit_title').html(data);
                            }
                        });
                    });
                });

                //ajax edit deskripsi
                $(document).ready(function() {
                    $('#edit_deskripsi').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_edit_deskripsi.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_edit_deskripsi').html(data);
                            }
                        });
                    });
                });

                //ajax edit file
                $(document).ready(function() {
                    $('#edit_file').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_edit_file.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_edit_file').html(data);
                            }
                        });
                    });
                });

                //ajax edit duedate
                $(document).ready(function() {
                    $('#edit_deadline').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_edit_task.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_edit_deadline').html(data);
                            }
                        });
                    });
                });

                //ajax delete filesisip 
                $(document).ready(function() {
                    $('#delete_filesisip').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_dlt_filesisip.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_delete_filesisip').html(data);
                            }
                        });
                    });
                });

                //ajax delete tmpt submit
                $(document).ready(function() {
                    $('#dlt_submit').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_dlt_submit.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_delete_submit').html(data);
                            }
                        });
                    });
                });

                //ajax add menu
                $(document).ready(function() {
                    $('#add_menu').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_add_menu.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_add_menu').html(data);
                            }
                        });
                    });
                });


                //ajax edit quiz
                $(document).ready(function() {
                    $('#edit_quiz').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_editquiz.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_editquiz').html(data);
                            }
                        });
                    });
                });


                //ajax dlt quiz
                $(document).ready(function() {
                    $('#dlt_quiz').on('show.bs.modal', function(e) {
                        var id_sesi = $(e.relatedTarget).data('sesi');
                        var code_class = $('#code_class').val();
                        var key = $('#key').val();

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_dlt_quiz.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_sesi': id_sesi
                            },
                            success: function(data) {
                                $('.modal_dltquiz').html(data);
                            }
                        });
                    });
                });
                //end ajax dlt quiz

                //ajax views file
                $(document).ready(function() {
                    $('#show_viewers').on('show.bs.modal', function(e) {
                        var id_file = $(e.relatedTarget).data('id_file');

                        $.ajax({
                            url: '../../controller/teachers/ajax/ajax_view_downloadfile.php',
                            type: 'POST',
                            data: {
                                'id_file': id_file
                            },
                            success: function(data) {
                                $('.modal_viewers_file').html(data);
                            }
                        });
                    });
                });
                //end ajax views file
            </script>
            <!-- end Jquery -->

            <?php
            if (isset($_GET['sesi_ok'])) {
            ?>
                <script>
                    swal({
                        title: "Good Job !",
                        text: "Session was successfully created!",
                        icon: "success",
                        button: "Ok!",
                    });
                </script>
            <?php } ?>

            <?php
            if (isset($_GET['exstension_false'])) {
            ?>
                <script>
                    swal({
                        title: "Exstensi salah atau ukuran file terlalu besar!",
                        text: "Coba lagi!",
                        icon: "warning",
                        button: "Ok!",
                    });
                </script>
            <?php } ?>

        </body>

        </html>
    <?php } ?>

<?php } else {

    header("location:../../index.php");
} ?>