<link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png" />
<meta name="apple-mobile-web-app-title" content="CodePen">

<link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />

<link rel="mask-icon" type="" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111" />


<title>Submission Apps</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<style>
  html {
    height: 100%;
  }

  body {
    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  /* Text Align */
  .text-c {
    text-align: center;
  }

  .text-l {
    text-align: left;
  }

  .text-r {
    text-align: right
  }

  .text-j {
    text-align: justify;
  }

  /* Text Color */
  .text-whitesmoke {
    color: whitesmoke
  }

  /* Lines */

  .line-b {
    border-bottom: 1px solid #FFEB3B !important;
  }

  /* Buttons */
  .button {
    border-radius: 3px;
  }

  .form-button {
    background-color: rgba(255, 235, 59, 0.24);
    border-color: rgba(255, 235, 59, 0.24);
    color: #e6e6e6;
  }

  .form-button:hover,
  .form-button:focus,
  .form-button:active,
  .form-button.active,
  .form-button:active:focus,
  .form-button:active:hover,
  .form-button.active:hover,
  .form-button.active:focus {
    background-color: rgba(255, 235, 59, 0.473);
    border-color: rgba(255, 235, 59, 0.473);
    color: #e6e6e6;
  }

  /* Margins g(global) - l(left) - r(right) - t(top) - b(bottom) */

  .margin-g {
    margin: 15px;
  }

  .margin-g-sm {
    margin: 10px;
  }

  .margin-g-md {
    margin: 20px;
  }

  .margin-g-lg {
    margin: 30px;
  }

  .margin-l {
    margin-left: 15px;
  }

  .margin-l-sm {
    margin-left: 10px;
  }

  .margin-l-md {
    margin-left: 20px;
  }

  .margin-l-lg {
    margin-left: 30px;
  }

  .margin-r {
    margin-right: 15px;
  }

  .margin-r-sm {
    margin-right: 10px;
  }

  .margin-r-md {
    margin-right: 20px;
  }

  .margin-r-lg {
    margin-right: 30px;
  }

  .margin-t {
    margin-top: 15px;
  }

  .margin-t-sm {
    margin-top: 10px;
  }

  .margin-t-md {
    margin-top: 20px;
  }

  .margin-t-lg {
    margin-top: 30px;
  }

  .margin-b {
    margin-bottom: 15px;
  }

  .margin-b-sm {
    margin-bottom: 10px;
  }

  .margin-b-md {
    margin-bottom: 20px;
  }

  .margin-b-lg {
    margin-bottom: 30px;
  }

  /* Bootstrap Form Control Extension */

  .form-control,
  .border-line {
    background-color: #5f5f5f;
    background-image: none;
    border: 1px solid #424242;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
  }

  .form-control:focus,
  .border-line:focus {
    border-color: #FFEB3B;
    background-color: #616161;
    color: #e6e6e6;
  }

  .form-control,
  .form-control:focus {
    box-shadow: none;
  }

  .form-control::-webkit-input-placeholder {
    color: #BDBDBD;
  }

  /* Container */

  .container-content {
    background-color: #3a3a3aa2;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #FFEB3B;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
  }

  /* Backgrounds */

  .main-bg {

    background: #424242;
    background: linear-gradient(#424242, #212121);
  }

  /* Login & Register Pages*/

  .login-container {
    max-width: 400px;
    z-index: 100;
    margin: 0 auto;
    padding-top: 100px;
  }

  .login.login-container {
    width: 300px;
  }

  .wrapper.login-container {
    margin-top: 140px;
  }

  .logo-badge {
    color: #e6e6e6;
    font-size: 80px;
    font-weight: 800;
    letter-spacing: -10px;
    margin-bottom: 0;
  }
</style>

<body class="main-bg">

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
    <form action="" method="POST">
      <div class="login-container text-c animated flipInX">
        <div>
          <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
        </div>
        <a href="../../index2.html">
          <h3 class="text-whitesmoke">Mercedes-Benz</h3>
        </a>
        <div class="container-content">
          <div class="margin-t">
            <div class="form-group">
              <input type="text" name="username" class="form-control" placeholder="Username" required="">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <button type="submit" name="submit" class="form-button button-l margin-b">Sign In</button>
            <!-- <p class="text-whitesmoke text-center"><small>Do not have an account?</small></p> -->
            <p class="margin-t text-whitesmoke"><small> A Daimler &copy; Company</small> </p>
          </div>
        </div>
      </div>
    </form>
</body>

<?php } ?>