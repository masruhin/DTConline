<?php
    @include '../../../config/config.php';
    @include '../../teachers/Quiz.php';
    @include '../../teachers/Class.php';
    @include '../../students/GradeQuiz.php';

    $q = $_POST['q'];
    $class_code = $_POST['class_code'];
    $id_sesi = $_POST['id_sesi'];
    $id_quiz = $_POST['id_quiz'];
    $judul_sesi = $_POST['title_sesi'];
    $id_join = $_POST['id_join'];

    $tgl_selesai_quiz = $_POST['tgl_selesai'];
    $waktu_selesai_quiz = $_POST['waktu_selesai'];

    $tgl_mulai_quiz = $_POST['tgl_mulai'];
    $waktu_mulai_quiz = $_POST['waktu_mulai'];

    $Detail_quiz = new quiz;
    $General_detail_quiz = new general;
    $Layout_quiz = new Quiz_Layout;

    $grade_quiz = new GradeQuiz;
    
?>

<h6 class="mb-3">Quiz in <span class="badge badge-primary"><?php echo $judul_sesi; ?></span></h6>

<table class="table table-responsive">
  <thead>
    <tr>
      <th scope="col" style="font-weight:normal;">Quiz opened</th>
      <th scope="col" style="font-weight:normal;">Quiz closed</th>
      <th scope="col" style="font-weight:normal;">Quiz Duration</th>
      <th scope="col" style="font-weight:normal;">Number of question</th>
    </tr>
  </thead>
  <tbody>

    <?php
        $Tampil_quiz = $Detail_quiz->tampil_quiz($host, $id_sesi);
        foreach($Tampil_quiz as $quiz_tampil){
            $day_started = $quiz_tampil['tgl_mulai'];
            $time_started = $quiz_tampil['waktu_mulai'];

            $day_finished = $quiz_tampil['tgl_selesai'];
            $time_finished = $quiz_tampil['waktu_selesai'];
    ?>
    
    <tr>
      <td><span class="badge badge-pill badge-primary"><?php echo $quiz_tampil['tgl_mulai']." / ".$quiz_tampil['waktu_mulai'] ?></span></td>
      <td><span class="badge badge-pill badge-primary"><?php echo $quiz_tampil['tgl_selesai']." / ".$quiz_tampil['waktu_selesai'] ?></span></td>
      <td><span class="badge badge-pill badge-primary"><?php echo $General_detail_quiz->durasi($day_started, $time_started, $day_finished, $time_finished); ?></span></td>
      <td><span class="badge badge-pill badge-secondary"><?php echo $Layout_quiz->totalsoal($host, $id_quiz); ?></span></td>
    </tr>
    <?php } ?>
  
</tbody>
</table>

<hr>

<?php
    if($grade_quiz->cek_status_quiz_forSiswa($host, $id_join, $id_quiz) == 0 && $Layout_quiz->status_quiz($tgl_selesai_quiz, $waktu_selesai_quiz) == "Quiz open" && $Layout_quiz->status_quiz_sebelum_buka($tgl_mulai_quiz, $waktu_mulai_quiz) == "quiz buka"){
?>
<form action="KerjakanQuiz.php" method="post">
    <?php echo"<input type='hidden' name='q' value='$q'>";?>
    <?php echo"<input type='hidden' name='class_code' value='$class_code'>";?>
    <?php echo"<input type='hidden' name='id_quiz' value='$id_quiz'>";?>
    <?php echo"<input type='hidden' name='id_sesi_kls' value='$id_sesi'>";?>
    <?php echo"<input type='hidden' name='id_join' value='$id_join'>";?>

    <?php
        $get_deadline = $Detail_quiz->tampil_quiz($host, $id_sesi);
        foreach ($get_deadline as $deadline_get){
    ?>

    <?php echo"<input type='hidden' name='hari_selesai' value='$deadline_get[tgl_selesai]'>";?>
    <?php echo"<input type='hidden' name='waktu_selesai' value='$deadline_get[waktu_selesai]'>";?>

    <?php } ?>

    <button type="submit" class="btn btn-outline-success">Mulai quiz</button>
</form>
<?php }else if($grade_quiz->cek_status_quiz_forSiswa($host, $id_join, $id_quiz) != 0){

?>
<p class="lead">
    Nilai final anda pada quiz ini adalah <span class="badge badge-success"><?php echo $grade_quiz->nilai_siswa_Forsiswa($host, $id_join, $id_quiz); ?></span>
</p>

<form action="PreviewQuiz.php" method="post" target="_blank">
    <?php echo"<input type='hidden' name='id_quiz' value='$id_quiz'>";?>
    <?php echo"<input type='hidden' name='id_join' value='$id_join'>";?>

    <button type="submit" name="preview_quiz" class="btn btn-outline-primary">Preview</button>
</form>

<?php }else if($Layout_quiz->status_quiz($tgl_selesai_quiz, $waktu_selesai_quiz) == "Time expired" && $grade_quiz->cek_status_quiz_forSiswa($host, $id_join, $id_quiz) == 0){

  echo "anda belum mengerjakan quiz dan telah lewat deadline :)";

}else{

  echo "quiz belum dimulai :)";

} ?>