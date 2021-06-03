<?php
    @include '../../../config/config.php';
    @include '../Quiz.php';

    //key 
    $class_code = $_POST['class_code'];
    $key = $_POST['key'];
    $id_soal = $_POST['id_soal'];
    $id_quiz=$_POST['id_quiz'];
    $nomor = $_POST['nomor'];
    // end key

    $quiz_layout = new Quiz_Layout;
    

    $sql=mysqli_query($host, "SELECT *FROM soal WHERE id_soal='$id_soal'");
    while($row=mysqli_fetch_array($sql)){
        $isi=$row['isi_soal'];
        $jawaban=$row['jawaban'];
    }
?>

<div class="form-group">
    <p class="card-text">Edit number <span class="badge badge-primary"><?php echo $nomor ?></span></p>
</div>

<div class="form-group">
    <label for="x"><span class="badge badge-primary"> Please Choose Argument</span></label>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="edit_soal" name="pilihan" required onclick="klik_keputusan()" checked>
            <label class="custom-control-label" for="edit_soal">Edit Question</label>
        </div>

    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="edit_file" name="pilihan" value="edit_file" required onclick="klik_keputusan()">
        <label class="custom-control-label" for="edit_file">Edit File Question</label>
    </div>
</div>


<form action="../../controller/teachers/Quiz.php" method="post" id="form_edit_soal">
    <br>

    <div class="form-group" id="question">
        <label><span class="badge badge-primary">Question</span> <span style="color: red;"> *</span></label>
        <textarea name="isi_soal" id="soal" class="form-control" required><?php echo $isi ?></textarea>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='class_code' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>
    <?php echo"<input type='hidden' id='id_soal' name='id_soal' value='$id_soal'>";?>

    <?php echo"<input type='hidden' id='nomor' name='nomor' value='$nomor'>";?>
<hr>
    <button type="submit" value="edit_title" class="btn btn-primary" name="edit_soal_essay">Update</button>
</form>



<form action="../../controller/teachers/Quiz.php" method="post" enctype="multipart/form-data" class="hidden" id="form_edit_file">    
    <div class="form-group" id="table_view">
        <label for="jwb_benar"><span class="badge badge-primary"><?php echo $quiz_layout->cek_gambar($host, $id_soal)." file saved"; ?></span><sup style="color: red;"> Maximum 3 file : Allowed png, jpg</sup></label>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>File old</th>
                    <th>File new</th>
                    <th><center>Delete</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($quiz_layout->cek_gambar($host, $id_soal) == 0){
                ?>
                
                <!-- gk ada file -->
                <?php }else{ ?>
                <!-- ada file -->
                <?php
                    $tampilfile=$quiz_layout->tampilgambar($host, $id_soal);
                    $k=1;
                    foreach($tampilfile as $filetampil){
                ?>
                <tr>
                    <td>
                        <?php echo"<a target='_blank' href='../assets/file_quiz/".$filetampil['nama_filesoal']."'>".$filetampil['nama_filesoal']."</a>"; ?>
                    </td>
                    <td><?php echo"<input type='file' name='data_file[]' id='data_edits_$k' required>";?></td>
                    <td>
                        <center><?php echo"<a href='../../controller/teachers/Quiz.php?key=$key&class_code=$class_code&id_quiz=$id_quiz&id_file=$filetampil[id_file]&dltfile_pilgan'><i class='fas fa-trash' style='color: red;'></i></a>";?></center>
                    </td>
                </tr>
                
                <?php $k++;} ?>

                <?php } ?>
            </tbody>
        </table>
    </div>


    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='class_code' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>
    <?php echo"<input type='hidden' id='id_soal' name='id_soal' value='$id_soal'>";?>

    <?php
        $jumlah_file = $quiz_layout->cek_gambar($host, $id_soal);
    ?>
    <?php echo"<input type='hidden' name='jum_file' id='jum_file' value='$jumlah_file'>";?>
        <?php
            if($jumlah_file < 3){
        ?>
            <div class="form-group" id="control_add_file">
                <label for="x"><span class="badge badge-success"> Are you want to Add file</span></label>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="yesadd" name="addfile" value="yes" required onclick="edit_file()">
                        <label class="custom-control-label" for="yesadd">Yes</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="noadd" name="addfile" value="no" required onclick="edit_file()" checked>
                        <label class="custom-control-label" for="noadd">No</label>
                    </div>
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
            <div id="file_add_3">
        </div>

        <br>
    <button type="submit" value="edit_title" class="btn btn-primary" name="update_file_soal_essay">Update</button>
</form>



<script>
    CKEDITOR.replace("soal");

    //ckeditor field required
    $('form').submit(function(e){
        var messageLength = CKEDITOR.instances['soal'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'The question, field is required' );
                e.preventDefault();
            }
    });
</script>