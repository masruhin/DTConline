<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['code_class'];
    $key = $_POST['key'];
    // end key

    $id_sesi = $_POST['id_sesi'];

    $sql=mysqli_query($host, "SELECT * FROM identitas_quiz WHERE id_sesi_kls='$id_sesi'");
    while($row = mysqli_fetch_array($sql)){
        $id_quiz = $row['id_quiz'];
    }

    $sqli=mysqli_query($host, "SELECT title FROM sesi_kelas WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");
    while($rowi = mysqli_fetch_array($sqli)){
        $title = $rowi['title'];
    }

?>

<form action="../../controller/teachers/Class.php" method="post">
    <div class="form-group">
        <p class="card-text">Are you sure you want to delete quiz place during on <?php echo $title ?></p>
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='code_class' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_sesi' name='id_sesi' value='$id_sesi'>";?>
    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>
<hr>
    <button type="submit" value="edit_title" class="btn btn-danger" name="delete_quiz">Delete</button>
</form>