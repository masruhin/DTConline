<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['code_class'];
    $key = $_POST['key'];
    // end key

    $id_sesi = $_POST['id_sesi'];

    $sql=mysqli_query($host, "SELECT * FROM file_sesi_kelas WHERE id_sesi_kls='$id_sesi'");
    $cek_jumlh = mysqli_num_rows($sql);

?>

<style>
    .hidden{
        display: none;
    }
</style>

<form action="../../controller/teachers/Class.php" method="post" enctype="multipart/form-data">
    <p class="card-text small" style="color: blue;">Allowed type file: png, jpg, pdf, docx, txt, mp3, mp4, xlsx, zip, rar. Ukuran file maxs 2mb</p>
        <div class="form-group" id="table">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">File old</th>
                        <th scope="col">File Update</th>
                        <th scope="col"><center>Delete</center></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $i=1;
                    ?>

                    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
                    <?php echo"<input type='hidden' id='code_class' name='class_code' value='$class_code'>";?>
                    <?php echo"<input type='hidden' id='id_sesi' name='id_sesi' value='$id_sesi'>";?>

                    <?php 
                        while($row=mysqli_fetch_array($sql)){
                        
                            $id_file = $row['id_file'];
                    ?>

                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td>
                            <?php echo"<a target='_blank' href='../assets/file/".$row['nama_file']."'>".$row['nama_file']."</a>"; ?>
                        </td>
                        <td><?php echo"<input type='file' name='data_edit[]' id='data_edit_edit_$i' required>";?></td>
                        <td>
                            <center><?php echo"<a href='../../controller/teachers/Class.php?key=$key&class_code=$class_code&id_sesi=$id_sesi&id_file=$id_file&hapus_file'><i class='fas fa-trash' style='color: red;'></i></a>";?></center>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
        
        <hr>
        
        <?php echo"<input type='hidden' name='jmlh' id='jmlh' value='$cek_jumlh'>";?>

        <?php 
            if($cek_jumlh < 3){
        ?>

        <div class="form-group">
        <label for="x">Add file <span style="color: red;">*</span></label>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="yes" name="val" value="yes" required onclick="hidden_file()">
                <label class="custom-control-label" for="yes">Yes</label>
            </div>

            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="no" name="val" value="no" required onclick="hidden_file()" checked>
                <label class="custom-control-label" for="no">No</label>
            </div>
        </div>
        <?php } ?>

        <div class="form-group">
            <div id="file_add_1"></div>
        </div>
        
        <div class="form-group">
            <div id="file_add_2"></div>
        </div>
        
        <div class="form-group">
            <div id="file_add_3"></div>
        </div>
        
    <button type="submit" value="edit_title" class="btn btn-primary" name="edit_insert_file">Save</button>
</form>
