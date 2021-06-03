<?php
    @include '../../../config/config.php';
    @include '../Pesan.php';

    $q = $_POST['q'];
    $class_code = $_POST['class_code'];
    $email_tujuan = $_POST['emailtujuan'];

    $Pesan = new Pesan;
?>

<form action="../../controller/students/Pesan.php" method="post">
    <div class="form-group">
        <label for="emailfrom">Email Pengirim</label>
        <input type="email" name="emailpengirim" id="emailpengirim" class="form-control" readonly value="<?php echo $Pesan->Getemailpengirim($host, $q); ?>">
    </div>

    <div class="form-group">
        <label for="emailto">Email Tujuan</label>
        <input type="email" name="emailtujuan" id="emailtujuan" class="form-control" readonly value="<?php echo $email_tujuan ?>">
    </div>

    <div class="form-group">
        <label for="subjek">Subjek</label>
        <input type="text" name="subject" id="subjek" class="form-control" required placeholder="Tuliskan subjek email.......">
    </div>

    <input type="hidden" name="q" value="<?php echo $q ?>">
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