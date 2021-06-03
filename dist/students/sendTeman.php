<?php
    @include '../../controller/inisial.php';
    @include '../../config/config.php';
    @include '../../controller/students/Dashboard_siswa.php';
    @include '../../controller/app/Aplikasi.php';
    @include '../../controller/students/Pesan.php';
    @include '../../controller/teachers/KumpulTugas.php';

    session_start();

    if(isset($_SESSION['q']) && isset($_GET['to'])){

        $q = $_SESSION['q'];
        $to = $_GET['to'];
        if(cek_halaman_utama_siswa($host, $q) == true){

            //class view
            $view = new view;
            $Identitas_app = new Aplikasi;
            $pesan = new Pesan;
            $kumpultugas = new KumpulTugas;
            $name_siswa = $view->view_nama_siswa($host, $q);
            $iden_app_arr = $Identitas_app->Viewapp($host);
            $email = $pesan->GetEmail_siswa($host, $q);

            cek_halaman_send_pesan_antar_siswa($host, $email, $to);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Send - Students</title>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">
        <link href="../css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="../css/chat.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>     

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="javscript:void(0)">
                <h6>
                    <?php
                        if($view->Cekisigambar($host, $q) == NULL){
                    ?>
                        <img src="../assets/img/noimg.png" alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;"> <?php echo $name_siswa[0]." ".$name_siswa[1] ?>
                    <?php
                        }else{
                            $mygambar = $view->Cekisigambar($host, $q);
                            echo "<img src='../assets/userprofil/$mygambar' alt='Avatar' class='avatar' style='vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;'> ".$name_siswa[0]." ".$name_siswa[1]."" ;

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
                        <a class="dropdown-item" href="../../DestroyedSiswa.php">Logout</a>
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
                                <a class="nav-link" href="index.php"><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>Dashboard</a>
                                <a class="nav-link" href="<?php echo "../../index.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home</a>

                                <div class="sb-sidenav-menu-heading">Control Class</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Modul Class
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo"<a class='nav-link' href='#join_class' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-plus-circle'></i></div>Join Class</a>";?></nav>
                                    <nav class="sb-sidenav-menu-nested nav"><?php echo "<a class='nav-link' href='#set_akun' data-toggle='modal' data-q='$q'><div class='sb-nav-link-icon'><i class='fas fa-user-cog'></i></div>Setting Accocunt</a>";?></nav>
                                </div>
                                <?php
                                    if($kumpultugas->CekJoinKelas($host, $email) == 0){
                                ?>
                                <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas </a>
                                <?php }else{ ?>                   
                                <?php if($kumpultugas->Validation($host, $email) == true){ ?>
                                    <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas  &nbsp; <span class='badge badge-danger'>New</span></a>
                                <?php }else{ ?>
                                    <a class="nav-link" href="<?php echo "DaftarTugas.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-thumbtack"></i></div>Daftar Tugas </a>
                                <?php } ?>
                                <?php } ?>

                                <div class="sb-sidenav-menu-heading">Communication</div>
                                <?php
                                    if($pesan->JumlahPesanBelumTerbaca($host, $email) == 0){
                                ?>
                                <a class="nav-link" href="pesan.php"><div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange</a>
                                <?php
                                    }else{
                                ?>
                                <a class="nav-link" href="pesan.php"><div class="sb-nav-link-icon"><i class='fab fa-facebook-messenger'></i></div>Messange &nbsp; <span class='badge badge-danger'>New</span></a>

                                <?php } ?>

                            </div>                            
                        
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                            Students
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h4 class="mt-3">
                            Messange
                        </h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><?php echo "<a href='./index.php'>Dashboard</a>";?></li>
                            <li class="breadcrumb-item"><?php echo "<a href='./pesan.php'>Messange</a>";?></li>
                            <li class="breadcrumb-item active">Send</li>
                        </ol>

                        <?php
                            if(isset($_GET['fail'])){
                        ?>
                            <div class="alert alert-danger" role="alert" id="no_input">
                                Kolom Pesan Tidak Boleh Kosong                      
                            </div>
                        <?php } ?>

                        <?php
                            if(isset($_GET['yes'])){
                        ?>
                            <div class="alert alert-success" role="alert" id="sukses">
                                Pesan Terkirim
                            </div>
                        <?php } ?>

                        <div class="card">
                            <div class="card-body">
                            <?php $DataSiswa = $pesan->GetNamaSiswa($host, $to); ?>
                                <h5 class="card-text">
                                    <?php if($DataSiswa[2] == NULL){ ?>
                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/img/noimg.png" ?>">
                                    <?php }else{ ?>
                                        <img alt="Avatar" class="avatar" style="vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; border:2px;" src="<?php echo "../assets/userprofil/$DataSiswa[2]" ?>">
                                    <?php } ?>
                                    <?php echo $DataSiswa[0]." ".$DataSiswa[1] ?>

                                    <?php if($pesan->GetStatusSiswa($host, $to) == true){ ?>
                                        <span class="badge badge-success">Online</span>
                                    <?php }else{ ?>
                                        <span class="badge badge-danger">Offline</span>
                                    <?php } ?>                                    
                                </h5><hr>

                                <?php if($pesan->Total_Pesan_siswa_to_siswa($host, $email, $to) == 0){
                                     echo "<h5 class='text-center'>Belum ada pesan masuk</h5>";
                                }else{
                                    $View_pesan_arr = $pesan->ShowJumlahPesanSiswaToSiswa($host, $email, $to);
                                    $Tampil_Profil = $pesan->GetNamaSiswa($host, $to);
                                    $Tampil_Profil_pengirim = $pesan->GetNamaSiswa($host, $email);

                                    foreach ($View_pesan_arr as $view_pesan){
                           
                                ?>

                                <?php if($view_pesan['email_pengirim'] == $to){ ?>    
                                    <div class="container">
                                        <?php
                                            if($Tampil_Profil[2] == NULL){
                                        ?>
                                            <img src="../assets/img/noimg.png" alt="Avatar" class="Avater" class="left">
                                        <?php }else { ?>
                                            <img src="<?php echo "../assets/userprofil/$Tampil_Profil[2]" ?>" alt="Avatar" class="left">
                                        <?php } ?>
                                        <p><?php echo $view_pesan['pesan'] ?></p>
                                        <span class="time-right"><?php echo $view_pesan['date_time'] ?></span>
                                    </div>
                                    <?php }else{ ?>
                                        <div class="container" style="background-color: white;">
                                        <a href="<?php echo "../../controller/students/Pesan.php?pesan_id=$view_pesan[id_pesan]&q=$q&to=$to&hapus_pesan_siswa_to_siswa" ?>" style="float: right; color:red;" data-tootlip="tooltip" title='Hapus'><i class="fas fa-trash"></i></a>
                                        <?php
                                            if($Tampil_Profil_pengirim[2] == NULL){
                                        ?>
                                            <img src="../assets/img/noimg.png" alt="Avatar" class="Avater" class="right">
                                        <?php }else { ?>
                                            <img src="<?php echo "../assets/userprofil/$Tampil_Profil_pengirim[2]" ?>" alt="Avatar" class="right">
                                        <?php } ?>
                                            <p><?php echo $view_pesan['pesan'] ?></p>
                                            <span class="time-left"><?php echo $view_pesan['date_time'] ?></span>
                                        </div>                                
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>

                                <form action="../../controller/students/Pesan.php" method="post">
                                    <textarea id="editor1" name="editor1"></textarea>
                                    <input type="hidden" id="email_penerima" name="email_pengirim" value="<?php echo $email ?>">
                                    <input type="hidden" id="email_tujuan" name="email_tujuan" value="<?php echo $to ?>">
                                    <input type="hidden" id="q" name="q" value="<?php echo $q ?>">
                                    <button id="kirim_pesan_siswa" type="submit" name="kirim_pesan_siswa" class="btn btn-success mt-2">Kirim</button>
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

        <!-- modal join class -->
        <div class="modal fade" id="join_class" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Join class</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_join_class"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal join class -->

        <!-- modal setting akun -->
        <div class="modal fade" id="set_akun" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Setting your accocunt</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_set_akun"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal seting akun -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../assets/ckeditor5/ckeditor.js"></script>

        <script>
            $(function () {
                $('[data-tootlip="tooltip"]').tooltip()
            });
        let editor;

        ClassicEditor
        .create( document.querySelector( '#editor1' ), {

            ckfinder: {
                uploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                
            },
            toolbar: [ 'imageUpload', '|', 'heading', '|', 'bold', 'italic','link', '|', 'undo', 'redo' ]
            
        })
        .then( newEditor => {
            editor = newEditor;
        } )
        .catch( error => {
            console.error( error );
        });

        // ajax modal join class
        $(document).ready(function(){
            $('#join_class').on('show.bs.modal', function(e){
                var q = $(e.relatedTarget).data('q');
                $.ajax({
                    url : '../../controller/students/ajax/ajax_joinClass.php',
                    type : 'POST',
                    data : {'q':q},
                    success : function(data){
                        $('.modal_join_class').html(data);
                    }
                });
            });
        });
        //end ajax modal join class

        // ajax modal update profile
        $(document).ready(function(){
            $('#set_akun').on('show.bs.modal', function(e){
                var q = $(e.relatedTarget).data('q');
                $.ajax({
                    url : '../../controller/students/ajax/ajax_set_akun.php',
                    type : 'POST',
                    data : {'q':q},
                    success : function(data){
                        $('.modal_set_akun').html(data);
                    }
                });
            });
        });
        //end ajax update profile

        </script>


    </body>
</html>

<?php }}else{
        header("location:../../index.php");
    }
?>