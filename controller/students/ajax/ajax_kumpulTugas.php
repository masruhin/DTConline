<?php
    @include '../../../config/config.php';
    @include '../Class_siswa.php';

    $siswa_class = new class_siswa;

    $q = $_POST['q'];
    $code_class = $_POST['class_code'];
    $id_sesi = $_POST['id_sesi'];

    $sql = mysqli_query($host, "SELECT *FROM sesi_kelas WHERE id_sesi='$id_sesi'");
    while($row=mysqli_fetch_array($sql)){

        $title = $row['title'];
        $time_deadline = $row['waktu_deadline'];
        $tgl_deadline = $row['tgl_deadline'];

    }

    $sqli=mysqli_query($host, "SELECT *FROM tb_pengumpulan_tugas WHERE id_sesi_kls='$id_sesi'");
    $count = mysqli_num_rows($sqli);
?>

<style>
    .hidden{
        display: none;
    }
</style>

<h6>Add submission at <span class="badge badge-primary"><?php echo $title ?></span></h6>

<div class="custom-control custom-radio">
  <input type="radio" id="add_file" name="customRadio" class="custom-control-input" onclick="home()" required>
  <label class="custom-control-label" for="add_file">Add submission</label>
</div>
<div class="custom-control custom-radio">
  <input type="radio" id="edit_file" name="customRadio" class="custom-control-input" onclick="home()" required>
  <label class="custom-control-label" for="edit_file">View submission</label>
</div>

<form action="../../controller/students/Class_siswa.php" method="post" enctype="multipart/form-data" id="form_add_file" class="hidden">
<hr>
    <div class="form-group">
        <label for="banyak_file" style="font-weight: bold;">Insert file submission <sup style="color: red;">Allowed type file: png, jpg, pdf, docx, txt, mp3, mp4, xlsx, zip, rar. Ukuran file maxs 2mb</sup></label>
        <select name="file_banyak" id="banyak_file" class="form-control" required onclick="tambah_file()">
            <option value="">No file upload</option>
            <option value="1">1 File</option>
            <option value="2">2 File</option>
            <option value="3">3 File</option>
        </select>
    </div>

    <div class="form-group">
        <div id="file_input_1"></div>
    </div>

    <div class="form-group">
        <div id="file_input_2"></div>
    </div>

    <div class="form-group">
        <div id="file_input_3"></div>
    </div>

    <?php echo"<input type='hidden' name='time_deadline' value='$time_deadline'>";?>
    <?php echo"<input type='hidden' name='day_deadline' value='$tgl_deadline'>";?>

    <?php echo"<input type='hidden' name='q' value='$q'>";?>
    <?php echo"<input type='hidden' name='code_class' value='$code_class'>";?>
    <?php echo"<input type='hidden' name='id_sesi' value='$id_sesi'>";?>


    <?php echo"<input type='hidden' id='tot_tgs_terkumpul' value='$count'>";?>

    <button type="submit" name="save_tugas" class="btn btn-primary">Save</button>
</form>


<form action="#" method="post" id="form_edit_file" class="hidden">
<br>
    <?php
        if($siswa_class->cek_pengumpulantugas($host, $q, $code_class, $id_sesi) == 0){
            echo "anda belum pernah mengumpulkan tugas";
        }else{
    ?>

    <table class="table table-responsive">
    <thead>
        <tr>
            <th scope="col" style="font-weight:normal;">File saved</th>
            <th scope="col" style="font-weight:normal;">Collect date</th>
            <th scope="col" style="font-weight:normal;">Your submitted in</th>
            <th scope="col" style="font-weight:normal;">Delete</th>
        </tr>
    </thead>
    <tbody>


        <?php 
            $view_file_submit = $siswa_class->tampil_file_terkumpul($host, $q, $code_class, $id_sesi);
            foreach ($view_file_submit as $view_file){
        ?>
        <tr>
            <td>
                <?php  echo "<a href='../../controller/students/Class_siswa.php?name_file_tugas=$view_file[nama_file]'>$view_file[nama_file]</a><br>"; ?>
            </td>
            
            <td>
                <span class="badge badge-pill badge-primary"><?php echo $view_file['tgl_kumpul']." / ".$view_file['waktu_kumpul'] ?></span>
            </td>
            
            
                <?php
                    if($view_file['status_kumpul'] == "success"){
                ?>
                
                <td><span class="badge badge-pill badge-success"> <?php echo $view_file['time_remaining'] ?></a></td>

                <?php }else if($view_file['status_kumpul'] == "failed"){ ?>
                
                <td><span class="badge badge-pill badge-danger"><?php echo "Overdue ".$view_file['time_remaining'] ?></span></td>
                
                <?php } ?>
            
            
            <td><center><?php echo"<a href='../../controller/students/Class_siswa.php?q=$q&code_class=$code_class&id_file=$view_file[id_file]&delete_file_kumpul' title='delete file'><i class='fas fa-trash-alt' style='color: red;'></i></a></center></td>";?>
        </tr>
        <?php } ?>

   
    </tbody>
    </table>
    
    <?php } ?>
    

</form>

<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
</script>