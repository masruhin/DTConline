<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$key = $_POST['key'];
$id_join = $_POST['id_join'];
$code_class = $_POST['code_class'];
?>

<form action="../../controller/teachers/Class_aksi_guru.php" method="post">
    <h6>Anda yakin ingin menghapus Student <span class="badge badge-primary"><?php echo $first_name . " " . $last_name ?></span></h6>
    <hr>

    <?php echo "<input type='hidden' name='key' value='$key'>"; ?>
    <?php echo "<input type='hidden' name='code_class' value='$code_class'>"; ?>
    <?php echo "<input type='hidden' name='id_join' value='$id_join'>"; ?>

    <button type="submit" class="btn btn-danger" name="delete_siswa">Delete</button>
</form>