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
            margin-top: 75px;
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
        .file-div{
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .file-input{
            position: relative;
            margin-left: -127px;
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
            margin-top: -540px;
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
                <a href="controle.php"><img class="logo" src="images/logo 2.png"></a>
            </div>
            <div class="background-sign-up">
            <form method="POST" enctype="multipart/form-data">
                    <h1>Add Book</h1>
                    <div class="input-div">
                        <input type="text" name="titre" placeholder="Title" required/>
                    </div>
                    <div class="textarea-div">
                        <textarea name="auteur" placeholder="Your Text" required></textarea>
                    </div>
                    <div class="input-div">
                        <input type="text" name="link" placeholder="Link Book https://.." required/>
                    </div>
                    <div class="file-div">
                        <input type="file" name="photo" class="file-input">
                    </div>
                    <div>
                        <input type="submit" name="valider" value="Upload" class="btn"/>
                    </div>
                </form>
            </div>
    </header>
</body>
</html>
<?php
  require 'config.php';

  if(isset($_POST['valider'])){

    $t              =   $_POST['titre'];
    $aut            =   $_POST['auteur'];
    $l              =   $_POST['link'];

    $nomphoto       =   $_FILES['photo']['name'];
    $filetmpname    =   $_FILES['photo']['tmp_name'];
    move_uploaded_file($filetmpname,'./upload/$nomphoto');

    $req     =   "insert into addBooks (titlebook,textbook,linkbook,photobook) values ('$t','$aut','$l','$nomphoto')";
        if(mysqli_query($con, $req)){
             echo "<p class='a'>" . 
                "sent succesfully" . 
                "</p>";
        }
  }
?>