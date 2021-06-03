<?php
@include '../../../config/config.php';
@include '../Dashboard.php';

$key = $_POST['key'];
$kode_kelas = $_POST['kode_kelas'];

//get author
$My_name = array();
$My_name = main("Nama", $key, $host);

//view editor
$object_ajax_class = new ajax_edit_class;

$show_class = $object_ajax_class->show_kelas($host, $key, $kode_kelas);

foreach ($show_class as $rows) {
?>

    <form action="../../controller/teachers/Dashboard.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name_class">Nama Course</label>
                <input type="text" class="form-control" id="name_class" placeholder="Input name class" required name="nama_class" value="<?php echo $rows['nama_kelas']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" readonly placeholder="author" required name="author" value="<?php echo $My_name[1] . " " . $My_name[0]; ?>">
            </div>
        </div>

        <?php echo "<input type='hidden' name='key' value='$key'>"; ?>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="class_kode">Kode Course</label>
                <input type="text" class="form-control" id="class_kode" readonly placeholder="Input code class" name="class_code" required value="<?php echo $rows['kode_kelas']; ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="theme">Course Theme Picture</label>
                <?php $theme_code = $rows['id_tema']; ?>
                <select name="theme" class="form-control" id="theme" required>
                    <option value="">Choose your background class</option>
                    <option <?php echo ($theme_code == "1") ? "selected" : "" ?> value="1">I.O Criteria</option>
                    <option <?php echo ($theme_code == "2") ? "selected" : "" ?> value="2">CGIS</option>
                    <option <?php echo ($theme_code == "3") ? "selected" : "" ?> value="3">CS1 Guidline</option>
                    <option <?php echo ($theme_code == "4") ? "selected" : "" ?> value="4">Push & Pull</option>
                    <option <?php echo ($theme_code == "5") ? "selected" : "" ?> value="5">Part Khusus</option>
                    <option <?php echo ($theme_code == "6") ? "selected" : "" ?> value="6">Mechanical Line</option>
                    <option <?php echo ($theme_code == "7") ? "selected" : "" ?> value="7">Penggeleman</option>
                    <option <?php echo ($theme_code == "8") ? "selected" : "" ?> value="8">Pengencangan</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="caption">Caption class <sup style="color: red;">Manfaatkan caption kelas sebagai papan pengumuman kelas anda</sup></label>
            <textarea class="form-control" name="caption" id="caption_edit" rows="3" required placeholder="Input your class caption"><?php echo $rows['caption']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="edit_class">Update</button>
        <button type="submit" class="btn btn-danger" name="delete_class">Delete</button>
    </form>

<?php } ?>

<script>
    CKEDITOR.replace("caption_edit");

    //ckeditor field required
    $('form').submit(function(e) {
        var messageLength = CKEDITOR.instances['caption'].getData().replace(/<[^>]*>/gi, '').length;
        if (!messageLength) {
            alert('The caption field is required');
            e.preventDefault();
        }
    });
</script>