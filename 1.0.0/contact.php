<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            width: 90%;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #ff6456;
            margin-bottom: 20px;
        }
        .input-container {
            position: relative;
            margin-bottom: 20px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-sizing: border-box;
            padding-left: 40px;
            transition: border-color 0.3s ease;
        }
        input:focus, textarea:focus {
            border-color: #ff6456;
        }
        #txt {
            top: 10%;
        }
        .input-container i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #999;
        }
        .btn {
            background-color: #ff6456;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .btn:hover {
            background-color: #F4347B;
        }
        textarea {
            resize: none;
            overflow-y: auto;
            height: 150px;
        }

        @media screen and (min-width: 768px) and (max-width: 1200px) {
            .container {
                width: 60%;
            }
        }
        @media screen and (min-width: 1200px) {
            .container {
                max-width: 40%;
            }
            textarea {
                height: 170px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form method="POST" action="submit.php">
            <div class="input-container">
                <i class="ri-user-fill"></i>
                <input type="text" name="name" placeholder="Your Name" required>
            </div>
            <div class="input-container">
                <i class="ri-mail-fill"></i>
                <input type="email" name="email" placeholder="Your Email" required>
            </div>
            <div class="input-container">
                <i class="ri-message-3-fill" id="txt"></i>
                <textarea name="message" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn"><i class="ri-send-plane-fill"></i> Send Message</button>
        </form>
    </div>
</body>
</html>
<!-- #txt {
            top: 20%;
        }
id="txt" -->

<!-- <!DOCTYPE html>
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
        /* background-image: url(images/contact.png);
        height: 100vh;
        background-size: cover;
        background-position: center; */
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
            background: -webkit-linear-gradient(45deg,#ff6456,#F4347B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
            border-radius: 20px;
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
        .textarea-div{
            margin: 10px 0px;
            background-color: #f0f0f0;
            border-radius: 18px;
            
        }
        textarea{
            outline: none;
            border: none;
            background: none;
            resize: none;
            width: 380px;
            height: 200px;
            border-radius: 20px;
            margin-top: 10px;
            padding: 0px 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }
        textarea::placeholder{
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
        .a{
            text-align: center;
            margin-top: -530px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 20px;
            color: #28b472;
        }
    </style>
</head>
<body>
    <header>
            <div class="logo-div">
                <a href="index.html"><img class="logo" src="images/logo 2.png"></a>
            </div>
            <div class="background-sign-up">
                <form method="POST">
                    <h1>Contact</h1>
                    <div class="input-div">
                        <input type="test" name="yourname" placeholder="Your name" required/>
                    </div>
                    <div class="input-div">
                        <input type="email" name="youremail" placeholder="Your Email" required/>
                    </div>
                    <div class="textarea-div">
                        <textarea name="text"  placeholder="Your Text" required></textarea>
                    </div>
                    <div>
                        <input type="submit" name="send" value="Send" class="btn"/>
                    </div>
                </form>
            </div>
    </header>
</body>
</html>
< ?php
        require 'config.php';

        if(isset($_POST['send'])){
        $yourname     =     $_POST['yourname'];
        $youremail    =     $_POST['youremail'];
        $text         =     $_POST['text'];

        $sql = "INSERT INTO contact (yourname, youremail, text) VALUES ('$yourname','$youremail','$text')";
                if(mysqli_query($con, $sql)){
                     echo "<p class='a'>" . 
                            "sent succesfully" . 
                            "</p>";
                }
        }
?> -->