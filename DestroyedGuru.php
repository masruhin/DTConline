<?php
    include './config/config.php';
    session_start();
    
    $session_guru = $_SESSION['key'];

    $sql = mysqli_query($host, "DELETE FROM sessionguru WHERE SessionId='$session_guru'");

    $_SESSION['key'] = '';
    unset($_SESSION['key']);
    session_unset();
    session_destroy();

    header("location:login.php");
?>