<?php
@include '../config/config.php';
@include '../controller/app/Aplikasi.php';
@include './php/dashboard.php';
@include './php/dataGuru.php';

session_start();

$Identitas_app = new Aplikasi;
$Dashboard = new dashboard;
$dataGuru = new dataGuru;

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
    <!-- Font Awesome Icons -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
    <link href="../vendor/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesoome css -->
    <link rel="stylesheet" href="../vendor/assets/libs/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../vendor/assets/css/app.css">
    <!-- <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script> -->

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

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
            <li class="nav-item active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
              </a>
            </li>

            <a href="#" class="nav-link active">
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="DataGuru.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Accessor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="DataSiswa.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="DataKelas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Course</p>
                </a>
              </li>
            </ul>
            </li>
            <a href="#" class="nav-link">
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

            <a href="#" class="nav-link">
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

            <a href="#" class="nav-link">
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
      <!-- <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Accessor</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Data Accessor</li>
                </ol>
              </div>
            </div>
          </div>
        </div> -->
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-12">
              <!-- Default box -->
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Buat Data Accessor</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body">

                  <div class="p-0 pt-0">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Buat Manual</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Import Excle</a>
                      </li>
                    </ul>
                  </div>

                  <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active mt-3" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                      <form action="./php/dataGuru.php" method="post">

                        <div class="form-row">
                          <div class="col">
                            <label for="first_name">Nama Depan</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Tuliskan Nama Depan" required>
                          </div>

                          <div class="col">
                            <label for="last_name">Nama Belakang</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Tuliskan Nama Belakang" required>
                          </div>
                        </div>

                        <div class="form-row mt-3">
                          <div class="col">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" required class="form-control" placeholder="Tuliskan Email">
                          </div>

                          <div class="col">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" required class="form-control" placeholder="Tuliskan Password">
                          </div>
                        </div>

                        <button class="btn btn-primary mt-3" type="submit" name="save">Simpan</button>
                      </form>

                    </div>
                    <div class="tab-pane fade mt-3" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                      <form action="./php/dataGuru.php" method="post" enctype="multipart/form-data">
                        <p class="card-text text-danger">Ekstensi File harus .XLS</p>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile" name="file_upload" required>
                          <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>

                        <button class="btn btn-success mt-3" type="submit" name="import">Import</button>
                      </form>

                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>


          <div class="row">
            <div class="col-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Data Seluruh Accessor</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>

                    <a href="./doc/pdfguru.php" target="_BLANK"><i class="fas fa-download"></i></a>
                  </div>
                </div>
                <div class="card-body">

                  <table id="example1" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Course Diampu</th>
                        <th>Email</th>
                        <th>No Hp / Whatsapp</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      if ($Dashboard->TotalUserGuru($host) == 0) {
                        //table empty
                      } else {
                        $DataguruArr = $dataGuru->ViewDataInTable($host);

                        foreach ($DataguruArr as $view) :
                      ?>
                          <tr>
                            <td>
                              <?php
                              if ($view['gambar'] == NULL) {
                              ?>
                                <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../dist/assets/img/noimg.png" ?>">
                                <?php echo $view['first_name'] . " " . $view['last_name'] ?>

                              <?php
                              } else {
                              ?>
                                <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../dist/assets/userprofil/$view[gambar]" ?>">
                                <?php echo $view['first_name'] . " " . $view['last_name'] ?>
                              <?php } ?>
                            </td>
                            <td>
                              <?php
                              if ($dataGuru->TotalKelas($host, $view['email']) == 0) {

                                echo "Not Found";
                              } else {
                              ?>
                                <a href="javascript:void(0)" class="badge badge-info" data-toggle="popover" title="Course yang diampu" data-content='
                                    <?php
                                    $GetNamaKelas = $dataGuru->ViewKelas($host, $view['email']);
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
                            '>Please click
                                </a>
                              <?php } ?>
                            </td>
                            <td><?php echo $view['email']; ?></td>
                            <td>
                              <?php
                              if ($view['nohp_guru'] == NULL) {
                                echo "belum melengkapi";
                              } else {
                                echo $view['nohp_guru'];
                              }
                              ?>
                            </td>
                            <td>
                              <?php if ($dataGuru->OnlineChek($host, $view['email']) == 0) { ?>
                                <span class="badge badge-danger">Offline</span>
                              <?php } else { ?>
                                <span class="badge badge-success">Online</span>
                              <?php } ?>
                            </td>
                            <td>
                              <a href="#edit" data-id="<?php echo $view['id'] ?>" data-toggle="modal" class="badge badge-primary">Edit</a>
                              <a href="#hapus" data-id="<?php echo $view['id'] ?>" data-toggle="modal" class="badge badge-danger">Hapus</a>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      <?php } ?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Kursus Diampu</th>
                          <th>Email</th>
                          <th>No Hp/Whatsapp</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot> -->
                  </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
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
      <!-- Control sidebar content goes here -->

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
            <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Akun</b></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="modal_edit"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal Edit -->

    <!-- modal Hapus -->
    <div class="modal fade" id="hapus" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><b>Hapus Akun</b></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="modal_hapus"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal Hapus -->
    <script src="../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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
      });

      $(document).ready(function() {
        bsCustomFileInput.init();
        $(function() {
          $('[data-toggle="popover"]').popover()
        })


        $('#edit').on('show.bs.modal', function(e) {
          var id = $(e.relatedTarget).data('id');

          $.ajax({
            type: 'POST',
            url: './php/ajax/EditGuru.php',
            data: {
              'id': id
            },
            success: function(data) {
              $('.modal_edit').html(data);
            }

          });

        });

        $('#hapus').on('show.bs.modal', function(e) {
          var id = $(e.relatedTarget).data('id');

          $.ajax({
            type: 'POST',
            url: './php/ajax/HapusGuru.php',
            data: {
              'id': id
            },
            success: function(data) {
              $('.modal_hapus').html(data);
            }

          });

        });
      });
    </script>
    <!-- sweet alert -->
    <?php
    if (isset($_GET['edit_ok'])) {
    ?>
      <script>
        swal("Edit Data Akun Berhasil");
      </script>
    <?php } ?>

    <?php
    if (isset($_GET['hapus_ok'])) {
    ?>
      <script>
        swal("Hapus Data Akun Berhasil");
      </script>
    <?php } ?>

    <?php
    if (isset($_GET['insert_ok'])) {
    ?>
      <script>
        swal("Tambah Data Akun Berhasil");
      </script>
    <?php } ?>

    <?php
    if (isset($_GET['redundan'])) {
    ?>
      <script>
        swal("Email atau password tiap akun tidak boleh sama");
      </script>
    <?php } ?>

    <?php
    if (isset($_GET['import_ok'])) {
    ?>
      <script>
        swal("Import Data Berhasil");
      </script>
    <?php } ?>

    <?php
    if (isset($_GET['exstensi'])) {
    ?>
      <script>
        swal("Exstensi File harus .XLS");
      </script>
    <?php } ?>
    <!-- end sweet alert -->
  </body>

  </html>
<?php } else {
  header("location:index.php");
} ?>