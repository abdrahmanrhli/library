<style>
    *{
        margin: 0px;
        padding: 0px;
        font-family: Arial, Helvetica, sans-serif;
    }
    .welcome{
        background-image: url(images/e.png);
        height: 100vh;
        background-size: cover;
        background-position: center;
    }
    .a{
        float: right;
        position: relative;
        top: 440px;
        right: 550px;    
        font-family: Arial, Helvetica, sans-serif;
        color: #ff6456;
        font-size: 50px;
    }
    .c{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-out{
        float: right;
        position: relative;
        top: 10px;
        right: 30px;
    }
    .l{
        float: left;
        position: relative;
        top: 600px;
        left: 722px;
    }
    .btn-out,.l{
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
    .l:hover{
        background: linear-gradient(45deg,#ff6456,#F4347B);
        color: #fff;
        border: 0px solid #ff6456;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }
</style>
    <form method="POST">
        <div class="div-btn">
             <input type="submit" name="sign-out" value="sign out" class="btn-out">
        </div>
        <div>
            <a class="l" href="book.php">Next</a>
        </div>
    </form>
<?php
    require 'auth.php';

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
                header("location: sign in.php");
                exit();
            }
?>