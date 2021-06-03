<?php
@include './config/config.php';
@include './controller/app/Aplikasi.php';
@include './controller/app/Session.php';

session_start();

$Identitas_app = new Aplikasi;

$SiteHomes2 = new Session;

$iden_app_arr = $Identitas_app->Viewapp($host);
$viewLayout = $Identitas_app->ViewLayoutDepan($host);

?>
<!doctype html>
<html lang="en">

<head>
  <style>
    .navbar-nav.navbar-center {
      position: absolute;
      left: 50%;
      transform: translatex(-50%);
    }

    /* @import url('https://fonts.googleapis.com/css?family=Roboto'); */

    body {
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-family: 'Roboto', sans-serif;
    }
  </style>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/landing.css">
  <link rel="stylesheet" href="dist/css/landing.css">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo './dist/assets/img/' . $iden_app_arr[1] ?>">
  <script src="libs/fontawesome/css/all.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <script src="libs/fontawesome/css/all.min.css"></script>
  <title><?php echo $iden_app_arr[0] ?></title>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="<?php echo './dist/assets/img/' . $iden_app_arr[2] ?>" width="30" height="30" class="d-inline-block align-top" alt=""> <?php echo $iden_app_arr[0] ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <!-- <nav class="tabs">
          <div class="selector"></div>
          <a href="#" class="active"><i class="fab fa-superpowers"></i>Avengers</a>
          <a href="#"><i class="fas fa-hand-rock"></i>Hulk</a>
          <a href="#"><i class="fas fa-bolt"></i>Thor</a>
          <a href="#"><i class="fas fa-burn"></i>Marvel</a>
        </nav> -->
        <ul class="navbar-nav navbar-center">
          <li class="nav-item active">
            <a class="nav-link btn1" href="#"><i class="fas fa-home"></i> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link btn1" href="#"><i class="fas fa-home"></i> Dashboard
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link btn1" href="#"><i class="fas fa-clock"></i> Events
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn1" href="#kelas"><i class="fas fa-school"></i> My Course</a>
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

              // echo "<a class='nav-link' href='login.php'> <i class='fas fa-sign-in-alt'></i> Login</a>";
            }
            ?>
          </li>
        </ul>
      </div>
    </div>
    <a class='nav-link' href='login.php'> <i class='fas fa-sign-in-alt'></i> Login</a>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="my-4">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?php echo "./dist/assets/breadcrumb/" . $viewLayout[0][0] ?>" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $viewLayout[0][1] ?></h5>
              <p><?php echo $viewLayout[0][2] ?></p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?php echo "./dist/assets/breadcrumb/" . $viewLayout[1][0] ?>" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $viewLayout[1][1] ?></h5>
              <p><?php echo $viewLayout[1][2] ?></p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?php echo "./dist/assets/breadcrumb/" . $viewLayout[2][0] ?>" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $viewLayout[2][1] ?></h5>
              <p><?php echo $viewLayout[2][2] ?></p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </header>

    <h4 class="text-center display-4 mb-4" id="kelas">Digital Training Center</h4>

    <div class="input-group" style="margin-bottom: 20px;">
      <input type="text" id="keyword" class="form-control  input-sm" placeholder="Cari Pelatihan Kursus ...">
      <div class="input-group-append">
        <a href="#cari" id="cari" type="button" class="btn btn-primary"><i class="fa fa-search"></i>
        </a>
      </div>
    </div>

    <!-- View Data Paging -->
    <div id="results" class="mt-4"></div>
    <div id="loading"></div>
    <div id="loader"></div>
    <!-- end paging data -->

  </div>
  <!-- /.container -->


  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white"><?php echo $iden_app_arr[3] ?></p>
    </div>
    <!-- /.container -->
  </footer>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
  <script src="libs/jquery/jquery-3.6.0.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script>
    var tabs = $('.tabs');
    var selector = $('.tabs').find('a').length;
    //var selector = $(".tabs").find(".selector");
    var activeItem = tabs.find('.active');
    var activeWidth = activeItem.innerWidth();
    $(".selector").css({
      "left": activeItem.position.left + "px",
      "width": activeWidth + "px"
    });

    $(".tabs").on("click", "a", function(e) {
      e.preventDefault();
      $('.tabs a').removeClass("active");
      $(this).addClass('active');
      var activeWidth = $(this).innerWidth();
      var itemPos = $(this).position();
      $(".selector").css({
        "left": itemPos.left + "px",
        "width": activeWidth + "px"
      });
    });
  </script>
  <script>
    function showRecords(perPageCount, pageNumber) {
      $.ajax({
        type: "GET",
        url: "./controller/app/SiteHome.php",
        data: "pageNumber=" + pageNumber,
        cache: false,
        beforeSend: function() {
          $('#loading').html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div>');

        },
        success: function(html) {
          $("#results").html(html);
          $('#loader').html('');
          $('#loading').html('');
        }
      });
    }

    $(document).ready(function() {

      $('#cari').click(function() {
        var keyword = $('#keyword').val();

        $.ajax({
          type: "GET",
          url: "./controller/app/SiteHome.php",
          data: {
            "keyword": keyword
          },
          cache: false,
          beforeSend: function() {
            $('#loading').html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div>');

          },
          success: function(html) {
            $("#results").html(html);
            $('#loader').html('');
            $('#loading').html('');
          }
        });
      })

    });

    $(document).ready(function() {
      showRecords(10, 1);
    });
  </script>

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