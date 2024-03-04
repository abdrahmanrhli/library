<?php

    $con = mysqli_connect('localhost','root','','books');

        if(mysqli_connect_errno()){
            echo 'not conecting';
        }
?>