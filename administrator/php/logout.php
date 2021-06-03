<?php
    @include '../../config/config.php';

    session_start();

    $seession_admin = $_SESSION['admin'];

    $sql = mysqli_query($host, "UPDATE admin SET session=null where id=1");

    $_SESSION['admin'] = '';
    unset($_SESSION['admin']);
    session_unset();
    session_destroy();

    header("location:../../index.php");

?>