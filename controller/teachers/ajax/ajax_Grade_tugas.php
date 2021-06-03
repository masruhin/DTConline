<?php
    @include '../../../config/config.php';
    @include '../../teachers/Grade_tugas.php';
    
    $key = $_POST['key'];
    $code_class = $_POST['code_class'];
    $id_join = $_POST['id_join'];
    $id_sesi = $_POST['id_sesi'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $Detail_grade = new pengumpulan_tugas;
    
?>
 <h6 class="mb-3">File by : <span class="badge badge-primary"><?php echo $first_name." ".$last_name ; ?></span></h6>
<table class="table table-responsive">
  <thead>
    <tr>
      <th scope="col" style="font-weight:normal;">File terlampir</th>
      <th scope="col" style="font-weight:normal;">Tgl kumpul</th>
      <th scope="col" style="font-weight:normal;">Waktu kumpul</th>
      <th scope="col" style="font-weight:normal;">Sisa waktu</th>
      <th scope="col" style="font-weight:normal;">Status</th>
    </tr>
  </thead>
  <tbody>
      <?php
            $detail_grade = $Detail_grade->Tb_pengumpulan_tugasDetail($host, $id_join, $id_sesi);
            foreach($detail_grade as $grade_detail){
                $nilai = $grade_detail['nilai'];
      ?>
    <tr>
        <td><?php echo "<a href='../assets/file_tugas/".$grade_detail['nama_file']."' target='_blank' rel='noopener noreferrer'>$grade_detail[nama_file]</a>";?></td>
        <td><span class="badge badge-pill badge-primary"><?php echo $grade_detail['tgl_kumpul'] ?></span></td>
        <td><span class="badge badge-pill badge-primary"><?php echo $grade_detail['waktu_kumpul'] ?></span></center></td>
        <td><span class="badge badge-pill badge-secondary"><?php echo $grade_detail['time_remaining'] ?></span></center></td>
        <td>
            <?php
                if($grade_detail['status_kumpul'] == "success"){
                    echo "<span class='badge badge-pill badge-success'>Tepat waktu</span>";
                }else if($grade_detail['status_kumpul'] == "failed"){
                    echo "<span class='badge badge-pill badge-danger'>Terlambat</span>";
                }
            ?>
        </td>
    </tr>
    <?php
        }
    ?>
  </tbody>
</table>

<hr>

<form action="../../controller/teachers/Grade_tugas.php" method="post" id="grade">
    <div class="form-group">
        <label for="grade_siswa">Nilai <span style="color: red;">*</span></label>
        <input type="number" name="grade_siswa" id="grade_siswa" max="100" min="0" maxlength="3" class="form-control" required value="<?php echo $nilai ?>">
    </div>
    
    <?php echo "<input type='hidden' name='key' value='$key'>";?>
    <?php echo "<input type='hidden' name='class_code' value='$code_class'>";?>
    <?php echo "<input type='hidden' name='id_sesi' value='$id_sesi'>";?>
    <?php echo "<input type='hidden' name='id_join' value='$id_join'>";?>


    <button type="submit" class="btn btn-primary" name="grade">Grade</button>
</form>
