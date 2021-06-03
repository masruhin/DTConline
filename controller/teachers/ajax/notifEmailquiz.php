<?php
    @include '../Dashboard.php';
    @include '../../../config/config.php';

    $key = $_POST['key'];
    $class_code = $_POST['class_code'];
    $sesi = $_POST['sesi'];
    $pass_siswa = $_POST['pass_siswa'];
    $id_quiz = $_POST['id_quiz'];

    $getEmail = new statistic;

?>

<form action="../../controller/students/GradeQuiz.php" method="post">

    <div class="form-group">
        <label for="email_tujuan">Email Anda</label>
        <input type="text" name="email_pengirim" id="email_pengirim" class="form-control" readonly value=<?php echo $getEmail->getEmailguru($host, $key); ?>>
    </div>

    <div class="form-group">
        <label for="email_tujuan">Email Tujuan</label>
        <input type="text" name="email_tujuan" id="email_tujuan" class="form-control" readonly value=<?php echo $getEmail->getEmailsiswa($host, $pass_siswa); ?>>
    </div>

    <input type="hidden" name="key" value=<?php echo $key ?>>
    <input type="hidden" name="class_code" value=<?php echo $class_code ?>>
    <input type="hidden" name="sesi" value=<?php echo $sesi; ?>>
    <input type="hidden" name="id_quiz" value=<?php echo $id_quiz; ?>>

    <div class="form-group">
        <label for="subject">Subjek</label>
        <input type="text" name="subject" id="subject" class="form-control" placeholder="Tuliskan subject email" required>
    </div>

    <div class="form-group">
        <label for="pesan">Pesan</label>
        <textarea name="pesan" id="pesan" class="form-control" rows="6" placeholder="Tuliskan pesan disini......" required></textarea>
    </div>

    <button type="submit" name="kirim_Email" class="btn btn-primary">Kirim</button>
</form>
<script>
    CKEDITOR.replace("pesan");

    //ckeditor field required
    $('form').submit(function(e){
        var messageLength = CKEDITOR.instances['pesan'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Inputan pesan email masih kosong' );
                e.preventDefault();
            }
    });
</script>
