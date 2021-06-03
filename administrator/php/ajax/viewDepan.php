<?php
    @include '../../../config/config.php';
    @include '../setApp.php';
    $id = $_POST['id'];

    $ViewLayoutEdit = new setApp;

    $DataArr = $ViewLayoutEdit->ViewLayoutDepanForEdit($host, $id);
    foreach($DataArr as $data){
?>

<form action="./php/setApp.php" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="nama_app">Judul</label>
    <input type="text" name="judul" id="judul" class="form-control" required value="<?php echo $data['judul'] ?>">
</div>

<input type="hidden" name="id" value="<?php echo $id ?>">

<div class="form-group">
    <label for="subjudul">Sub Judul</label>
    <textarea name="subjudul" id="subjudul" required cols="2" rows="2" class="form-control"><?php echo $data['subjudul'] ?></textarea>
</div>

<div class="row mt-3">
<div class="col">
    <label for="customfile">Gambar Layout Depan</label>
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="customFile" name="gambar" required>
      <label class="custom-file-label" for="customFile">Choose file</label>
    </div>          
    <p class="mt-2">Gambar Sekarang : <a href="<?php echo '../dist/assets/breadcrumb/'.$data['gambar'] ?>"><?php echo $data['gambar'] ?></a></p>
</div>

</div>

<button type="submit" class="btn btn-primary" name="breadcrumb">Update</button>
</form>
<?php } ?>
<script>
    bsCustomFileInput.init();
</script>