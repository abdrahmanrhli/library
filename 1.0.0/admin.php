<!DOCTYPE html>
<html>
<head>
    <title>Admine</title>
    <meta charset="UTF-8">
    <style>
    *{
        margin: 0px;
        padding: 0px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .background{
        background-image: url(images/f.png);
        height: 100vh;
        background-size: cover;
        background-position: center;
    }
    .background-sign-up{
        float: left;
        margin-top: 180px;
        margin-left: 615px;
    }
    form{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .input-div{
        max-width: 380px;
        width: 85%;
        height: 55px;
        background-color: #3395CC;
        margin: 10px 0px;
        border-radius: 55px;
        display: grid;
        grid-template-columns: 100% 15%;
        padding: 0px 3rem;
    }
    .input-div input{
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
    }
    .input-div input::placeholder{
        color: #FFFFFF;
        font-weight: 500;
    }
    .btn{
        background: none;
        color: #3395CC;
        margin: 10px 0px 20px;
        font-size: 20px;
        border: 2px solid #3395CC;
        border-radius: 50px;
        padding: 5px 30px;
        text-decoration: none;
        transition: 0.6s ease;
    }
    .btn:hover{
        background-color: #3395CC;
        color: #fff;
        border: 0px solid #3395CC;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }
    h1{
        color: #244093;
    }
    .a{
        float: right;
        position: relative;
        top: -680px;
        right: 460px;    
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size: 20px;
        color: #ff6456;
    }
</style>
</head>
<body>
    <div class="background">
      <div class="background-sign-up">
          <form method="POST">
            <h1>Sign in</h1>  
            <div class="input-div">
            <input type="test" name="username" placeholder="Username">
            </div>
             <div class="input-div">
            <input type="password" name="password" placeholder="Password">
            </div>
            <div>
               <input type="submit" name="admin" value="login" class="btn">
            </div>
         </form>
     </div>
    </div>   
</body>
</html>
<?php
    require 'config.php';
    session_start();

        if(isset($_POST['admin'])){

            $user   =     $_POST['username'];
            $pass   =     $_POST['password'];
            $sql    =     "SELECT * FROM admin WHERE username = '$user' && password = '$pass'";

            if(mysqli_num_rows(mysqli_query($con, $sql)) > 0){
                $_SESSION['username'] = $user;
                header("location: controle.php");
            } else {
                echo "<p class='a'>" . 
                        "sorry ! incorrect password or username
                        please try again" . 
                     "</p>";
            }
        }
?>