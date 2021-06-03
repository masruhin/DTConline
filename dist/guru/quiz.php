<?php
    @include '../../config/config.php';
    @include '../../controller/inisial.php';
    @include '../../controller/teachers/Class.php';
    @include '../../controller/teachers/Quiz.php';
    @include '../../controller/students/GradeQuiz.php';
    @include '../../controller/app/Aplikasi.php';
    @include '../../controller/teachers/Dashboard.php';
    @include '../../controller/teachers/Messange.php';

    session_start();

    if(isset($_SESSION['key'])){

    if(isset($_GET['class_code']) && isset($_GET['id_quiz'])){
        
        $key = $_SESSION['key'];
        $class_code = $_GET['class_code'];
        $id_quiz = $_GET['id_quiz'];

        //inisialissasi
        chek_quizguru($key, $host, $class_code, $id_quiz);
    
        $chek_class = new statistic;
        $general_objek = new general; //objek general
        $quiz_objek = new Quiz_Layout; //objek quiz layout
        $info_quiz = new InfoUmumQuiz; //objek info quiz
        $Identitas_app = new Aplikasi;
        $grade_quiz = new HasilQuiz;
        $messange = new Messange;
        $email_get = new ajax_input_kelas;

        $iden_app_arr = $Identitas_app->Viewapp($host);

        $total_soal_pilgan = $info_quiz->jumlah_soal_pilgan($host, $id_quiz);
        $total_soal_essay = $info_quiz->jumlah_soal_essay($host, $id_quiz);
        $Rasio_nilai = $info_quiz->rasio_nilai($host, $id_quiz);
        $total_sudah_quiz = $grade_quiz->total_siswa_sudah_quiz($host, $id_quiz);
        $total_belum_quiz = $grade_quiz->total_siswa_belum_kuis($host, $class_code);
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
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    </head>
    <body>
        <body class="sb-nav-fixed">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="javscript:void(0)">
                <h6>
                    <?php
                        if($chek_class->Cekisigambar($host, $key) == NULL){
                    ?>
                        <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo substr($My_name[1]." ".$My_name[0], 0, 20)  ?>
                    <?php
                        }else{
                            $mygambar = $chek_class->Cekisigambar($host, $key);
                            echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> ".substr($My_name[1]." ".$My_name[0], 0, 20)."" ;

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
                            <a class="dropdown-item" href="../../DestroyedGuru.php">Logout</a>
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
                                <a class="nav-link" href="javascript:void(0)"><div class="sb-nav-link-icon"><i class="fas fa-rocket"></i></div>Quiz Home</a>
                                <a class="nav-link" href="<?php echo "../../index.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home</a>

                                <div class="sb-sidenav-menu-heading">Control Quiz</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Modul Quiz
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo"quizCreatesoal.php?class_code=$class_code&id_quiz=$id_quiz" ?>"><div class="sb-nav-link-icon"><i class="fas fa-plus-circle"></i></div>Create question</a></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo"quizEditsoal.php?class_code=$class_code&id_quiz=$id_quiz" ?>"><div class="sb-nav-link-icon"><i class="fas fa-edit"></i></div>Edit question</a></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo"<a class='nav-link' href='#import_soal' data-toggle='modal' data-id_quiz=''><div class='sb-nav-link-icon'><i class='fas fa-file-excel'></i></div>Import question</a>";?></nav>
                                </div>

                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Modul Participant
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                 <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="<?php echo"quizGrade.php?class_code=$class_code&id_quiz=$id_quiz" ?>"><div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>Grade participant</a></nav>
                                </div>
                                <div class="sb-sidenav-menu-heading">Communication</div>
                                <?php
                                    if($messange->CekJumlaPesanMasukForGuru($host, $email) == 0){
                                        
                                        echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange</a>";

                                    }else{

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
                    <?php
                        $namakelas=$objek_general->this_name_class($host, $class_code);
                        $namasesi=$quiz_objek->get_namesession($host, $id_quiz);
                        $namaquiz=$quiz_objek->get_titlequiz($host, $id_quiz);

                        foreach($namakelas as $class_name){
                            $classname = $class_name['nama_kelas'];
                        }

                        foreach($namasesi as $sesion_name){
                            $sesionname = $sesion_name['title'];
                        }

                        foreach($namaquiz as $quiz_name){
                            $namequiz = $quiz_name['title_quiz'];

                            $waktu_mulai=$quiz_name['waktu_mulai'];
                            $waktu_selesai=$quiz_name['waktu_selesai'];
                            $tgl_mulai=$quiz_name['tgl_mulai'];
                            $tgl_selesai=$quiz_name['tgl_selesai'];
                        }
                    ?>
                    <div class="container-fluid">
                        <h4 class="mt-3">
                            Quiz Kelas <?php echo $classname ?>
                        </h4>
                        <ol class="breadcrumb mb-4 mt-3">
                            <li class="breadcrumb-item"><a href=<?php echo"index.php"; ?>>Dashboard</a></li>
                            <li class="breadcrumb-item"><a href=<?php echo"class.php?class_code=$class_code"; ?>><?php echo $classname; ?></a></li>
                            <li class="breadcrumb-item active">Quiz <?php echo $sesionname; ?></li>
                        </ol>

                        <?php
                            if(isset($_GET['import_ok'])) {
                        ?>
                        
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Import Question successfully
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['import_no'])) {
                        ?>
                        
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Error</strong> Exstension failed
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <div class="card mb-4">
                            <div class="card-body">
                            <?php echo"<a href='#edit_quiz' data-toggle='modal' data-sesi='$id_quiz' data-tootlip='tooltip' data-placement='top' title='edit quiz' style='float: right; font-size:15px;'><i class='fas fa-edit'></i></a>"; ?>
                            <h5 class="card-text mb-4" style="color: black">Indentity Quiz, Sesi <span class="badge badge-secondary"><?php echo$sesionname; ?></span></h5>
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                    <th scope="col" style="font-weight:normal;">Judul Quiz</th>
                                    <th scope="col" style="font-weight: normal;">Quiz dibuka</th>
                                    <th scope="col" style="font-weight:normal;">Quiz ditutup</th> 
                                    <th scope="col" style="font-weight:normal;">Jumlah soal</th>
                                    <th scope="col" style="font-weight:normal;">Durasi Quiz</th>
                                    <th scope="col" style="font-weight:normal;">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $namequiz ?></span></td>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $tgl_mulai." / ".$waktu_mulai ?></span></td>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $tgl_selesai." / ".$waktu_selesai ?></span></td>                                    
                                        <td><center><span class="badge badge-pill badge-primary"><?php echo $quiz_objek->totalsoal($host, $id_quiz)?></span></center></td>
                                        <td><span class="badge badge-pill badge-primary"><?php echo $objek_general->durasi($tgl_mulai, $waktu_mulai, $tgl_selesai, $waktu_selesai)?></span></td>
                                        <td>
                                            <?php
                                                if($quiz_objek->status_quiz($tgl_selesai, $waktu_selesai) == "Quiz open"){
                                            ?>
                                                <span class="badge badge-pill badge-success"><?php echo $quiz_objek->status_quiz($tgl_selesai, $waktu_selesai) ?></span>
                                            <?php }else{ ?>
                                                <span class="badge badge-pill badge-danger"><?php echo $quiz_objek->status_quiz($tgl_selesai, $waktu_selesai) ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>

                            </div>
                        </div>
                    

                        <div class="card-deck">
                            <div class="col-sm-6 mb-4">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Statistik Nilai</h5>
                                    <canvas id="myChart"></canvas>
                                    
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-6">
                                <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Statistik Soal</h5>
                                    <canvas id="pie_chart"></canvas>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-deck">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sebaran Nilai</h5>
                                        <canvas id="Linechart"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Statistik Peserta</h5>
                                        <canvas id="PesertaStatistik"></canvas>
                                    </div>
                                </div>
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
        
        <?php echo"<input type='hidden' id='key' value='$key'>";?>
        <?php echo"<input type='hidden' id='code_class' value='$class_code'>";?>
        <?php echo"<input type='hidden' id='id_quiz' value='$id_quiz'>";?>

        <?php echo"<input type='hidden' id='total_sudah_quiz' value='$total_sudah_quiz'>";?>
        <?php echo"<input type='hidden' id='total_belum_quiz' value='$total_belum_quiz'>";?>

        <?php echo"<input type='hidden' id='total_pilgan' value='$total_soal_pilgan'>";?>
        <?php echo"<input type='hidden' id='total_essay' value='$total_soal_essay'>";?>

        <?php echo"<input type='hidden' id='nilai_10' value='$Rasio_nilai[0]'>";?>
        <?php echo"<input type='hidden' id='nilai_20' value='$Rasio_nilai[1]'>";?>
        <?php echo"<input type='hidden' id='nilai_30' value='$Rasio_nilai[2]'>";?>
        <?php echo"<input type='hidden' id='nilai_40' value='$Rasio_nilai[3]'>";?>
        <?php echo"<input type='hidden' id='nilai_50' value='$Rasio_nilai[4]'>";?>
        <?php echo"<input type='hidden' id='nilai_60' value='$Rasio_nilai[5]'>";?>
        <?php echo"<input type='hidden' id='nilai_70' value='$Rasio_nilai[6]'>";?>
        <?php echo"<input type='hidden' id='nilai_80' value='$Rasio_nilai[7]'>";?>
        <?php echo"<input type='hidden' id='nilai_90' value='$Rasio_nilai[8]'>";?>
        <?php echo"<input type='hidden' id='nilai_100' value='$Rasio_nilai[9]'>";?>

        <!-- modal edit_quizz -->
        <div class="modal fade" id="edit_quiz" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit Quiz</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_editquiz"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal editquizz -->

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
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/BarChart.js"></script>
        <script src="../js/RoundChart.js"></script>
        <script src="../js/import.js"></script>
        <script src="../js/Linechart.js"></script>
        <script src="../js/PesertaStatistik.js"></script>
       
       <script>
        $(function () {
            $('[data-tootlip="tooltip"]').tooltip()
        })

            //ajax edit quiz
            $(document).ready(function(){
            $('#edit_quiz').on('show.bs.modal', function(e){
                var id_sesi = $(e.relatedTarget).data('sesi');
                var code_class = $('#code_class').val();
                var key = $('#key').val();

                $.ajax({
                    url : '../../controller/teachers/ajax/ajax_editquiz.php',
                    type : 'POST',
                    data : {'code_class':code_class, 'key':key, 'id_sesi':id_sesi},
                    success : function(data){
                        $('.modal_editquiz').html(data);
                    }
                });
            });
        });

        //ajax import soal
        $(document).ready(function(){
            $('#import_soal').on('show.bs.modal', function(e){

                var key = $('#key').val();
                var class_code = $('#code_class').val();
                var id_quiz = $('#id_quiz').val();
                
                $.ajax({
                    url : '../../controller/teachers/ajax/ajax_import_soal.php',
                    type : 'POST',
                    data : {'key':key, 'class_code':class_code, 'id_quiz':id_quiz},
                    success : function(data){
                        $('.modal_import_soal').html(data);
                    }
                });
            });
        });
        //end ajax import soal
        </script>
    </body>
</html>
    <?php }else{
        echo "directory access forhibidden";
    } ?>

<?php
    }else{
        header("location:../../index.php");

    }
?>