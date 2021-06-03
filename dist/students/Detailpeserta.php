<?php
@include '../../controller/inisial.php';
@include '../../config/config.php';
@include '../../controller/students/Dashboard_siswa.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/students/Class_siswa.php';
@include '../../controller/students/Pesan.php';
@include '../../controller/teachers/KumpulTugas.php';

session_start();

if (isset($_SESSION['q'])) {

    if (isset($_GET['class_code'])) {

        $q = $_SESSION['q'];
        $class_code = $_GET['class_code'];

        if (cek_halaman_class_siswa($host, $class_code, $q) == true) {

            $view = new view;

            $Identitas_app = new Aplikasi;

            $class_siswa = new class_siswa;

            $pesan = new Pesan;

            $kumpultugas = new KumpulTugas;

            $iden_app_arr = $Identitas_app->Viewapp($host);

            $name_siswa = $view->view_nama_siswa($host, $q);

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
                <title>Detail Peserta - Students</title>
                <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
                <link href="../css/styles.css" rel="stylesheet" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

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

            <body class="sb-nav-fixed">
                <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

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
                                        <a class="nav-link" href="<?php echo "pesan.php" ?>">
                                            <div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a class="nav-link" href="<?php echo "pesan.php" ?>">
                                            <div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange &nbsp; <span class='badge badge-danger'>New</span>
                                        </a>

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
                                    echo "Data Peserta Kelas " . $view->view_nama_kelas($host, $class_code);
                                    ?>
                                </h4>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><?php echo "<a href='index.php'>Dashboard</a>"; ?></li>
                                    <li class="breadcrumb-item active"><?php echo "<a href='class.php?class_code=$class_code'>"; ?> <?php echo $view->view_nama_kelas($host, $class_code) ?></a></li>
                                    <li class="breadcrumb-item active">Anggota</li>

                                </ol>

                                <?php
                                if (isset($_GET['emailok'])) {
                                ?>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                                        <strong>Success</strong> Pesan melalui email berhasil terkirim
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                <?php } ?>

                                <div class="card mb-2">

                                    <div class="card-body">
                                        <a href="javascript:void(0)" style="text-decoration: none;">
                                            <h5 class="mt-0"><i class='fas fa-users'></i> Total Peserta <span class="badge badge-primary"><?php echo $class_siswa->CountPesertaInKelas($host, $class_code); ?>
                                        </a></span></h5>
                                        <hr>
                                        <a href="javascript:void(0)" style="text-decoration: none;">
                                            <h5><i class="fas fa-user-tie"></i> Accessor Name : <?php echo $view->view_nama_guru($host, $class_code) ?>
                                        </a> <a href="pesan.php" data-tootlip="tooltip" title="Pesan Aplikasi" style="float: right;"><i class='fab fa-facebook-messenger' style='font-size:20px;'></i></a></h5>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-body">

                                        <h5 style="color:blue;">Data Peserta</h5>
                                        <hr>

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
                                                        <center>Whatsapp number</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th>
                                                        <center>Action</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $nomor = 1;
                                                $Showanggota = $class_siswa->ShowPesertaInKelas($host, $class_code);
                                                foreach ($Showanggota as $peserta) {
                                                ?>
                                                    <?php
                                                    if ($peserta['password'] == $q) {
                                                    ?>

                                                        <tr class="table-active">
                                                            <td>
                                                                <center>
                                                                    <?php echo $nomor; ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$peserta[gambar]" ?>">
                                                                <?php echo $peserta['first_name'] . " " . $peserta['last_name'] ?>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php echo $peserta['email'] ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($peserta['nohp_siswa'] == NULL) {
                                                                        echo "<span class='badge badge-primary'>Belum mengisi</span>";
                                                                    } else {
                                                                        echo $peserta['nohp_siswa'];
                                                                    }
                                                                    ?>
                                                                </center>

                                                            </td>

                                                            <td>
                                                                <center>
                                                                    <span class="badge badge-success">Online</span>
                                                                </center>
                                                            </td>

                                                            <td>
                                                                <center>
                                                                    Host
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    } else {
                                                    ?>

                                                        <tr>
                                                            <td>
                                                                <center>
                                                                    <?php echo $nomor; ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($view->Cekisigambar($host, $peserta['password']) == null) {

                                                                ?>
                                                                    <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;">
                                                                    <?php echo $peserta['first_name'] . " " . $peserta['last_name'] ?>
                                                                <?php } else { ?>
                                                                    <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$peserta[gambar]" ?>">
                                                                    <?php echo $peserta['first_name'] . " " . $peserta['last_name'] ?>
                                                                <?php } ?>

                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php echo $peserta['email'] ?>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($peserta['nohp_siswa'] == NULL) {
                                                                        echo "<span class='badge badge-primary'>Belum Mengisi</span>";
                                                                    } else {
                                                                        echo $peserta['nohp_siswa'];
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </td>

                                                            <td>
                                                                <center>
                                                                    <?php
                                                                    if ($class_siswa->CekstatusSiswa($host, $peserta['password']) == true) {
                                                                        echo "<span class='badge badge-success'>Online</span>";
                                                                    } else {
                                                                        echo "<span class='badge badge-danger'>Offline</span>";
                                                                    }
                                                                    ?>
                                                                </center>
                                                            </td>

                                                            <td>
                                                                <center>
                                                                    <?php echo "<a href='#whatsapp' data-toggle='modal' data-q='$q' data-classcode='$class_code' data-nohp='$peserta[nohp_siswa]' data-tootlip='tooltip' title='Hubungi via whatsapp'><i class='fab fa-whatsapp' style='font-size:20px;'></i></a>"; ?>
                                                                    <?php echo "<a href='#email' data-toggle='modal' data-q='$q' data-classcode='$class_code' data-emailtujuan='$peserta[email]' data-tootlip='tooltip' title='Hubungi via email'><i class='fas fa-envelope-open-text' style='font-size:20px;'></i></a>"; ?>
                                                                    <?php echo "<a href='#pesan' data-tootlip='tooltip' title='Pesan Aplikasi'><i class='fab fa-facebook-messenger' style='font-size:20px;'></i></a>"; ?>
                                                                    <?php echo "<a href='#detail_siswa' data-toggle='modal' data-q='$q' data-pass_siswa='$peserta[password]' data-tootlip='tooltip' title='Lihat Profil'><i class='fas fa-cog' style='font-size:20px;'></i></a>"; ?>
                                                                </center>
                                                            </td>
                                                        </tr>

                                                    <?php } ?>
                                                <?php $nomor++;
                                                } ?>
                                            </tbody>
                                        </table>

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


                <?php echo "<input type='hidden' id='q' value='$q'>"; ?>
                <?php echo "<input type='hidden' id='code_class' value='$class_code'>"; ?>

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
                <div class="modal fade" id="email" role="dialog">
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

                <!-- modal view detail friend -->
                <div class="modal fade" id="detail_siswa" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><b>Lihat Profil</b></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">
                                <div class="modal_detail_siswa"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal view detail friend -->

                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                <script src="../js/scripts.js"></script>

                <script>
                    $(document).ready(function() {
                        $('#example').DataTable();
                    });
                    $(function() {
                        $('[data-tootlip="tooltip"]').tooltip()
                    })

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

                    // ajax modal whatsapp
                    $(document).ready(function() {
                        $('#whatsapp').on('show.bs.modal', function(e) {
                            var q = $(e.relatedTarget).data('q');
                            var class_code = $(e.relatedTarget).data('classcode');
                            var nohp = $(e.relatedTarget).data('nohp');

                            $.ajax({
                                url: '../../controller/students/ajax/ajax_whatsapp.php',
                                type: 'POST',
                                data: {
                                    'q': q,
                                    'class_code': class_code,
                                    'nohp': nohp
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
                        $('#email').on('show.bs.modal', function(e) {
                            var q = $(e.relatedTarget).data('q');
                            var class_code = $(e.relatedTarget).data('classcode');
                            var emailtujuan = $(e.relatedTarget).data('emailtujuan');

                            $.ajax({
                                url: '../../controller/students/ajax/ajax_email.php',
                                type: 'POST',
                                data: {
                                    'q': q,
                                    'class_code': class_code,
                                    'emailtujuan': emailtujuan
                                },
                                success: function(data) {
                                    $('.modal_send_email').html(data);
                                }
                            });
                        });
                    });
                    //end ajax modal kirim email

                    // ajax modal detail siswa
                    $(document).ready(function() {
                        $('#detail_siswa').on('show.bs.modal', function(e) {
                            var q = $(e.relatedTarget).data('q');
                            var pass_siswa_view = $(e.relatedTarget).data('pass_siswa');

                            $.ajax({
                                url: '../../controller/students/ajax/ajax_detail_siswa.php',
                                type: 'POST',
                                data: {
                                    'q': q,
                                    'pass_siswa_view': pass_siswa_view
                                },
                                success: function(data) {
                                    $('.modal_detail_siswa').html(data);
                                }
                            });
                        });
                    });
                    //end ajax modal detail siswa
                </script>

            </body>

            </html>

    <?php }
    } else {
        echo "directory access forhibdeen";
    } ?>

<?php
} else {
    header("location:../../index.php");
}
?>