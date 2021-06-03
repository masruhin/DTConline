<?php
    @include '../../../config/config.php';
    @include '../dataSiswa.php';

    $EditSiswa = new dataSiswa;

    $id = $_POST['id'];

    $ViewEdit = $EditSiswa->ViewDataEditAndDelete($host, $id);

    foreach ($ViewEdit as $view):
?>

<form action="./dataSiswa.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <p class="card-text">Anda Yakin Ingin Menghapus Data <span class="badge badge-info"><?php echo $view['first_name']." ".$view['last_name'] ?></span></p>

    <hr>
    <button class="btn btn-danger" name="hapus" type="submit">Hapus</button>
</form>

<?php endforeach ?>