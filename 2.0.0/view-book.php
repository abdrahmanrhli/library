<?php
require 'config.php';

session_start();
if (isset($_SESSION["UserID"])) {
    $UserID = $_SESSION["UserID"];
    $BookID = $_GET['id'];
} else {
    $UserID = "null";
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookID = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM books WHERE BookID = ?");
    $stmt->execute([$bookID]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: home.php");
    exit();
}

$title = $book['Title'];
$description = $book['Description'];
$category = $book['Category'];
$cover = $book['Cover'];
$views = $book['Views'];
$date = $book['Date'];
$url = $book['Url'];

$bookKey = 'book_' . $bookID;
if (!isset($_COOKIE[$bookKey])) {
    $stmt = $conn->prepare("UPDATE books SET Views = Views + 1 WHERE BookID = ?");
    $stmt->execute([$bookID]);

    setcookie($bookKey, 'viewed', time() + (86400 * 1), "/"); // 86400 seconds * 1 day = 1 day
}

$stmt = $conn->prepare("SELECT interactions.*, users.FullName, users.Avatar FROM interactions JOIN users ON interactions.UserIDF = users.UserID WHERE BookIDF = ?");
$stmt->execute([$bookID]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/view-book.css">
</head>
<body>
    <div class="container">
        <div class="book-details">
            <div class="book-cover">
                <?php if (!empty($cover)) : ?>
                    <img src="assets/images/books/<?php echo $cover; ?>" alt="Book Cover">
                <?php else : ?>
                    <img src="assets/images/books/nocover.png" alt="Book Cover">
                <?php endif; ?>
            </div>
            <div class="book-description">
                <h1><i class="ri-edit-line"></i><?php echo $title; ?></h1><br>
                <div><i class="ri-file-text-fill"></i> <?php echo $description; ?></div>
                <div><i class="ri-book-2-fill"></i> <?php echo $category; ?></div>
                <div><i class="ri-eye-fill"></i> <?php echo $views; ?></div>
                <div><i class="ri-calendar-fill"></i> <?php echo $date; ?></div>
                <div><a href="<?php echo $url; ?>" class="button"><i class="ri-external-link-fill"></i>View Book</a></div>
            </div>
        </div>
        <div class="container-comment">
            <form autocomplete="off" enctype="multipart/form-data" action="" method="post">
                <input type="hidden" id="userid" name="userid" value="<?php echo $UserID; ?>">
                <input type="hidden" id="bookid" name="bookid" value="<?php echo $BookID; ?>">
                <div class="input-container">
                    <i class="ri-message-3-fill" id="txt"></i>
                    <textarea id="comment" name="comment" placeholder="Your Comment" required></textarea>
                </div>
                <button type="submit" onclick="AddComment('addcomment')" class="btn"><i class="ri-send-plane-fill"></i>&nbsp;Send</button>
            </form>
        </div>
        <div class="users">
            <?php foreach ($comments as $comment) : ?>
                <div class="user-comment">
                    <div class="avatar">
                        <?php if (!empty($comment['Avatar'])) : ?>
                            <img src="assets/images/avatars/<?php echo $comment['Avatar']; ?>" alt="User Avatar">
                        <?php else : ?>
                            <img src="assets/images/avatars/avatar.png" alt="User Avatar">
                        <?php endif; ?>
                    </div>
                    <div class="user-details">
                        <div class="fullname"><i class="ri-user-fill"></i> <?php echo $comment["FullName"]; ?></div>
                        <div class="comment"><i class="ri-chat-3-fill"></i> <?php echo $comment["Comment"]; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include 'assets/js/script_book.php'; ?>
</body>
</html>