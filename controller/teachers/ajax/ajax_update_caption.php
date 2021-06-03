<?php
    @include '../../../config/config.php';
    @include '../../../controller/teachers/Dashboard.php';

    $key = $_POST['key'];
    $class_code = $_POST['class_code'];

    $objek_capt = new statistic;

?>
<form action="../../controller/teachers/Dashboard.php" method="post">
    <div class="form-group">
        <label for="caption">Caption kelas <sup style="color: red;">Gunakan caption kelas sebagai papan pengumuman di kelas anda</sup></label>
        <textarea name="caption" id="caption" cols="30" rows="10"><?php echo $objek_capt->get_Caption($host, $class_code); ?></textarea>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='code_class' name='class_code' value='$class_code'>";?>

    <button type="submit" class="btn btn-primary" name="update_caption">Update</button>
</form>

<script>
    CKEDITOR.replace("caption");

    //ckeditor field required
    $('form').submit(function(e){
        var messageLength = CKEDITOR.instances['caption'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'The caption field is required' );
                e.preventDefault();
            }
    });
</script>