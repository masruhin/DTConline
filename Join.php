<?php
@include './config/config.php';
@include './controller/app/Aplikasi.php';
@include './controller/app/Session.php';

session_start();

$Identitas_app = new Aplikasi;

$SiteHomes2 = new Session;

$iden_app_arr = $Identitas_app->Viewapp($host);

if (isset($_GET['id']) && $SiteHomes2->DataKelas($host, $_GET['id']) == true) {

  $TampilDataKelas = $SiteHomes2->TampilDataKelas($host, $_GET['id']);
?>
  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./dist/css/landing.css">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo './dist/assets/img/' . $iden_app_arr[1] ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

    <title><?php echo $iden_app_arr[0] ?></title>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-sm navbar-light fixed-top" style="background-color: #06d2bf; color:white; height: 60px;">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="<?php echo './dist/assets/img/' . $iden_app_arr[2] ?>" width="30" height="30" class="d-inline-block align-top" alt=""> <?php echo $iden_app_arr[0] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="index.php"><i class="fas fa-school"></i> Course Class</a>
            </li>
            <li class="nav-item">

              <?php
              if (isset($_SESSION['key'])) {

                if ($SiteHomes2->ChekSessionGuru($host, $_SESSION['key']) > 0) {

                  $DataGuru = $SiteHomes2->ShowProfileGuru($host, $_SESSION['key']);

                  foreach ($DataGuru as $profilguru) {

                    echo "<a class='nav-link' href='login.php'> <i class='fas fa-user'></i> $profilguru[first_name] $profilguru[last_name]</a>";
                  }
                }
              } else if (isset($_SESSION['q'])) {

                if ($SiteHomes2->ChekSessionSiswa($host, $_SESSION['q'])  > 0) {

                  $DataSiswa = $SiteHomes2->ShowProfilSiswa($host, $_SESSION['q']);

                  foreach ($DataSiswa as $profilsiswa) {

                    echo "<a class='nav-link' href='login.php'> <i class='fas fa-user'></i> $profilsiswa[first_name] $profilsiswa[last_name]</a>";
                  }
                }
              } else {

                echo "<a class='nav-link' href='login.php'> <i class='fas fa-sign-in-alt'></i> Login</a>";
              }
              ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <header class="my-4">

        <?php foreach ($TampilDataKelas as $Data) : ?>
          <div class="jumbotron jumbotron-fluid bg-light">
            <div class="container">
              <h1 class="display-4"><?php echo $Data['nama_kelas'] ?></h1>

              <p class="lead"><span class="badge badge-info badge-pill" style="font-weight: 500;"><?php echo $SiteHomes2->jmlh_siswa_join_per_kls($host, $_GET['id']) ?> Students Tergabung di Kelas Ini</span> </p>
              <p class="lead"><?php echo $Data['caption'] ?></p>

              <p class="text-right"><?php echo "Author : " . $Data['first_name'] . " " . $Data['last_name'] ?></p>

              <?php
              if (isset($_SESSION['q'])) {
              ?>

                <form action="controller/students/Dashboard_siswa.php" method="post">
                  <div class="form-group">
                    <label for="inputan_codeclass">Kode Kelas <span style="color:red;">*</span></label>
                    <input type="text" name="inputan_codeclass" class="form-control" placeholder="Tuliskan kode kelas" required>
                  </div>

                  <input type="hidden" name="q" value="<?php echo $_SESSION['q'] ?>">

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="inputan_kd_kls_siswa">Join</button>
                  </div>
                </form>

              <?php
              } else if (isset($_SESSION['key'])) {
              ?>

                <p class="text-center">Hanya akun Students yang di izinkan join ke kelas</p>

              <?php } else { ?>

                <p class="text-center"><span class="badge badge-danger badge-pill" style="font-weight: normal; ">Silahkan login ke akun anda terlebih dahulu.</span></p>

              <?php } ?>

            </div>
          </div>
        <?php endforeach ?>
      </header>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
      $('.test, .nav-link, .navbar-brand, .new-button').click(function() {
        var sectionTo = $(this).attr('href');
        $('html, body').animate({
          scrollTop: $(sectionTo).offset().top
        }, 1000);
      });
    </script>
  </body>

  </html>
<?php } else {
  echo "Direktori access forhibiden";
} ?>