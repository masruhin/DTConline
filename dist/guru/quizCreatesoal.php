<?php
@include '../../config/config.php';
@include '../../controller/inisial.php';
@include '../../controller/teachers/Class.php';
@include '../../controller/teachers/Quiz.php';
@include '../../controller/app/Aplikasi.php';
@include '../../controller/teachers/Dashboard.php';
@include '../../controller/teachers/Messange.php';

session_start();

if (isset($_SESSION['key'])) {

    if (isset($_GET['class_code']) && isset($_GET['id_quiz'])) {

        $key = $_SESSION['key'];
        $class_code = $_GET['class_code'];
        $id_quiz = $_GET['id_quiz'];

        //inisialissasi
        chek_quizguru($key, $host, $class_code, $id_quiz);

        $messange = new Messange;
        $email_get = new ajax_input_kelas;
        $chek_class = new statistic;
        $general_objek = new general; //objek general
        $quiz_layout = new Quiz_Layout; //objek quiz layout
        $Identitas_app = new Aplikasi;
        $iden_app_arr = $Identitas_app->Viewapp($host);
        $email = $email_get->email_user($host, $key);

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
            <title>Quiz-Teachers</title>
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/' . $iden_app_arr[1] ?>">

            <link href="../css/styles.css" rel="stylesheet" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="../assets/ckeditor/ckeditor.js"></script>
            <script src="../js/quizchoose.js"></script>
            <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

        </head>

        <body>

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
                    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button><!-- Navbar Search-->
                    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                    </form>
                    <!-- Navbar-->
                    <ul class="navbar-nav ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../../Destroyed.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div id="layoutSidenav">
                    <div id="layoutSidenav_nav">
                        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                            <div class="sb-sidenav-menu">
                                <div class="nav">
                                    <div class="sb-sidenav-menu-heading">Core</div>
                                    <a class="nav-link" href="<?php echo "quiz.php?class_code=$class_code&id_quiz=$id_quiz" ?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-rocket"></i></div>Quiz Home
                                    </a>
                                    <a class="nav-link" href="<?php echo "../../index.php" ?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home
                                    </a>

                                    <div class="sb-sidenav-menu-heading">Control Quiz</div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                        Modul Quiz
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="javascript:void(0)">
                                                <div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>Create question
                                            </a></nav>
                                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo "quizEditsoal.php?class_code=$class_code&id_quiz=$id_quiz" ?>">
                                                <div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>Edit question
                                            </a></nav>
                                        <nav class="sb-sidenav-menu-nested nav"><?php echo "<a class='nav-link' href='#import_soal' data-toggle='modal' data-id_quiz=''><div class='sb-nav-link-icon'><i class='fas fa-file-excel'></i></div>Import question</a>"; ?></nav>
                                    </div>

                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                        Modul Participant
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo "quizGrade.php?class_code=$class_code&id_quiz=$id_quiz" ?>">
                                                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>Grade participant
                                            </a></nav>
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
                                Guru
                            </div>
                        </nav>
                    </div>

                    <div id="layoutSidenav_content">
                        <main>
                            <div class="container-fluid">

                                <?php
                                $namakelas = $objek_general->this_name_class($host, $class_code);
                                $namasesi = $quiz_layout->get_namesession($host, $id_quiz);

                                foreach ($namakelas as $class_name) {
                                    $classname = $class_name['nama_kelas'];
                                }

                                foreach ($namasesi as $sesion_name) {
                                    $sesionname = $sesion_name['title'];
                                }

                                ?>
                                <h4 class="mt-3 text">
                                    Buat Soal Quiz Kelas <?php echo $classname ?> Sesi <?php echo $sesionname ?>
                                </h4>
                                <ol class="breadcrumb mb-4">

                                    <li class="breadcrumb-item"><a href=<?php echo "index.php"; ?>>Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href=<?php echo "class.php?class_code=$class_code"; ?>><?php echo $classname; ?></a></li>
                                    <li class="breadcrumb-item"><a href=<?php echo "quiz.php?class_code=$class_code&id_quiz=$id_quiz"; ?>><?php echo "Quiz home"; ?></a></li>
                                    <li class="breadcrumb-item active">Buat soal</li>
                                </ol>

                                <?php
                                if (isset($_GET['question_add'])) {
                                ?>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                                        <strong>Success</strong> Question has been successfully entered
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                <?php } ?>

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-text" style="color: #0099e6">Pilih type soal</h5>
                                        <hr>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="pilihanganda" name="type_soal" class="custom-control-input" value="pilihanganda" onclick="click_val()">
                                            <label class="custom-control-label" for="pilihanganda">Pilihan ganda</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="essay" name="type_soal" class="custom-control-input" value="essay" onclick="click_val()">
                                            <label class="custom-control-label" for="essay">Essay</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="null" name="type_soal" class="custom-control-input" value="null" onclick="click_val()" checked>
                                            <label class="custom-control-label" for="null">Info</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="card mb-4" id="view_infoquis">
                                    <div class="card-body">
                                        <h5 class="card-text" style="color: #0099e6">Info soal</h5>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="font-weight:normal;">Pilihan Ganda</th>
                                                    <th scope="col" style="font-weight:normal;">Essay</th>
                                                    <th scope="col" style="font-weight:normal;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><span class="badge badge-pill badge-primary"><?php echo $quiz_layout->pilgan_count($host, $id_quiz) . " numbers" ?></span></td>
                                                    <td><span class="badge badge-pill badge-info"><?php echo $quiz_layout->essay_count($host, $id_quiz) . " numbers" ?></span></td>
                                                    <td><span class="badge badge-pill badge-success"><?php echo $quiz_layout->totalsoal($host, $id_quiz); ?></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card mb-4 hidden" id="pilihanganda_view">
                                    <div class="card-body">
                                        <h5 class="card-text" style="color: #0099e6">Type Pilihan Ganda</h5>
                                        <hr>

                                        <form action="../../controller/teachers/Quiz.php" method="post" id="form_pilihanganda" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="pertanyaan" style="color: #0099e6;">Soal <span style="color:red">*</span></label>
                                                <textarea name="pertanyaan_pilgan" id="pertanyaan" class="form-control"></textarea>
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="pilihan_a" style="color: #0099e6;">Pilihan A <span style="color:red">*</span></label>
                                                <textarea name="pilihan_a" id="pilihan_a" class="form-control"></textarea>
                                            </div><br>

                                            <div class="form-group">
                                                <label for="pilihan_b" style="color: #0099e6;">Pilihan B <span style="color:red">*</span></label>
                                                <textarea name="pilihan_b" id="pilihan_b" class="form-control"></textarea>
                                            </div><br>

                                            <div class="form-group">
                                                <label for="pilihan_c" style="color: #0099e6;">Pilihan C <span style="color:red">*</span></label>
                                                <textarea name="pilihan_c" id="pilihan_c" class="form-control"></textarea>
                                            </div><br>

                                            <div class="form-group">
                                                <label for="pilihan_d" style="color: #0099e6;">Pilihan D <span style="color:red">*</span></label>
                                                <textarea name="pilihan_d" id="pilihan_d" class="form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="pilihan_e" style="color: #0099e6;">Pilihan E <span style="color:red">*</span></label>
                                                <textarea name="pilihan_e" id="pilihan_e" class="form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="file_pilihanganda" style="color: #0099e6;">Insert file <sup style="color: red;">Allowed type file: png, jpg</sup></label>
                                                <select name="file_pilihanganda" id="file_pilihanganda" class="form-control" onclick="cekfile()">
                                                    <option value="null">No file upload</option>
                                                    <option value="1">1 File</option>
                                                    <option value="2">2 File</option>
                                                    <option value="3">3 File</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <div id="file_pilihanganda_1"></div>
                                            </div>

                                            <div class="form-group">
                                                <div id="file_pilihanganda_2"></div>
                                            </div>

                                            <div class="form-group">
                                                <div id="file_pilihanganda_3"></div>
                                            </div>

                                            <?php echo "<input type='hidden' name='key' value='$key'>"; ?>
                                            <?php echo "<input type='hidden' name='class_code' value='$class_code'>"; ?>
                                            <?php echo "<input type='hidden' name='id_quiz' value='$id_quiz'>"; ?>

                                            <div class="form-group">
                                                <label for="jwb_true" style="color: #0099e6;">Pilihan benar <span style="color: red;">*</span></label>
                                                <select name="jwb_true" id="jwb_true" class="form-control" required>
                                                    <option value="">Pilihan jawaban</option>
                                                    <option value="pilihan_a">Pilihan A</option>
                                                    <option value="pilihan_b">Pilihan B</option>
                                                    <option value="pilihan_c">Pilihan C</option>
                                                    <option value="pilihan_d">Pilihan D</option>
                                                    <option value="pilihan_e">Pilihan E</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" id="save_pilihanganda" name="save_pilihanganda">Save</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>



                                <div class="card mb-4 hidden" id="essay_view">
                                    <div class="card-body">
                                        <h5 class="card-text" style="color: #0099e6">Type essay</h5>
                                        <hr>

                                        <form action="../../controller/teachers/Quiz.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="pertanyaan_essay" style="color: #0099e6;">Soal <span style="color:red">*</span></label>
                                                <textarea name="pertanyaan_essay" id="pertanyaan_essay" class="form-control" required></textarea>
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="answer_essay" style="color: #0099e6;">Jawaban <span style="color:red">*</span></label>
                                                <textarea name="answer_essay" id="answer_essay" class="form-control" required rows="4"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="file_essay" style="color: #0099e6;">Insert file <sup style="color: red;">Allowed type file: png, jpg</sup></label>
                                                <select name="file_essay" id="file_essay" class="form-control" onclick="cekfile_essay()">
                                                    <option value="null">No file upload</option>
                                                    <option value="1">1 File</option>
                                                    <option value="2">2 File</option>
                                                    <option value="3">3 File</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <div id="file_essay_1"></div>
                                            </div>

                                            <div class="form-group">
                                                <div id="file_essay_2"></div>
                                            </div>

                                            <div class="form-group">
                                                <div id="file_essay_3"></div>
                                            </div>

                                            <?php echo "<input type='hidden' name='key' value='$key'>"; ?>
                                            <?php echo "<input type='hidden' name='class_code' value='$class_code'>"; ?>
                                            <?php echo "<input type='hidden' name='id_quiz' value='$id_quiz'>"; ?>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" name="save_essay" id="save_essay">Save</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
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


                <?php echo "<input type='hidden' id='key' value='$key'>"; ?>
                <?php echo "<input type='hidden' id='code_class' value='$class_code'>"; ?>
                <?php echo "<input type='hidden' id='id_quiz' value='$id_quiz'>"; ?>

                <!-- modal import soal from excle-->
                <div class="modal fade" id="import_soal" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><b>Import Question</b></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">
                                <div class="modal_import_soal"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal import soal from excle-->

                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                <script src="../js/scripts.js"></script>
                <script src="../js/import.js"></script>
                <script>
                    //ajax import soal
                    $(document).ready(function() {
                        $('#import_soal').on('show.bs.modal', function(e) {

                            var key = $('#key').val();
                            var class_code = $('#code_class').val();
                            var id_quiz = $('#id_quiz').val();

                            $.ajax({
                                url: '../../controller/teachers/ajax/ajax_import_soal.php',
                                type: 'POST',
                                data: {
                                    'key': key,
                                    'class_code': class_code,
                                    'id_quiz': id_quiz
                                },
                                success: function(data) {
                                    $('.modal_import_soal').html(data);
                                }
                            });
                        });
                    });
                    //end ajax import soal
                </script>

                <script>
                    CKEDITOR.replace("pertanyaan");
                    CKEDITOR.replace("pertanyaan_essay");

                    CKEDITOR.replace("pilihan_a");
                    CKEDITOR.replace("pilihan_b");
                    CKEDITOR.replace("pilihan_c");
                    CKEDITOR.replace("pilihan_d");
                    CKEDITOR.replace("pilihan_e");

                    $("#save_pilihanganda").click(function(e) {
                        var pertanyaan = CKEDITOR.instances['pertanyaan'].getData().replace(/<[^>]*>/gi, '').length;
                        var pilihan_a = CKEDITOR.instances['pilihan_a'].getData().replace(/<[^>]*>/gi, '').length;
                        var pilihan_b = CKEDITOR.instances['pilihan_b'].getData().replace(/<[^>]*>/gi, '').length;
                        var pilihan_c = CKEDITOR.instances['pilihan_c'].getData().replace(/<[^>]*>/gi, '').length;
                        var pilihan_d = CKEDITOR.instances['pilihan_d'].getData().replace(/<[^>]*>/gi, '').length;
                        var pilihan_e = CKEDITOR.instances['pilihan_e'].getData().replace(/<[^>]*>/gi, '').length;

                        if (!pertanyaan) {
                            alert('The question field is required');
                            e.preventDefault();
                        }

                        if (!pilihan_a) {
                            alert('The choice A field is required');
                            e.preventDefault();
                        }

                        if (!pilihan_b) {
                            alert('The choice B field is required');
                            e.preventDefault();
                        }

                        if (!pilihan_c) {
                            alert('The choice C field is required');
                            e.preventDefault();
                        }

                        if (!pilihan_d) {
                            alert('The choice D field is required');
                            e.preventDefault();
                        }

                        if (!pilihan_e) {
                            alert('The choice E field is required');
                            e.preventDefault();
                        }
                    });


                    $("#save_essay").click(function(e) {
                        var pertanyaan = CKEDITOR.instances['pertanyaan_essay'].getData().replace(/<[^>]*>/gi, '').length;

                        if (!pertanyaan) {
                            alert('The question field is required');
                            e.preventDefault();
                        }
                    });
                </script>


                <?php
                if (isset($_GET['exstension_false'])) {
                ?>
                    <script>
                        swal({
                            title: "Exstension failed !",
                            text: "Im sorry!",
                            icon: "warning",
                            button: "Ok!",
                        });
                    </script>
                <?php } ?>


            </body>

        </html>
    <?php } else {
        echo "directory access forhibidden";
    } ?>

<?php
} else {
    header("location:../../index.php");
}
?>