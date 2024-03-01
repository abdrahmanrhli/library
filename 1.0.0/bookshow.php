
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
        header{
        background-image: url(images/contact.png);
        height: 100vh;
        background-size: cover;
        background-position: center;
        }
        .logo-div{
            text-align: center;
        }
        .logo{
            margin-top: 20px;
            width: 100px;
            height: 109px;    
        }
        .background-sign-up{
            margin-top: 500px;
            position: absolute;
        }
        #img_div{
            width: 80%;
            padding: 5px;
            margin: 15px auto;
            border: 1px solid #cbcbcb;
            background: #767272;
            color: white;
        }
        #img_div:after{
            content: "";
            display: block;
            clear: both;
        }
        img{
            float: left;
            margin: 5px;
            width: 300px;
            height: 140px;
        }
    </style>
</head>
<body>
<header>
            <div class="logo-div">
                <a href="index.html"><img class="logo" src="images/logo 2.png"></a>
            </div>
            <div class="background-sign-up">
            <?php
            require 'config.php';    
            $result = mysqli_query($con, "SELECT * FROM image_book");
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div id='img_div'>";
                        echo "<p>".$row['titre']."</p>";
                        echo "<img src='upload/".$row['photo']."' >";
                    echo "</div>";
                }
            ?>
            </div>
    </header>
</body>
</html>

