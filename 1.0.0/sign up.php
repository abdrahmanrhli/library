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
        background-image: url(images/c.png);
        height: 100vh;
        background-size: cover;
        background-position: center;
    }
    .background-sign-up{
        float: left;
        margin-top: 190px;
        margin-left: 250px;
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
        padding: 0px 2.5rem;
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
        padding: 2px 20px;
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
        padding: 5px 28px;
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
        margin: 0px 0px 30px;
    }
    .a{
        float: left;
        position: relative;
        top: -620px;
        left: 220px;    
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size: 20px;
        color: #28b472;
    }
</style>
</head>
<body>
<div>
</div>
    <div class="background">
        <div class="background-sign-up">
            <div>
                <form action="" method="POST">
                    <h1>Sign up</h1>
                    <div class="input-div">

                        <input type="test" name="username" placeholder="Username" required/>
                    </div>
                    <div class="input-div">

                        <input type="email" name="email" placeholder="Email" required/>
                    </div>
                    <div class="input-div">

                        <input type="password" name="password" placeholder="Password" required/>
                    </div>
                    <div>

                        <input type="submit" name="create" value="sigan up" class="btn"/>
                    </div>
                    <div>
                        <h3>if you are registered. log in here.</h3>
                    </div>
                    <div>
                        
                        <a class="l" href="sign in.php">sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
        require 'config.php';

        if(isset($_POST['create'])){
        $username     =     $_POST['username'];
        $email        =     $_POST['email'];
        $password     =     $_POST['password'];

        $sql = "INSERT INTO signup (username, email, password) VALUES ('$username','$email','$password')";
                if(mysqli_query($con, $sql)){
                     echo '<p class="a">' . 
                            'Account successfully created. login now' . 
                           '</p>';
           }
        }
?>