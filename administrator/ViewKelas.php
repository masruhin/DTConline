<?php
@include '../config/config.php';
@include '../controller/app/Aplikasi.php';
@include './php/dashboard.php';
@include './php/viewKelas.php';

session_start();

$Identitas_app = new Aplikasi;
$Dashboard = new dashboard;
$ViewKelas = new viewKelas;

$iden_app_arr = $Identitas_app->Viewapp($host);
$TampilProfil = $Dashboard->DataProfil($host);
$authors = $ViewKelas->GetNamaKlsandAuthor($host, $_GET['kd_kls']);
?>

<?php if (isset($_SESSION['admin']) && isset($_GET['kd_kls']) && $ViewKelas->CekKelas($host, $_GET['kd_kls']) != 0) { ?>
  <!DOCTYPE html>
  <!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin <?php echo $iden_app_arr[0] ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../dist/assets/img/' . $iden_app_arr[1] ?>">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="../index.php" class="nav-link" target="_BLANK">Site Home</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php
      include 'menu.php';
      ?>
      <!-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="javascript:void(0)" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Administrator</span>
        </a>

        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="dist/img/<?php echo $TampilProfil['gambar'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?php echo $TampilProfil['nama'] ?></a>
            </div>
          </div>

          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item active">
                <a href="Dashboard.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-database"></i>
                  <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="DataGuru.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Guru</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="DataSiswa.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Siswa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Kelas</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Konfigurasi
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="SetApp.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Setting Aplikasi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="SetDocs.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Setting Dokumen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="SetAdmin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Setting Akun</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
                  <i class="fas fa-server nav-icon"></i>
                  <p>
                    Database
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="Restart.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Restart Database</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-envelope-open-text"></i>
                  <p>
                    Messange
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="PesanGuru.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pesan Accessor</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="PesanSiswa.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pesan Students</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="./php/logout.php" class="nav-link">
                  <ion-icon name="exit-outline" class="nav-icon"></ion-icon>
                  <p>
                    Log Out
                  </p>
                </a>
              </li>

            </ul>
          </nav>
        </div>
      </aside> -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tampilan Course</h1>
                <p class="text-blue">By <?php echo $authors[0] . " " . $authors[1] ?></p>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="DataKelas.php">Data Course</a></li>
                  <li class="breadcrumb-item active"><?php echo $authors[2]; ?></li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">

            <?php
            if ($ViewKelas->CekSesiKelas($host, $_GET['kd_kls']) == 0) {

              echo "<h4 class='text-center mt-3'>Sesi Kelas Belum Dibuat</h4>";
            } else {
              $ViewSesiKlsArr = $ViewKelas->ViewSesiKelas($host, $_GET['kd_kls']);

              foreach (array_reverse($ViewSesiKlsArr) as $sesikls) :
            ?>
                <div class="row mb-3">
                  <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title text-blue"><i class='fas fa-bars'></i> <?php echo $sesikls['title']; ?></h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                      </div>
                      <div class="card-body">
                        <h6 class="mb-3 text-blue">Deskripsi : </h6>
                        <?php echo $sesikls['deskripsi'] ?>

                        <?php
                        if ($ViewKelas->cek_file_sisip($host, $sesikls['id_sesi']) == 0) {
                        } else {

                          //ada file
                          echo "<hr>";
                          echo "<h6 class='mb-3 text-blue'>File Dilampirkan </h6> ";

                          $file_lampir = $ViewKelas->ViewFileSisip($host, $sesikls['id_sesi']);

                          foreach ($file_lampir as $lampir_file) {
                            echo "<a href='../controller/students/Class_siswa.php?name_file=$lampir_file[nama_file]'><i class='far fa-file-alt'></i> $lampir_file[nama_file]</a><br>";
                          }
                        }
                        ?>

                        <?php
                        if ($sesikls['tgl_deadline'] == "0000-00-00") {
                        } else {
                        ?>
                          <hr>
                          <h6 class="mb-3 text-blue">Pengumpulan Tugas : </h6>
                          <table class="table table-responsive">
                            <thead>
                              <tr>
                                <th scope="col" style="font-weight:normal;">Deadline</th>
                                <th scope="col" style="font-weight:normal;">Waktu Tunggu</th>
                              </tr>
                            </thead>

                            <tr>
                              <td><span class="badge badge-primary"><?php echo $sesikls['tgl_deadline'] . " / " . $sesikls['waktu_deadline'] ?></span></td>
                              <td>
                                <?php
                                if ($ViewKelas->WaktuTunggu($sesikls['tgl_deadline'], $sesikls['waktu_deadline']) == false) {
                                ?>
                                  <span class="badge badge-danger">Time Expired</span>
                                <?php } else { ?>
                                  <span class="badge badge-success"><?php echo $ViewKelas->WaktuTunggu($sesikls['tgl_deadline'], $sesikls['waktu_deadline']); ?></span>
                                <?php } ?>
                              </td>
                            </tr>
                          </table>

                        <?php } ?>


                        <?php
                        if ($ViewKelas->CekQuiz($host, $sesikls['id_sesi']) == 0) {
                        } else {
                          $Viewquiz_arr = $ViewKelas->ViewQuiz($host, $sesikls['id_sesi']);
                        ?>
                          <hr>
                          <h6 class="mb-3 text-blue">Pengumpulan Tugas : </h6>
                          <table class="table table-responsive">
                            <thead>
                              <tr>
                                <th scope="col" style="font-weight:normal;">Judul</th>
                                <th scope="col" style="font-weight:normal;">Quiz Dimulai</th>
                                <th scope="col" style="font-weight:normal;">Quiz Ditutup</th>
                                <th scope="col" style="font-weight:normal;">Status</th>
                              </tr>
                            </thead>

                            <?php foreach ($Viewquiz_arr as $viewquiz) : ?>
                              <tr>
                                <td><span class="badge badge-success"><?php echo $viewquiz['title_quiz'] ?></span></td>
                                <td><span class="badge badge-primary"><?php echo $viewquiz['tgl_mulai'] . " / " . $viewquiz['waktu_mulai'] ?></span></td>
                                <td><span class="badge badge-secondary"><?php echo $viewquiz['tgl_selesai'] . " / " . $viewquiz['waktu_selesai'] ?></td>
                                <td>
                                  <?php
                                  if ($ViewKelas->WaktuTunggu($viewquiz['tgl_selesai'], $viewquiz['waktu_selesai']) == false) {
                                  ?>
                                    <span class="badge badge-danger">Time Expired</span>
                                  <?php } else { ?>
                                    <span class="badge badge-success"><?php echo $ViewKelas->WaktuTunggu($viewquiz['tgl_selesai'], $viewquiz['waktu_selesai']); ?></span>
                                  <?php } ?>
                                </td>
                              </tr>

                            <?php endforeach ?>
                          </table>
                        <?php } ?>
                      </div>
                      <div class="card-footer text-center">
                        Modifiy On <?php echo $sesikls['tgl_posting'] . " / " . $sesikls['waktu_posting'] ?>
                      </div>
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              <?php endforeach ?>
            <?php } ?>

          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">

      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong><?php echo $iden_app_arr[3] ?></strong>
      </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="plugins/chart/round.js"></script>
    <script src="plugins/chart/browser.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  </body>

  </html>
<?php } else {
  header("location:index.php");
} ?>