<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <style>
    *{
        margin: 0px;
        padding: 0px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .background{
        background-image: url(images/d.png);
        height: 100vh;
        background-size: cover;
        background-position: center;
    }
    .background-sign-up{
        float: right;
        margin-top: 230px;
        margin-right: 250px;
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
        background-color: #f0f0f0;
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
        color: #aaa;
        font-weight: 500;
    }
    .btn{
        background: none;
        color: #ff6456;
        margin: 10px 0px 20px;
        font-size: 20px;
        border: 2px solid #ff6456;
        border-radius: 50px;
        padding: 2px 30px;
        text-decoration: none;
        transition: 0.6s ease;
    }
    .btn:hover{
        background: linear-gradient(45deg,#ff6456,#F4347B);
        color: #fff;
        border: 2px solid #ff6456;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }
    .l{
        color: #ff6456;
        font-size: 20px;
        border: 2px solid #ff6456;
        border-radius: 50px;
        padding: 5px 18px;
        text-decoration: none;
        transition: 0.6s ease;
    }
    .l:hover{
        background: linear-gradient(45deg,#ff6456,#F4347B);
        color: #fff;
        border: 2px solid #ff6456;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }
    h3{
        margin:  0px 0px 30px;
    }
    .a{
        float: right;
        position: relative;
        top: -600px;
        right: 160px;    
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

            <input type="text" name="username" placeholder="Username" required/>
            </div>
             <div class="input-div">

            <input type="password" name="password" placeholder="Password" required/>
            </div>
            <div>

                <input type="submit" name="login" value="login" class="btn">
            </div>
            <div>
                <h3>if you are not registered. register now</h3>
            </div>
            <div>
                <a class="l" href="sign up.php">sign up</a>
            </div>
         </form>
     </div>
    </div>   
</body>
</html>
<?php
    require 'config.php';
    session_start();

        if(isset($_POST['login'])){

            $user   =     $_POST['username'];
            $pass   =     $_POST['password'];
            $sql    =     "SELECT * FROM signup WHERE username = '$user' && password = '$pass'";

            if(mysqli_num_rows(mysqli_query($con, $sql)) > 0){
                $_SESSION['username'] = $user;
                header("location: welcome.php");
            } else {
                echo '<p class="a">' . 
                        'sorry ! incorrect password or username
                        please try again' . 
                     '</p>';
            }
        }
?>