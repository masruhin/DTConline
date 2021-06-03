<?php
    $id_quiz = $_POST['id_quiz'];
    $id_join = $_POST['id_join'];
    $key = $_POST['key'];
    $class_code = $_POST['class_code'];
?>

<form action="../students/PreviewQuiz.php" method="post">
    <h6 class="card-text mb-2">Anda yakin mau hapus nilai siswa ini ?</h6>
    <?php echo "<input type='hidden' name='id_quiz' value='$id_quiz'>";?>
    <?php echo "<input type='hidden' name='id_join' value='$id_join'>";?>

    <?php echo "<input type='hidden' name='class_code' value='$class_code'>";?>
    <?php echo "<input type='hidden' name='key' value='$key'>";?>
    <hr>
    <button type="submit" class="btn btn-danger" name="hapus_nilai_quiz">Delete</button>
</form>