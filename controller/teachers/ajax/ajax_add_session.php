<?php
    include '../../../config/config.php';
    include '../Dashboard.php';

    $key = $_POST['key'];
    $code_class = $_POST['code_class'];

    $My_name = array();
    $My_name = main("Nama", $key, $host);
?>

<style>
    .hidden{
        display: none;
    }
</style>

<form action="../../controller/teachers/Class.php" method="POST">

    <div class="form-group">
            <label for="name_class" style="font-weight: bold;">Judul <span style="color: red;">*</span></label>
            <input type="text" class="form-control" id="title" placeholder="Example : Session-1" required name="title">
    </div>

    <?php echo"<input type='hidden' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' name='kode_kelas' value='$code_class'>";?>

    <div class="form-group">
        <label for="caption" style="font-weight: bold;">Deskripsi <span style="color: red;">*</span></label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required placeholder="Input description in this session"></textarea>
    </div>

  <button type="submit" class="btn btn-primary" name="create_session">Save</button>
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