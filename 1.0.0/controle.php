<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Controle</title>
    <style>
        *{
        margin: 0px;
        padding: 0px;
        font-family: Arial, Helvetica, sans-serif;
        }
        header{
        background-image: url(images/controle.png);
        height: 100vh;
        background-size: cover;
        background-position: center;
        }
        .admin{
            float: right;
            margin-top: 25%;
            margin-right: 18%;
        }
        .books{     
            width: 160px;
            height: 40px;
            background-color: #ff6456;
            border-radius: 35px;
        }
        .img1{
            width: 35px;
            height: 35px;
            float: left;
            margin-top: 3px;
            margin-left: 18px;
        }
        .title1{
            color: aliceblue;
            float: right;
            margin-top: 10px;
            margin-right: 25px;
            font-size: 18px;
            text-decoration: none;
        }
        .books:hover,.contact:hover{
            background-color:#FF4A56;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }
        .contact{
            margin-top: 70px;
            width: 160px;
            height: 40px;
            background-color: #ff6456;
            border-radius: 35px;
        }
        .img2{
            width: 30px;
            height: 30px;
            float: left;
            margin-top: 5px;
            margin-left: 20px;
        }
        .title2{
            color: aliceblue;
            float: right;
            margin-top: 10px;
            margin-right: 35px;
            font-size: 18px;
            text-decoration: none;
        }
        .btn-out{
            float: right;
            position: relative;
            top: 10px;
            right: 30px;
        }
        .btn-out{
            background: none;
            color: #ff6456;
            font-size: 20px;
            border: 2px solid #ff6456;
            border-radius: 50px;
            padding: 5px 20px;
            text-decoration: none;
            transition: 0.6s ease;
        }
        .btn-out:hover{
            background: linear-gradient(45deg,#ff6456,#F4347B);
            color: #fff;
            border: 2px solid #ff6456;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
        }
        .a{
            float: right;
            position: relative;
            top: -600px;
            right: 330px;    
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 60px;
            background: -webkit-linear-gradient(45deg,#ff6456,#F4347B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .c{
            display: flex;
            align-items: center;
            justify-content: center;
            
        }
    </style>
</head>
<body>
    <header>
        <form method="POST">
            <div class="div-btn">
                <input type="submit" name="sign-out" value="sign out" class="btn-out">
            </div>
        </form>
        <div class="admin">
            <div class="books">
                <a href="addbook.php"><img src="icon/book1-icon.png" class="img1"></a>
                <a href="addbook.php" class="title1">Add Book</a>
            </div>
            <div class="contact">
                <a href="admin-contact.php"><img src="icon/call-1.png" class="img2"></a>
                <a href="admin-contact.php" class="title2">Contact</a>
            </div>
        </div>
    </header>
</body>
</html>
<?php
    require 'auth-admin.php';

    echo    '<div class="welcome">' . 
                '<div class="a">' .
                    '<div class="b">' . 
                        'Welcome' . '<br/>' . 
                    '</div>' .
                    '<p class="c">' .
                        $_SESSION['username'] .
                    '</p>' . 
                '</div>' .              
            '</div>';
        
            if(isset($_POST['sign-out'])){
                unset($_SESSION['username']);
                header("location: admin.php");
                exit();
            }
?>