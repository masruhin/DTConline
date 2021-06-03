<?php
@include '../../config/config.php';
@include '../../controller/inisial.php';
@include '../../controller/teachers/Dashboard.php';
@include '../../controller/teachers/Class.php';
@include '../../controller/teachers/Class_aksi_guru.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/teachers/Messange.php';
@include '../../controller/teachers/PesanAdmin.php';

session_start();

if (isset($_SESSION['key'])) {

    $key = $_SESSION['key'];

    if (My_chek($key, $host));

    //objek objek
    $chek_class = new statistic;
    $general_objek = new general;
    $messange = new Messange;
    $pesanadmin = new PesanAdmin;

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
        <title>Pesan - Teachers</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
        <link href="../../vendor/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../vendor/assets/css/app.css">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
        <link href="../css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="../../vendor/assets/libs/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../css/chat.css">
        <script src="../js/Chatting.js"></script>

        <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
        <script src="../../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/ckeditor/ckeditor.js"></script>
    </head>
    <style>
        a {
            font-weight: 500;
        }

        .clik {
            display: inline-block;
            padding: 6px 6px;
            font-size: 12px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px #999;
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
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Master Data Kelas
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


                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Master Data Siswa
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

                                echo "<a class='nav-link' href='javascript:void(0)'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange</a>";
                            } else {

                                echo "<a class='nav-link' href='javascript:void(0)'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange&nbsp; <span class='badge badge-danger'>New</span></a>";
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
                        Messange
                    </h4>
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><?php echo "<a href='index.php'>Dashboard</a>"; ?></li>
                        <li class="breadcrumb-item active">Messange</li>
                    </ol>
                    <?php
                    if (isset($_GET['terhapus'])) {
                    ?>
                        <div class="alert alert-danger" role="alert" id="no_input">
                            Pesan Terhapus
                        </div>
                    <?php } ?>

                    <?php
                    if (isset($_GET['terkirim'])) {
                    ?>
                        <div class="alert alert-success" role="alert" id="sukses">
                            Pesan Terkirim
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($_GET['pesan_kosong'])) {
                    ?>
                        <div class="alert alert-warning" role="alert" id="no_input">
                            Kolom Pesan Tidak Boleh Kosong
                        </div>
                    <?php } ?>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Total Kontak <span class="badge badge-primary"><?php echo $messange->JumlahKontak($host, $email); ?></span></h5>
                            <hr>
                            <label for="xxx">Pilih argumen dibawah <span style="color: red;">*</span></label>
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="mulai_obrolan" name="customRadio" class="custom-control-input" required checked onclick="Userclick()">
                                <label class="custom-control-label" for="mulai_obrolan">Mulai Obrolan</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="hubungi_admin" name="customRadio" class="custom-control-input" required onclick="Userclick()">
                                <label class="custom-control-label" for="hubungi_admin">Hubungi Admin</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="pesan_masuk" name="customRadio" class="custom-control-input" required onclick="Userclick()">
                                <label class="custom-control-label" for="pesan_masuk">Lihat Pesan Masuk <span class="badge badge-warning badge-pill"><?php echo $messange->CekJumlaPesanMasukForGuru($host, $email); ?></span></label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="view_mulai_obrolan">
                        <div class="card-body">
                            <h5>Mulai Obrolan</h5>
                            <hr>

                            <table id="lihatkontak" class="table dt-responsive nowrap" style="width:100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>No</center>
                                        </th>
                                        <th>
                                            <center>Nama</center>
                                        </th>
                                        <th>
                                            <center>Course</center>
                                        </th>
                                        <th>
                                            <center>Status</center>
                                        </th>
                                        <th>
                                            <center>Total Pesan</center>
                                        </th>
                                        <th>
                                            <center>Action</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if ($messange->JumlahKontak($host, $email) == 0) {
                                    } else {

                                        $ViewKontak = $messange->TampilkanKontak($host, $email);
                                        foreach ($ViewKontak as $view) {

                                    ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <?php echo $no; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($view['gambar'] == NULL) {
                                                    ?>
                                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                                    <?php } else { ?>
                                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$view[gambar]" ?>">
                                                    <?php } ?>
                                                    <?php echo $view['first_name'] . " " . $view['last_name'] ?>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="javascript:void(0)" class="badge badge-primary badge-pill" style="font:500;" data-toggle="popover" title="Course yang diikuti" data-content='
                                                <?php
                                                $GetNamaKelas = $messange->GetNamaKelas($host, $view['email']);
                                                $pjg = count($GetNamaKelas);
                                                $i = 0;
                                                foreach ($GetNamaKelas as $nama_kelas) {
                                                ?>
                                                    
                                                    <?php
                                                    echo $nama_kelas['nama_kelas'];
                                                    if ($i == $pjg - 1) {
                                                        continue;
                                                    } else {
                                                        echo ",";
                                                    }
                                                    ?>
                                                <?php $i++;
                                                } ?>
                                            '>Please click</a>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        if ($messange->CekStatusSiswa($host, $view['email']) == true) {
                                                        ?>
                                                            <span class="badge badge-success">Online</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-danger">Offline</span>
                                                        <?php } ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <span class="badge badge-info"><?php echo $messange->CekJumlahPesan($host, $email, $view['email']) . " pesan" ?></span>
                                                    </center>

                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="<?php echo "./send.php?to=$view[email]" ?>">Mulai Chat</a>
                                                    </center>
                                                </td>
                                            </tr>
                                    <?php $no++;
                                        }
                                    } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="card mb-4 hidden" id="view_pesan_masuk">
                        <div class="card-body">
                            <h5>Pesan Belum Terbaca</h5>
                            <hr>

                            <?php
                            if ($messange->CekJumlaPesanMasukForGuru($host, $email) == 0) {
                                echo "Belum ada pesan terbaru";
                            } else {
                            ?>

                                <table class="table dt-responsive nowrap" style="width:100%" style="width:100%" id="table_belum_dibaca">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>No</center>
                                            </th>
                                            <th>
                                                <center>Pengirim</center>
                                            </th>
                                            <th>
                                                <center>Status</center>
                                            </th>
                                            <th>
                                                <center>Belum dibaca</center>
                                            </th>
                                            <th>
                                                <center>Action</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $Data_kontak = $messange->TampilkanPesanMasukForGuru($host, $email);
                                        $i = 1;
                                        foreach ($Data_kontak as $view_siswa) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $i; ?></center>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($view_siswa['gambar'] == NULL) {
                                                    ?>
                                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                                    <?php } else { ?>
                                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$view_siswa[gambar]" ?>">
                                                    <?php } ?>
                                                    <?php echo $view_siswa['first_name'] . " " . $view_siswa['last_name'] ?>
                                                </td>

                                                <td>
                                                    <center>
                                                        <?php
                                                        if ($pesan->CekStatusSiswa($host, $view_siswa['email']) == true) {
                                                        ?>
                                                            <span class="badge badge-success">Online</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-danger">Offline</span>
                                                        <?php } ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <span class="badge badge-info"><?php echo $messange->JumlahPesanBelumTerbacaPerSiswaForGuru($host, $email, $view_siswa['email']) . " pesan" ?></span>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <a href="<?php echo "../../controller/teachers/Messange.php?key=$key&to=$view_siswa[email]&email=$email&update" ?>">Baca Sekarang</a>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        } ?>
                                    </tbody>
                                </table>

                            <?php } ?>
                        </div>
                    </div>

                    <div class="card mb-4 hidden" id="view_hubungi_admin">
                        <div class="card-body">
                            <h5>
                                <?php if ($pesanadmin->StatusAdmin($host) > 0) { ?>
                                    Hubungi Admin <span class="badge badge-success">Online</span>
                                <?php } else { ?>
                                    Hubungi Admin <span class="badge badge-danger">Ofline</span>

                                <?php } ?>
                            </h5>
                            <hr>

                            <?php
                            if ($pesanadmin->CekPesanKosong($host, $email) == 0) {

                                echo "<h4 class='mb-4 text-center'>Belum Ada Pesan Masuk</h4>";
                            } else {
                                $view_pesan_arr = $pesanadmin->ViewChatting($host, $email);
                                foreach ($view_pesan_arr as $view_pesan) :
                            ?>
                                    <?php if ($view_pesan['pengirim'] == "guru") : ?>
                                        <div class="container">
                                            <a href="<?php echo "../../controller/teachers/PesanAdmin.php?id=$view_pesan[id_pesan]" ?>" style="float: right; color:red;" data-tootlip="tooltip" title='Hapus'><i class="fas fa-trash"></i></a>
                                            <?php if ($mygambar == NULL) { ?>
                                                <img src="../assets/user/img/noimg.png" alt="Avatar" class="left">
                                            <?php } else { ?>
                                                <img src="../assets/userprofil/<?php echo $mygambar ?>" alt="Avatar" class="left">
                                            <?php } ?>
                                            <p><?php echo $view_pesan['pesan'] ?></p>
                                            <span class="time-right"><?php echo $view_pesan['date_time'] ?></span>
                                        </div>
                                    <?php endif ?>

                                    <?php if ($view_pesan['pengirim'] == "admin") : ?>
                                        <div class="container darker">
                                            <img src="../../administrator/dist/img/<?php echo $pesanadmin->gettingGambarAdmin($host); ?>" alt="Avatar" class="right">
                                            <p><?php echo $view_pesan['pesan'] ?></p>
                                            <span class="time-left"><?php echo $view_pesan['date_time'] ?></span>
                                        </div>
                                    <?php endif ?>

                                <?php endforeach ?>
                            <?php } ?>

                            <form action="../../controller/teachers/PesanAdmin.php" method="post">
                                <textarea id="editor1" name="pesan"></textarea>
                                <input type="hidden" name="email_guru" value="<?php echo $email ?>">
                                <button id="kirim" type="submit" name="kirim" class="btn btn-default btn-sm clik" style="color: #fff; background: #031b29;border-color: #3c1012">
                                    <i class="fa fa-paper-plane text-theme m-l-5"></a></i> Kirim
                                </button>
                                <!-- <button id="kirim" type="submit" name="kirim" class="btn btn-success mt-2">Kirim</button> -->
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

        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script> -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
    </body>

    <script>
        $(function() {
            $('[data-tootlip="tooltip"]').tooltip()
        })
        let editor;

        ClassicEditor
            .create(document.querySelector('#editor1'), {

                ckfinder: {
                    uploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

                },
                toolbar: ['imageUpload', '|', 'heading', '|', 'bold', 'italic', 'link', '|', 'undo', 'redo']

            })
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $(document).ready(function() {
            $('#lihatkontak').DataTable();
            $('#table_belum_dibaca').DataTable();

            $(function() {
                $('[data-toggle="popover"]').popover()
            })
        });
    </script>

    <script>
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
    </script>

    </html>

<?php
} else {
    header("location:../../index.php");
}
?>