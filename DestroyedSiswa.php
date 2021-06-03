<?php
    include './config/config.php';
    session_start();
    
    $session_siswa = $_SESSION['q'];

    $sql = mysqli_query($host, "DELETE FROM sessionsiswa WHERE SessionId='$session_siswa'");

    $_SESSION['q'] = '';
    unset($_SESSION['q']);
    session_unset();
    session_destroy();

    header("location:login.php");
?>