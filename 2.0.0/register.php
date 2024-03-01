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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = sanitize($_POST["fullname"]);
    $username = sanitize($_POST["username"]);
    $email = sanitize($_POST["email"]);
    $password = md5(sanitize($_POST["password"]));

    // Check if the username or email already exists
    $checkQuery = "SELECT * FROM users WHERE Username = :username OR Email = :email";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":username", $username, PDO::PARAM_STR);
    $checkStmt->bindParam(":email", $email, PDO::PARAM_STR);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        echo "<script>
                    alert('Username or email already exists.');
              </script>";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (Fullname, Username, Email, Password) VALUES (:fullname, :username, :email, :password)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(":fullname", $fullname, PDO::PARAM_STR);
        $insertStmt->bindParam(":username", $username, PDO::PARAM_STR);
        $insertStmt->bindParam(":email", $email, PDO::PARAM_STR);
        $insertStmt->bindParam(":password", $password, PDO::PARAM_STR);
        $insertStmt->execute();

        echo "<script>
                    alert('Registration successful. You can now login.');
                    window.location.href = 'login.php';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <div class="container">
        <div class="container-login">
            <h2>Sign up</h2>
            <form autocomplete="off" enctype="multipart/form-data" action="" method="post">
                <div class="input-container">
                    <i class="ri-user-fill icon"></i>
                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="input-container">
                    <i class="ri-user-fill icon"></i>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-container">
                    <i class="ri-mail-fill icon"></i>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-container">
                    <i class="ri-lock-password-fill icon"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn"><i class="ri-user-add-fill"></i></i>&nbsp; Sign up</button>
            </form>
            <p>If you are registered, <a href="login.php">log in here</a></p>
        </div>
        <div class="container-cover">
            <img src="assets/images/background/register.png" class="cover-1" alt="Book Cover">
            <img src="assets/images/background/register-screen.png" class="cover-2" alt="Book Cover">
        </div>
    </div>
    <!-- onclick="submitData('adduserup')"; -->
    <?php include 'assets/js/script_user.php'; ?>
</body>
</html>
