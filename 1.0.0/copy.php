<?php
echo $username . " " . $email . " " . $password;
?>
<?php
$db_user = "root";
$db_pass = "";
$db_name = "book";

$db = new PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
        require_once('config.php');
?>
<?php
        if(isset($_POST['create'])){
        $username     =     $_POST['username'];
        $email        =     $_POST['email'];
        $password     =     $_POST['password'];

        $sql = "INSERT INTO signup (username, email, password) VALUES (?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$username, $email, $password]);
        if($result){
         echo 'Successfully saved.';
           }else{
         echo'there ware erros while saving the data';
           }
        }
?>
<?php
    require 'config.php';
    session_start();

        if(isset($_POST['login'])){

            $user   =     $_POST['username'];
            $pass   =     $_POST['password'];
            $sql    =     "SELECT * FROM signup WHERE username = '$user' && password = '$pass'";

            if(mysqli_num_rows(mysqli_query($con, $sql)) > 0){
                $_SESSION['username'] = $user;
                header("location: index.html");
            } else {
                echo'not acount';
            }
        }
?>
