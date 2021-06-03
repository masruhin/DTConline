<?php
@include '../../config/config.php';

class Paging
{

    public function Limit()
    {

        return 3;
    }

    public function get_email($host, $q)
    {

        $sql = mysqli_query($host, "SELECT email FROM data_siswa WHERE password='$q'");

        while ($row = mysqli_fetch_array($sql)) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function cek_jmlh_kls_join($host, $q)
    {

        $email_arr = $this->get_email($host, $q);

        foreach ($email_arr as $arr_email) {

            $email_siswa = $arr_email['email'];
        }

        $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls WHERE email_siswa = '$email_siswa'");
        $count = mysqli_num_rows($sql);

        return $count;
    }

    public function view_class_join($host, $q, $page)
    {

        $email_arr = $this->get_email($host, $q);

        $limit = $this->Limit();
        $mulaiDari = ($page - 1) * $limit;

        foreach ($email_arr as $arr_email) {

            $email_siswa = $arr_email['email'];
        }

        $sql = mysqli_query($host, "SELECT *FROM tb_siswa_join_kls INNER JOIN identitas_kelas ON tb_siswa_join_kls.kd_kls=identitas_kelas.kode_kelas WHERE email_siswa='$email_siswa' ORDER BY nama_kelas ASC LIMIT $mulaiDari, $limit");

        while ($row = mysqli_fetch_array($sql)) {

            $rows[] = $row;
        }

        return $rows;
    }
}

$Pangings = new Paging;

$q = $_GET['q'];

if (isset($_GET['pageNumber'])) {

    $page = $_GET['pageNumber'];

    if ($Pangings->cek_jmlh_kls_join($host, $q) == 0) {
    } else {

        $Data = $Pangings->view_class_join($host, $q, $page);
    }
} else {

    $page = 1;

    if ($Pangings->cek_jmlh_kls_join($host, $q) == 0) {
    } else {

        $Data = $Pangings->view_class_join($host, $q, $page);
    }
}

$pagescount = ceil($Pangings->cek_jmlh_kls_join($host, $q) / $Pangings->Limit());

$next_page = ($page < $pagescount) ? $page + 1 : $pagescount; //next page
$prev_page = ($page > 1) ? $page -  1 : 1; //prev page

$start_number = ($page > $Pangings->Limit()) ? $page - $Pangings->Limit() : 1;
$end_number = ($page < ($pagescount - $Pangings->Limit())) ? $page + $Pangings->Limit() : $pagescount;


?>


<?php
if ($Pangings->cek_jmlh_kls_join($host, $q) == 0) {

    echo "<center> Anda Belum Join Course, Silahkan Join Course Dahulu</center>";
} else {

?>
    <div class="card-columns">
        <?php foreach ($Data as $class_show) : $class_code = $class_show['kode_kelas']; ?>

            <div class="card mb-4">
                <img class="card-img-top" src="data:image/jpeg;base64,<?= base64_encode($class_show['tema']) ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $class_show['nama_kelas'] ?></h5>
                </div>

                <div class="card-footer">
                    <?php echo "<a href='class.php?class_code=$class_code' class='card-link'>Masuk Course</a>"; ?>
                    <?php echo "<a href='#leave_class' data-toggle='modal' data-nama_kls='$class_show[nama_kelas]' data-q='$q' data-id_join='$class_show[id_join]' class='card-link text-warning'>Leave</a>"; ?>
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