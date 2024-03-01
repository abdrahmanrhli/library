<?php
include('config.php');

get_data();
if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $insertQuery = "INSERT INTO messages (SenderUserID, Subject, Message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);

        $userID = $_SESSION["UserID"];
        $stmt->execute([$userID, $subject, $message]);

        echo "<script>
                    alert('Message sent successfully');
                    window.location.href = 'books.php';
              </script>";
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-container">
                <i class="ri-user-fill"></i>
                <input type="text" name="name" placeholder="Your Name" value="<?php echo $_SESSION["Username"]; ?>" readonly>
            </div>
            <div class="input-container">
                <i class="ri-mail-fill"></i>
                <input type="email" name="email" placeholder="Your Email" value="<?php echo $_SESSION["Email"]; ?>" readonly>
            </div>
            <div class="input-container">
                <i class="ri-edit-fill"></i>
                <input type="text" name="subject" placeholder="Subject" required>
            </div>
            <div class="input-container">
                <i class="ri-message-3-fill" id="txt"></i>
                <textarea name="message" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn"><i class="ri-send-plane-fill"></i>&nbsp;Send Message</button>
        </form>
    </div>
</body>
</html>