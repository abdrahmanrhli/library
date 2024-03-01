<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}

// Include config file
include('config.php');

// Check if message_id is set in the URL
if(isset($_GET['message_id']) && !empty($_GET['message_id'])){
    $message_id = $_GET['message_id'];
    
    // Fetch message details from database
    $sql = "SELECT messages.*, users.Username, users.Email 
            FROM messages 
            INNER JOIN users ON messages.SenderUserID = users.UserID
            WHERE MessageID = :message_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Check if message exists
    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $sender_username = $row['Username'];
        $subject = $row['Subject'];
        $message = $row['Message'];
        $sender_email = $row['Email'];
    } else {
        echo "Message not found.";
        exit();
    }
} else {
    echo "Invalid message ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/view-message.css">
</head>
<body>
    <div class="container">
        <h1>View Message</h1>
        <div class="message-details">
            <p><strong><i class="ri-user-fill"></i> From:</strong> <?php echo $sender_username; ?></p>
            <p><strong><i class="ri-edit-fill"></i> Subject:</strong> <?php echo $subject; ?></p>
            <p><strong><i class="ri-message-3-fill"></i> Message:</strong> <?php echo $message; ?></p>
        </div>
        <div class="btn-container">
            <a href="mailto:<?php echo $sender_email; ?>" class="btn"><i class="ri-mail-line"></i> Reply via Email</a>
            <button class="btn" onclick="deleteMessageView(<?php echo $message_id; ?>);"><i class="ri-delete-bin-line"></i> Delete Message</button>
        </div>
    </div>

    <?php require 'assets/js/script_message.php'; ?>
</body>
</html>