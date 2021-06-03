<?php
    @include '../../../config/config.php';
    @include '../../teachers/Dashboard.php';

    $key = $_POST['key'];

    $Objek_edit_guru = new statistic;

    $Data_guru_arr = $Objek_edit_guru->ViewProfile($host, $key);

    foreach ($Data_guru_arr as $Data_guru){
?>
<form action="../../controller/teachers/Dashboard.php" method="post" enctype="multipart/form-data">
<div class="alert alert-primary" role="alert">
  Setelah update profil, mohon untuk kembali login.
</div>

<div class="row">

    <div class="col">
        <label for="first_name">first name</label>
        <input type="text" name="first_name" id="first_name" required class="form-control" value="<?php echo $Data_guru['first_name'] ?>">
    </div>

    <div class="col">    
        <label for="last_name">last name</label>
        <input type="text" name="last_name" id="last_name" required class="form-control" value="<?php echo $Data_guru['last_name'] ?>">
    </div>

</div>

<br>

<div class="row">

    <div class="col">
        <label for="email">email</label>
        <input type="email" name="email" id="email" required class="form-control" value="<?php echo $Data_guru['email'] ?>">
    </div>

    <input type="hidden" name="id" value="<?php echo $Data_guru['id'] ?>">
    <input type="hidden" name="key" value="<?php echo $key ?>">


    <div class="col">
        <label for="password">password new <sup style="color: red;">kosongkan jika tidak perlu</sup></label>
        <input type="text" name="password" id="password" class="form-control" placeholder="massukkan password baru anda disini">
    </div>

</div>

<br>

<div class="row">

<div class="col">
    <label for="nohp">Whatsapp number <sup style="color: red;">Notifikasi from whatsapp</sup></label>
    <input type="number" name="nohp" id="nohp" class="form-control" required placeholder="0815537xxxxxx" value="<?php echo $Data_guru['nohp_guru'] ?>">
</div>

<div class="col">
    <label for="gambar">Picture <sup style="color: red;">Allowed type is png, jpg</sup></label>
    <input type="file" name="gambar" id="inputFile">
</div>

</div>

<img src="../assets/img/noimg.png" id="imgView" class="avatar" style="vertical-align: middle; width: 135px; margin-top:10px; height: 135px; border-radius: 50%; border:2px;">
<br><hr>

<button type="submit" class="btn btn-primary" name="update_profile">update</button>
</form>

<script>
    $("#inputFile").change(function(event) {  
      fadeInAdd();
      getURL(this);    
    });

    $("#inputFile").on('click',function(event){
      fadeInAdd();
    });

    function getURL(input) {    
      if (input.files && input.files[0]) {   
        var reader = new FileReader();
        var filename = $("#inputFile").val();
        filename = filename.substring(filename.lastIndexOf('\\')+1);
        reader.onload = function(e) {
          debugger;      
          $('#imgView').attr('src', e.target.result);
          $('#imgView').hide();
          $('#imgView').fadeIn(500);             
        }
        reader.readAsDataURL(input.files[0]);    
      }
    }

    function fadeInAdd(){
      fadeInAlert();  
    }
    function fadeInAlert(text){
      $(".alert").text(text).addClass("loadAnimate");  
    }
  </script>

<?php } ?>