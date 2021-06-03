<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['class_code'];
    $key = $_POST['key'];
    $id_soal = $_POST['id_soal'];
    $id_quiz=$_POST['id_quiz'];
    $nomor = $_POST['nomor'];
    // end key

    $sql=mysqli_query($host, "SELECT *FROM soal WHERE id_soal='$id_soal'");
    while($row=mysqli_fetch_array($sql)){
        $isi=$row['pil_e'];
    }
?>

<form action="../../controller/teachers/Quiz.php" method="post">
    <div class="form-group">
        <p class="card-text">Edit number <span class="badge badge-primary"><?php echo $nomor ?></span>.</p>
    </div>

    <div class="form-group">
        <label><span class="badge badge-primary">Choice E</span> <span style="color: red;">*</span></label>
        <textarea name="pil_e" id="pil_e" class="form-control" required><?php echo $isi ?></textarea>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='class_code' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>
    <?php echo"<input type='hidden' id='id_soal' name='id_soal' value='$id_soal'>";?>
<hr>
    <button type="submit" value="edit_title" class="btn btn-primary" name="edit_pil_e">Update</button>
</form>

<script>
    CKEDITOR.replace("pil_e");

    //ckeditor field required
    $('form').submit(function(e){
        var messageLength = CKEDITOR.instances['pil_e'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'The Chocie E, field is required' );
                e.preventDefault();
            }
    });
</script>