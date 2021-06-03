<?php
$q = $_POST['q'];
?>
<form action="../../controller/students/Dashboard_siswa.php" method="post">

    <div class="form-group">
        <label for="inputan_kd_kls_siswa">Enter class code</label>
        <input type="text" name="inputan_codeclass" id="inputas_kd_kls_siswa" class="form-control" required placeholder="input key class code">
    </div>

    <?php echo "<input type='hidden' name='q' value='$q'>"; ?>
    <hr>
    <button type="submit" class="btn btn-primary" name="inputan_kd_kls_siswa">Ok</button>
</form>