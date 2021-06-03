<?php
    $server = "localhost";
    $db_name = "elerning";
    $username = "root";
    $password = null;

    $host = mysqli_connect($server, $username, $password, $db_name);

    if(mysqli_connect_errno()){
        echo "koneksi ke database gagal";
    }


?>