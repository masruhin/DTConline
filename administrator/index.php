  <?php
  @include '../config/config.php';
  @include '../controller/app/Aplikasi.php';

  session_start();

  $Identitas_app = new Aplikasi;

  $iden_app_arr = $Identitas_app->Viewapp($host);
  ?>

  <?php
  if (isset($_SESSION['admin'])) {

    header("location:Dashboard.php");
  } else {
  ?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Log in</title>

      <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../dist/assets/img/' . $iden_app_arr[1] ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/vendor/assets/libs/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <!-- <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css"> -->
      <link rel="stylesheet" href="../vendor/assets/libs/fontawesome/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="./dist/css/adminlte.min.css">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <style>
      .clik {
        display: inline-block;
        padding: 6px 6px;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #4CAF50;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px #999;
      }

      .clik:hover {
        background-color: #3e8e41
      }

      .clik:active {
        background-color: #3e8e41;
        box-shadow: 0 2px #666;
        transform: translateY(4px);
      }
    </style>

    <body class="hold-transition login-page">
      <div class="login-box">
        <!-- <div class="login-logo">
          <a href="../../index2.html"><b>Administrator</b></a>
        </div> -->

        <?php if (isset($_GET['fail'])) { ?>

          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Username atau password salah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <?php } ?>

        <!-- /.login-logo -->
        <div class="card">
          <div class="card-header text-center" style="background-color: white;"><img src=<?php echo '../dist/assets/img/' . $iden_app_arr[2] ?> width="80px" alt="">
            <h3 class="text-center font-weight-light my-3"> <?php echo $iden_app_arr[0] ?></h3>
          </div>
          <div class="card-body login-card-body">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->
            <div class="login-logo">
              <a href="../../index2.html"><b>Administrator</b></a>
            </div>
            <form action="./php/Login.php" method="post">
              <div class="input-group input-group-sm mb-3">
                <input type="text" class="form-control" placeholder="Username" required name="username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fas fa-user"></i>
                  </div>
                </div>
              </div>
              <div class="input-group input-group-sm mb-3">
                <input type="password" class="form-control" placeholder="Password" required name="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <center>
                  <button type="submit" name="login" class="btn btn-default btn-sm clik" style="color: #fff; background: #031b29;
    border-color: #3c1012"> <i class="fa fa-paper-plane text-theme m-l-5"></a></i> Sign In</button>
            </form>
            </center>
          </div>
          </form>

        </div>
        <!-- /.login-card-body -->
      </div>
      </div>
      <!-- /.login-box -->

      <script src="../vendor/assets/libs/fontawesome/css/all.min.css"></script>

      <!-- jQuery -->
      <script src="./plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- AdminLTE App -->
      <script src="./dist/js/adminlte.min.js"></script>
      <script src="../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
      <script src="../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>

  <?php } ?>