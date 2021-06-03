<?php
    @include './config/config.php';
    @include './controller/app/Aplikasi.php';

    session_start();

    if(isset($_SESSION['q'])){

    $Identitas_app = new Aplikasi;

    $iden_app_arr = $Identitas_app->Viewapp($host);
    $Arrayname = $Identitas_app->Getnamasiswa($host, $_SESSION['q']);
    
?>

<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo './dist/assets/img/'.$iden_app_arr[1] ?>">
    <title>Session configuration</title>

    <style>
        .card {
            margin: 0 auto; /* Added */
            float: none; /* Added */
            margin-bottom: 10px; /* Added */
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
        <p class="card-text">Session login dengan nama siswa <span class="badge badge-success"><?php echo $Arrayname[0]."".$Arrayname[1] ?></span> masih terdaftar di server, apakah anda ingin melanjutkan session ini atau login dari awal.</p>
        <?php echo "<a href='./dist/students/index.php' class='btn btn-success'>Lanjut</a>";?>
        <?php echo "<a href='DestroyedSiswa.php' class='btn btn-info'>Login back</a>";?>
    </div>
    </div>
</div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <footer id="sticky-footer" class="py-4 bg-dark text-white-50 fixed-bottom">
    <div class="container text-center">
      <small><?php echo $iden_app_arr[3] ?></small>
    </div>
  </footer>
  </body>
</html>
<?php }else{
    header("location:index.php");
} ?>