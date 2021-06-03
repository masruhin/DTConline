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

    <!-- <title>Admin <?php echo $iden_app_arr[0] ?></title> -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../dist/assets/img/' . $iden_app_arr[1] ?>">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

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

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">

            <!-- Info boxes -->
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Semua User</span>
                    <span class="info-box-number">
                      <?php echo $Dashboard->TotalUser($host); ?>
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-tie"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">User Accessor</span>
                    <span class="info-box-number"><?php echo $Dashboard->TotalUserGuru($host); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix hidden-md-up"></div>

              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-friends"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">User Students</span>
                    <span class="info-box-number"><?php echo $Dashboard->TotalUserSiswa($host); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Total Course</span>
                    <span class="info-box-number"><?php echo $Dashboard->TotalKelas($host); ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Statistic User</h5>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-8">
                        <p class="text-center">
                          <strong>Today : <?php echo $Dashboard->GetDay() ?></strong>
                        </p>

                        <div class="chart">
                          <!-- Sales Chart Canvas -->
                          <canvas id="roundchart" height="100" style="height: 100px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-4">
                        <p class="text-center">
                          <strong>User Information</strong>
                        </p>

                        <div class="progress-group">
                          User Participants Online
                          <span class="float-right"><b><?php echo $Dashboard->TotalSiswaOnline($host) ?></b>/<?php echo $Dashboard->TotalUserSiswa($host); ?></span>
                          <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: <?php echo $Dashboard->RangeSiswaOnline($host) . "%" ?>"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->

                        <div class="progress-group">
                          User Accessor Online
                          <span class="float-right"><b><?php echo $Dashboard->TotalGuruOnline($host); ?></b>/<?php echo $Dashboard->TotalUserGuru($host); ?></span>
                          <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" style="width: <?php echo $Dashboard->RangeGuruOnline($host) . "%" ?>"></div>
                          </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">User Participants Offline</span>
                          <span class="float-right"><b><?php echo $Dashboard->TotalSiswaOffline($host); ?></b>/<?php echo $Dashboard->TotalUserSiswa($host); ?></span>
                          <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: <?php echo $Dashboard->RangeSiswaOfline($host) . "%" ?>"></div>
                          </div>
                        </div>

                        <!-- /.progress-group -->
                        <div class="progress-group">
                          User Accessor Offline
                          <span class="float-right"><b><?php echo $Dashboard->TotalGuruOffline($host); ?></b>/<?php echo $Dashboard->TotalUserGuru($host); ?></span>
                          <div class="progress progress-sm">
                            <div class="progress-bar bg-warning" style="width: <?php echo $Dashboard->RangeGuruOfline($host) . "%" ?>"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- ./card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


            <div class="row">
              <div class="col-md-7">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Online User</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">

                    <table id="example2" class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Level</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if ($Dashboard->TotalGuruOnline($host) == 0) {
                        } else {

                          $viewGuruOnline = $Dashboard->ViewSessionGuruOnline($host);

                          $i = 1;

                          foreach ($viewGuruOnline as $viewemail) :

                            $DataGuruOnline = $Dashboard->ViewGuruOnline($host, $viewemail['email']);

                            foreach ($DataGuruOnline as $Dataguru) :
                        ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                  <?php
                                  if ($Dataguru['gambar'] == NULL) {
                                  ?>
                                    <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../dist/assets/img/noimg.png" ?>">
                                    <?php echo $Dataguru['first_name'] . " " . $Dataguru['last_name'] ?>

                                  <?php
                                  } else {
                                  ?>
                                    <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../dist/assets/userprofil/$Dataguru[gambar]" ?>">
                                    <?php echo $Dataguru['first_name'] . " " . $Dataguru['last_name'] ?>
                                  <?php } ?>
                                </td>
                                <td>
                                  <span class="badge badge-info">Accessor</span>
                                </td>
                                <td>
                                  <span class="badge badge-success">Online</span>
                                </td>
                              </tr>
                            <?php $i++;
                            endforeach ?>
                          <?php endforeach ?>
                        <?php } ?>


                        <?php
                        if ($Dashboard->TotalSiswaOnline($host) == 0 || $Dashboard->TotalGuruOnline($host) == 0) {
                        } else {

                          $viewGuruOnline = $Dashboard->ViewSessionSiswaOnline($host);

                          $i = 1;

                          foreach ($viewGuruOnline as $viewemail) :

                            $DataGuruOnline = $Dashboard->ViewSiswaOnline($host, $viewemail['email']);

                            foreach ($DataGuruOnline as $Datasiswa) :
                        ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                  <?php
                                  if ($Datasiswa['gambar'] == NULL) {
                                  ?>
                                    <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../dist/assets/img/noimg.png" ?>">
                                    <?php echo $Datasiswa['first_name'] . " " . $Datasiswa['last_name'] ?>

                                  <?php
                                  } else {
                                  ?>
                                    <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../dist/assets/userprofil/$Datasiswa[gambar]" ?>">
                                    <?php echo $Datasiswa['first_name'] . " " . $Datasiswa['last_name'] ?>
                                  <?php } ?>
                                </td>
                                <td>
                                  <span class="badge badge-secondary">Students</span>
                                </td>
                                <td>
                                  <span class="badge badge-success">Online</span>
                                </td>
                              </tr>
                            <?php $i++;
                            endforeach ?>
                          <?php endforeach ?>
                        <?php } ?>


                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>

              <div class="col-md-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-chart-pie mr-1"></i>
                      Browser Used
                    </h3>

                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content p-0">
                      <!-- Morris chart - Sales -->
                      <canvas id="browser" height="150" style="height: 100px;"></canvas>
                    </div>
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>


            <div class="row">
              <div class="col-md-7">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Konfirmasi Akun Students</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <?php if (isset($_GET['terima'])) : ?>

                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil </strong> Akun sudah diaktifkan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                    <?php endif ?>

                    <?php if (isset($_GET['tolak'])) : ?>

                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Berhasil </strong> Akun tidak diaktifkan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                    <?php endif ?>
                    <table id="example1" class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if ($Dashboard->JumlahSiswaBelumKonfirmasi($host) == 0) {
                        } else {

                          $Confirmasi = $Dashboard->ViewSiswaBelumKonfirmasi($host);

                          $i = 1;

                          foreach ($Confirmasi as $view) :
                        ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $view['first_name'] . " " . $view['last_name'] ?></td>
                              <td>
                                <span class="badge badge-warning">Belum Konfirmasi</span>
                              </td>
                              <td>
                                <a href="#terima" data-toggle="modal" data-id="<?php echo $view['id'] ?>" data-last_name="<?php echo $view['last_name'] ?>" data-first_name="<?php echo $view['first_name'] ?>"><span class="badge badge-success">Confirm</span></a>
                                <a href="#tolak" data-toggle="modal" data-id="<?php echo $view['id'] ?>" data-last_name="<?php echo $view['last_name'] ?>" data-first_name="<?php echo $view['first_name'] ?>"><span class="badge badge-danger">Tolak</span></a>
                              </td>
                            </tr>
                          <?php $i++;
                          endforeach ?>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>

              <div class="col-md-5">
                <!-- Calendar -->
                <div class="card bg-gradient-success">
                  <div class="card-header border-0">

                    <h3 class="card-title">
                      <i class="far fa-calendar-alt"></i>
                      Calendar
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                      <!-- button with a dropdown -->
                      <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                          <i class="fas fa-bars"></i></button>
                        <div class="dropdown-menu" role="menu">
                          <a href="#" class="dropdown-item">Add new event</a>
                          <a href="#" class="dropdown-item">Clear events</a>
                          <div class="dropdown-divider"></div>
                          <a href="#" class="dropdown-item">View calendar</a>
                        </div>
                      </div>
                      <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                    <!-- /. tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body pt-0">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                  </div>
                  <!-- /.card-body -->
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

    <!-- modal Terima -->
    <div class="modal fade" id="terima" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><b>Aktifasi Akun</b></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="modal_terima"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal Terima -->

    <!-- modal Terima -->
    <div class="modal fade" id="tolak" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><b>Tolak Akun</b></h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="modal_tolak"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal Terima -->

    <!-- Chart element getter -->
    <input type="hidden" id="userguru" value="<?php echo $Dashboard->TotalUserGuru($host) ?>">
    <input type="hidden" id="usersiswa" value="<?php echo $Dashboard->TotalUserSiswa($host) ?>">

    <!-- Chart Browser Getter -->
    <input type="hidden" id="Chrome" value="<?php echo $Dashboard->GoggleChrome($host); ?>">
    <input type="hidden" id="Mozila" value="<?php echo $Dashboard->Mozila($host); ?>">
    <input type="hidden" id="Opera" value="<?php echo $Dashboard->Opera($host); ?>">
    <input type="hidden" id="Safari" value="<?php echo $Dashboard->Safari($host); ?>">
    <input type="hidden" id="Explore" value="<?php echo $Dashboard->Explore($host); ?>">

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="plugins/chart/round.js"></script>
    <script src="plugins/chart/browser.js"></script>

    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
      $(function() {
        $("#example2").DataTable({
          "responsive": true,
          "autoWidth": false,
          "iDisplayLength": 4
        });
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false
        });
      });

      $(document).ready(function() {

        $('#terima').on('show.bs.modal', function(e) {
          var first_name = $(e.relatedTarget).data('first_name');
          var last_name = $(e.relatedTarget).data('last_name');
          var id = $(e.relatedTarget).data('id');

          $.ajax({
            type: 'POST',
            url: './php/ajax/TerimaSiswa.php',
            data: {
              'first_name': first_name,
              'last_name': last_name,
              'id': id
            },
            success: function(data) {
              $('.modal_terima').html(data);
            }

          });

        });

        $('#tolak').on('show.bs.modal', function(e) {
          var first_name = $(e.relatedTarget).data('first_name');
          var last_name = $(e.relatedTarget).data('last_name');
          var id = $(e.relatedTarget).data('id');

          $.ajax({
            type: 'POST',
            url: './php/ajax/TolakSiswa.php',
            data: {
              'first_name': first_name,
              'last_name': last_name,
              'id': id
            },
            success: function(data) {
              $('.modal_tolak').html(data);
            }

          });

        });
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:index.php");
} ?>