<?php

    $con = mysqli_connect('localhost','root','','book');

        if(mysqli_connect_errno()){
            echo 'not conecting';
        }
?>