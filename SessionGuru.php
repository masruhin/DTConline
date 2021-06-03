<?php
@include './config/config.php';
@include './controller/app/Aplikasi.php';

session_start();

if (isset($_SESSION['key'])) {

  $Identitas_app = new Aplikasi;

  $iden_app_arr = $Identitas_app->Viewapp($host);
  $Arrayname = $Identitas_app->Getnamaguru($host, $_SESSION['key']);

?>

  <!Doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/assets/libs/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo './dist/assets/img/' . $iden_app_arr[1] ?>">
    <title>Session configuration</title>

    <style>
      .card {
        margin: 0 auto;
        /* Added */
        float: none;
        /* Added */
        margin-bottom: 10px;
        /* Added */
      }
    </style>
  </head>

  <body>

    <div class="container col-md-8" style="margin-top: 200px;">
      <div class="card ">
        <div class="card-header text-center">
          <h5>Session Confirm</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Session login dengan nama <span class="badge badge-pill badge-danger"><?php echo $Arrayname[0] . "" . $Arrayname[1] ?></span> masih terdaftar di server, apakah anda ingin melanjutkan session ini atau login dari awal.</p>
          <?php echo "<a href='./dist/guru/index.php' class='btn btn-success btn-sm'>Lanjut</a>"; ?>
          <?php echo "<a href='DestroyedGuru.php' class='btn btn-info btn-sm'>Login back</a>"; ?>
        </div>
      </div>
    </div>


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> -->

    <script src="/assets/libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
      <div class="container text-center">
        <small><?php echo $iden_app_arr[3] ?></small>
      </div>
    </footer>
  </body>

  </html>
<?php } else {
  header("location:index.php");
} ?>