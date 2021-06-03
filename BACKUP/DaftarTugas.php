<!-- MILIK STUDENTS -->


<?php
@include '../../controller/inisial.php';
@include '../../config/config.php';
@include '../../controller/students/Dashboard_siswa.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/students/Pesan.php';
@include '../../controller/teachers/KumpulTugas.php';

session_start();

if (isset($_SESSION['q'])) {

    $q = $_SESSION['q'];
    if (cek_halaman_utama_siswa($host, $q) == true) {

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
            <title>Daftar Tugas</title>
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
            <link href="../css/styles.css" rel="stylesheet" />
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

            <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">

            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
            <script src="../../vendor/assets/libs/fontawesome/css/all.min.css"></script>


        </head>

        <!-- <body class="sb-nav-fixed">
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


                                <div class="sb-sidenav-menu-heading">Control Class</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Modul Kelas
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo "<a class='nav-link' href='#join_class' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-plus-circle'></i></div>Join Course</a>"; ?></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo "<a class='nav-link' href='#set_akun' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-user-cog'></i></div>Setting Akun</a>"; ?></nav>
                                </div>
                                <?php
                                if ($kumpultugas->CekJoinKelas($host, $email) == 0) {
                                ?>
                                    <a class="nav-link" href="<?php echo "javascript:void(0)" ?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas
                                    </a>
                                <?php } else { ?>
                                    <?php if ($kumpultugas->Validation($host, $email) == true) { ?>
                                        <a class="nav-link" href="javascript:void(0)">
                                            <div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas &nbsp; <span class='badge badge-danger'>New</span>
                                        </a>
                                    <?php } else { ?>
                                        <a class="nav-link" href="javascript:void(0)">
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
                            <div class="small">Logged in as:</div>
                            Students
                        </div>
                    </nav> -->
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h4 class="mt-3">
                        Daftar Tugas
                    </h4>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?php echo "index.php" ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Tugas</li>
                    </ol>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-text">Tugas yang belum diselesaikan</h5>
                            <hr>

                            <?php
                            if ($kumpultugas->JumlahSeluruhSesiKelas($host, $email) == 0) {
                                echo "Tidak ada tugas";
                            } else {

                            ?>

                                <table class="table dt-responsive nowrap" style="width:100%" style="width:100%" id="table_tugas">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>Type Tugas</center>
                                            </th>
                                            <th>
                                                <center>Nama Session</center>
                                            </th>
                                            <th>
                                                <center>Nama Kelas</center>
                                            </th>
                                            <th>
                                                <center>Deadline</center>
                                            </th>
                                            <th>
                                                <center>Action</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $Kumpul = $kumpultugas->TampilkanJumlahSeluruhSesiKelas($host, $email);

                                        foreach ($Kumpul as $view_tugas) :
                                            if ($kumpultugas->JumlahSiswaBelumKumpulTugas($host, $email, $view_tugas['id_sesi']) == 0) {

                                                if ($view_tugas['tgl_deadline'] != NULL) {
                                        ?>
                                                    <tr>
                                                        <td>
                                                            <center> <span class="badge badge-success">Belum Kumpul Tugas</span></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['title'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['nama_kelas'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><span class="badge badge-primary"><?php echo $view_tugas['tgl_deadline'] . " / " . $view_tugas['waktu_deadline'] ?></span></center>
                                                        </td>
                                                        <td>
                                                            <center><a href="<?php echo "class.php?class_code=$view_tugas[kode_kelas]" ?>"><span class="badge badge-success">Selesaikan</span></a></center>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            }
                                            if ($kumpultugas->JumlahSiswaBelumQuiz($host, $email, $view_tugas['id_quiz']) == 0) {
                                                if ($view_tugas['id_quiz'] != NULL) { ?>

                                                    <tr>
                                                        <td>
                                                            <center><span class="badge badge-info">Belum Quiz</span></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['title'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['nama_kelas'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><span class="badge badge-primary"><?php echo $view_tugas['tgl_selesai'] . " / " . $view_tugas['waktu_selesai'] ?></span></center>
                                                        </td>
                                                        <td>
                                                            <center><a href="<?php echo "class.php?class_code=$view_tugas[kode_kelas]" ?>"><span class="badge badge-info">Selesaikan</span></a></center>
                                                        </td>
                                                    </tr>

                                            <?php }
                                            } ?>
                                        <?php endforeach ?>
                                    </tbody>

                                </table>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </main>
            <div class="fixed-bootom">
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

        <script>
            // ajax modal join class
            $(document).ready(function() {

                $('#table_tugas').DataTable();

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

    <?php } ?>
<?php
} else {
    header("location:../../index.php");
}
?>