<?php
@include '../../config/config.php';
@include '../../controller/inisial.php';
@include '../../controller/teachers/Dashboard.php';
@include '../../controller/teachers/Class.php';
@include '../../controller/teachers/Class_aksi_guru.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/teachers/Messange.php';


session_start();

if (isset($_SESSION['key'])) {

    if (isset($_GET['class_code'])) {

        $key = $_SESSION['key'];
        $class_code = $_GET['class_code'];

        chek_sesiguru($key, $host, $class_code);

        //objek objek
        $chek_class = new statistic;
        $general_objek = new general;
        $objek_aksi_guru = new peserta_join;
        $messange = new Messange;

        //get email from key
        $email_get = new ajax_input_kelas;
        $email = $email_get->email_user($host, $key);
        //end get email

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
            <title>Detail Students - Teachers</title>
            <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
            <link href="../../vendor/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../../vendor/assets/css/app.css">
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link href="../css/styles.css" rel="stylesheet" />
            <link rel="stylesheet" href="../../vendor/assets/libs/fontawesome/css/all.min.css">

            <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
            <script src="../assets/ckeditor/ckeditor.js"></script>
            <script src="../../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
            <script src="../assets/ckeditor/ckeditor.js"></script>
            <script src="../assets/ckfinder/ckfinder.js"></script>
            <script src="../js/Datasiswa.js"></script>
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
                            <a class="dropdown-item" href="../../SessionGuru.php">Logout</a>
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
                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth"> Data Course
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


                                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError"> Data Participants
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
                            Guru
                        </div>
                    </nav> -->
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3 mb-5">
                            <?php
                            $rows = $general_objek->this_name_class($host, $class_code);

                            foreach ($rows as $row) {
                                $nama_kelas = $row['nama_kelas'];

                                echo "Master Data Participants Course " . $nama_kelas;
                            }
                            ?>
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><?php echo "<a href='index.php'>Dashboard</a>"; ?></li>
                            <li class="breadcrumb-item"><?php echo "<a href='class.php?class_code=$class_code'>$nama_kelas</a>"; ?></li>
                            <li class="breadcrumb-item active">Detail Participants Course <?php echo $nama_kelas; ?></li>
                        </ol>

                        <?php
                        if (isset($_GET['save_ok'])) {
                        ?>

                            <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Success</strong> Data Students berhasil dibuat
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['emailok'])) {
                        ?>

                            <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Success</strong> Kirim pesan Lewat Email berhasil terkirim
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['import_ok'])) {
                        ?>

                            <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Success</strong> Berhasil import Data
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['email_or_password'])) {
                        ?>

                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Gagal</strong> Email atau password sudah digunakan
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['ekstensi'])) {
                        ?>

                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Gagal</strong> ekstensi file salah
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['dlt_ok'])) {
                        ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Berhasil</strong> Hapus data Students berhasil
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['edit_ok'])) {
                        ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                <strong>Berhasil</strong> Edit data Students berhasil
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="total_siswa">Total Students <span class="badge badge-primary"><?php echo $objek_aksi_guru->jmlh_siswa_join_per_kls($host, $class_code); ?></span></h5>
                                <hr>
                                <label for="xxx">Pilih argumen dibawah <span style="color: red;">*</span></label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="view_siswa" name="customRadio" class="custom-control-input" required onclick="formKu()" checked>
                                    <label class="custom-control-label" for="view_siswa">Lihat semua Participants di Course ini</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="import_siswa" name="customRadio" class="custom-control-input" required onclick="formKu()">
                                    <label class="custom-control-label" for="import_siswa">Import Data Participants dari excle</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="buat_data_siswa" name="customRadio" class="custom-control-input" required onclick="formKu()">
                                    <label class="custom-control-label" for="buat_data_siswa">Buat data Participants di kelas ini</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="export" name="customRadio" class="custom-control-input" required onclick="formKu()">
                                    <label class="custom-control-label" for="export">Export data Participants</label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4" id="view_data_siswa">
                            <div class="card-body">
                                <h5 class="mb-3" style="color: blue;">Nama Participants yang terdaftar</h5>
                                <hr>

                                <?php
                                if ($objek_aksi_guru->jmlh_siswa_join_per_kls($host, $class_code) == 0) {
                                    echo "belum ada participants yang bergabung di course ini";
                                } else {

                                ?>
                                    <table id="example" class="table table-bordered dt-responsive nowrap" style="width:100%" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>No</center>
                                                </th>
                                                <th>
                                                    <center>Name</center>
                                                </th>
                                                <th>
                                                    <center>Email</center>
                                                </th>
                                                <th>
                                                    <center>Whatsapp Number</center>
                                                </th>
                                                <th>
                                                    <center>Status</center>
                                                </th>
                                                <th>
                                                    <center>Hubungi</center>
                                                </th>
                                                <th>
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $view_siswa_join = $objek_aksi_guru->tampil_siswa_join_per_kls($host, $class_code);
                                            foreach ($view_siswa_join as $view_siswa) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $no ?></center>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($view_siswa['gambar'] == NULL) {
                                                        ?>
                                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                                            <?php echo $view_siswa['first_name'] . " " . $view_siswa['last_name'] ?>

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$view_siswa[gambar]" ?>">
                                                            <?php echo $view_siswa['first_name'] . " " . $view_siswa['last_name'] ?>
                                                        <?php } ?>
                                                    </td>

                                                    <td>
                                                        <center><?php echo $view_siswa['email']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php
                                                            if ($view_siswa['nohp_siswa'] == null) {
                                                                echo "<span class='badge badge-primary'>Belum mengisi</span>";
                                                            } else {
                                                                echo $view_siswa['nohp_siswa'];
                                                            }
                                                            ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php
                                                            if ($objek_aksi_guru->Cek_SiswaOnline($host, $view_siswa['password']) == true) {
                                                            ?>
                                                                <span class="badge badge-success">Online</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger">Offline</span>
                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php echo "<a href='#whatsapp' data-toggle='modal' data-key='$key' data-pass_siswa='$view_siswa[password]' data-tootlip='tooltip' title='Hubungi via whatsapp'><i class='fab fa-whatsapp' style='font-size:20px;'></i></a>"; ?>
                                                            <?php echo "<a href='#emailkirim' data-toggle='modal' data-key='$key' data-class_code='$class_code' data-email_tujuan='$view_siswa[email]' data-tootlip='tooltip' title='Hubungi via email'><i class='fas fa-envelope-open-text' style='font-size:20px;'></i></a>"; ?>
                                                            <?php echo "<a href='Pesan.php' data-tootlip='tooltip' title='Pesan Aplikasi'><i class='fab fa-facebook-messenger' style='font-size:20px;'></i></a>"; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php echo "<a href='#edit_siswa' data-id_join='$view_siswa[id_join]' data-key='$key' data-class_code='$class_code' data-pass_siswa_view='$view_siswa[password]' data-toggle='modal' class='badge badge-primary'>Edit</a>"; ?>
                                                            <?php echo "<a href='#hapus_siswa' data-id_join='$view_siswa[id_join]' data-key='$key' data-class_code='$class_code' data-first_name='$view_siswa[first_name]' data-last_name='$view_siswa[last_name]' data-toggle='modal' class='badge badge-danger'>Delete</a>"; ?>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>


                                <?php
                                }
                                ?>

                            </div>
                        </div>

                        <div class="card mb-4 hidden" id="import_data_siswa">
                            <div class="card-body">

                                <form action="../../controller/teachers/Class_aksi_guru.php" method="post" enctype="multipart/form-data">
                                    <h5 class="mb-3" style="color: blue;">Import Data Participants dari excle</h5>
                                    <hr>

                                    <?php echo "<input type='hidden' name='class_code' id='class_code' value='$class_code'>"; ?>
                                    <?php echo "<input type='hidden' name='key' id='key' value='$key'>"; ?>

                                    <div class="form-group">
                                        <label for="file_excle">Import from excle file <sup style="color: red;">Allowed type file xls</sup></label>
                                        <input type="file" name="file_upload" id="file_upload" required class="form-control-file">
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="import_data_siswa_to_excle">Import</button>
                                </form>

                            </div>
                        </div>

                        <div class="card mb-4 hidden" id="export_data_siswa">
                            <div class="card-body">
                                <form action="#" method="post">
                                    <h5 class="mb-3" style="color: blue;">Export Data Participants</h5>
                                    <hr>

                                    <?php echo "<input type='hidden' name='class_code' id='class_code' value='$class_code'>"; ?>
                                    <?php echo "<input type='hidden' name='key' id='key' value='$key'>"; ?>

                                    <a href=<?php echo "../assets/export/Datasiswapdf.php?key=$key&class_code=$class_code&det_kls=$nama_kelas"; ?> type="button" class="btn btn-outline-primary">Export pdf</a>
                                </form>

                            </div>
                        </div>

                        <div class="card mb-4 hidden" id="siswa_buatData">
                            <div class="card-body">

                                <form action="../../controller/teachers/Class_aksi_guru.php" method="post">

                                    <h5 class="mb-3" style="color: blue;">Buat Data Participants manual</h5>
                                    <hr>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="first_name">First name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                                        </div>

                                        <div class="col">
                                            <label for="last_name">Last name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2 mb-2">
                                        <label for="email">email</label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>

                                    <div class="form-row">
                                        <div class="col">
                                            <label for="password">password</label>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                        </div>

                                        <?php echo "<input type='hidden' name='class_code' id='class_code' value='$class_code'>"; ?>
                                        <?php echo "<input type='hidden' name='key' id='key' value='$key'>"; ?>

                                        <div class="col">
                                            <label for="code_class">Nama Course</label>
                                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" readonly value="<?php echo $nama_kelas ?>">
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary" name="save_siswa" style="color: white;">Save</button>
                                </form>

                            </div>
                        </div>
                    </div>
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


            <!-- modal delete siswa -->
            <div class="modal fade" id="hapus_siswa" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Delete Student From Class</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_hapus_siswa"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal delete siswa -->

            <!-- modal edit siswa -->
            <div class="modal fade" id="edit_siswa" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Data Students</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_edit_siswa"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal edit siswa -->

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

            <!-- modal send whatsapp -->
            <div class="modal fade" id="whatsapp" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Kirim Pesan Via Whatsapp</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_send_whatsapp"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal send whatsapp -->

            <!-- modal send email -->
            <div class="modal fade" id="emailkirim" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><b>Kirim Pesan Via Email</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="modal_send_email"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal send email -->


            <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script> -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>
            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });
                $(function() {
                    $('[data-tootlip="tooltip"]').tooltip()
                })

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


                //ajax hapus siswa
                $(document).ready(function() {
                    $('#hapus_siswa').on('show.bs.modal', function(e) {
                        var id_join = $(e.relatedTarget).data('id_join');
                        var code_class = $(e.relatedTarget).data('class_code');
                        var key = $(e.relatedTarget).data('key');
                        var first_name = $(e.relatedTarget).data('first_name');
                        var last_name = $(e.relatedTarget).data('last_name');

                        $.ajax({
                            url: '../../controller/teachers/ajax/Delete_siswa.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_join': id_join,
                                'first_name': first_name,
                                'last_name': last_name
                            },
                            success: function(data) {
                                $('.modal_hapus_siswa').html(data);
                            }
                        });
                    });
                });
                //end ajax hapus siswa

                //ajax edit siswa
                $(document).ready(function() {
                    $('#edit_siswa').on('show.bs.modal', function(e) {
                        var id_join = $(e.relatedTarget).data('id_join');
                        var code_class = $(e.relatedTarget).data('class_code');
                        var key = $(e.relatedTarget).data('key');
                        var pass_siswa = $(e.relatedTarget).data('pass_siswa_view');

                        $.ajax({
                            url: '../../controller/teachers/ajax/Edit_siswa.php',
                            type: 'POST',
                            data: {
                                'code_class': code_class,
                                'key': key,
                                'id_join': id_join,
                                'pass_siswa': pass_siswa
                            },
                            success: function(data) {
                                $('.modal_edit_siswa').html(data);
                            }
                        });
                    });
                });
                //end ajax edit siswa

                // ajax modal whatsapp
                $(document).ready(function() {
                    $('#whatsapp').on('show.bs.modal', function(e) {
                        var key = $(e.relatedTarget).data('key');
                        var pass_siswa = $(e.relatedTarget).data('pass_siswa');

                        $.ajax({
                            url: '../../controller/teachers/ajax/NotifWaSubmision.php',
                            type: 'POST',
                            data: {
                                'key': key,
                                'pass_siswa': pass_siswa
                            },
                            success: function(data) {
                                $('.modal_send_whatsapp').html(data);
                            }
                        });
                    });
                });
                //end ajax modal whatsapp

                // ajax modal kirim email
                $(document).ready(function() {
                    $('#emailkirim').on('show.bs.modal', function(e) {
                        var key = $(e.relatedTarget).data('key');
                        var class_code = $(e.relatedTarget).data('class_code');
                        var emailtujuan = $(e.relatedTarget).data('email_tujuan');

                        $.ajax({
                            url: '../../controller/teachers/ajax/Notifemailpesan.php',
                            type: 'POST',
                            data: {
                                'key': key,
                                'class_code': class_code,
                                'email_tujuan': emailtujuan
                            },
                            success: function(data) {
                                $('.modal_send_email').html(data);
                            }
                        });
                    });
                });
                //end ajax modal kirim email
            </script>


        </body>

        </html>
    <?php } else {
        echo "directory access forhibidden";
    } ?>

<?php
} else {
    header("location:../../index.php");
}
?>