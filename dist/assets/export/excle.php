<?php
    @include '../../../config/config.php';
    @include '../../../controller/students/GradeQuiz.php';

    if(isset($_GET['id_quiz'])){
    
    $grade_quiz = new HasilQuiz;

    $id_quiz = $_GET['id_quiz'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>export</title>

    <style>
        body{
            font-family: sans-serif;
        }
        table{
            margin: 20px auto;
            border-collapse: collapse;
        }
        table th,
        table td{
            border: 1px solid #3c3c3c;
            padding: 3px 8px;
    
        }
        a{
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

</head>
<body>
        
    <?php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_nilai.xls");
    ?>

    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Nilai</th>
        </tr>

        <?php
            $tampil_siswa_arr = $grade_quiz->tampil_siswa_sudah_quiz($host, $id_quiz);

            foreach($tampil_siswa_arr as $tampil_siswa){
        ?>
        <tr>
            <td>
                <center>
                    <?php
                        $Tampil_nama_siswa = $grade_quiz->tampil_nama_siswa($host, $tampil_siswa['id_join']);
                        echo $Tampil_nama_siswa[0]." ".$Tampil_nama_siswa[1];
                    ?>
                </center>
            </td>
            <td>
                <center>
                    <?php

                        echo $tampil_siswa['nilai'];

                    ?>
                </center>
            </td>
        </tr>

        <?php } ?>

    </table>

</body>
</html>

<?php }else{

    echo "directoy access forhibidden";

} ?>