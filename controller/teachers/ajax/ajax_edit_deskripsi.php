<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['code_class'];
    $key = $_POST['key'];
    // end key

    $id_sesi = $_POST['id_sesi'];

    $sql=mysqli_query($host, "SELECT deskripsi FROM sesi_kelas WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");
    
    while($row = mysqli_fetch_array($sql)){

        $deskripsi = $row['deskripsi'];
    
    }

?>

<form action="../../controller/teachers/Class.php" method="post">
    <div class="form-group">
        <label for="deskripsi">Deskripsi <span style="color: red;">*</span></label>
        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"><?php echo $deskripsi ?></textarea>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='code_class' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_sesi' name='id_sesi' value='$id_sesi'>";?>

    <button type="submit" value="edit_title" class="btn btn-primary" name="edit_deskripsi">Save</button>
</form>

<script>
    CKEDITOR.replace("deskripsi");

    //ckeditor field required
    $('form').submit(function(e){
        var messageLength = CKEDITOR.instances['deskripsi'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'The description field is required' );
                e.preventDefault();
            }
    });
</script>