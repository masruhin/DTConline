<?php
@include '../config/config.php';
@include '../controller/app/Aplikasi.php';
@include './php/dashboard.php';
@include './php/setApp.php';

session_start();

$Identitas_app = new Aplikasi;
$Dashboard = new dashboard;
$SetApp = new setApp;

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

      <!-- Main Sidebar Container -->

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
                    <a href="DataKelas.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Kelas</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Konfigurasi
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link active">
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
      <!-- <div class="content-wrapper"> -->
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Setting Aplikasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Setting Aplikasi</li>
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
                  <h3 class="card-title">General Setting</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body">

                  <?php
                  $DataApkArr = $SetApp->ViewDataAplikasi($host);
                  foreach ($DataApkArr as $view) :
                  ?>
                    <form action="./php/setApp.php" method="post" enctype="multipart/form-data">

                      <div class="row">

                        <div class="col">
                          <label for="nama_app">Nama Aplikasi</label>
                          <input type="text" name="nama_app" id="nama_app" class="form-control" required value="<?php echo $view['nama_app'] ?>">
                        </div>

                        <div class="col">
                          <label for="copyright">Copyright</label>
                          <input type="text" name="copyright" id="copyright" class="form-control" required value="<?php echo $view['copyright'] ?>">
                        </div>

                      </div>

                      <div class="row mt-3">
                        <div class="col">
                          <label for="customfile">Logo Aplikasi</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="gambar" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>

                          <p class="mt-2">Logo Sekarang : <a href="<?php echo '../dist/assets/img/' . $iden_app_arr[2] ?>"><?php echo $iden_app_arr[2] ?></a></p>
                        </div>

                        <div class="col">
                          <label for="customfile">Favicon Aplikasi</label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="favicon" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <p class="mt-2">Logo Sekarang : <a href="<?php echo '../dist/' . $iden_app_arr[2] ?>"><?php echo $iden_app_arr[1] ?></a></p>
                        </div>
                      </div>

                      <button class="btn btn-primary" type="submit" name="update_app">Update</button>
                    </form>

                  <?php endforeach ?>


                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
            </div>
          </div>


          <div class="row">
            <div class="col-12">
              <!-- Default box -->
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Tampilan Depan</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body">

                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Sub Judul</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $viewLayoutDepan = $SetApp->ViewLayoutDepan($host);
                      $i = 1;

                      foreach ($viewLayoutDepan as $viewLayout) :
                      ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><a href="<?php echo '../dist/assets/breadcrumb/' . $viewLayout['gambar'] ?>"><?php echo $viewLayout['gambar'] ?></a></td>
                          <td><?php echo substr($viewLayout['judul'], 0, 20) . " ..." ?></td>
                          <td><?php echo substr($viewLayout['subjudul'], 0, 20) . " ..." ?></td>
                          <td><a href="#edit" data-id="<?php echo $viewLayout['id'] ?>" data-toggle="modal" class="badge badge-primary">Edit</a></td>
                        </tr>
                      <?php $i++;
                      endforeach ?>
                    </tbody>
                  </table>

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
    <!-- modal Edit -->
    <div class="modal fade" id="edit" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Tampilan Depan</b></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="modal_edit"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal Edit -->
    <script src="../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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

    <script>
      $(function() {
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false
        });
        bsCustomFileInput.init();
      });

      $(document).ready(function() {
        $('#edit').on('show.bs.modal', function(e) {
          var id = $(e.relatedTarget).data('id');
          $.ajax({
            type: 'POST',
            url: './php/ajax/viewDepan.php',
            data: {
              'id': id
            },
            success: function(data) {
              $('.modal_edit').html(data);
            }
          });
        });
      });
    </script>

    <!-- sweet alert -->
    <?php
    if (isset($_GET['update_app'])) {
    ?>
      <script>
        swal("Update Data Aplikasi Berhasil");
      </script>
    <?php } ?>

    <!-- sweet alert -->
    <?php
    if (isset($_GET['exstensi'])) {
    ?>
      <script>
        swal("Ada Exstensi Yang Tidak Sesuai");
      </script>
    <?php } ?>
  </body>

  </html>
<?php } else {
  header("location:index.php");
} ?>