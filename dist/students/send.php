<?php
@include '../../controller/inisial.php';
@include '../../config/config.php';
@include '../../controller/students/Dashboard_siswa.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/students/Pesan.php';
@include '../../controller/teachers/KumpulTugas.php';

session_start();

if (isset($_SESSION['q']) && isset($_GET['to'])) {

    $q = $_SESSION['q'];
    $to = $_GET['to'];
    if (cek_halaman_utama_siswa($host, $q) == true) {

        cek_halaman_send_pesan_siswa($host, $q, $to);
        //class view
        $view = new view;
        $Identitas_app = new Aplikasi;
        $pesan = new Pesan;
        $kumpultugas = new KumpulTugas;
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
            <link rel="stylesheet" href="../../vendor/assets/libs/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="../../vendor/assets/css/app.css">
            <title>Send - Students</title>
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link rel="stylesheet" href="../css/styles.css" />
            <link rel="stylesheet" href="../../vendor/assets/libs/fontawesome/css/all.min.css">
            <link rel="stylesheet" href="../css/chat.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">

            <script src="../../administrator/plugins/sweetalert2/sweetalert2.min.js"></script>
            <script src="../../vendor/assets/libs/fontawesome/css/all.min.css"></script>
            <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
            <script src="../../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

            <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

        </head>

        <body class="sb-nav-fixed">
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
                                <a class="nav-link" href="index.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard
                                </a>
                                <a class="nav-link" href="<?php echo "../../index.php" ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home
                                </a>

                                <div class="sb-sidenav-menu-heading">Control Class</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Modul Class
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
                                    <a class="nav-link" href="pesan.php">
                                        <div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="nav-link" href="pesan.php">
                                        <div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange &nbsp; <span class='badge badge-danger'>New</span>
                                    </a>

                                <?php } ?>

                            </div>

                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">Logged in as:</div>
                            Students
                        </div>
                    </nav> -->
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3">
                            Messange
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><?php echo "<a href='./index.php'>Dashboard</a>"; ?></li>
                            <li class="breadcrumb-item"><?php echo "<a href='./pesan.php'>Messange</a>"; ?></li>
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

                        <div class="card mb-3">
                            <div class="card-body">
                                <?php $DataGuru = $pesan->GetNamaGuru($host, $to); ?>
                                <h5 class="card-text">
                                    <?php if ($DataGuru[2] == NULL) { ?>
                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                    <?php } else { ?>
                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$DataGuru[2]" ?>">
                                    <?php } ?>
                                    <?php echo $DataGuru[0] . " " . $DataGuru[1] ?>

                                    <?php if ($pesan->GetStatusGuru($host, $to) == true) { ?>
                                        <span class="badge badge-success">Online</span>
                                    <?php } else { ?>
                                        <span class="badge badge-danger">Offline</span>
                                    <?php } ?>
                                </h5>
                                <hr>

                                <?php if ($pesan->JumlahPesan_siswaToGuru($host, $to, $q) == 0) {
                                    echo "<h5 class='text-center'>Pesan Masih Kosong</h5>";
                                } else {
                                    $View_pesan_arr = $pesan->GetChattingElementGuruAndSiswa($host, $to, $email);
                                    foreach ($View_pesan_arr as $view_pesan) {
                                ?>

                                        <?php if ($view_pesan['pengirim'] == "guru") { ?>
                                            <div class="container">
                                                <?php
                                                if ($view_pesan['gambar_guru'] == NULL) {
                                                ?>
                                                    <img src="../assets/user/img/noimg.png" alt="Avatar" class="Avater" class="left">
                                                <?php } else { ?>
                                                    <img src="<?php echo "../assets/userprofil/$view_pesan[gambar_guru]" ?>" alt="Avatar" class="left">
                                                <?php } ?>
                                                <p><?php echo $view_pesan['pesan'] ?></p>
                                                <span class="time-right"><?php echo $view_pesan['date_time'] ?></span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="container" style="background-color: white;">
                                                <?php
                                                if ($view_pesan['gambar_siswa'] == NULL) {
                                                ?>
                                                    <a href="<?php echo "../../controller/students/Pesan.php?id_pesan=$view_pesan[id_pesan]&q=$q&to=$to" ?>" style="float: right; color:red;" data-tootlip="tooltip" title='Hapus'><i class="fas fa-trash"></i></a>
                                                    <img src="../assets/img/noimg.png" alt="Avatar" class="Avater" class="right">
                                                <?php } else { ?>
                                                    <a href="<?php echo "../../controller/students/Pesan.php?id_pesan=$view_pesan[id_pesan]&q=$q&to=$to" ?>" style="float: right; color:red;" data-tootlip="tooltip" title='Hapus'><i class="fas fa-trash"></i></a>
                                                    <img src="<?php echo "../assets/userprofil/$view_pesan[gambar_siswa]" ?>" alt="Avatar" class="right">
                                                <?php } ?>
                                                <p><?php echo $view_pesan['pesan'] ?></p>
                                                <span class="time-left"><?php echo $view_pesan['date_time'] ?></span>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>

                                <form action="../../controller/students/Pesan.php" method="post">
                                    <textarea id="editor1" name="editor1"></textarea>
                                    <input type="hidden" id="email_siswa" name="email_siswa" value="<?php echo $email ?>">
                                    <input type="hidden" id="email_guru" name="email_guru" value="<?php echo $to ?>">
                                    <input type="hidden" id="q" name="q" value="<?php echo $q ?>">
                                    <button id="kirim_pesan" type="submit" name="kirim_pesan" class="btn btn-success mt-2">Kirim</button>
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
            <script src="../assets/ckeditor5/ckeditor.js"></script>
            <script>
                $(document).ready(function() {
                    $('#table_kontak_guru').DataTable();
                    $(function() {
                        $('[data-tootlip="tooltip"]').tooltip()
                    });
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