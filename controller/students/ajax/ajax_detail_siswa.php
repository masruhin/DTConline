<?php
    @include '../../../config/config.php';
    @include '../Detailsiswa.php';

    $q = $_POST['q'];
    $pass_siswa_view = $_POST['pass_siswa_view'] ;

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

<div class="row">
    <div class="col-6 col-md-4 col-md-4">
        <div class="card text-center">
            <?php
                if($gambar != null){
            ?>
            
            <center><img class="rounded-circle" <?php echo "src='../assets/img/".$gambar."'"?> alt="Card image cap" style="vertical-align: middle; width: 135px; margin-top:10px; height: 135px; border-radius: 50%; border:2px;"></center>
            
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

    <div class="col-12 col-sm-6 col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Detail Profil</h5><hr>

                <div class="row">
                    <div class="col">
                        <label for="firstname">Nama Depan</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $first_name ?>" class="form-control" readonly style="background-color:aliceblue;">
                    </div>

                    <div class="col">
                        <label for="lastname">Nama Belakang</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $last_name ?>" class="form-control" readonly style="background-color:aliceblue;">
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
<button type="button" class="btn btn-secondary" data-dismiss="modal" style="float:right;">Close</button>