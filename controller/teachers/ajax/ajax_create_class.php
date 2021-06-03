<?php
include '../../../config/config.php';
include '../Dashboard.php';

$key = $_POST['key'];

$My_name = array();
$My_name = main("Nama", $key, $host);
?>

<form action="../../controller/teachers/Dashboard.php" method="POST">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name_class">Nama Course</label>
            <input type="text" class="form-control" id="name_class" placeholder="Input name class" required name="nama_class">
        </div>
        <div class="form-group col-md-6">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" readonly placeholder="Author" required name="author" value="<?php echo $My_name[1] . " " . $My_name[0]; ?>">
        </div>
    </div>

    <?php echo "<input type='hidden' name='key' value='$key'>"; ?>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="class_kode">Kode Course</label>
            <input type="text" class="form-control" id="class_kode" placeholder="Input code class" name="class_code" required>
        </div>

        <!-- <div class="col">
            <label for="customfile">Profil</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="theme">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div> -->

        <div class="form-group col-md-6">
            <label for="theme">Pilih Tema</label>
            <select name="theme" class="form-control" id="theme" required>
                <option value="">Choose your background Course</option>
                <option value="1">I.O Criteria</option>
                <option value="2">CGIS</option>
                <option value="3">CS1 Guidline</option>
                <option value="4">Push & Pull</option>
                <option value="4">Part Khusus</option>
                <option value="4">Mechanical Line</option>
                <option value="4">Penggeleman</option>
                <option value="4">Pengencangan</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="caption">Caption class <sup style="color: red;">Manfaatkan caption kelas sebagai papan pengumuman kelas anda</sup></label>
        <textarea class="form-control" name="caption" id="caption" rows="3" required placeholder="Input your class caption"></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="create_class">Create</button>
</form>

<script>
    CKEDITOR.replace("caption");

    //ckeditor field required
    $('form').submit(function(e) {
        var messageLength = CKEDITOR.instances['caption'].getData().replace(/<[^>]*>/gi, '').length;
        if (!messageLength) {
            alert('The caption field is required');
            e.preventDefault();
        }
    });
</script>