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
<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Fontawesoome css -->
<link rel="stylesheet" href="libs/fontawesome/css/all.min.css">
<link rel="stylesheet" href="/vendor/assets/libs/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/vendor/assets/libs/fontawesome/css/all.css">

<head>
  <style>
    .navbar-nav {
      /* position: absolute; */
      position: relative;
      height: 60px;
    }

    a {
      font-weight: 500;
    }

    .btn1 {
      background-color: #1bd4aa;
      position: relative;
      display: block;
      overflow: hidden;
      line-height: 50px;
      margin: 1rem auto;
      color: white;
      line-height: 20px;
      text-align: center;
      transition: ease 0.5s;
      /* font-family: Arial, Helvetica, sans-serif; */
      /* font-weight: bold; */
      font-size: 12px;
      box-shadow: -3px 9px 20px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    ul {
      margin-top: 50px;
      display: block;
      text-align: center;
    }

    ul li {
      display: inline-block;
    }

    li {
      list-style: none;
      width: 120px;
      margin-left: 10px;
    }


    .btn1:before {
      content: "";
      position: absolute;
      top: 0;
      right: -50px;
      bottom: 0;
      left: 0;
      border-right: 50px solid transparent;
      border-bottom: 80px solid white;
      -webkit-transform: translateX(-100%);
      transform: translateX(-100%);
      transition: cubic-bezier(1, -0.02, 0.26, 0.38) 0.5s;
      z-index: -1;
    }

    .btn1:hover {
      color: #00c3ff;
      background-color: beige;
    }

    .btn1:hover:before {
      transform: translateX(0);
    }


    #kiri {
      height: 600px;
      background-size: 920px 600px;
      margin-left: 0%;
      padding-left: 0%;
      padding-right: 0%;
      padding-top: 0%;
      padding-bottom: 0%;

    }

    #kanan {
      overflow-y: scroll;
      position: relative;
      background-image: url('libs/img/bg.jpg');
      background-size: 920px 600px;
      width: 100%;
      min-height: 1px;
      padding-right: 1px;
      padding-left: 0px;
      height: 621px;
    }

    .carousel .item {
      height: 600px;
    }

    .item img {
      position: absolute;
      top: 0%;
      left: 0%;
      min-height: 600px;
    }

    .w-100 {
      height: 621px;
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/landing.css">
  <link rel="stylesheet" href="dist/css/landing.css">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo './dist/img/' . $iden_app_arr[1] ?>">
  <script src="libs/fontawesome/css/all.min.css"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  <script src="libs/fontawesome/css/all.min.css"></script>
  <title><?php echo $iden_app_arr[0] ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-light fixed-top" style="background-color: #06d2bf; color:white; height: 60px;">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="<?php echo './dist/assets/img/' . $iden_app_arr[2] ?>" width="80" height="40" class="d-inline-block align-top" alt=""> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-right">
          <li class="nav-item active">
            <a class="nav-link btn1" href="index.php"><i class="fa fa-home text-dark"></i> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link btn1" href="#"><i class="fa fa-layer-group text-dark"></i> Dashboard
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link btn1" href="#"><i class="fa fa-clock text-dark"></i> Events
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link btn1" href="#"><i class="fa fa-list-ul text-dark"></i> My Course
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <!-- <li class="nav-item active">
            <a class="nav-link btn1" href="#kelas"><i class="fa fa-list-ul text-dark"></i>My Course
              <span class="sr-only">(current)</span>
            </a>
          </li> -->
          <li class="nav-item ">

            <?php
            if (isset($_SESSION['key'])) {

              if ($SiteHomes2->ChekSessionGuru($host, $_SESSION['key']) > 0) {

                $DataGuru = $SiteHomes2->ShowProfileGuru($host, $_SESSION['key']);

                foreach ($DataGuru as $profilguru) {
                  echo "<li class='nav-item active'><a class='nav-link btn1' href='index.php'>$profilguru[first_name] $profilguru[last_name]</a></li>";
                  // echo "<li class='nav-item active'><a class='nav-link btn1' href='#kelas'>$profilguru[first_name] $profilguru[last_name]</a></li>";
                  // echo "<br/><a class='nav-link active' href='login.php' style='width:300px; '> <i class='fas fa-user'></i> $profilguru[first_name] $profilguru[last_name]</a>";
                }
              }
            } else if (isset($_SESSION['q'])) {

              if ($SiteHomes2->ChekSessionSiswa($host, $_SESSION['q'])  > 0) {

                $DataSiswa = $SiteHomes2->ShowProfilSiswa($host, $_SESSION['q']);

                foreach ($DataSiswa as $profilsiswa) {
                  echo "
                  <div class='col-md-12'>
                    <div class='col-md-8'>
                      <li class='nav-item active'><a class='nav-link btn1' href='index.php' style='width: 200px;'>$profilsiswa[first_name] $profilsiswa[last_name]</a></li>
                    </div>
                  </div>";

                  // echo "<br/><a class='nav-link active' href='login.php' style='width:300px; color:black'> <i class='fas fa-user'></i> $profilsiswa[first_name] $profilsiswa[last_name]</a>";
                }
              }
              // echo "
              // <div>
              // <li class='nav-item dropdown'>
              //   <a href='#' class='nav-link dropdown-toggle' id='dropdown-2' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='color: black;'>Action</a>
              //   <div class='dropdown-menu' aria-labelledby='dropdown-2'>
              //     <a class='nav-link' href='login.php' style='color: black;'><i class='fas fa-sign-in-alt'></i> Login</a>
              //     <a href='/profile.html' class='dropdown-item'>Profile</a>
              //     <a class='nav-link' href='login.php' style='color: black;'><i class='fas fa-angle-left'></i> Log Out</a>
              //   </div>
              // </li> 
              // </div>
              // ";
            } else {
            }
            ?>
          </li>
        </ul>
        <!-- <div class="">
          <li class='nav-item dropdown'>
            <a href='#' class='nav-link dropdown-toggle' id='dropdown-2' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='color: black;'>Action</a>
            <div class='dropdown-menu' aria-labelledby='dropdown-2'>
              <a class='nav-link' href='login.php' style='color: black;'><i class='fas fa-sign-in-alt'></i> Login</a>
              <a href='/profile.html' class='dropdown-item'>Profile</a>
              <a class='nav-link' href='login.php' style='color: black;'><i class='fas fa-angle-left'></i> Log Out</a>
            </div>
          </li>
        </div> -->
      </div>
    </div>
    <ul class="nav footer-main-links row text-center text-uppercase" style="padding-left: 20px;">
      <li class='nav-item dropdown'>
        <a type="button" href='#' aria-haspopup='true' aria-expanded='false' style='color:white'></a>
        <div class='dropdown-menu' aria-labelledby='dropdown-2'>

        </div>
      </li>
    </ul>
    <div class="dropdown btn-group ">
      <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #1bd4aa; color: black; "> <i class="fa fa-users text-dark"></i>
        Action
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="login.php">Login</a>
        <a class="dropdown-item" href="./dist/register.php">Register</a>
        <a class="dropdown-item" href="index.php">Log Out</a>
      </div>
    </div>
  </nav>

  <body>
    <div class="container-fluid navbarNav">
      <div class="row">
        <br>
        <div class="col-md-8 col-sm-8 kanan" id="kanan">
          <h4 class="text-center mb-3" style="margin-bottom: 20px; margin-top:20px;">Digital Training Center</h4>
          <div class="col-md-4"></div>
          <div class="col-md-4"></div>
          <div class="col-md-4"></div>
          <div class="input-group input-group-sm mb-3" style="margin-bottom: 20px; width:300px; margin-left:570px;">
            <input type="text" id="keyword" class="form-control input-sm" placeholder="Cari Pelatihan Kursus ...">
            <div class="input-group-append">
              <a href="#cari" id="cari" type="button" class="btn btn-primary"><i class="fas fa-search"></i>
              </a>
            </div>
          </div>

          <!-- View Data Paging -->
          <div class="container">
            <div class="container-fluid">
              <div class="row">
                <div id="results" class="mt-4"></div>
                <div id="loading"></div>
                <div id="loader"></div>
              </div>
            </div>
          </div>
          <!-- end paging data -->
        </div>
        <!-- end konten kanan -->

        <!-- start konten kiri -->
        <div class="col-md-4 col-sm-4 kiri" id="kiri">
          <!-- <header class="my-4"> -->
          <div id="carouselExampleCaptions" class="carousel" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="<?php echo "./dist/assets/breadcrumb/" . $viewLayout[0][0] ?>" class="w-100" alt="...">
                <div class="carousel-caption">
                  <h5><?php echo $viewLayout[0][1] ?></h5>
                  <p><?php echo $viewLayout[0][2] ?></p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="<?php echo "./dist/assets/breadcrumb/" . $viewLayout[1][0] ?>" class="w-100" alt="...">
                <div class="carousel-caption">
                  <h5><?php echo $viewLayout[1][1] ?></h5>
                  <p><?php echo $viewLayout[1][2] ?></p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="<?php echo "./dist/assets/breadcrumb/" . $viewLayout[2][0] ?>" class="w-100" alt="...">
                <div class="carousel-caption">
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

          <!-- </header> -->
        </div>
        <!-- end konten kiri -->
      </div>
    </div>


    <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script> -->
  </body>
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="libs/jquery/jquery-3.6.0.min.js"></script>
  <script src="libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="libs/jquery/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="libs/bootstrap/js/bootstrap.min.js"></script>
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