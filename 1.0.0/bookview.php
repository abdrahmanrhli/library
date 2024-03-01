<?php

        if(isset($_GET['id'])){

            require 'config.php';
            $nomid         =     mysqli_real_escape_string($con, $_GET['id']);
            $sql           =     "SELECT * FROM addBooks WHERE id='$nomid' ";
            $result        =     mysqli_query($con,$sql);
            $row           =     mysqli_fetch_array($result);
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['titlebook'] ?></title>
    <style>
        *{
        margin: 0px;
        padding: 0px;
        font-family: Arial, Helvetica, sans-serif;
        }
        .backg1{
            background: linear-gradient(45deg,#ff6456,#F4347B);
            height: 50px;
            width: 90%;
            margin: 0px auto;
            border-radius: 0px 0px 80px 80px;
        }
        .logo-div{
            text-align: center;
        }
        .logo{
            margin: -20px;
            width: 80px;
            position: relative;  
        }
        .backg2{
            background: linear-gradient(45deg,#ff6456,#F4347B);
            height: 30px;
            width: 40%;
            margin: 0px auto;
            border-radius: 0px 0px 80px 80px;
        }
        ul{
            text-align: center;
            list-style-type: none;
            padding: 6px;
        }
        ul li{
            display: inline-block;
        }
        ul li a{
            text-decoration: none;
            color: #fff;
            padding: 0px 30px;
            transition: 0.6s ease;
        }
        ul li a:hover{
            color: #000;
        }
        .view-div{ 
            position: relative;
            background: linear-gradient(45deg,#ff6456,#F4347B);
            margin: 25px auto 15px;
            width: 90%;
            height: 600px;
            border-radius: 10px;
        }
        .view-text{
            position: relative;
            float: left;
            margin: 80px auto 100px 150px;
            width: 500px;
            height: 400px;
            white-space: normal;
            display: block;
        }
        .p-title{
            margin: auto auto 100px;
            color: #FFFFFF;
            padding-left: 10px;
            border-left: 5px solid #FFFFFF;
        }
        .view-down{
            width: 30px;
            padding: 10px 10px;
        }
        .view-down:hover{
            background-color: #28b472;
            
            border-radius: 50%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
                         0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        #id-title{
            font-weight: bold;
            font-size: 2rem;
        }
        #id-text{
            font-weight: 200;
            font-size: 1rem;
        }
        .view-img{
            position: relative;
            border: 5px solid #ffffff;
            border-radius: 10px;
            float: right;
            width: 440px;
            margin-top: 20px;
            margin-right: 240px;
            box-shadow: 0 7px 50px 0 rgba(0, 0, 0, 0.2),
                     0 9px 100px 0 rgba(0, 0, 0, 0.19);
        }
        </style>
</head>
<body>
<header>
        <div class="backg1">
            <div class="logo-div">
                <a href="index.html"><img class="logo" src="images/logo 2.png"></a>
            </div>
        </div>
        <div class="backg2">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="book.php">Books</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
</header>
<div>
    <div class='view-div'>
        <div class="view-text">
            <p class="p-title" id="id-title"><?php echo $row['titlebook'] ?></p>
            <p class="p-title" id="id-text"><?php echo $row['textbook'] ?></p>
            <a href="<?php echo $row['linkbook'] ?>" target="_blank">
                       <img src="icon/view-1.png" class="view-down"/></a>
        </div>
        <div>
            <img src="upload/<?php echo $row['photobook'] ?>" class="view-img"/>
        </div>
    </div>
</div>
</body>
</html>