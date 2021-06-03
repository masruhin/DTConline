<?php
    @include '../../config/config.php';
    @include '../../controller/inisial.php';
    @include '../../controller/teachers/Grade_tugas.php';
    @include '../../controller/teachers/Dashboard.php';
    @include '../../controller/app/Aplikasi.php';
    @include '../../controller/teachers/Messange.php';

    session_start();

    if(isset($_SESSION['key'])){

    if(isset($_GET['class_code']) && isset($_GET['sesi'])){

        $kd_kls = $_GET['class_code'];
        $key = $_SESSION['key'];
        $sesi = $_GET['sesi'];

        chek_halaman_grade_guru($key, $host, $kd_kls, $sesi);
        $chek_class = new statistic;
        $obj_identitas_gradeTgs = new Identitas;
        $obj_pengumpulan_tgs = new pengumpulan_tugas;
        $Identitas_app = new Aplikasi;
        $messange = new Messange;

        $iden_app_arr = $Identitas_app->Viewapp($host);
        //get email from key
        $email_get = new ajax_input_kelas;
        $email = $email_get->email_user($host, $key);
        //end get email

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
        <title>Grade-submission - Teachers</title>
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo '../assets/img/'.$iden_app_arr[1] ?>">

        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>
        <script src="../js/ViewGradeTgs.js"></script>
        <script src="../assets/ckeditor/ckeditor.js"></script>

        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css">
    
    </head>
    <body>
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
                    <?php echo "<a class='dropdown-item' href='../../DestroyedGuru.php'>Logout</a>";?>                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">

                    <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <?php echo "<a class='nav-link' href='index.php'><div class='sb-nav-link-icon'><i class='fas fa-tachometer-alt'></i></div>Dashboard</a>";?>
                            <a class="nav-link" href="<?php echo "../../index.php" ?>"><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Site home</a>

                            <div class="sb-sidenav-menu-heading">Control class</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"><div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php echo"<a class='nav-link' href='#create_class' data-toggle='modal' data-key='$key'>Create class</a>";?>
                                    <?php echo "<a href='#edit_profile' class='nav-link' data-toggle='modal' data-key='$key'>Setting accocunt</a>";?>
                                </nav>
                            </div>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">Master Data Kelas
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>

                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <?php
                                            if($chek_class->chek_class_null($host, $email) == true){
                                                $row_nav = array();
                                                $row_nav = main("Show_class", $email, $host);

                                                foreach ($row_nav as $nav_class){
                                        ?>
                                            <?php echo "<a class='nav-link' href='class.php?class_code=$nav_class[kode_kelas]'>$nav_class[nama_kelas]</a>";?>                                            
                                            <?php } ?>
                                        <?php } ?>
                                        
                                        </nav>
                                    </div>


                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">Master Data Siswa
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <?php
                                                if($chek_class->chek_class_null($host, $email) == true){
                                                    $row_view_data = array();
                                                    $row_view_data = main("Show_class", $email, $host);

                                                    foreach ($row_view_data as $row_data_view){
                                                    
                                            ?>
                                                <?php echo"<a class='nav-link' href='classDetail_siswa.php?class_code=$row_data_view[kode_kelas]'>$row_data_view[nama_kelas]</a>";?>
                                                <?php } ?>
                                            <?php } ?>
                                        </nav>
                                    </div>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Communication</div>
                            <?php
                                if($messange->CekJumlaPesanMasukForGuru($host, $email) == 0){
                                    
                                    echo "<a class='nav-link' href='Pesan.php'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange</a>";

                                }else{

                                    echo "<a class='nav-link' href='Pesan.ph'><div class='sb-nav-link-icon'><i class='fab fa-facebook-messenger'></i></div>Messange&nbsp; <span class='badge badge-danger'>New</span></a>";

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
                        <h4 class="mt-3">
                            <?php
                                $view_identitas = $obj_identitas_gradeTgs->sesi_kelas($host, $sesi, $kd_kls);
                                
                                $nama_kelas = $view_identitas[0];
                                $nama_sesi = $view_identitas[1];

                                echo "Penilaian tugas kelas ".$view_identitas[0]." ".$nama_sesi."";
                            ?>
                        </h4>

                        <ol class="breadcrumb mb-4">
                            <?php echo"<li class='breadcrumb-item'><a href='index.php'>Dashboard</a></li>";?>
                            <?php echo"<li class='breadcrumb-item'><a href='class.php?class_code=$kd_kls'>$nama_kelas</a></li>";?>
                            <li class="breadcrumb-item active"><?php echo "Grade submission ".$nama_sesi; ?></li>
                        </ol>

                        <?php
                            if(isset($_GET['nilai_ok'])) {
                        ?>
                        
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Nilai berhasil di update
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['emailok'])) {
                        ?>
                        
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Email berhasil dikirim
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <?php
                            if(isset($_GET['nilai_dlt'])) {
                        ?>
                        
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="margin-top: -10px;">
                            <strong>Success</strong> Pengumpulan tugas berhasil dihapus
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        
                        <?php } ?>

                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 id="count_mengumpulkan">Total Submitted <span class="badge badge-primary"><?php echo $obj_pengumpulan_tgs->Jmlh_siswa_kumpul($host, $sesi, $kd_kls); ?></span></h5>
                                <h5 id="count_belum_mengumpulkan" class="hidden">Not Submitted <span class="badge badge-danger"><?php echo $obj_pengumpulan_tgs->SiswabelumkumpulCount($host, $kd_kls); ?></span></h5>

                                <hr>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sudah_mengumpulkan" name="customRadio" class="custom-control-input" required onclick="Userclick()" checked>
                                    <label class="custom-control-label" for="sudah_mengumpulkan">Siswa yang sudah mengumpulkan tugas</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="belum_mengumpulkan" name="customRadio" class="custom-control-input" required onclick="Userclick()">
                                    <label class="custom-control-label" for="belum_mengumpulkan">Siswa yang belum mengumpulkan tugas</label>
                                </div>

                            </div>
                        </div>

                        <div class="card mb-4" id="view_sudah_mengumpulkan">
                            <div class="card-body">
                                <h5 class="mb-3" style="color: blue;">Siswa yang sudah mengumpulkan tugas</h5>
                                <hr>

                                <?php
                                    if($obj_pengumpulan_tgs->Jmlh_siswa_kumpul($host, $sesi, $kd_kls) == 0){
                                        echo "belum ada siswa yang mengumpulkan tugas";
                                    }else{
                                ?>
                                <table id="mengumpulkan_tugas" class="table dt-responsive nowrap" style="width:100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Nama siswa</center></th>
                                            <th><center>File terlampir</center></th>
                                            <th><center>Nilai</center></th>
                                            <th><center>View file</center></th>
                                            <th><center>Action</center></th>
                                        </tr>
                                    </thead>                                    
                                    <tbody>

                                    <?php
                                        $arr_Data_siswaKumpul = $obj_pengumpulan_tgs->Tb_pengumpulan_tgs($host, $sesi);
                                        $no=1;
                                        foreach($arr_Data_siswaKumpul as $pengumpul_tugas){

                                    ?>
                                    
                                    <tr>
                                        <td><center><?php echo $no; ?></center></td>
                                        <td><center><?php echo $pengumpul_tugas['first_name']." ".$pengumpul_tugas['last_name'] ?></center></td>
                                        <td><center><span class="badge badge-pill badge-primary"><?php echo $obj_pengumpulan_tgs->hitung_Jmlh_Tgs_PerSiswa($host, $sesi, $pengumpul_tugas['join_id'])." file terlampir" ?></span></center></td>
                                        <td><center>
                                            <?php
                                                if($obj_pengumpulan_tgs->grade_tugas($host, $sesi, $pengumpul_tugas['join_id']) == false){
                                                    echo "<span class='badge badge-pill badge-secondary'>Belum dinilai</span>";
                                                }else{
                                            ?>
                                                <span class='badge badge-pill badge-success'><?php echo $obj_pengumpulan_tgs->grade_tugas($host, $sesi, $pengumpul_tugas['join_id']) ?></span>
                                            <?php } ?>
                                        </center></td>
                                        <td><center><?php echo"<a href='#grade_siswa' data-toggle='modal' data-id_sesi='$sesi' data-key='$key' data-class_code='$kd_kls' data-id_join='$pengumpul_tugas[join_id]' data-first_name='$pengumpul_tugas[first_name]' data-last_name='$pengumpul_tugas[last_name]' class='badge badge-info'>View file</a>";?></center></td>
                                        <td><center><?php echo"<a href='#delete_tugas' data-toggle='modal' data-id_sesi='$sesi' data-key='$key' data-class_code='$kd_kls' data-id_join='$pengumpul_tugas[join_id]' data-first_name='$pengumpul_tugas[first_name]' data-last_name='$pengumpul_tugas[last_name]' class='badge badge-danger'>Delete</a>";?></center></td>
                                    </tr>
                                    
                                        <?php $no++; } ?>

                                    </tbody>
                                </table>

                                <?php } ?>

                            </div>
                        </div>

                    <div class="card mb-4 hidden" id="view_belum_mengumpulkan">
                        <div class="card-body">
                            <h5 class="mb-3" style="color: blue;">Siswa yang belum mengumpulkan tugas</h5>
                            <hr>
                            
                            <?php
                                if($obj_pengumpulan_tgs->SiswabelumkumpulCount($host, $kd_kls) == 0){
                                    
                                    echo "Semua siswa mengumpulkan tugas";

                                }else{
                            ?>

                            <table id="tdk_mengumpulkan_tugas" class="table dt-responsive nowrap" style="width:100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><center>No</center></th>
                                        <th><center>Nama siswa</center></th>
                                        <th><center>email</center></th>
                                        <th><center>Whatsapp number</center></th>
                                        <th><center>Kirim pesan</center></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $nomor = 1;
                                        $siswa_belum_kumpulTgs = $obj_pengumpulan_tgs->SiswabelumkumpulView($host, $kd_kls);
                                        foreach ($siswa_belum_kumpulTgs as $belum_mengumpulkan){
                                            $Name_blmKumpulTgs_arr = $obj_pengumpulan_tgs->Getnamasiswa($host, $belum_mengumpulkan['email_siswa']);
                                    ?>
                                    <tr>
                                        <td><center><?php echo $nomor; ?></center></td>
                                        <td><center><?php echo $Name_blmKumpulTgs_arr[0]." ".$Name_blmKumpulTgs_arr[1] ?></center></td>
                                        <td><center><?php echo $belum_mengumpulkan['email_siswa']; ?></center></td>
                                        <td><center>
                                            <?php
                                                if(is_null($Name_blmKumpulTgs_arr[2])){
                                                    echo"<a href='javascript:void(0)' data-toggle='modal' class='badge badge-success'>Belum melengkapi</a>";
                                                }else{
                                                    echo $Name_blmKumpulTgs_arr[2];
                                                }
                                            ?>
                                        </center></td>
                                        <td><center>
                                            <?php echo"<a href='#kirim_wa' data-toggle='modal' data-key='$key' data-pass_siswa='$Name_blmKumpulTgs_arr[3]' class='badge badge-success'>Whatsapp</a>";?>
                                            <?php echo"<a href='#kirim_email' data-toggle='modal' data-class_code='$kd_kls' data-sesi='$sesi' data-key='$key' data-pass_siswa='$Name_blmKumpulTgs_arr[3]' class='badge badge-info'>Email</a>";?>
                                        </center></td>
                                    </tr>
                                    
                                    <?php $nomor++; } ?>
                                </tbody>
                            </table>
                            
                            <?php } ?>
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

        <!-- modal edit siswa -->
        <div class="modal fade" id="grade_siswa" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>View tugas siswa</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_grade_siswa"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal edit siswa -->

        <!-- kirim pesan via whatsapp -->
        <div class="modal fade" id="kirim_wa" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Notification via Whatsapp</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_kirim_wa"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end kirim pesan via whatsapp-->

        <!-- kirim pesan via email -->
        <div class="modal fade" id="kirim_email" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Notification via Email</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_kirim_email"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end kirim pesan via email-->

        <!-- modal delete tugas -->
        <div class="modal fade" id="delete_tugas" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Confirm</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_delete_tugas"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal delete tugas -->


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

        <!-- Modal create class -->
        <div class="modal fade" id="create_class" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><b>Create new class</b></h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                
                            </div>
                            <div class="modal-body">
                        <div class="modal_create_class"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal create class -->

        <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script> -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>

        <script>
            $(document).ready(function() {
                $('#mengumpulkan_tugas').DataTable();
            });

            $(document).ready(function() {
                $('#tdk_mengumpulkan_tugas').DataTable();
            });

            $(document).ready(function(){
            $('#edit_profile').on('show.bs.modal', function(e){
                var key = $(e.relatedTarget).data('key');

                $.ajax({
                    url : '../../controller/teachers/ajax/ajax_set_profile.php',
                    type : 'POST',
                    data : {'key':key},
                    success : function(data){
                        $('.modal_edit_profile').html(data);
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#kirim_wa').on('show.bs.modal', function(e){
                var key = $(e.relatedTarget).data('key');
                var passsiswa = $(e.relatedTarget).data('pass_siswa');

                $.ajax({
                    url : '../../controller/teachers/ajax/NotifWaSubmision.php',
                    type : 'POST',
                    data : {'key':key, 'pass_siswa':passsiswa},
                    success : function(data){
                        $('.modal_kirim_wa').html(data);
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#kirim_email').on('show.bs.modal', function(e){
                var key = $(e.relatedTarget).data('key');
                var passsiswa = $(e.relatedTarget).data('pass_siswa');
                var class_code = $(e.relatedTarget).data('class_code');
                var sesi = $(e.relatedTarget).data('sesi');

                $.ajax({
                    url : '../../controller/teachers/ajax/NotifEmailSubmision.php',
                    type : 'POST',
                    data : {'key':key, 'pass_siswa':passsiswa, 'class_code':class_code, 'sesi':sesi},
                    success : function(data){
                        $('.modal_kirim_email').html(data);
                    }
                });
            });
        });


        $(document).ready(function(){
            $('#create_class').on('show.bs.modal', function(e){
                var key = $(e.relatedTarget).data('key');
                $.ajax({
                    url : '../../controller/teachers/ajax/ajax_create_class.php',
                    type : 'POST',
                    data : {'key':key},
                    success : function(data){
                        $('.modal_create_class').html(data);
                    }
                });
            });
        });

            //ajax grade
            $(document).ready(function(){
                $('#grade_siswa').on('show.bs.modal', function(e){
                var id_sesi = $(e.relatedTarget).data('id_sesi');
                var code_class = $(e.relatedTarget).data('class_code');
                var key = $(e.relatedTarget).data('key');
                var id_join = $(e.relatedTarget).data('id_join');
                var first_name = $(e.relatedTarget).data('first_name');
                var last_name = $(e.relatedTarget).data('last_name');

                $.ajax({
                    url : '../../controller/teachers/ajax/ajax_Grade_tugas.php',
                    type : 'POST',
                    data : {'code_class':code_class, 'key':key, 'id_join':id_join, 'id_sesi':id_sesi, 'first_name':first_name, 'last_name':last_name},
                    success : function(data){
                        $('.modal_grade_siswa').html(data);
                    }
                });
            });
        });
        //end ajax grade


        //ajax delete tugas
        $(document).ready(function(){
                $('#delete_tugas').on('show.bs.modal', function(e){
                var id_sesi = $(e.relatedTarget).data('id_sesi');
                var code_class = $(e.relatedTarget).data('class_code');
                var key = $(e.relatedTarget).data('key');
                var id_join = $(e.relatedTarget).data('id_join');
                var first_name = $(e.relatedTarget).data('first_name');
                var last_name = $(e.relatedTarget).data('last_name');

                $.ajax({
                    url : '../../controller/teachers/ajax/ajax_delete_tugasGuru.php',
                    type : 'POST',
                    data : {'code_class':code_class, 'key':key, 'id_join':id_join, 'id_sesi':id_sesi, 'first_name':first_name, 'last_name':last_name},
                    success : function(data){
                        $('.modal_delete_tugas').html(data);
                    }
                });
            });
        });
        //end ajax delete tugas

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