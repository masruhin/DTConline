<?php
    $q = $_POST['q'];
    $class_code = $_POST['class_code'];
    $nohp = $_POST['nohp'];

    if($nohp != NULL){
?>

<form action="../../controller/students/Pesan.php" method="post" target="_BLANK">
    <div class="form-group">
        <label for="nohptujuan">No Whatsapp</label>
        <input type="text" name="no_tujuan" id="no_tujuan" readonly class="form-control" value=<?php echo $nohp; ?>>
    </div>

    <div class="form-group">
        <label for="pesan">Pesan</label>
        <textarea name="pesan" id="pesan" class="form-control" rows="6" placeholder="Tuliskan pesan disini......" required></textarea>
    </div>

    <button type="submit" name="kirim_WA" class="btn btn-primary">Kirim</button>
</form>

<?php
    }else{
        echo "Siswa ini belum mengisi nomor whatsapp";
    }
?>