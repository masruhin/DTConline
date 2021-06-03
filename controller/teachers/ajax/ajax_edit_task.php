<?php
    include '../../../config/config.php';

    //key 
    $class_code = $_POST['code_class'];
    $key = $_POST['key'];
    // end key

    $id_sesi = $_POST['id_sesi'];

    $sql=mysqli_query($host, "SELECT * FROM sesi_kelas WHERE id_sesi='$id_sesi' AND kd_kls='$class_code'");
    while($row = mysqli_fetch_array($sql)){
        $tgl_deadline = $row['tgl_deadline'];
        $waktu_deadline = $row['waktu_deadline'];
    }

?>

<style>
  .hidden{
    display: none;
  }
</style>

<form action="../../controller/teachers/Class.php" method="post">

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="date_old">Date deadline old</label>
      <input type="date" class="form-control" id="date_old" readonly value="<?php echo $tgl_deadline ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="time_old">Time deadline old</label>
      <input type="time" class="form-control" id="time_old" readonly value="<?php echo $waktu_deadline ?>">
    </div>
</div>

<hr>

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="date_new">Date deadline new <span style="color: red;">*</span></label>
      <input type="date" class="form-control" name="day_new" id="date_new" required>
    </div>
    <div class="form-group col-md-6">
      <label for="time_new">Time deadline new <span style="color: red;">*</span></label>
      <input type="time" class="form-control" name="time_new" id="time_new" required>
    </div>
</div>

<hr>

<div class="form-group">
  <div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="customCheck1" onclick="remainingChek()" value="">
    <label class="custom-control-label" for="customCheck1">Check time remaining</label>
  </div>
</div>

<div class="form-group mt-3 hidden" id="remaining">
    <div id="remaining"></div>
</div>

    <?php echo"<input type='hidden' id='key' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' id='code_class' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' id='id_sesi' name='id_sesi' value='$id_sesi'>";?>

    <button type="submit" value="edit_title" class="btn btn-primary" name="edit_time_deadline">Save</button>
</form>