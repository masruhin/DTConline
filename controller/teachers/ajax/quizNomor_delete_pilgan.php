<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['class_code'];
    $key = $_POST['key'];
    $id_soal = $_POST['id_soal'];
    $id_quiz=$_POST['id_quiz'];
    $nomor = $_POST['nomor'];
    // end key

?>

<form action="../../controller/teachers/Quiz.php" method="post">
    <div class="form-group">
        <p class="card-text">Are you sure you want to delete question number <span class="badge badge-primary"><?php echo $nomor ?></span> ?</p>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='class_code' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>
    <?php echo"<input type='hidden' id='id_soal' name='id_soal' value='$id_soal'>";?>
<hr>
    <button type="submit" value="edit_title" class="btn btn-danger" name="delete_soal">Delete</button>
</form>