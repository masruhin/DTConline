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

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Accessor</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-fixed/">
        <!-- Bootstrap core CSS -->
        <link href="../../vendor/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Fontawesoome css -->
        <link rel="stylesheet" href="../../vendor/assets/libs/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="../../vendor/assets/css/app.css">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

        <script src="../../vendor/assets/libs/jquery/jquery-3.6.0.min.js"></script>
        <script src="../../vendor/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/ckeditor/ckeditor.js"></script>
        <script src="../assets/ckfinder/ckfinder.js"></script>

        <style>
            /* Dropdown Button */
            .dropbtn {
                background-color: #04AA6D;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
            }

            /* The container <div> - needed to position the dropdown content */
            .dropdown {
                position: relative;
                display: inline-block;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            /* Links inside the dropdown */
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content a:hover {
                background-color: #ddd;
            }

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {
                display: block;
            }

            /* Change the background color of the dropdown button when the dropdown content is shown */
            .dropdown:hover .dropbtn {
                background-color: #3e8e41;
            }
        </style>
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

            <a class="navbar-brand" href="javscript:void(0)">
                <h6>
                    <?php
                    if ($chek_class->Cekisigambar($host, $key) == NULL) {
                    ?>
                        <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo substr($My_name[1] . " " . $My_name[0], 0, 20)  ?>
                    <?php
                    } else {
                        $mygambar = $chek_class->Cekisigambar($host, $key);
                        echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> " . substr($My_name[1] . " " . $My_name[0], 0, 20) . "";
                    }
                    ?>

                </h6>
            </a>

            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <div class="collapse navbar-collapse fixed-top" id="navbarSupportedContent" style="background-color: #168c81; color:white; height: 60px;">
                <div class="dropdown">
                    <button class="dropbtn">Dropdown</button>
                    <div class="dropdown-content">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                    </div>
                </div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=" <?php echo "../../index.php" ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My Course
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <?php echo "<a class='dropdown-item' href='#create_class' data-toggle='modal' data-key='$key'>Create Class</a>"; ?>
                            </li>
                            <li>
                                <?php echo "<a href='#edit_profile' data-toggle='modal' data-key='$key'>Setting accocunt</a>"; ?>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="userDropdown">
                            <?php echo "<a class='dropdown-item' href='../../DestroyedGuru.php'>Logout</a>"; ?>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto ml-md-0">
                </ul>
                <form class="" style="padding-top: 10px;">
                    <div class="inpit-group input-group-sm">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <button class="btn btn-primary btn-sm">cari</button>
                        </div>
                    </div>
            </div>
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->

        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard
                            </a>
                            <a class="nav-link" href="<?php echo "../../index.php" ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home
                            </a>


                            <div class="sb-sidenav-menu-heading">Control class</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php echo "<a class='nav-link' href='#create_class' data-toggle='modal' data-key='$key'>Create class</a>"; ?>
                                    <?php echo "<a href='#edit_profile' class='nav-link' data-toggle='modal' data-key='$key'>Setting accocunt</a>"; ?>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Data Course
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <?php
                                            if ($chek_class->chek_class_null($host, $email) == true) {
                                                $row_nav = array();
                                                $row_nav = main("Show_class", $email, $host);

                                                foreach ($row_nav as $nav_class) {
                                            ?>
                                                    <?php echo "<a class='nav-link' href='class.php?class_code=$nav_class[kode_kelas]'>$nav_class[nama_kelas]</a>"; ?>
                                                <?php } ?>
                                            <?php } ?>

                                        </nav>
                                    </div>


                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Data Participants
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <?php
                                            if ($chek_class->chek_class_null($host, $email) == true) {
                                                $row_view_data = array();
                                                $row_view_data = main("Show_class", $email, $host);

                                                foreach ($row_view_data as $row_data_view) {

                                            ?>
                                                    <?php echo "<a class='nav-link' href='classDetail_siswa.php?class_code=$row_data_view[kode_kelas]'>$row_data_view[nama_kelas]</a>"; ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Communication</div>

                            <?php
                            if ($messange->CekJumlaPesanMasukForGuru($host, $email) == 0) {

                                echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange</a>";
                            } else {

                                echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange&nbsp; <span class='badge badge-danger'>New</span></a>";
                            }
                            ?>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login Sebagai:</div>
                        Accessor
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3">Dashboard
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>

                        <?php
                        if (isset($_GET['success_edit_class'])) {
                        ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                                <strong>Success</strong> Edit class completed
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['success'])) {
                        ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                                <strong>Success</strong> Selamat datang Accessor
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <?php
                        if (isset($_GET['success_dlt_class'])) {
                        ?>

                            <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -20px;">
                                <strong>Success</strong> Delete class completed
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <!-- View Data Paging -->
                        <div id="results" class="mt-4"></div>
                        <div id="loading"></div>
                        <div id="loader"></div>
                        <!-- end paging data -->

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"><?php echo $iden_app_arr[3]; ?> </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


        <!-- Modal create class -->
        <div class="modal fade" id="create_class" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Create new Course</b></h5>
                        <button type="button" Course="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <div class="modal_create_class"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal create class -->

        <!-- Modal edit class -->
        <?php echo "<input type='hidden' name='key' id='key' value='$key'>"; ?>
        <?php echo "<input type='hidden' name='email' id='email' value='$email'>"; ?>

        <div class="modal fade" id="edit_class" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit this class</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <div class="modal_edit_class"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit class -->

        <!-- Modal edit profil -->
        <div class="modal fade" id="edit_profile" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit your profile</b></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <div class="modal_edit_profile"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit profil -->

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>

        <!-- Jquery  -->

        <script>
            var editor = CKEDITOR.replace('caption', {
                filebrowserBrowseUrl: '../assets/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl: '../assets/ckfinder/ckfinder.html?type=Images',
                filebrowserUploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
            });
            CKFinder.setupCKEditor(editor);

            function showRecords(perPageCount, pageNumber) {

                var key = $('#email').val();
                var realkey = $('#key').val();

                $.ajax({
                    type: "GET",
                    url: "../../controller/teachers/Paging.php",
                    data: {
                        "pageNumber": pageNumber,
                        'key': key,
                        'realkey': realkey
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
            }

            $(document).ready(function() {
                showRecords(10, 1);
            });
        </script>


        <script>
            $(document).ready(function() {
                $('#create_class').on('show.bs.modal', function(e) {
                    var key = $(e.relatedTarget).data('key');
                    $.ajax({
                        url: '../../controller/teachers/ajax/ajax_create_class.php',
                        type: 'POST',
                        data: {
                            'key': key
                        },
                        success: function(data) {
                            $('.modal_create_class').html(data);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#edit_class').on('show.bs.modal', function(e) {
                    var kode_kelas = $(e.relatedTarget).data('code');
                    var key = $('#key').val();

                    $.ajax({
                        url: '../../controller/teachers/ajax/ajax_edit_class.php',
                        type: 'POST',
                        data: {
                            'key': key,
                            'kode_kelas': kode_kelas
                        },
                        success: function(data) {
                            $('.modal_edit_class').html(data);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $('#edit_profile').on('show.bs.modal', function(e) {
                    var key = $(e.relatedTarget).data('key');

                    $.ajax({
                        url: '../../controller/teachers/ajax/ajax_set_profile.php',
                        type: 'POST',
                        data: {
                            'key': key
                        },
                        success: function(data) {
                            $('.modal_edit_profile').html(data);
                        }
                    });
                });
            });
        </script>
        <!-- end Jquery -->

        <!-- sweet alert -->

        <?php
        if (isset($_GET['false_create_class'])) {
        ?>
            <script>
                swal({
                    title: "Sory !",
                    text: "Code class already used!",
                    icon: "error",
                    button: "Ok!",
                });
            </script>
        <?php } ?>

        <?php
        if (isset($_GET['false_dlt_class'])) {
        ?>
            <script>
                swal({
                    title: "class failed to delete !",
                    text: "Im sorry!",
                    icon: "error",
                    button: "Ok!",
                });
            </script>
        <?php } ?>
        <!-- end sweet alert -->
    </body>

    </html>

<?php
} else {
    header("location:../../index.php");
}
?>