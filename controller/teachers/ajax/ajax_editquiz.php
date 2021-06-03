<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['code_class'];
    $key = $_POST['key'];
    // end key

    $id_sesi = $_POST['id_sesi'];

    $sql=mysqli_query($host, "SELECT * FROM identitas_quiz WHERE id_sesi_kls='$id_sesi' OR id_quiz='$id_sesi'");
    while($row = mysqli_fetch_array($sql)){
        $tgl_selesai = $row['tgl_selesai'];
        $waktu_selesai = $row['waktu_selesai'];
        $tgl_mulai  = $row['tgl_mulai'];
        $waktu_mulai = $row['waktu_mulai'];
        $title_quiz = $row['title_quiz'];

        $id_quiz = $row['id_quiz'];
    }

?>

<form action="../../controller/teachers/Class.php" method="post">

        <div class="form-group">
            <label for="title">Title quiz <span style="color: red;">*</span></label>
            <input type="text" name="title_quiz" id="title_quiz" required class="form-control" value="<?php echo $title_quiz ?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tgl_mulai">Date quiz opened <span style="color: red;">*</span></label>
                <input type="date" name="tgl_mulai" id="tgl_mulai_quiz" class="form-control" required value="<?php echo $tgl_mulai ?>">
            </div>
            
            <div class="form-group col-md-6">
                <label for="waktu_selesai">Time quiz opened <span style="color:red">*</span></label>
                <input type="time" name="waktu_mulai" id="waktu_mulai_quiz" class="form-control" required value="<?php echo $waktu_mulai ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tgl_selesai">Date quiz closed <span style="color: red;">*</span></label>
                <input type="date" name="tgl_selesai" id="tgl_selesai_quiz" class="form-control" required value="<?php echo $tgl_selesai ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="waktu_selesai">Time quiz closed <span style="color: red;">*</span></label>
                <input type="time" name="waktu_selesai" id="waktu_selesai_quiz" class="form-control" required value="<?php echo $waktu_selesai ?>">
            </div>
        </div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='code_class' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_sesi' name='id_sesi' value='$id_sesi'>";?>

    <?php echo"<input type='hidden' id='id_quiz' name='id_quiz' value='$id_quiz'>";?>

    <button type="submit" class="btn btn-primary" name="edit_quiz">Save</button>
</form>