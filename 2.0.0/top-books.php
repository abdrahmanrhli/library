<?php
require 'config.php';

get_data();
if (isset($_SESSION["UserID"])) {
    $UserID = $_SESSION["UserID"];
} else {
    $UserID = "null";
}

function getCategoryBooks($conn) {
    try {
        $stmt = $conn->prepare("
            SELECT b.BookID, b.Title, b.Cover, 
            COUNT(i.IntID) AS Interactions,
            SUM(i.LikeStatus) AS TotalLikes,
            COUNT(i.Comment) AS TotalComments,
            b.Views
            FROM books b
            LEFT JOIN interactions i ON b.BookID = i.BookIDF
            GROUP BY b.BookID, b.Title, b.Cover, b.Views
            ORDER BY Interactions DESC, TotalLikes DESC, TotalComments DESC, b.Views DESC
        ");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return array();
    }
}

function generateFavoriteButton($conn, $UserID, $BookID) {
    $query = "SELECT * FROM favorites WHERE UserIDF = :userid AND BookIDF = :bookid";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userid', $UserID);
    $stmt->bindParam(':bookid', $BookID);
    $stmt->execute();
    $count = $stmt->rowCount();

    $iconClass = ($count > 0) ? 'ri-heart-fill' : 'ri-heart-line';
    
    $buttonHTML = '
    <button type="button" class="favorites" onclick="Favorites(\'favorites\', ' . $UserID . ', ' . $BookID . ')">
        <i id="icon_' . $BookID . '" class="' . $iconClass . '"></i>
    </button>';

    echo $buttonHTML;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Books</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/navbar.css">

</head>
<body>
<?php include 'include/nav-user.php'; ?>
<div class="container">
    <div class="books-container">
        <h2 class="category-title"><i class="ri-fire-line"></i>Top Books</h2>
        <div class="books">
        <?php foreach (getCategoryBooks($conn) as $row) : ?>
                <div class="book">
                    <a href="view-book.php?id=<?php echo $row['BookID']; ?>">
                        <?php if (!empty($row['Cover'])) : ?>
                            <img class="book-cover" src="assets/images/books/<?php echo $row['Cover']; ?>" alt="Book Cover">
                        <?php else : ?>
                            <img class="book-cover" src="assets/images/books/nocover.png" alt="Book Cover">
                        <?php endif; ?>
                        <p class="book-title"><?php echo substr($row['Title'], 0, 20); ?></p>
                    </a>
                    <?php generateFavoriteButton($conn, $UserID, $row['BookID']); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include 'assets/js/script_book.php'; ?>
<?php include 'assets/js/script_navbar.php'; ?>
</body>
</html>