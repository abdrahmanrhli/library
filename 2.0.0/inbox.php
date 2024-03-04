<?php
include('config.php');
get_data();
session_admin();

// Fetch messages from database
$sql = "SELECT messages.*, users.FullName 
        FROM messages 
        INNER JOIN users ON messages.UserIDF = users.UserID";
$stmt = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/inbox.css">
</head>
<body>
<?php include 'include/nav-admin.php'; ?>
    <div class="container">
        <h1>Inbox</h1>
        <button class="btn refresh-btn" onclick="location.reload();"><i class="ri-refresh-line"></i> Refresh Messages</button>
        <ul class="messages">
            <?php
                if ($stmt->rowCount() > 0) {
                    // Output data of each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<li class='message' id='" . $row['MessageID'] . "'>
                                <div class='message-info'>
                                    <span class='sender'><i class='ri-user-fill'></i> " . $row['FullName'] . "</span>
                                    <span class='subject'><i class='ri-edit-fill'></i> " . $row['Subject'] . "</span>
                                    <p><i class='ri-file-text-fill'></i> " . substr($row['Message'], 0, 50) . "...</p>
                                </div>
                                <div class='message-actions'>
                                    <button class='open' onclick=\"window.location.href = 'view-message.php?message_id=" . $row['MessageID'] . "';\"><i class='ri-mail-open-fill'></i> Open</button>
                                    <button class='delete' onclick='deleteMessage(" . $row['MessageID'] . ");'><i class='ri-delete-bin-fill'></i> Delete</button>
                                </div>
                            </li>";
                    }
                } else {
                    echo "<li>No messages found</li>";
                }

                // Close PDO connection
                $conn = null;
            ?>
        </ul>
    </div>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php require 'assets/js/script_message.php'; ?>
<?php include 'assets/js/script_navbar.php'; ?>
</body>
</html>