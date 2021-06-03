<?php
    include '../../../config/config.php';

    $q = $_POST['q'];
    $id_join = $_POST['id_join'];
    $nama_kls = $_POST['nama_kls'];

?>
<form action="../../controller/students/Dashboard_siswa.php" method="post">
  
    <p class="card-text">Are you sure leave from class <span class="badge badge-pill badge-primary"><?php echo $nama_kls; ?></span></p>

    <?php echo"<input type='hidden' name='q' value='$q'>";?>
    <?php echo"<input type='hidden' name='id_join' value='$id_join'>";?>
    <hr>
    <button type="submit" class="btn btn-danger" name="leave_class">Leave</button>
</form>