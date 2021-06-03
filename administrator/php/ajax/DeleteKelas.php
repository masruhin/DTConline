<?php
    $kd_kls = $_POST['kd_kls'];
    $nama_kls = $_POST['nama_kls'];
?>

<form action="./php/dataKelas.php" method="post">
    <p class="card-text">Apakah anda yakin ingin menghapus kelas <span class="badge badge-primary"><?php echo $nama_kls ?></span></p>
    <br>
    <input type="hidden" name="kode_kelas" value="<?php echo $kd_kls ?>">
    <button type="submit" class="btn btn-danger" name="hapus_kelas">Hapus</button>
</form>