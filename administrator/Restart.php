<?php
@include '../config/config.php';
@include '../controller/app/Aplikasi.php';
@include './php/dashboard.php';

session_start();

$Identitas_app = new Aplikasi;
$Dashboard = new dashboard;

$iden_app_arr = $Identitas_app->Viewapp($host);
$TampilProfil = $Dashboard->DataProfil($host);
?>

<?php if (isset($_SESSION['admin'])) { ?>
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
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
    <link href="../vendor/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesoome css -->
    <link rel="stylesheet" href="../vendor/assets/libs/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../vendor/assets/css/app.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>


  <?php
  include 'menu.php';
  ?>

  <body>
    <div class="wrapper">

      <!-- Navbar -->
      <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="../index.php" class="nav-link" target="_BLANK">Site Home</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
          </li>
        </ul>
      </nav> -->
      <!-- /.navbar -->

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

              <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
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
                    <a href="DataKelas.php" class="nav-link active">
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
                  <li class="nav-item active">
                    <a href="SetAdmin.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Setting Akun</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                  <i class="fas fa-server nav-icon"></i>
                  <p>
                    Database
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active">
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
      <!-- <div class="content-wrapper"> -->
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Restart Database</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Restart Database</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">


          <div class="row">
            <div class="col-12">
              <!-- Default box -->
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Restart Database System</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body">

                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Restart Database</h4>
                    <p>Database anda akan direstart, Semua data akan dihapus oleh system kecuali data guru dan data siswa.</p>
                    <hr>
                    <p class="mb-0">Sebelum melakukan restart alangkah baiknya untuk mencadangkan database terlebih dahulu di phpmyadmin, pada web hosting anda.</p>
                  </div>

                  <a href="#restart" data-toggle="modal" type="button" class="btn btn-outline-success">Restart</a>

                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
            </div>
          </div>

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
    <!-- modal restart -->
    <div class="modal fade" id="restart" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><b>Konfirmasi</b></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="modal_restart"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal Hapus -->

    <script src="../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <script>
      $('#restart').on('show.bs.modal', function(e) {

        $.ajax({
          type: 'POST',
          url: '../config/popup_restart.php',
          success: function(data) {
            $('.modal_restart').html(data);
          }

        });

      });
    </script>
    <!-- sweet alert -->
    <?php
    if (isset($_GET['ok'])) {
    ?>
      <script>
        swal("Restart Aplikasi Sukses");
      </script>
    <?php } ?>

  </body>

  </html>
<?php } else {
  header("location:index.php");
} ?>