<?php
    @include '../../../config/config.php';
    @include '../dataGuru.php';

    $EditGuru = new dataGuru;

    $id = $_POST['id'];

    $ViewEdit = $EditGuru->GetDetailGuru($host, $id);

    foreach ($ViewEdit as $view):
?>

<form action="./dataGuru.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <p class="card-text">Anda Yakin Ingin Menghapus Data <span class="badge badge-info"><?php echo $view['first_name']." ".$view['last_name'] ?></span></p>

    <hr>
    <button class="btn btn-danger" name="hapus" type="submit">Hapus</button>
</form>

<?php endforeach ?>