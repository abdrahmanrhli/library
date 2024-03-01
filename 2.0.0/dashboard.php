<?php

function getTotal1($conn, $table) {
    $query = "SELECT COUNT(*) FROM $table";
    $result = $conn->query($query);
    return $result->fetch(PDO::FETCH_COLUMN);
}
function getTotal2($conn, $column, $table) {
    $query = "SELECT SUM($column) FROM $table";
    $result = $conn->query($query);
    return $result->fetch(PDO::FETCH_COLUMN);
}

function getTopViewedBooks($conn, $limit = 4) {
    $query = "SELECT * FROM books ORDER BY Views DESC LIMIT $limit";
    $stmt = $conn->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

include('config.php');
get_data();
session_admin();

$totalUsers = getTotal1($conn, 'users');
$totalBooks = getTotal1($conn, 'books');
$totalComments = getTotal1($conn, 'interactions');
$totalViews = getTotal2($conn, 'Views', 'books');
$topViewedBooks = getTopViewedBooks($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css --> 
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
<?php include 'include/nav-admin.php'; ?>
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
                        // echo '<a href="' . $row["Url"] . '">';
                        echo '<img class="d-block w-100" src="assets/images/covers/' . $row["Cover"] . '" alt="Cover Image">';
                        // echo '</a>';
                        echo '<a href="manage-covers.php" class="button"><i class="ri-image-edit-line"></i></a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="books-container">
    <h2 class="category-title"><i class="ri-bar-chart-fill"></i>Statistics</h2>
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="dashboard-box">
                        <h5><i class="ri-user-fill"></i> Users</h5>
                        <p><?php echo $totalUsers; ?></p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="dashboard-box">
                        <h5><i class="ri-book-2-fill"></i> Books</h5>
                        <p><?php echo $totalBooks; ?></p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="dashboard-box">
                        <h5><i class="ri-eye-2-fill"></i> Views</h5>
                        <p><?php echo $totalViews; ?></p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="dashboard-box">
                        <h5><i class="ri-chat-3-fill"></i> Comments</h5>
                        <p><?php echo $totalComments; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <div class="books-container">
        <h2 class="category-title"><i class="ri-eye-line"></i>Top Views</h2>
        <div class="books">
            <?php foreach ($topViewedBooks as $row) : ?>
                <div class="book">
                    <a href="view-book.php?id=<?php echo $row['BookID']; ?>">
                        <?php if (!empty($row['Cover'])) : ?>
                            <img class="book-cover" src="assets/images/books/<?php echo $row['Cover']; ?>" alt="Book Cover">
                        <?php else : ?>
                            <img class="book-cover" src="assets/images/books/nocover.png" alt="Book Cover">
                        <?php endif; ?>
                        <p class="book-title"><?php echo substr($row['Title'], 0, 20); ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
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