<?php
@include '../../config/config.php';
@include '../../controller/inisial.php';
@include '../../controller/teachers/Dashboard.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/teachers/Messange.php';

session_start();

if (isset($_SESSION['key'])) {

  $chek_class = new statistic;

  $key = $_SESSION['key'];
  if (My_chek($key, $host));

  //get email from key
  $email_get = new ajax_input_kelas;
  $messange = new Messange;

  //  $email = array();
  $email = $email_get->email_user($host, $key);

  $Identitas_app = new Aplikasi;

  $iden_app_arr = $Identitas_app->Viewapp($host);

  $My_name = array();
  $My_name = main("Nama", $key, $host);
?>


  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Fixed top navbar example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">



    <!-- Bootstrap core CSS -->
    <link href="../../vendor/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesoome css -->
    <link rel="stylesheet" href="../../vendor/assets/libs/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../vendor/assets/css/app.css">

    <meta name="theme-color" content="#7952b3">

  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #168c81; color:white;">
      <div class="container">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Dashboard</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form class="" style="padding-top: 10px;">
              <div class="inpit-group input-group-sm">
                <div class="input-group input-group-sm mb-3">
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                  <button class="btn btn-primary btn-sm">cari</button>
                </div>
              </div>
          </div>
          </form>
        </div>
      </div>
      </div>
    </nav>

    <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>


  <?php
} else {
  header("location:../../index.php");
}
  ?>