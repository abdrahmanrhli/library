<div>
    <style>
        .a{
        position: relative;
        float: right;
        margin-top: -35px;
        margin-right: 100px;
        color: #ffffff;
        }
        .contener_slideshow
        {
        width:610px;
        height:211px;
        margin-top: 5px;
        overflow: hidden;
        position: relative;
        }
        .slid_1, .slid_2, .slid_3
        {
        position: absolute;
        width:610px;
        height:211px;
        }
        .slid_1{left: 0;}
        .slid_2{left: 610px;}
        .slid_3{left: 1220px;}
        .contener_slide
        {
        width: 1220px;
        height: 211px;
        left:0px;
        position: absolute;
        animation-duration: 10s;
        animation-iteration-count:infinite;
        animation-name: anim_slide;
        }
        @keyframes anim_slide 
        {
        0% {left:0px;}
        22% {left:0px;}
        33% {left:-610px;}
        45% {left:-610px;}
        66% {left:-1220px;}
        90% {left:-1220px;}
        }
    </style>
    <?php
    

    if(!isset($_SESSION['username'])){
        echo   "<form method='POST'>
            <div class='div-btn'>
                <input type='submit' name='sign-out' value='sign out' class='btn-out'>
            </div>
        </form>";
        exit();
        }
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
</div>
<div align="center">
    <div class="contener_slideshow">
        <div class="contener_slide">
        <div class="slid_1"><img src="images/bookcover1.png"></div>
        <div class="slid_2"><img src="images/bookcover2.png"></div>
        <div class="slid_3"><img src="images/bookcover3"></div>
        </div>
    </div>