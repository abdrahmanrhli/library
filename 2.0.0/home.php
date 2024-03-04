<?php
require 'config.php';

get_data();
if (isset($_SESSION["UserID"])) {
    $UserID = $_SESSION["UserID"];
} else {
    $UserID = "null";
}


$newBooksQuery = "SELECT * FROM books WHERE Date >= DATE_SUB(NOW(), INTERVAL 1 WEEK) LIMIT 10";
$stmtNewBooks = $conn->query($newBooksQuery);
$rowsNewBooks = $stmtNewBooks->fetchAll(PDO::FETCH_ASSOC);

function getCategoryBooks($conn, $category) {
    $query = "SELECT * FROM books WHERE Category = :category ORDER BY Views DESC LIMIT 10";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category', $category);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Home</title>
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
<div class="space"></div>
<div class="container">
    <div class="cover-container">
            <div class="cover">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    $coversQuery = "SELECT * FROM covers";
                    $stmtCovers = $conn->query($coversQuery);
                    $rowsCovers = $stmtCovers->fetchAll(PDO::FETCH_ASSOC);

                    $active = "active";
                    for ($i = 0; $i < count($rowsCovers); $i++) {
                        echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $i . '" class="' . ($i == 0 ? $active : '') . '"></li>';
                        $active = '';
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    foreach ($rowsCovers as $row) {
                        echo '<div class="carousel-item ' . ($row == $rowsCovers[0] ? "active" : "") . '">';
                        echo '<a href="' . $row["Url"] . '">';
                        echo '<img class="d-block w-100" src="assets/images/covers/' . $row["Cover"] . '" alt="Cover Image">';
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
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
    </div>
    <div class="books-container">
        <h2 class="category-title"><i class="fa-solid fa-jet-fighter-up"></i>New Books</h2>
        <div class="books">
            <?php foreach ($rowsNewBooks as $row) : ?>
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
    <div class="books-container">
        <h2 class="category-title"><i class="ri-bookmark-line"></i>Literature</h2>
        <div class="books">
            <?php foreach (getCategoryBooks($conn, 'Literature') as $row) : ?>
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
        <a href="category/literature.php">Show More</a>
    </div>

    <div class="books-container">
        <h2 class="category-title"><i class="ri-bookmark-line"></i>Science</h2>
        <div class="books">
            <?php foreach (getCategoryBooks($conn, 'Science') as $row) : ?>
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
        <a href="category/science.php">Show More</a>
    </div>

    <div class="books-container">
        <h2 class="category-title"><i class="ri-bookmark-line"></i>Biography and Memoir</h2>
        <div class="books">
            <?php foreach (getCategoryBooks($conn, 'Biography and Memoir') as $row) : ?>
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
        <a href="category/biography-and-memoir.php">Show More</a>
    </div>

    <div class="books-container">
        <h2 class="category-title"><i class="ri-bookmark-line"></i>Politics</h2>
        <div class="books">
            <?php foreach (getCategoryBooks($conn, 'Politics') as $row) : ?>
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
        <a href="category/politics.php">Show More</a>
    </div>

    <div class="books-container">
        <h2 class="category-title"><i class="ri-bookmark-line"></i>Philosophy</h2>
        <div class="books">
            <?php foreach (getCategoryBooks($conn, 'Philosophy') as $row) : ?>
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
        <a href="category/philosophy.php">Show More</a>
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