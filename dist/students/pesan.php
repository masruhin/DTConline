<?php
@include '../../controller/inisial.php';
@include '../../config/config.php';
@include '../../controller/students/Dashboard_siswa.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/students/Pesan.php';
@include '../../controller/teachers/KumpulTugas.php';
@include '../../controller/students/PesanAdmin.php';

session_start();

if (isset($_SESSION['q'])) {

    $q = $_SESSION['q'];
    if (cek_halaman_utama_siswa($host, $q) == true) {

        //class view
        $view = new view;
        $Identitas_app = new Aplikasi;
        $pesan = new Pesan;
        $kumpultugas = new KumpulTugas;
        $pesanadmin = new pesanadmin;

        $name_siswa = $view->view_nama_siswa($host, $q);
        $iden_app_arr = $Identitas_app->Viewapp($host);
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
            <title>Pesan - Students</title>
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link href="../css/styles.css" rel="stylesheet" />
            <link rel="stylesheet" href="../css/chat.css">
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link href="../css/styles.css" rel="stylesheet" />
            <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
            <link rel="stylesheet" href="../../vendor/assets/libs/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="../../vendor/assets/css/app.css">
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link rel="stylesheet" href="../css/styles.css" />
            <link rel="stylesheet" href="../../vendor/assets/libs/fontawesome/css/all.min.css">
            <link rel="stylesheet" href="/assets/libs/fontawesome/css/all.min.css">
            <link rel="stylesheet" href="/assets/css/app.css">
            <script src="../../administrator/plugins/sweetalert2/sweetalert2.min.js"></script>
            <script src="../../vendor/assets/libs/fontawesome/css/all.min.css"></script>
            <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
            <script src="../../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
            <script src="../assets/ckeditor5/ckeditor.js"></script>

        </head>

        <body class="hold-transition layout-top-nav">

            <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #06d2bf; color:white;  box-shadow: 0px 4px 10px #999;">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item mt-1">
                            <h6 style="color:black; font-weight:normal">
                                <?php
                                if ($view->Cekisigambar($host, $q) == NULL) {
                                ?>
                                    <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo $name_siswa[0] . " " . $name_siswa[1] ?>
                                <?php
                                } else {
                                    $mygambar = $view->Cekisigambar($host, $q);
                                    echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> " . $name_siswa[0] . " " . $name_siswa[1] . "";
                                }
                                ?>

                            </h6>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo "../../index.php" ?>"><i class="fa fa-home text-dark"></i>
                                Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo "index.php" ?>"><i class="fas fa-layer-group text-dark"></i> Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active " id="dropdown-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-database"></i> My Course</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-1">
                                <a href="#" class="dropdown-item">
                                    <?php echo "<a class='dropdown-item' href='#join_class' data-toggle='modal' data-q='$q'>Join Class</a>"; ?>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <?php echo "<a class='dropdown-item' href='#set_akun' data-toggle='modal' data-q='$q'>Setting Accocunt </a>"; ?>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($kumpultugas->CekJoinKelas($host, $email) == 0) {
                            ?>
                                <a type="button" class="btn position-relative" href="<?php echo "DaftarTugas.php" ?>"> <i class="fas fa-tags text-dark" style="padding-left: 1px;"></i>
                                    Task
                                </a>
                            <?php } else { ?>
                                <?php if ($kumpultugas->Validation($host, $email) == true) { ?>
                                    <a type="button" class="btn position-relative font-weight-bold" href="<?php echo "DaftarTugas.php" ?>">
                                        <i class="fas fa-tags text-dark" style="padding-left: 1px;">
                                        </i>
                                        Task <span class="badge position-absolute top-0 left-100 translate-middle bg-danger badge-pill" style="font-weight: normal; padding-top:0px">new</span>
                                    </a>
                                <?php } else { ?>
                                    <a type="button" class="btn position-relative" href="<?php echo "DaftarTugas.php" ?>"> <i class="fas fa-tags text-dark" style="padding-left: 1px;"></i>
                                        Task
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
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
                        if ($pesan->JumlahPesanBelumTerbaca($host, $email) == 0) {

                            echo "<a class='nav-link active' href='Pesan.php' title='Commuication'><i class='fa fa-comments text-dark' title='Commuication'></i> Message</a>";
                        } else {

                            echo "<a class='nav-link active' href='Pesan.php' title='Commuication'><i class='fa fa-comments text-info' title='Communication'></i> Message&nbsp; <span class='badge badge-danger'>New</span></a>";
                        }
                        ?>
                    </li>
                </ul>
                <ul class="navbar-nav" style="padding-left: 20px;">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" id="dropdown-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-edit text-dark"></i>
                            Student</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-2">
                            <?php echo "<a class='dropdown-item' href='#set_akun' data-toggle='modal' data-q='$q'>Edit Profile</a>"; ?>
                            <a href='../../login.php' class="dropdown-item">Log-out</a>
                        </div>
                    </li>
                </ul>

                <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                </form>

            </nav>
            <!-- <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <a class="navbar-brand" href="javscript:void(0)">
                    <h6>
                        <?php
                        if ($view->Cekisigambar($host, $q) == NULL) {
                        ?>
                            <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo $name_siswa[0] . " " . $name_siswa[1] ?>
                        <?php
                        } else {
                            $mygambar = $view->Cekisigambar($host, $q);
                            echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> " . $name_siswa[0] . " " . $name_siswa[1] . "";
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
                                <a class="nav-link" href="<?php echo "index.php" ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard
                                </a>
                                <a class="nav-link" href="<?php echo "../../index.php" ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home
                                </a>

                                <div class="sb-sidenav-menu-heading">Control Kelas</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Modul Kelas
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo "<a class='nav-link' href='#join_class' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-plus-circle'></i></div>Join Class</a>"; ?></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo "<a class='nav-link' href='#set_akun' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-user-cog'></i></div>Setting Accocunt</a>"; ?></nav>
                                </div>
                                <?php
                                if ($kumpultugas->CekJoinKelas($host, $email) == 0) {
                                ?>
                                    <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas
                                    </a>
                                <?php } else { ?>
                                    <?php if ($kumpultugas->Validation($host, $email) == true) { ?>
                                        <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>">
                                            <div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas &nbsp; <span class='badge badge-danger'>New</span>
                                        </a>
                                    <?php } else { ?>
                                        <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>">
                                            <div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                                <div class="sb-sidenav-menu-heading">Communication</div>

                                <?php
                                if ($pesan->JumlahPesanBelumTerbaca($host, $email) == 0) {
                                ?>
                                    <a class="nav-link" href="javascript:void(0)">
                                        <div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="nav-link" href="javascript:void(0)">
                                        <div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange &nbsp; <span class='badge badge-danger'>New</span>
                                    </a>

                                <?php } ?>
                            </div>

                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                            Students
                        </div>
                    </nav>
                </div> -->


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3">
                            Messange
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><?php echo "<a href='./index.php'>Dashboard</a>"; ?></li>
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

                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-text" id="view_kontak_guru">Total Kontak <span class="badge badge-primary"><?php echo $pesan->Jumlah_Kontak_Guru($host, $q); ?></span></h5>
                                <h5 class="card-text hidden" id="view_kontak_teman">Total Kontak <span class="badge badge-success"><?php echo $pesan->TotalKontakTeman($host, $q); ?></span></h5>
                                <h5 class="card-text hidden" id="view_hubungi_admin">Hubungi Admin</h5>
                                <h5 class="card-text hidden" id="view_pesan_belum_terbaca">Pesan Belum Terbaca </span></h5>
                                <hr>

                                <label for="xxx">Pilih argumen dibawah <span style="color: red;">*</span></label>
                                <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="kontak_guru" name="customRadio" class="custom-control-input" required checked onclick="View()">
                                    <label class="custom-control-label" for="kontak_guru">Contact Accessor</label>
                                </div>
                                <!-- <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="kontak_teman" name="customRadio" class="custom-control-input" required onclick="View()">
                                    <label class="custom-control-label" for="kontak_teman">Kontak Teman</label>
                                </div> -->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="hubungi_admin" name="customRadio" class="custom-control-input" required onclick="View()">
                                    <label class="custom-control-label" for="hubungi_admin">Hubungi Admin</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="pesan_belum_terbaca" name="customRadio" class="custom-control-input" required onclick="View()">
                                    <label class="custom-control-label" for="pesan_belum_terbaca">Pesan Belum Terbaca <span class="badge badge-info"><?php echo $pesan->JumlahPesanBelumTerbaca($host, $email); ?></span></label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3" id="view_kontak_guruu">
                            <div class="card-body">
                                <h5 class="card-text">Contact Accessor</h5>
                                <hr>
                                <?php
                                if ($pesan->Jumlah_Kontak_Guru($host, $q) == 0) {
                                    echo "Anda belum bergabung dengan kelas manapun";
                                } else {

                                ?>
                                    <table class="table table-bordered dt-responsive nowrap" style="width:100%" style="width:100%" id="table_kontak_guru">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>No</center>
                                                </th>
                                                <th>
                                                    <center>Nama</center>
                                                </th>
                                                <th>
                                                    <center>Wali Kelas</center>
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
                                            $Data_kontak = $pesan->TampilKontakGuru($host, $q);
                                            $i = 1;
                                            foreach ($Data_kontak as $view_guru) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $i; ?></center>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($view_guru['gambar_guru'] == NULL) {
                                                        ?>
                                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                                        <?php } else { ?>
                                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$view_guru[gambar_guru]" ?>">
                                                        <?php } ?>
                                                        <?php echo $view_guru['first_name'] . " " . $view_guru['last_name'] ?>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="javascript:void(0)" class="badge badge-success badge-pill" style="font-weight: 500; padding: buttom 2px;" data-toggle="popover" title="Kelas yang diampu" data-content='
                                                    <?php
                                                    $Get_nama_kelas = $pesan->Get_Namakelas($host, $view_guru['email']);
                                                    $i = 0;
                                                    $jum = count($Get_nama_kelas);

                                                    foreach ($Get_nama_kelas as $nama_kelas) {
                                                        echo $nama_kelas['nama_kelas'];
                                                        if ($i == $jum - 1) {
                                                            continue;
                                                        } else {
                                                            echo " , ";
                                                        }
                                                        $i++;
                                                    }
                                                    ?>
                                                    '>Please click</a>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php
                                                            if ($pesan->GetStatusGuru($host, $view_guru['email']) == true) {
                                                            ?>
                                                                <span class="badge badge-success badge-pill" style="font-weight: 500; padding: buttom 2px;">Online</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger badge-pill" style="font-weight: 500; padding: buttom 2px;">Offline</span>
                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <span class="badge badge-info badge-pill" style="font-weight: 500; padding: buttom 2px;"><?php echo $pesan->JumlahPesan_siswaToGuru($host, $view_guru['email'], $q) . " pesan" ?></span>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo "./send.php?to=$view_guru[email]" ?>">Mulai Chat</a>
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

                        <div class="card mb-3 hidden" id="view_kontak_temann">
                            <div class="card-body">
                                <h5 class="card-text">Kontak Teman</h5>
                                <hr>
                                <?php
                                if ($pesan->TotalKontakTeman($host, $q) == 0) {
                                    echo "Anda belum memiliki teman";
                                } else {
                                ?>
                                    <table class="table table-bordered dt-responsive nowrap" style="width:100%" style="width:100%" id="table_kontak_teman">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>No</center>
                                                </th>
                                                <th>
                                                    <center>Nama</center>
                                                </th>
                                                <th>
                                                    <center>Kelas</center>
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
                                            $Data_teman_arr = $pesan->TampilKontakTeman($host, $q);
                                            $no = 1;
                                            foreach ($Data_teman_arr as $view_siswa) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $no; ?></center>
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
                                                            if ($pesan->Cek_Jumlah_Kelas_join($host, $view_siswa['email']) == 0) {
                                                                echo "<span class='badge badge-warning'>Belum Terdaftar</span>";
                                                            } else {
                                                            ?>
                                                                <a href="javascript:void(0)" class="badge badge-success" data-toggle="popover" title="Kelas yang diikuti" data-content='
                                                    <?php
                                                                $Get_nama_kelas_siswa = $pesan->TampilkanKelasSiswa($host, $view_siswa['email']);
                                                                $j = 0;
                                                                $jumlah = count($Get_nama_kelas_siswa);

                                                                foreach ($Get_nama_kelas_siswa as $nama_kelas_siswa) {
                                                                    echo $nama_kelas_siswa['nama_kelas'];
                                                                    if ($j == $jumlah - 1) {
                                                                        continue;
                                                                    } else {
                                                                        echo " , ";
                                                                    }
                                                                    $j++;
                                                                }
                                                    ?>
                                                    '>Please click</a>
                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php
                                                            if ($pesan->GetStatusSiswa($host, $view_siswa['email']) == true) {
                                                            ?>
                                                                <span class="badge badge-success">Online</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger">Offline</span>
                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center><span class="badge badge-info"><?php echo $pesan->Total_Pesan_siswa_to_siswa($host, $email, $view_siswa['email']) . " pesan" ?></span></center>
                                                    </td>
                                                    <td>
                                                        <center><a href="<?php echo "sendTeman.php?to=$view_siswa[email]" ?>">Mulai Chat</a></center>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="card mb-3 hidden" id="view_hubungi_adminn">
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
                                        <?php if ($view_pesan['pengirim'] == "siswa") : ?>
                                            <div class="container">
                                                <a href="<?php echo "../../controller/students/PesanAdmin.php?id=$view_pesan[id_pesan]" ?>" style="float: right; color:red;" data-tootlip="tooltip" title='Hapus'><i class="fas fa-trash"></i></a>
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

                                <form action="../../controller/students/PesanAdmin.php" method="post">
                                    <textarea id="editor1" name="pesan"></textarea>
                                    <input type="hidden" name="email_siswa" value="<?php echo $email ?>">
                                    <button id="kirim" type="submit" name="kirim" class="btn btn-success mt-2">Kirim</button>
                                </form>
                            </div>
                        </div>

                        <div class="card mb-3 hidden" id="view_pesan_belum_terbacaa">
                            <div class="card-body">
                                <h5 class="card-text">Pesan belum terbaca </h5>
                                <hr>

                                <?php
                                if ($pesan->JumlahPesanBelumTerbaca($host, $email) == 0) {
                                    echo "Tidak ada pesan terbaru";
                                } else {

                                ?>
                                    <table class="table table-bordered dt-responsive nowrap" style="width:100%" style="width:100%" id="table_belum_dibaca">
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
                                            $Data_kontak = $pesan->TampilPesanBelumTerbaca($host, $email);
                                            $i = 1;
                                            foreach ($Data_kontak as $view_guru) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <center><?php echo $i; ?></center>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($view_guru['gambar_guru'] == NULL) {
                                                        ?>
                                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                                        <?php } else { ?>
                                                            <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$view_guru[gambar_guru]" ?>">
                                                        <?php } ?>
                                                        <?php echo $view_guru['first_name'] . " " . $view_guru['last_name'] ?>
                                                    </td>

                                                    <td>
                                                        <center>
                                                            <?php
                                                            if ($pesan->GetStatusGuru($host, $view_guru['email']) == true) {
                                                            ?>
                                                                <span class="badge badge-success">Online</span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger">Offline</span>
                                                            <?php } ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <span class="badge badge-info"><?php echo $pesan->JumlahSiswaBelumBacaPesan($host, $view_guru['email'], $email) . " pesan" ?></span>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo "./send.php?to=$view_guru[email]&email=$email&update" ?>">Baca Sekarang</a>
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
            <script src="../js/ChattingSiswa.js"></script>

            <script>
                $(document).ready(function() {
                    $('#table_kontak_guru').DataTable();
                    $('#table_kontak_teman').DataTable();
                    $('#table_belum_dibaca').DataTable();

                    $(function() {
                        $('[data-toggle="popover"]').popover()
                    })
                });
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

                // ajax modal join class
                $(document).ready(function() {
                    $('#join_class').on('show.bs.modal', function(e) {
                        var q = $(e.relatedTarget).data('q');
                        $.ajax({
                            url: '../../controller/students/ajax/ajax_joinClass.php',
                            type: 'POST',
                            data: {
                                'q': q
                            },
                            success: function(data) {
                                $('.modal_join_class').html(data);
                            }
                        });
                    });
                });
                //end ajax modal join class

                // ajax modal update profile
                $(document).ready(function() {
                    $('#set_akun').on('show.bs.modal', function(e) {
                        var q = $(e.relatedTarget).data('q');
                        $.ajax({
                            url: '../../controller/students/ajax/ajax_set_akun.php',
                            type: 'POST',
                            data: {
                                'q': q
                            },
                            success: function(data) {
                                $('.modal_set_akun').html(data);
                            }
                        });
                    });
                });
                //end ajax update profile
            </script>


        </body>

        </html>

<?php }
} else {
    header("location:../../index.php");
}
?>