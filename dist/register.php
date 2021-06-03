<?php
@include '../config/config.php';
@include '../controller/app/Aplikasi.php';

$Identitas_app = new Aplikasi;

$iden_app_arr = $Identitas_app->Viewapp($host);
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
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo './assets/img/' . $iden_app_arr[1] ?>">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="background">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center" style="background-color: white;"><img src=<?php echo './assets/img/' . $iden_app_arr[2] ?> width="80px" alt="">
                                    <h3 class="text-center font-weight-light my-3">Buat akun user</h3>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/create.php" method="POST">
                                        <div class="alert alert-warning" role="alert">
                                            Untuk Pendaftaran Akun Accessor silahkan Request ke admin
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputFirstName">First Name</label>
                                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter first name" name="first_name" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputLastName">Last Name</label>
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter last name" name="last_name" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                    <input class="form-control" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputlevel">Level</label>
                                                    <input type="text" name="level" value="Students" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputPassword">Password</label>
                                                    <input class="form-control" id="inputPassword" type="password" placeholder="Enter password" name="password" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                    <input class="form-control" id="inputConfirmPassword" type="password" placeholder="Confirm password" name="confirm_password" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mt-4 mb-0">
                                            <button type="submit" name="submit" class="btn btn-primary btn-block">Create Account</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small">
                                        <a href="../login.php">Have an account? Go to login</a>
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
                            <a href="../index.php"><i class="fas fa-home"></i> Site Home</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>



    <!-- sweet alert -->
    <?php
    if (isset($_GET['email_fail'])) {
    ?>
        <script>
            swal({
                title: "Email sudah digunakan!",
                text: "Gagal membuat akun!",
                icon: "error",
                button: "Ok!",
            });
        </script>
    <?php } ?>

    <?php
    if (isset($_GET['password_fail'])) {
    ?>
        <script>
            swal({
                title: "Password tidak sama!",
                text: "Gagal membuat akun!",
                icon: "error",
                button: "Ok!",
            });
        </script>
    <?php } ?>

    <?php
    if (isset($_GET['success'])) {
    ?>
        <script>
            swal({
                title: "Akun berhasil dibuat!",
                text: "Berhasil membuat akun!",
                icon: "success",
                button: "Ok!",
            });
        </script>
    <?php } ?>
    <!-- end sweet alert -->
</body>

</html>