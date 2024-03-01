<?php
require 'config.php';

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
} elseif (isset($_SESSION["UserID"])) {
    $UserID = $_SESSION["UserID"];
}

$stmt = $conn->prepare("SELECT favorites.*, books.Title, books.Cover FROM favorites INNER JOIN books ON favorites.BookIDF = books.BookID WHERE favorites.UserIDF = ?");
$stmt->execute([$UserID]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorites</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/favorites.css">
</head>
<body>
<div class="container">
    <h1>Favorites</h1>
    <div class="book-container">
        <?php foreach ($rows as $row) : ?>
            <div class="book" id="<?php echo $row["FavID"]; ?>">
                <a href="view-book.php?id=<?php echo $row['BookIDF']; ?>">
                <div class="book-cover">
                    <?php if (!empty($row['Cover'])) : ?>
                        <img src="assets/images/books/<?php echo $row['Cover']; ?>" alt="Book Cover">
                    <?php else : ?>
                        <img src="assets/images/books/nobook.png" alt="Book Cover">
                    <?php endif; ?>
                </div>
                <div class="book-details">
                    <div><strong><?php echo $i++; ?></strong></div>
                    <div><strong><i class="ri-edit-line icon"></i> Title:</strong> <?php echo substr($row['Title'], 0, 20); ?>..</div>
                </a>
                </div>
                <div class="actions">
                    <button type="button" onclick="DeleteFavorites(<?php echo $row['FavID']; ?>);"><i class="ri-delete-bin-fill icon"></i>Delete</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php require 'assets/js/script_book.php'; ?>
</div>
</body>
</html>