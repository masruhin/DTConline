<?php
    @include '../Class.php';
    @include '../../../config/config.php';

    $View = new model_view;
    $total = $View->totalviewfile($host, $_POST['id_file']);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<table id="views" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Terakhir Dilihat</th>
            <th>Total Dilihat</th>
        </tr>
    </thead>
    <tbody>
    <?php if($total > 0): ?>
    <?php $data_arr = $View->getviewfile($host, $_POST['id_file']); ?>
    <?php $i=1; foreach ($data_arr as $x): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $x['nama']; ?></td>
            <td><?php echo $x['tanggal']; ?></td>
            <td><?php echo $x['dilihat'] ?></td>
        </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#views').DataTable({
        responsive: true
    });
});
</script>