<?php
    include '../../../config/config.php';
    include '../Class.php';

    //objek
    $objek_sesi = new model_view;
    $objek_general = new general;
    $obejek_quiz = new quiz;
    

    //key 
    $class_code = $_POST['code_class'];
    $key = $_POST['key'];
    // end key

    $id_sesi = $_POST['id_sesi'];

    //method call chek
    $cek_all = $objek_general->cek_add_menu($host, $class_code, $id_sesi);
    $cek_quiz = $obejek_quiz->cek_quiz($host, $id_sesi);

    
    $sql=mysqli_query($host, "SELECT title FROM sesi_kelas WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");
    while($row = mysqli_fetch_array($sql)){
        $title = $row['title'];
    }

?>

<style>
    .hidden{
        display: none;
    }
</style>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Main course</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

    <p class="card-text mt-3" style="color:blue;">Anda dapat menambahkan menu pada <?php echo $title ?></p>

    <form action="#" method="post">
        <div class="form-group">
            <div class="custom-control custom-radio">
                
                <?php
                    if($objek_sesi->jmlh_file($host, $id_sesi) == false){
                ?>
                
                <!-- penyisipan file digunakan -->
                        
                <input type="radio" id="filesisip" name="newmenu" class="custom-control-input" onclick="Clickfirst()">
                <label class="custom-control-label" for="filesisip">Tambahkan menu lampiran file</label>
                
                <?php }else{ ?>

                <!-- penyisipan file tidak digunakan -->

                <input type="radio" id="filesisip" name="newmenu" class="custom-control-input" disabled readonly>
                <label class="custom-control-label" for="filesisip">Tambahkan menu lampiran file</label>
                
                <?php } ?>
            
            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-radio">
                
                <?php
                    foreach($cek_all as $cek_dtbs){
                ?>

                <?php
                    if($cek_dtbs['waktu_deadline'] == "00:00:00" && $cek_dtbs['tgl_deadline'] == "0000-00-00"){
                ?>

                <!-- pengumpulan tugas digunakan -->

                <input type="radio" id="filesubmit" name="newmenu" class="custom-control-input" onclick="Clickfirst()">
                <label class="custom-control-label" for="filesubmit">Tambahkan tempat pengumpulan tugas</label>

                <?php }else{ ?>

                <!-- pengumpulan tugas tidak digunakan -->

                <input type="radio" id="filesubmit" name="newmenu" class="custom-control-input" disabled readonly> 
                <label class="custom-control-label" for="filesubmit">Tambahkan tempat pengumpulan tugas</label>

                <?php } ?>

                <?php } ?>

            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-radio">
            
                <?php
                    if($cek_quiz == false){
                ?>
                
                <!-- quiz digunakan -->
                
                <input type="radio" id="quiz" name="newmenu" class="custom-control-input" onclick="Clickfirst()">
                <label class="custom-control-label" for="quiz">Tambahkan menu quiz</label>

                <?php }else if($cek_quiz == true){ ?>

                 <!-- quiz tidak digunakan -->
            
                <input type="radio" id="quiz" name="newmenu" class="custom-control-input" disabled readonly>
                <label class="custom-control-label" for="quiz">Tambahkan menu quiz</label>

                <?php } ?>

            </div>
        </div>


    </form>



    <!-- form controlllll sisip file -->
    
    <form action="../../controller/teachers/Class.php" method="post" id="filesisip_act" class="hidden" enctype="multipart/form-data">

        <div class="form-group">
            <hr>
            <label for="tot_file" style="font-weight: bold;">Insert file <sup style="color: red;">Allowed type file: png, jpg, pdf, docx, txt, mp3, mp4, xlsx, zip, rar. Ukuran file maxs 2mb</sup></label>
            <select name="tot_file" id="tot_file" class="form-control" onclick="filesisip_Listener()" required>
                <option value="">No file upload</option>
                <option value="1">1 File</option>
                <option value="2">2 File</option>
                <option value="3">3 File</option>
            </select>
        </div>

        <?php echo"<input type='hidden' name='key' value='$key'>";?>
        <?php echo"<input type='hidden' name='class_code' value='$class_code'>";?>
        <?php echo"<input type='hidden' name='id_sesi' value='$id_sesi'>";?>

        <div class="form-group">
            <div id="filesisip_1"></div>
        </div>

        <div class="form-group">
            <div id="filesisip_2"></div>
        </div>

        <div class="form-group">
            <div id="filesisip_3"></div>
        </div>

        <button type="submit" class="btn btn-primary" name="add_menu_sisipfile">Save</button>
    </form>
  <!-- akhirrrrrr form controlllll sisip file -->




  <!-- form control add tmpt submisiion -->

  <form action="../../controller/teachers/Class.php" method="post" id="filesubmit_act" class="hidden">
        <hr>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="date_new">Tanggal deadline<span style="color: red;">*</span></label>
            <input type="date" class="form-control" name="day_new" id="day_add_task" required>
        </div>
        
        <div class="form-group col-md-6">
            <label for="time_new">Waktu deadline<span style="color: red;">*</span></label>
            <input type="time" class="form-control" name="time_new" id="time_add_task" required>
        </div>
    </div>

    <?php echo"<input type='hidden' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' name='id_sesi' value='$id_sesi'>";?>

    <hr>

    <div class="form-group">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="chektime_add" onclick="remainingCheks()" value="">
        <label class="custom-control-label" for="chektime_add">Check time remaining</label>
    </div>
    </div>

    <div class="form-group mt-3 hidden" id="remaining_addtask">
        <div id="remaining_addtask_view"></div>
    </div>

        <button type="submit" class="btn btn-primary" name="add_menuinput_task">Save</button>
  </form>
  <!-- end form control add tmpt submisiion -->


  <!-- form_control add quiz -->

    <form action="../../controller/teachers/Class.php" method="post" id="add_quiz" class="hidden">
        <hr>

        <div class="form-group">
            <label for="title">Judul quiz <span style="color: red;">*</span></label>
            <input type="text" name="title_quiz" id="title_quiz" required class="form-control">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tgl_mulai">Tanggal quiz dibuka <span style="color: red;">*</span></label>
                <input type="date" name="tgl_mulai" id="tgl_mulai_quiz" class="form-control" required>
            </div>
            
            <div class="form-group col-md-6">
                <label for="waktu_selesai">Waktu quiz dibuka <span style="color:red">*</span></label>
                <input type="time" name="waktu_mulai" id="waktu_mulai_quiz" class="form-control" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tgl_selesai">Tanggal quiz ditutup <span style="color: red;">*</span></label>
                <input type="date" name="tgl_selesai" id="tgl_selesai_quiz" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label for="waktu_selesai">Waktu quiz ditutup <span style="color: red;">*</span></label>
                <input type="time" name="waktu_selesai" id="waktu_selesai_quiz" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" name="chek_quiztime" id="chekquiz_time" class="custom-control-input" onclick="remainingCheksss()">
                <label for="chekquiz_time" class="custom-control-label">chek time remaining</label>
            </div>
        </div>

        <?php echo"<input type='hidden' name='key' value='$key'>";?>
        <?php echo"<input type='hidden' name='class_code' value='$class_code'>";?>
        <?php echo"<input type='hidden' name='id_sesi' value='$id_sesi'>";?>

        <div class="form-group mt-3 hidden" id="remainingtime_quiz">
        <div id="remainingtime_quiz_view"></div>
    </div>

    <div class="form-group mt-3 hidden" id="lama_quiz">
        <div id="lamaquiz_view"></div>
    </div>


        <button type="submit" name="quiz_add" class="btn btn-primary">save</button>
    </form>

  <!-- end form_control add quiz -->




<!-- delete this session -->
<form action="../../controller/teachers/Class.php" method="post">
    <hr>
    <?php echo"<input type='hidden' name='id_sesi' value='$id_sesi'>";?>
    <?php echo"<input type='hidden' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' name='class_code' value='$class_code'>";?>
    <button type="submit" class="btn btn-danger" name="delete_session">Delete session</button>
</form>

<!-- end delete this session -->

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
</div>