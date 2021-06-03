<?php
@include '../../../config/config.php';
@include '../dataSiswa.php';

$EditSiswa = new dataSiswa;

$id = $_POST['id'];

$ViewEdit = $EditSiswa->ViewDataEditAndDelete($host, $id);

foreach ($ViewEdit as $view) :
?>

    <form action="./php/dataSiswa.php" method="post">

        <div class="row">
            <div class="col-6 col-md-4 col-md-4">
                <div class="card text-center">
                    <?php
                    if ($view['gambar'] != null) {
                    ?>

                        <center><img class="rounded-circle" <?php echo "src='../dist/assets/userprofil/" . $view['gambar'] . "'" ?> alt="Card image cap" style="vertical-align: middle; width: 135px; margin-top:10px; height: 135px; border-radius: 50%; border:2px;"></center>

                    <?php } else { ?>
                        <center><img class="rounded-circle" <?php echo "src='../dist/assets/img/noimg.png'" ?> alt="Card image cap" style="vertical-align: middle; width: 135px; margin-top:10px; height: 135px; border-radius: 50%; border:2px;"></center>

                    <?php } ?>
                    <div class="card-body">
                        <?php
                        if ($EditSiswa->OnlineChek($host, $view['email']) == 0) {
                        ?>
                            <span class="badge badge-danger">offline</span>
                        <?php } else { ?>
                            <span class="badge badge-success">online</span>
                        <?php } ?>
                        <br>
                        <center>
                            <h5 class="mt-2">Course Yang Diikuti</h5>
                        </center>
                        <p class="text-center card-text">
                            <?php
                            if ($EditSiswa->CekJumlahJoinKelas($host, $view['email']) == 0) {
                            } else {

                                $Datakls_arr = $EditSiswa->ShowKelasJoin($host, $view['email']);
                                $pjg = count($Datakls_arr);
                                $i = 0;
                                foreach ($Datakls_arr as $Datakls) {
                            ?>

                                    <a href="javascript:void(0)">
                                        <?php
                                        echo $Datakls['nama_kelas'];
                                        if ($i == $pjg - 1) {
                                            continue;
                                        } else {
                                            echo " , ";
                                        }
                                        ?>

                                <?php $i++;
                                }
                            } ?>
                                    </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Profil</h5><br>
                        <hr>

                        <div class="row">
                            <div class="col">
                                <label for="firstname">Nama Depan</label>
                                <input type="text" name="first_name" id="firstname" value="<?php echo $view['first_name'] ?>" class="form-control" required>
                            </div>

                            <div class="col">
                                <label for="lastname">Nama Belakang</label>
                                <input type="text" name="last_name" id="lastname" value="<?php echo $view['last_name'] ?>" class="form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <label for="firstname">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo $view['email'] ?>" class="form-control" readonly style="background-color:aliceblue;">
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <?php
                            if ($view['nohp_siswa'] == null) {
                            ?>
                                <div class="col">
                                    <label for="lastname">Whatsapp Number</label>
                                    <input type="text" name="nohp" id="nohp" placeholder="Belum melengkapi" class="form-control">
                                </div>
                            <?php } else { ?>
                                <div class="col">
                                    <label for="lastname">Whatsapp Number</label>
                                    <input type="text" name="nohp" id="nohp" value="<?php echo $view['nohp_siswa'] ?>" class="form-control">
                                </div>
                            <?php } ?>
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="password">Password Baru <sup style="color: red;">Kosongkan Jika Tidak Perlu diubah</sup></label>
                            <input type="text" name="password" class="form-control" placeholder="Tuliskan Password Baru">
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr>
        <button type="submit" class="btn btn-primary" name="update">Update</button>

    </form>

<?php endforeach ?>