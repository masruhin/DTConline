<?php
@include '../../config/config.php';

class SiteHome
{

  public function Limit()
  {

    return 8; // banyaknya card yg ingin ditampilkan per page

  }

  public function JumlahKelas($host)
  {

    $sql = mysqli_query($host, "SELECT *FROM identitas_kelas");

    $count = mysqli_num_rows($sql);

    return $count;
  }

  public function ViewKelas($host, $page)
  {

    $limit = $this->Limit();
    $mulaiDari = ($page - 1) * $limit;

    $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN data_guru ON identitas_kelas.author = data_guru.email ORDER BY 
            nama_kelas ASC LIMIT $mulaiDari, $limit");

    while ($row = mysqli_fetch_array($sql)) {

      $rows[] = $row;
    }

    return $rows;
  }

  public function ViewClassSearch($host, $search)
  {

    $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN data_guru ON identitas_kelas.author = data_guru.email WHERE nama_kelas LIKE '$search%'");

    while ($row = mysqli_fetch_array($sql)) {

      $rows[] = $row;
    }

    return $rows;
  }

  public function CountViewClassSearch($host, $search)
  {

    $sql = mysqli_query($host, "SELECT *FROM identitas_kelas INNER JOIN data_guru ON identitas_kelas.author = data_guru.email WHERE nama_kelas LIKE '$search%'");

    return mysqli_num_rows($sql);
  }
}

$SiteHomes = new SiteHome;

if (isset($_GET['pageNumber'])) {

  $page = $_GET['pageNumber'];

  if ($SiteHomes->JumlahKelas($host) == 0) {
  } else {

    $Data = $SiteHomes->ViewKelas($host, $page);
  }
} else {

  $page = 1;

  if ($SiteHomes->JumlahKelas($host) == 0) {
  } else {

    $Data = $SiteHomes->ViewKelas($host, $page);
  }
}

$pagescount = ceil($SiteHomes->JumlahKelas($host) / $SiteHomes->Limit());

$next_page = ($page < $pagescount) ? $page + 1 : $pagescount; //next page
$prev_page = ($page > 1) ? $page -  1 : 1; //prev page

$start_number = ($page > $SiteHomes->Limit()) ? $page - $SiteHomes->Limit() : 1;
$end_number = ($page < ($pagescount - $SiteHomes->Limit())) ? $page + $SiteHomes->Limit() : $pagescount;

?>

<!-- Page Features -->
<div class="row text-center">

  <?php
  if ($SiteHomes->JumlahKelas($host) == 0) {

    echo " <br/><div class='text-center'><img src='dist/assets/img/notfound.png' style='width:50%; height:50%' alt=''></div>";
  } else {

  ?>
    <?php
    if (isset($_GET['keyword']) != NULL) {
      if ($SiteHomes->CountViewClassSearch($host, $_GET['keyword']) == 0) {

        echo "<br/><div class='text-center'><img src='dist/assets/img/notfound.png' style='width:50%; height:50%' alt=''></div>";
      } else {
        $Data_cari = $SiteHomes->ViewClassSearch($host, $_GET['keyword']);
        foreach ($Data_cari as $Result) :
    ?>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 ">
              <img class="card-img-top" src="data:image/jpeg;base64,<?= base64_encode($Result['tema']) ?>" alt="">
              <div class="card-body" id="carikelas">
                <h4 class="card-title"><?php echo $Result['nama_kelas']; ?></h4>
                <p class="card-text"><?php echo substr($Result['caption'], 0, 75) . "...."; ?></p>
              </div>
              <div class="card-footer">
                <a href="<?php echo "Join.php?id=$Result[id_kls]" ?>" class="btn btn-primary btn-sm">Join Course</a>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      <?php } ?>

    <?php } else { ?>

      <?php foreach ($Data as $Result) : ?>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-10 " style="border-radius: 50%; height: 200px;width: 200px; background-color: rgb(102, 204, 151); box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);">
            <img class="card-img-top mx-auto" src="data:image/jpeg;base64,<?= base64_encode($Result['tema']) ?>" alt="" style="height: 90x; width: 90px;">
            <div class="card-body" id="carikelas">
              <h4 class="card-title"><?php echo $Result['nama_kelas']; ?></h4>
              <a href="<?php echo "Join.php?id=$Result[id_kls]" ?>" class="btn btn-secondary active btn-xs btn-sm">Join Course</a>
            </div>
            <!-- <div class="card-footer">
              <a href="<?php echo "Join.php?id=$Result[id_kls]" ?>" class="btn btn-success btn-xs">Join Course</a>
            </div> -->
          </div>
        </div>
      <?php endforeach ?>
    <?php } ?>

  <?php } ?>

</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">

    <?php if ($page > 1) { ?>
      <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $SiteHomes->Limit();  ?>', '<?php echo $prev_page; ?>');">Previous</a></li>
    <?php } else { ?>
      <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $SiteHomes->Limit();  ?>', '<?php echo $prev_page; ?>');">Previous</a></li>
    <?php } ?>

    <?php
    for ($i = $start_number; $i <= $end_number; $i++) :
    ?>

      <?php if ($i == $page) { ?>
        <li class="page-item active">
          <a class="page-link" href="javascript:void(0)"><?php echo $i ?></a>
        </li>

      <?php } else { ?>

        <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $SiteHomes->Limit();  ?>', '<?php echo $i; ?>');"><?php echo $i; ?></a></li>

      <?php } ?>
    <?php endfor ?>

    <?php if ($page != $pagescount) { ?>
      <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $SiteHomes->Limit();  ?>', '<?php echo $next_page; ?>');">Next</a></li>
    <?php } else { ?>
      <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $SiteHomes->Limit();  ?>', '<?php echo $next_page; ?>');">Next</a></li>

    <?php } ?>
  </ul>

</nav>