<?php
    @include '../../../config/config.php';
    @include '../Quiz.php';
    
    //key 
    $class_code = $_POST['class_code'];
    $key = $_POST['key'];
    $id_quiz=$_POST['id_quiz'];
    //end key
?>

<div class="form-group">
    <label for="x"><span class="badge badge-primary"> Please Choose Argument</span></label>
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="import_pilihanganda" name="pilihan" required onclick="control_import()">
            <label class="custom-control-label" for="import_pilihanganda">Import Question multiplate choice</label>
        </div>

    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="import_essay" name="pilihan" value="essay" required onclick="control_import()">
        <label class="custom-control-label" for="import_essay">Import Question Essay</label>
    </div>
</div>

<form action="../../controller/teachers/Quiz.php" method="post" id="import_pilgan" class="hidden" enctype="multipart/form-data">
    <hr>
    <div class="form-group">
        <label for="file_pilgan"><span class="badge badge-success">Import Question Multilate choice</span></label>
        <input type="file" name="file_upload" id="pilgan_import" class="form-control-file" required>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='class_code' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>

    <hr>
    <button type="submit" name="import_pilgan" class="btn btn-primary">Import</button>
</form>


<form action="../../controller/teachers/Quiz.php" method="post" id="import_essay_essay" class="hidden" enctype="multipart/form-data">
    <hr>
    <div class="form-group">
        <label for="file_pilgan"><span class="badge badge-success">Import Question Essay</span></label>
        <input type="file" name="file_upload" id="essay_import" class="form-control-file" required>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='class_code' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>

    <hr>
    <button type="submit" name="import_essay" class="btn btn-primary">Import</button>
</form>