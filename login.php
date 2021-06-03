<?php
@include './config/config.php';
@include './controller/app/Aplikasi.php';

$Identitas_app = new Aplikasi;

$iden_app_arr = $Identitas_app->Viewapp($host);

session_start();

if (isset($_SESSION['key'])) {

    header("location:SessionGuru.php");
} else if (isset($_SESSION['q'])) {

    header("location:SessionSiswa.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $iden_app_arr[0] ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo './dist/assets/img/' . $iden_app_arr[1] ?>">
    <link href="./dist/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

<body class="background">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>

                <?php
                if (isset($_GET['edit_profile_ok'])) {
                ?>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil</strong> Profil berhasil diupdate silahkan login ulang
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                <?php } ?>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center" style="background-color: white;"><img src=<?php echo './dist/assets/img/' . $iden_app_arr[2] ?> width="80px" alt="">
                                    <h3 class="text-center font-weight-light my-3"> <?php echo $iden_app_arr[0] ?></h3>
                                </div>
                                <div class="card-body">
                                    <form action="./controller/login.php" method="POST">

                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter email address" name="email" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Enter password" name="password" required />
                                        </div>

                                        <div class="form-group">
                                            <label class="small mb-1" for="inputlevel">Level</label>
                                            <select class="custom-select" id="inputlevel" required name="level">
                                                <option value="">User Level</option>
                                                <option value="Teachers">Accessor</option>
                                                <option value="Students">Students</option>
                                            </select>
                                        </div>

                                        <center>
                                            <button type="submit" name="login" class="btn btn-default btn-sm clik" style="color: #fff; background: #031b29;
    border-color: #3c1012"> <i class="fa fa-paper-plane text-theme m-l-5"></a></i> Sign In</button>
                                    </form>
                                    </center>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small">
                                        <a href="./dist/register.php">Need an account? Sign up!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><?php echo $iden_app_arr[3] ?></div>
                        <div>
                            <a href="index.php"><i class="fas fa-home"></i> Site Home</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./dist/js/scripts.js"></script>
</body>

<!-- sweet alert -->
<?php
if (isset($_GET['fail'])) {
?>
    <script>
        swal("Email dan Password Salah Atau akun belum diaktifkan oleh Admin");
    </script>
<?php } ?>
<!-- end sweet alert -->

</html>