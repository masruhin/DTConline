<?php
    $code_class = $_POST['code_class'];
    $key = $_POST['key'];
    $id_join = $_POST['id_join'];
    $id_sesi = $_POST['id_sesi'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
?>

<form action="../../controller/teachers/Grade_tugas.php" method="post">
    <p class="card-text">Anda yakin ingin menghapus pekerjaan siswa <span class="badge badge-primary"><?php echo $first_name." ".$last_name ?></span></p>
    <br>
    <input type="hidden" name="key" value=<?php echo $key ?>>
    <input type="hidden" name="code_class" value=<?php echo $code_class ?>>
    <input type="hidden" name="id_join" value=<?php echo $id_join ?>>
    <input type="hidden" name="id_sesi" value=<?php echo $id_sesi ?>>

    <button type="submit" class="btn btn-primary" name="delete_tugas">Delete</button>

</form>