<?php
    @include '../../../config/config.php';
    @include '../../students/Detailsiswa.php';

    $key = $_POST['key'];
    $id_join = $_POST['id_join'];
    $code_class = $_POST['code_class'];
    $pass_siswa_view = $_POST['pass_siswa'];

    $Detailsiswa = new Detailsiswa;
    $Detailsiswa_arr = $Detailsiswa->Detailsiswaa($host, $pass_siswa_view);

    foreach ($Detailsiswa_arr as $profil){
        $first_name = $profil['first_name'];
        $last_name = $profil['last_name'];
        $email = $profil['email'];
        $nohp = $profil['nohp_siswa'];
        $gambar = $profil['gambar'];

    }
?>

<form action="../../controller/teachers/Class_aksi_guru.php" method="post">

<div class="row">
    <div class="col-6 col-md-4 col-md-4">
        <div class="card text-center">
            <?php
                if($gambar != null){
            ?>
            
            <center><img class="rounded-circle" <?php echo "src='../assets/userprofil/".$gambar."'"?> alt="Card image cap" style="vertical-align: middle; width: 135px; margin-top:10px; height: 135px; border-radius: 50%; border:2px;"></center>
            
            <?php }else{ ?>
                <center><img class="rounded-circle" <?php echo "src='../assets/img/noimg.png'"?> alt="Card image cap" style="vertical-align: middle; width: 135px; margin-top:10px; height: 135px; border-radius: 50%; border:2px;"></center>

            <?php } ?>
            <div class="card-body">
                <?php
                    if($Detailsiswa->Statussiswa($host, $pass_siswa_view) == true){
                ?>
                    <span class="badge badge-success">online</span>
                <?php }else{ ?>
                    <span class="badge badge-danger">offline</span>
                <?php } ?>
                <h5 class="card-title mt-2">Daftar Kelas Diikuti</h5>
                <p class="text-center card-text">
                    <?php
                        $Datakls_arr = $Detailsiswa->Detailsiswajoinkls($host, $email);
                        $pjg = count($Datakls_arr);
                        $i=0;
                        foreach ($Datakls_arr as $Datakls){
                    ?>

                        <a href="javascript:void(0)">
                            <?php 
                                echo $Datakls['nama_kelas'];
                                if($i==$pjg-1){
                                    continue;
                                }else{
                                    echo " , ";
                                }
                            ?>                        

                    <?php $i++;} ?>
                    </a>
                </p>        
            </div>
        </div>
    </div>

    <?php echo"<input type='hidden' name='key' value='$key'>";?>
    <?php echo"<input type='hidden' name='code_class' value='$code_class'>";?>
    <?php echo"<input type='hidden' name='id_join' value='$id_join'>";?>
    <?php echo"<input type='hidden' name='email' value='$email'>";?>

    <div class="col-12 col-sm-6 col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Profil</h5><hr>

                <div class="row">
                    <div class="col">
                        <label for="firstname">Nama Depan</label>
                        <input type="text" name="first_name" id="firstname" value="<?php echo $first_name ?>" class="form-control" required>
                    </div>

                    <div class="col">
                        <label for="lastname">Nama Belakang</label>
                        <input type="text" name="last_name" id="lastname" value="<?php echo $last_name ?>" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="firstname">Email</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $email ?>" class="form-control" readonly style="background-color:aliceblue;">
                    </div>

                    <?php
                        if($nohp == null){
                    ?>
                    <div class="col">
                        <label for="lastname">Whatsapp Number</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo "belum melengkapi" ?>" class="form-control" readonly style="background-color:aliceblue;">
                    </div>
                    <?php }else{ ?>
                    <div class="col">
                        <label for="lastname">Whatsapp Number</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $nohp ?>" class="form-control" readonly style="background-color:aliceblue;">
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>

</div>
<hr>
<button type="submit" class="btn btn-primary" name="update_siswa">Update</button>


</form>