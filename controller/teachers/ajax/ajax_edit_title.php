<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['code_class'];
    $key = $_POST['key'];
    // end key

    $id_sesi = $_POST['id_sesi'];

    $sql=mysqli_query($host, "SELECT title FROM sesi_kelas WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");
    while($row = mysqli_fetch_array($sql)){
        $title = $row['title'];
    }

?>

<form action="../../controller/teachers/Class.php" method="post">
    <div class="form-group">
        <label for="title">Title <span style="color: red;">*</span></label>
        <input type="text" name="title" id="title" required class="form-control" value="<?php echo $title; ?>">
    </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='code_class' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_sesi' name='id_sesi' value='$id_sesi'>";?>

    <button type="submit" value="edit_title" class="btn btn-primary" name="edit_title">Save</button>
</form>