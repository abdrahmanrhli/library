<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("location: sign in.php");
        exit();
    }
?>