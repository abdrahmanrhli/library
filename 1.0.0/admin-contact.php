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
            margin-top: 96px;
        }
        h1{
            background: linear-gradient(45deg,#ff6456,#F4347B);
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .div-contact{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .your{
            width: 30%;
            background-color: #f0f0f0;
            margin: 10px 0px;
            border-radius: 20px;
            padding: 15px 10px;
            text-align: center;
            font-weight: bold;
            white-space: normal;
        }
        .text{
            background-color: #f0f0f0;
            width: 435px;
            height: 200px;
            padding: 15px 20px;
            border-radius: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
            font-weight: bold;
            overflow: auto;
        }
        .fasl{
            background: linear-gradient(45deg,#ff6456,#F4347B);
            width: 435px;
            height: 3px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 300px;
        }
    </style>
</head>
<body>
    <header>
            <div class="logo-div">
                <a href="controle.php"><img class="logo" src="images/logo 2.png"></a>
            </div>
            <div class="background-sign-up">
                <?php
                    require 'config.php';

	                $result = mysqli_query($con,"SELECT * FROM contact");
	
                    while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='div-contact'>
                            <div class='your'>{$row['yourname']}</div>
                            <div class='your'>{$row['youremail']}</div>
                            <div class='text'>{$row['text']}</div>
                            echo <hr class='fasl'>
                        </div>";
                    }
                ?>
            </div>
    </header>
</body>
</html>
