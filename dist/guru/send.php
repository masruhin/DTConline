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

    if (isset($_GET['to'])) {

        $key = $_SESSION['key'];
        $email_siswa = $_GET['to'];

        if (My_chek($key, $host));

        //objek objek
        $chek_class = new statistic;
        $general_objek = new general;
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
            <title>Send Pesan - Teachers</title>
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link rel="stylesheet" href="../css/styles.css" />
            <link rel="stylesheet" href="../css/chat.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
            <script src="../assets/ckeditor/ckeditor.js"></script>
            <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
            <script src="../assets/ckeditor5/ckeditor.js"></script>

            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
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

                            echo "<a class='nav-link' href='Pesan.php' title='Commuication'><i class='fa fa-comments text-dark' title='Communication'></i> Message&nbsp; <span class='badge badge-danger'>New</span></a>";
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
                            Guru
                        </div>
                    </nav> -->
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3 mb-5">
                            Messange
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><?php echo "<a href='index.php'>Dashboard</a>"; ?></li>
                            <li class="breadcrumb-item"><?php echo "<a href='Pesan.php'>Messange</a>"; ?></li>
                            <li class="breadcrumb-item active">Send</li>
                        </ol>

                        <?php
                        if (isset($_GET['fail'])) {
                        ?>
                            <div class="alert alert-danger" role="alert" id="no_input">
                                Kolom Pesan Tidak Boleh Kosong
                            </div>
                        <?php } ?>

                        <?php
                        if (isset($_GET['yes'])) {
                        ?>
                            <div class="alert alert-success" role="alert" id="sukses">
                                Pesan Terkirim
                            </div>
                        <?php } ?>
                        <div class="card mb-4" id="view_pesan_masuk">
                            <div class="card-body">
                                <?php
                                $Datatujuan = $messange->GetIdentitasSiswa($host, $email_siswa);
                                ?>

                                <h5>
                                    <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$Datatujuan[2]" ?>">
                                    <?php echo $Datatujuan[0] . " " . $Datatujuan[1] ?>

                                    <?php
                                    if ($messange->CekStatusSiswa($host, $email_siswa) == true) {
                                    ?>
                                        <span class="badge badge-success">Online</span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">Offline</span>
                                    <?php } ?>

                                </h5>
                                <hr>

                                <?php
                                if ($messange->CekChatGuruAndSiswa($host, $email, $email_siswa) == 0) {
                                    echo "<h5 class='text-center'>Pesan Masih Kosong</h5>";
                                } else {
                                    $View_pesan_arr = $messange->GetChattingElementGuruAndSiswa($host, $email, $email_siswa);
                                    foreach ($View_pesan_arr as $view_pesan) {
                                ?>
                                        <?php if ($view_pesan['pengirim'] == "siswa") { ?>
                                            <div class="container">
                                                <?php
                                                if ($view_pesan['gambar_siswa'] == NULL) {
                                                ?>
                                                    <img src="../assets/user/img/noimg.png" alt="Avatar" class="Avater" class="left">
                                                <?php } else { ?>
                                                    <img src="<?php echo "../assets/userprofil/$view_pesan[gambar_siswa]" ?>" alt="Avatar" class="left">
                                                <?php } ?>
                                                <p><?php echo $view_pesan['pesan'] ?></p>
                                                <span class="time-right"><?php echo $view_pesan['date_time'] ?></span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="container" style="background-color: white;">
                                                <?php
                                                if ($view_pesan['gambar_guru'] == NULL) {
                                                ?>
                                                    <img src="../assets/user/img/noimg.png" alt="Avatar" class="Avater" class="right">
                                                <?php } else { ?>
                                                    <a href="<?php echo "../../controller/teachers/Messange.php?id_pesan=$view_pesan[id_pesan]&key=$key&to=$email_siswa" ?>" style="float: right; color:red;" data-tootlip="tooltip" title='Hapus'><i class="fas fa-trash"></i></a>
                                                    <img src="<?php echo "../assets/userprofil/$view_pesan[gambar_guru]" ?>" alt="Avatar" class="right">
                                                <?php } ?>
                                                <p><?php echo $view_pesan['pesan'] ?></p>
                                                <span class="time-left"><?php echo $view_pesan['date_time'] ?></span>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                                <?php } ?>
                                <form action="../../controller/teachers/Messange.php" method="post">
                                    <textarea id="editor1" name="editor1"></textarea>
                                    <input type="hidden" id="email_siswa" name="email_siswa" value="<?php echo $email_siswa ?>">
                                    <input type="hidden" id="email_guru" name="email_guru" value="<?php echo $email ?>">
                                    <input type="hidden" id="key" name="key" value="<?php echo $key ?>"> <br>
                                    <button id="kirim_pesan" type="submit" name="kirim_pesan" class="btn btn-default btn-sm clik" style="color: #fff; background: #031b29;border-color: #3c1012">
                                        <i class="fa fa-paper-plane text-theme m-l-5"></a></i> Kirim
                                    </button>
                                    <!-- <button id="kirim_pesan" type="submit" name="kirim_pesan" class="btn btn-success mt-2">Kirim</button> -->
                                </form>
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

            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="../js/scripts.js"></script>
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