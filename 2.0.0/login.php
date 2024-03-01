<?php
include('config.php');

session_start();
if (isset($_SESSION["UserID"])) {
    header("Location: " . ($_SESSION["Roll"] == 1 ? "dashboard.php" : "books.php"));
    exit();
}

function sanitize($data) {
    global $conn;
    return htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8');
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginIdentifier = sanitize($_POST["login_identifier"]);
    $password = sanitize($_POST["password"]);

    $query = "SELECT * FROM users WHERE (Username = :loginIdentifier OR Email = :loginIdentifier)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":loginIdentifier", $loginIdentifier, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (md5($password) === $result["Password"]) {
            $_SESSION["UserID"] = $result["UserID"];
            $_SESSION["Roll"] = $result["Roll"];
            $_SESSION["Username"] = $result["Username"];
            $_SESSION["Email"] = $result["Email"];
            $_SESSION["FullName"] = $result["FullName"];
            $_SESSION["Avatar"] = $result["Avatar"];

            header("Location: " . ($result["Roll"] == 1 ? "dashboard.php" : "home.php"));
        } else {
            echo "<script>
                        alert('Invalid password.');
                  </script>";
            
        }
    } else {

        $usernameCheckQuery = "SELECT * FROM users WHERE Username = :username";
        $emailCheckQuery = "SELECT * FROM users WHERE Email = :email";

        $checkStmt = function ($query, $param) use ($conn, $loginIdentifier) {
            $stmt = $conn->prepare($query);
            $stmt->bindParam($param, $loginIdentifier, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() == 0;
        };

        if ($checkStmt($usernameCheckQuery, ":username") && $checkStmt($emailCheckQuery, ":email")) {
            echo "<script>
                    alert('Invalid username/email.');
                  </script>";
            
        } elseif ($checkStmt($usernameCheckQuery, ":username")) {
            echo "<script>
                        alert('Invalid username.');
                  </script>";
            
        } elseif ($checkStmt($emailCheckQuery, ":email")) {
            echo "<script>
                        alert('Invalid email.');
                  </script>";
            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="container-cover">
            <img src="assets/images/background/login.png" class="cover-1" alt="Book Cover">
            <img src="assets/images/background/login-screen.png" class="cover-2" alt="Book Cover">
        </div>
        <div class="container-login">
            <h2>Sign in</h2>
            <form autocomplete="off" enctype="multipart/form-data" action="" method="post">
                <div class="input-container">
                    <i class="ri-user-fill icon"></i>
                    <input type="text" id="login_identifier" name="login_identifier" placeholder="Username or Email" required>
                </div>
                <div class="input-container">
                    <i class="ri-lock-password-fill icon"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn"><i class="ri-login-circle-fill"></i>&nbsp; Login</button>
            </form><!-- onclick="SignIN('signin')"; -->
            <p>If you are not registered,<br> <a href="register.php">register now</a></p>
        </div>
    </div>

    <!-- < ?php include 'assets/js/script_user.php'; ?> -->
</body>
</html>