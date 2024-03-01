<!-- home.php -->
        <div class="cover">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="covers/image_1.png" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="covers/image_2.png" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="covers/image_3.png" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
                        
                        <?php
                        $query = "SELECT * FROM favorites WHERE UserIDF = :userid AND BookIDF = :bookid";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':userid', $UserID);
                        $stmt->bindParam(':bookid', $row['BookID']);
                        $stmt->execute();
                        $count = $stmt->rowCount();

                        $iconClass = ($count > 0) ? 'ri-heart-fill' : 'ri-heart-line';
                        ?>
                        <button type="button" class="favorites" onclick="Favorites('favorites', <?php echo $UserID; ?>, <?php echo $row['BookID']; ?>)">
                            <i id="icon_<?php echo $row['BookID']; ?>" class="<?php echo $iconClass; ?>"></i>
                        </button>
<!-- inbox.php -->

<?php
include('config.php');

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION["Roll"] == 0) {
    header("Location: books.php");
    exit();
}

$currentUserRoll = $_SESSION["Roll"];
$currentUserID = $_SESSION["UserID"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderUserID = $currentUserID;

    if ($currentUserRoll == 1) {

        $receiverUserID = $_POST["receiverUserID"];
    } else {

        $receiverUserID = 1;
    }

    $subject = $_POST["subject"];
    $messageText = $_POST["message"];

    $insertMessageQuery = "INSERT INTO messages (SenderUserID, ReceiverUserID, Subject, MessageText) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertMessageQuery);
    $stmt->execute([$senderUserID, $receiverUserID, $subject, $messageText]);
}

$inboxQuery = "SELECT * FROM messages WHERE (SenderUserID = ? OR ReceiverUserID = ?)";
$stmt = $conn->prepare($inboxQuery);
$stmt->execute([$currentUserID, $currentUserID]);
$inbox = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <h2>Messages</h2>

    <?php if ($currentUserRoll == 1): ?>

        <form action="example.php" method="post">
            <label for="receiverUserID">Receiver UserID:</label>
            <input type="text" id="receiverUserID" name="receiverUserID" required><br>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required><br>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea><br>
            <input type="submit" value="Send Message">
        </form>
    <?php endif; ?>

    <div>
        <h3>Inbox</h3>
        <?php foreach ($inbox as $message): ?>
            <div>
                <p><strong>From UserID:</strong> <?php echo $message['SenderUserID']; ?></p>
                <p><strong>To UserID:</strong> <?php echo $message['ReceiverUserID']; ?></p>
                <p><strong>Subject:</strong> <?php echo $message['Subject']; ?></p>
                <p><strong>Message:</strong> <?php echo $message['MessageText']; ?></p>
                <p><strong>Timestamp:</strong> <?php echo $message['Timestamp']; ?></p>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
</body>
</html>

<!-- message -->

<?php
include('config.php');

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["UserID"];

// Get user ID from URL parameter
if(isset($_GET['userID'])) {
    $viewUserID = $_GET['userID'];
} else {
    // Redirect if user ID is not provided
    header("Location: message.php");
    exit();
}

// Query to get user details
$queryUser = "SELECT Username, Avatar FROM users WHERE UserID = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->execute([$viewUserID]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Query to get messages between admin and user
$queryMessages = "SELECT messages.*, users.Username 
                  FROM messages 
                  INNER JOIN users ON messages.UserID = users.UserID 
                  WHERE (messages.AdminID = ? AND messages.UserID = ?) OR (messages.AdminID = ? AND messages.UserID = ?) 
                  ORDER BY messages.SentAt ASC";
$stmtMessages = $conn->prepare($queryMessages);
$stmtMessages->execute([$userID, $viewUserID, $viewUserID, $userID]);
$messages = $stmtMessages->fetchAll(PDO::FETCH_ASSOC);

// Handle message submission
if(isset($_POST['message']) && !empty($_POST['message'])) {
    $newMessage = $_POST['message'];

    // Insert the new message into the database
    $queryInsert = "INSERT INTO messages (UserID, AdminID, Message) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($queryInsert);
    $stmtInsert->execute([$userID, $viewUserID, $newMessage]);

    // Update UnreadMessages for the recipient user
    $queryUpdate = "UPDATE users SET UnreadMessages = UnreadMessages + 1 WHERE UserID = ?";
    $stmtUpdate = $conn->prepare($queryUpdate);
    $stmtUpdate->execute([$viewUserID]);

    // Redirect to avoid form resubmission
    header("Location: view-message.php?userID=$viewUserID");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Conversation with <?php echo $user['Username']; ?></h2>

    <div>
        <ul>
            <?php foreach ($messages as $message) : ?>
                <li>
                    <p><?php echo $message['Username']; ?>: <?php echo $message['Message']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <form action="" method="post">
        <textarea name="message" rows="4" cols="50" placeholder="Type your message here..."></textarea><br>
        <input type="submit" value="Send">
    </form>
</body>
</html>
<!-- < ?php
include('config.php');

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["UserID"];

// Get user ID from URL parameter
if(isset($_GET['userID'])) {
    $viewUserID = $_GET['userID'];
} else {
    // Redirect if user ID is not provided
    header("Location: message.php");
    exit();
}

// Query to get user details
$queryUser = "SELECT Username, Avatar FROM users WHERE UserID = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->execute([$viewUserID]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Query to get messages between admin and user
$queryMessages = "SELECT messages.*, users.Username 
                  FROM messages 
                  INNER JOIN users ON messages.UserID = users.UserID 
                  WHERE (messages.AdminID = ? AND messages.UserID = ?) OR (messages.AdminID = ? AND messages.UserID = ?) 
                  ORDER BY messages.SentAt ASC";
$stmtMessages = $conn->prepare($queryMessages);
$stmtMessages->execute([$userID, $viewUserID, $viewUserID, $userID]);
$messages = $stmtMessages->fetchAll(PDO::FETCH_ASSOC);

// Handle message submission
if(isset($_POST['message']) && !empty($_POST['message'])) {
    $newMessage = $_POST['message'];

    // Insert the new message into the database
    $queryInsert = "INSERT INTO messages (UserID, AdminID, Message) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($queryInsert);
    $stmtInsert->execute([$userID, $viewUserID, $newMessage]);

    // Redirect to avoid form resubmission
    header("Location: view-message.php?userID=$viewUserID");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Conversation with < ?php echo $user['Username']; ?></h2>

    <div>
        <ul>
            < ?php foreach ($messages as $message) : ?>
                <li>
                    <p>< ?php echo $message['Username']; ?>: < ?php echo $message['Message']; ?></p>
                </li>
            < ?php endforeach; ?>
        </ul>
    </div>

    <form action="" method="post">
        <textarea name="message" rows="4" cols="50" placeholder="Type your message here..."></textarea><br>
        <input type="submit" value="Send">
    </form>
</body>
</html> -->


<!-- login -->


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

            header("Location: " . ($result["Roll"] == 1 ? "dashboard.php" : "books.php"));
            exit();
        } else {
            $errors[] = "Invalid password.";
        }
    } else {
        // Separate error messages for invalid username and invalid email
        $usernameCheckQuery = "SELECT * FROM users WHERE Username = :username";
        $emailCheckQuery = "SELECT * FROM users WHERE Email = :email";

        $checkStmt = function ($query, $param) use ($conn, $loginIdentifier) {
            $stmt = $conn->prepare($query);
            $stmt->bindParam($param, $loginIdentifier, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() == 0;
        };

        if ($checkStmt($usernameCheckQuery, ":username") && $checkStmt($emailCheckQuery, ":email")) {
            $errors[] = "Invalid username/email.";
        } elseif ($checkStmt($usernameCheckQuery, ":username")) {
            $errors[] = "Invalid username.";
        } elseif ($checkStmt($emailCheckQuery, ":email")) {
            $errors[] = "Invalid email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <?php
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    ?>
    <form action="" method="post">
        <label for="login_identifier">Username/Email:</label>
        <input type="text" name="login_identifier" required>

        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <br>

        <input type="submit" value="Login">
    </form>
    <a href="register.php">Sign up</a>
</body>
</html>

<!-- message.php -->

<?php
include('config.php');

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION["Roll"] == 0) {
    header("Location: books.php");
    exit();
}

$userID = $_SESSION["UserID"];

// Query to get users with unread messages
$queryUnreadMessages = "SELECT UserID, Username, Avatar, UnreadMessages FROM users WHERE UnreadMessages > 0";
$stmtUnreadMessages = $conn->prepare($queryUnreadMessages);
$stmtUnreadMessages->execute();
$usersUnreadMessages = $stmtUnreadMessages->fetchAll(PDO::FETCH_ASSOC);

// Query to get users without messages with admin
$queryNoMessages = "SELECT UserID, Username, Avatar, UnreadMessages 
                    FROM users 
                    WHERE UserID NOT IN (SELECT UserID FROM messages WHERE AdminID = ?)";
$stmtNoMessages = $conn->prepare($queryNoMessages);
$stmtNoMessages->execute([$userID]);
$usersNoMessages = $stmtNoMessages->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Messages</h2>

    <div>
        <h3>Unread Messages</h3>
        <ul>
            <?php foreach ($usersUnreadMessages as $user) : ?>
                <li>
                    <?php if (!empty($user['Avatar'])) : ?>
                        <img src="<?php echo "avatar/" . $user['Avatar']; ?>" alt="User Avatar">
                    <?php endif; ?>
                    <p>User: <?php echo $user['Username']; ?></p>
                    <span>Unread Messages: <?php echo $user['UnreadMessages']; ?></span>
                    <a href="view-message.php?userID=<?php echo $user['UserID']; ?>">View Messages</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div>
        <h3>Send Message</h3>
        <ul>
            <?php foreach ($usersNoMessages as $user) : ?>
                <li>
                    <?php if (!empty($user['Avatar'])) : ?>
                        <img src="<?php echo "avatar/" . $user['Avatar']; ?>" alt="User Avatar">
                    <?php endif; ?>
                    <p>User: <?php echo $user['Username']; ?></p>
                    <a href="view-message.php?userID=<?php echo $user['UserID']; ?>">Send Message</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>


<!-- view-message -->

<?php
include('config.php');

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["UserID"];

// Get user ID from URL parameter
if(isset($_GET['userID'])) {
    $viewUserID = $_GET['userID'];
} else {
    // Redirect if user ID is not provided
    header("Location: message.php");
    exit();
}

// Query to get user details
$queryUser = "SELECT Username, Avatar FROM users WHERE UserID = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->execute([$viewUserID]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Query to get messages between admin and user
$queryMessages = "SELECT messages.*, users.Username 
                  FROM messages 
                  INNER JOIN users ON messages.UserID = users.UserID 
                  WHERE (messages.AdminID = ? AND messages.UserID = ?) OR (messages.AdminID = ? AND messages.UserID = ?) 
                  ORDER BY messages.SentAt ASC";
$stmtMessages = $conn->prepare($queryMessages);
$stmtMessages->execute([$userID, $viewUserID, $viewUserID, $userID]);
$messages = $stmtMessages->fetchAll(PDO::FETCH_ASSOC);

// Handle message submission
if(isset($_POST['message']) && !empty($_POST['message'])) {
    $newMessage = $_POST['message'];

    // Insert the new message into the database
    $queryInsert = "INSERT INTO messages (UserID, AdminID, Message) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($queryInsert);
    $stmtInsert->execute([$userID, $viewUserID, $newMessage]);

    // Update UnreadMessages for the recipient user
    $queryUpdate = "UPDATE users SET UnreadMessages = UnreadMessages + 1 WHERE UserID = ?";
    $stmtUpdate = $conn->prepare($queryUpdate);
    $stmtUpdate->execute([$viewUserID]);

    // Redirect to avoid form resubmission
    header("Location: view-message.php?userID=$viewUserID");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Conversation with <?php echo $user['Username']; ?></h2>

    <div>
        <ul>
            <?php foreach ($messages as $message) : ?>
                <li>
                    <p><?php echo $message['Username']; ?>: <?php echo $message['Message']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <form action="" method="post">
        <textarea name="message" rows="4" cols="50" placeholder="Type your message here..."></textarea><br>
        <input type="submit" value="Send">
    </form>
</body>
</html>
<!-- < ?php
include('config.php');

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["UserID"];

// Get user ID from URL parameter
if(isset($_GET['userID'])) {
    $viewUserID = $_GET['userID'];
} else {
    // Redirect if user ID is not provided
    header("Location: message.php");
    exit();
}

// Query to get user details
$queryUser = "SELECT Username, Avatar FROM users WHERE UserID = ?";
$stmtUser = $conn->prepare($queryUser);
$stmtUser->execute([$viewUserID]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

// Query to get messages between admin and user
$queryMessages = "SELECT messages.*, users.Username 
                  FROM messages 
                  INNER JOIN users ON messages.UserID = users.UserID 
                  WHERE (messages.AdminID = ? AND messages.UserID = ?) OR (messages.AdminID = ? AND messages.UserID = ?) 
                  ORDER BY messages.SentAt ASC";
$stmtMessages = $conn->prepare($queryMessages);
$stmtMessages->execute([$userID, $viewUserID, $viewUserID, $userID]);
$messages = $stmtMessages->fetchAll(PDO::FETCH_ASSOC);

// Handle message submission
if(isset($_POST['message']) && !empty($_POST['message'])) {
    $newMessage = $_POST['message'];

    // Insert the new message into the database
    $queryInsert = "INSERT INTO messages (UserID, AdminID, Message) VALUES (?, ?, ?)";
    $stmtInsert = $conn->prepare($queryInsert);
    $stmtInsert->execute([$userID, $viewUserID, $newMessage]);

    // Redirect to avoid form resubmission
    header("Location: view-message.php?userID=$viewUserID");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Conversation with < ?php echo $user['Username']; ?></h2>

    <div>
        <ul>
            < ?php foreach ($messages as $message) : ?>
                <li>
                    <p>< ?php echo $message['Username']; ?>: < ?php echo $message['Message']; ?></p>
                </li>
            < ?php endforeach; ?>
        </ul>
    </div>

    <form action="" method="post">
        <textarea name="message" rows="4" cols="50" placeholder="Type your message here..."></textarea><br>
        <input type="submit" value="Send">
    </form>
</body>
</html> -->