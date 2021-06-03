<?php
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $id = $_POST['id'];
?>

<form action="./php/dashboard.php" method="post">
    <p class="text-card">Anda Yakin Ingin Menonaktifkan akun <span class="badge badge-info"><?php echo $first_name. " ".$last_name ?></span></p>
    <hr>

    <input type="hidden" name="id" value="<?php echo $id ?>">

    <button class="btn btn-danger" name="tolak_akun" >Hapus</button>
</form>