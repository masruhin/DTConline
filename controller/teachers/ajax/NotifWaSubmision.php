<?php
@include '../Dashboard.php';
@include '../../../config/config.php';

$key = $_POST['key'];
$pass_siswa = $_POST['pass_siswa'];

$getNohpsiswa = new statistic;

?>

<?php
if ($getNohpsiswa->CekNohpsiswa($host, $pass_siswa) == 0) {
    // echo "There's not Whatsapp number Student..!";
    echo "<div class='alert alert-danger alert-dismissible'>
                  <h5><i class='icon fas fa-ban'></i> Alert!</h5>
                  There's not Whatsapp number Student..!
                </div>";
} else {
?>
    <form action="../../controller/teachers/Grade_tugas.php" method="post">
        <div class="form-group">
            <label for="numberwa">Wa tujuan</label>
            <input type="text" name="numberwa" id="numberwa" class="form-control" readonly value=<?php echo $getNohpsiswa->Nohpsiswa($host, $pass_siswa); ?>>
        </div>

        <div class="form-group">
            <label for="pesan">Pesan</label>
            <textarea name="pesan" id="pesan" class="form-control" rows="6" placeholder="Tuliskan pesan disini......" required></textarea>
        </div>

        <button type="submit" name="kirim_WA" class="btn btn-primary">Kirim</button>
    </form>
<?php } ?>