<?php
    @include '../../../config/config.php';
    @include '../Pesan.php';

    $key = $_POST['key'];
    $class_code = $_POST['class_code'];
    $email_tujuan = $_POST['email_tujuan'];

    $PesanEmail = new PesanEmail;
?>

<form action="../../controller/teachers/Pesan.php" method="post">
    <div class="form-group">
        <label for="email_pengirim">Email Pengirim</label>
        <input type="email" name="email_pengirim" id="email_pengirim" readonly class="form-control" value="<?php echo $PesanEmail->getEmailpengirim($host, $key); ?>">
    </div>

    <div class="form-group">
        <label for="email_tujuan">Email Tujuan</label>
        <input type="email" name="email_tujuan" id="email_tujuan" readonly class="form-control" value="<?php echo $email_tujuan; ?>">
    </div>

    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" required class="form-control" placeholder="Tulis Subjek email">
    </div>

    <input type="hidden" name="key" value="<?php echo $key ?>">
    <input type="hidden" name="class_code" value="<?php echo $class_code ?>">

    <div class="form-group">
        <label for="pesan">Pesan</label>
        <textarea name="pesan" id="pesan" class="form-control" rows="6" placeholder="Tuliskan pesan disini......" required></textarea>
    </div>

    <button type="submit" name="kirim_email" class="btn btn-primary">Kirim</button>

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