<?php
    @include '../../../config/config.php';
    @include '../../students/Dashboard_siswa.php';

    $Objk_view_Edit = new view;

    $q = $_POST['q'];
    $Arr_obj_Datasiswa = $Objk_view_Edit->tampilkanIdentitasSiswa($host, $q);

    foreach ($Arr_obj_Datasiswa as $Datasiswa){
?>

<form action="../../controller/students/Dashboard_siswa.php" method="post" enctype="multipart/form-data">

<div class="alert alert-primary" role="alert">
  Setelah update profil, mohon untuk kembali login.
</div>

<div class="row">
    
    <div class="col">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" id="firstname" class="form-control" required value="<?php echo $Datasiswa['first_name'] ?>">
    </div>

    <div class="col">
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" id="lastname" required class="form-control" value="<?php echo $Datasiswa['last_name'] ?>">
    </div>

</div>
<br>
<div class="row">

    <div class="col">
        <label for="email">email</label>
        <input type="email" name="email" id="email" required class="form-control" value="<?php echo $Datasiswa['email'] ?>">
    </div>

    <input type="hidden" name="id" value="<?php echo $Datasiswa['id']; ?>">
    <input type="hidden" name="q" value="<?php echo $q ?>">

    <div class="col">
        <label for="password">Password baru <sup style="color: red;">Kosongkan saja jika tidak perlu diubah</sup></label>
        <input type="text" name="password" id="password" class="form-control" placeholder="Masukkan password baru anda disini">
    </div>

</div>

<br>

<div class="row">

<div class="col">
    <label for="nohp">Whatsapp number <sup style="color: red;">Notifikasi from whatsapp</sup></label>
    <input type="number" name="nohp" id="nohp" class="form-control" required placeholder="0815537xxxxxx" value="<?php echo $Datasiswa['nohp_siswa'] ?>">
</div>

<div class="col">
    <label for="gambar">Picture <sup style="color: red;">Allowed type is png, jpg</sup></label>
    <input type="file" name="gambar" id="inputFile">
</div>

</div>
    <img src="../assets/img/noimg.png" id="imgView" class="avatar" style="vertical-align: middle; width: 135px; margin-top:10px; height: 135px; border-radius: 50%; border:2px;">
<br><hr>

    <button type="submit" class="btn btn-primary" name="update_profile">Update</button>
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