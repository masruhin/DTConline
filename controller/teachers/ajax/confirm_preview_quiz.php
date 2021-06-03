<?php
    $id_quiz = $_POST['id_quiz'];
    $id_join = $_POST['id_join'];
?>

<form action="../students/PreviewQuiz.php" method="post" target="_blank">
    <br>
    <h6 class="card-text mb-2">Anda yakin mau lihat preview pengerjaan soal siswa ini ?</h6>
    <?php echo "<input type='hidden' name='id_quiz' value='$id_quiz'>";?>
    <?php echo "<input type='hidden' name='id_join' value='$id_join'>";?>
    <br>
    <button type="submit" class="btn btn-primary">Preview</button>
</form>