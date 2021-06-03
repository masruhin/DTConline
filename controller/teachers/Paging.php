<?php
@include '../../config/config.php';

class Paging
{

    public function Limit()
    {

        return 6;
    }

    public function JumlahKelas($host, $key)
    {

        $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author = '$key'");

        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function ViewKelas($host, $page, $key)
    {

        $limit = $this->Limit();
        $mulaiDari = ($page - 1) * $limit;

        $sql = mysqli_query($host, "SELECT *FROM identitas_kelas WHERE author='$key' ORDER BY nama_kelas ASC LIMIT $mulaiDari, $limit");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }
}

$Pangings = new Paging;

$key = $_GET['key'];
$realKey = $_GET['realkey'];

if (isset($_GET['pageNumber'])) {

    $page = $_GET['pageNumber'];

    if ($Pangings->JumlahKelas($host, $key) == 0) {
    } else {

        $Data = $Pangings->ViewKelas($host, $page, $key);
    }
} else {

    $page = 1;

    if ($Pangings->JumlahKelas($host, $key) == 0) {
    } else {

        $Data = $Pangings->ViewKelas($host, $page, $key);
    }
}

$pagescount = ceil($Pangings->JumlahKelas($host, $key) / $Pangings->Limit());

$next_page = ($page < $pagescount) ? $page + 1 : $pagescount; //next page
$prev_page = ($page > 1) ? $page -  1 : 1; //prev page

$start_number = ($page > $Pangings->Limit()) ? $page - $Pangings->Limit() : 1;
$end_number = ($page < ($pagescount - $Pangings->Limit())) ? $page + $Pangings->Limit() : $pagescount;

?>


<?php
if ($Pangings->JumlahKelas($host, $key) == 0) {

    echo "Belum ada kelas yang dibuat";
} else {

?>

    <div class="card-columns">
        <?php foreach ($Data as $row) : ?>

            <div class="card mb-4">
                <img class="card-img-top" src="data:image/jpeg;base64,<?= base64_encode($row['tema']) ?>" alt="Card image cap" width="100px">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nama_kelas']; ?></h5>
                    <p class="card-text">Kode Course : <span class="badge badge-primary"><?php echo $row['kode_kelas'] ?></span></p>
                </div>
                <div class="card-footer">
                    <?php echo "<a href='class.php?class_code=$row[kode_kelas]' class='card-link'>Masuk Course</a>"; ?>
                    <?php echo "<a href='#edit_class' data-toggle='modal' data-code='$row[kode_kelas]' class='card-link text-warning'>Edit class</a>"; ?>
                </div>
            </div>

        <?php endforeach ?>
    <?php } ?>
    </div>



    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">

            <?php if ($page > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $Pangings->Limit();  ?>', '<?php echo $prev_page; ?>');">Previous</a></li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $Pangings->Limit();  ?>', '<?php echo $prev_page; ?>');">Previous</a></li>
            <?php } ?>

            <?php
            for ($i = $start_number; $i <= $end_number; $i++) :
            ?>

                <?php if ($i == $page) { ?>

                    <li class="page-item active">
                        <a class="page-link" href="javascript:void(0)"><?php echo $i ?></a>
                    </li>

                <?php } else { ?>

                    <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $Pangings->Limit();  ?>', '<?php echo $i; ?>');"><?php echo $i; ?></a></li>

                <?php } ?>
            <?php endfor ?>

            <?php if ($page != $pagescount) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $Pangings->Limit();  ?>', '<?php echo $next_page; ?>');">Next</a></li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" onclick="showRecords('<?php echo $Pangings->Limit();  ?>', '<?php echo $next_page; ?>');">Next</a></li>

            <?php } ?>
        </ul>

    </nav>