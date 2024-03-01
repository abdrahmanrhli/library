<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="slideshow.css" />
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
        .logo{
            position: relative;
            margin: -20px 650px;
            width: 80px;  
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
        .bg-books{
            position: relative;
            width: 100%;
            margin: 30px auto;
        }
        .title-books{
            position: absolute;
            margin: 10px auto auto 150px;
        }
        .title-books h2{
            position: absolute;
            display: inline-block;
            margin-top: 2px;
            padding-left: 10px;
            color: #ff6456;
            font-size: 23px;
        }
        .book-icon{
            width: 30px;
        }
        .books{
            position: relative;
            margin: auto 100px;
        }
        .div-books{
            display: inline-block;
            position: relative;
            margin-top: 60px;
            margin-left: 45px;
        }
        .div-img{
            float: right;
            height: 250px;
            width: 200px;
            border: 5px solid #ff6456;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
             0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .div-title{
            position: absolute;
            width: 200px;
            margin-top: 270px;
            padding: 20px auto;
            float: right;
            color: #1A6692;
            font-weight: 400;
            font-size: 1.3rem;
            white-space: normal;
            text-decoration: none;
            transition: 0.3s ease;
        }
        .div-img1:hover .div-title:hover{
            color: #ff6456;
        }
        .fasl{
            margin-top: 150px;
            position: relative;
        }
        footer{
            background-image: url(images/h.png);
            height: 100vh;
            background-size: cover;
            background-position: center;
        }
        .links{
            float: right;
            margin-top: 400px;
            margin-right: 550px;
            text-align: center;
        }
        .links p{
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .links p a{
            color: #a8a1a1;
            text-decoration: none;
            transition: 0.3s ease;
        }
        .links p a:hover{
            color: #ff6456;
        }
        .icon{
            float: right;
            margin-top: 400px;
            margin-right: -270px;
            display: block;
        }
        .icon a img{
            display: block;
            width: 30px;
            height: 30px;
            margin-top: 20px;
            margin-left: 25%;
        }
        .qr{
            float: right;
            width: 200px;
            height: 200px;
            margin-top: 400px;
            margin-right: -540px;
            text-align: center;
        }
        .qr img{
            width: 100px;
            height: 100px;
            margin-top: 20px;
            opacity: 70%;
        }
        hr{
            width: 1100px;
            height: 1px;
            background: #030303;
            border: none;
        }
        .hr{
            float: left;
            margin-top: 1.5%;
            margin-left: 17%;
        }
        .id{
            position: relative;
            text-align: right;
            margin-top: -15px;
        }
    </style>
</head>
<body>
    <header>
            <div class="backg1">
                <div>
                    <a href="index.html"><img class="logo" src="images/logo 2.png"></a>
                </div>
                <div>
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
    <div align="center">
    <div class="contener_slideshow">
        <div class="contener_slide">
        <div class="slid_1"><img src="images/bookcover1.png"></div>
        <div class="slid_2"><img src="images/bookcover2.png"></div>
        <div class="slid_3"><img src="images/bookcover3.png"></div>
        </div>
    </div>
</div>
    <div class="bg-books">
        <div class="title-books">
            <img src="icon/book-icon1.png" class="book-icon"/>
            <h2>Books</h2>
        </div>
        <div class="books">
        
    <?php
    require 'config.php';
    $result = mysqli_query($con, "SELECT * FROM addBooks");

    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='div-books'>
        <a href='bookview.php?id={$row['id']}' class='div-img1'><img src='upload/{$row['photobook']}' class='div-img'></a>
                <a href='bookview.php?id={$row['id']}' class='div-title'>{$row['titlebook']}</a>
            </div>";
        }
    ?>
        </div>
    </div>
     <div class="fasl">
    <footer>
        <div class="links">
            <h4>Useful Links</h4>
            <p><a href="index.html">Home</a></P>
            <P><a href="book.html">Books</a></P>
            <P><a href="about.html">About</a></P>
            <P><a href="contact.html">Contact</a></P>  
        </div>
        <div class="icon">
            <h4>Contacts</h4>
            <a href="socialmedia.html"><img src="icon/facebook.png"></a>
            <a href="socialmedia.html"><img src="icon/instagram.png"></a>
            <a href="socialmedia.html"><img src="icon/twitter.png"></a>
            <a href="socialmedia.html"><img src="icon/snapchat.png"></a>
        </div>
        <div class="qr">
            <h4>QR Code</h4>
            <img src="images/QR Code.png">
        </div>
        <div class="hr">
            <hr>
           <h5>Copyright &copy; 2020-2021 </h5>           
           <h5 class="id">Desgin & Dev erahali &trade;</h5><br>
           <h6 class="id">ID A0001R</h6>
        </div>
    </footer>
    </div>
</body>
</html>