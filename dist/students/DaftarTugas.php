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

            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">

            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>


        </head>

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
                                                            <center> <span class="badge badge-warning badge-pill" style="font-weight: 500; padding: buttom 2px;">Belum Kumpul Tugas</span></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['title'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['nama_kelas'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><span class="badge badge-primary badge-pill" style="font-weight: 500; padding: buttom 2px;"><?php echo $view_tugas['tgl_deadline'] . " / " . $view_tugas['waktu_deadline'] ?></span></center>
                                                        </td>
                                                        <td>
                                                            <center><a href="<?php echo "class.php?class_code=$view_tugas[kode_kelas]" ?>"><span class="badge badge-success badge-pill" style="font-weight: 500; padding: buttom 2px;">Selesaikan</span></a></center>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            }
                                            if ($kumpultugas->JumlahSiswaBelumQuiz($host, $email, $view_tugas['id_quiz']) == 0) {
                                                if ($view_tugas['id_quiz'] != NULL) { ?>

                                                    <tr>
                                                        <td>
                                                            <center><span class="badge badge-warning badge-pill" style="font-weight: 500; padding: buttom 2px;">Belum Quiz</span></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['title'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $view_tugas['nama_kelas'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><span class="badge badge-primary badge-pill" style="font-weight: 500; padding: buttom 2px;"><?php echo $view_tugas['tgl_selesai'] . " / " . $view_tugas['waktu_selesai'] ?></span></center>
                                                        </td>
                                                        <td>
                                                            <center><a href="<?php echo "class.php?class_code=$view_tugas[kode_kelas]" ?>"><span class="badge badge-info badge-pill" style="font-weight: 500; padding: buttom 2px;">Selesaikan</span></a></center>
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