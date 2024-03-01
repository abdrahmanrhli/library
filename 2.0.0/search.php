<?php
require 'config.php';

session_user();

if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];

    $stmt = $conn->prepare("SELECT * FROM books WHERE Title LIKE ?");
    $stmt->execute(["%$search%"]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        $stmt = $conn->prepare("SELECT * FROM books WHERE Description LIKE ?");
        $stmt->execute(["%$search%"]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/search.css">
</head>
<body>
<div class="container">
        <h1>Search</h1>
        <div class="input-container">
            <input type="search" id="search" name="search" value="<?php echo $search ?>" required>
            <button type="button" onclick="Search();"><i class="ri-search-eye-line"></i> Search</button>
        </div>
        <div class="book-container">
            <?php foreach ($rows as $row) : ?>
                <a href="view-book.php?id=<?php echo $row['BookID']; ?>">
                <div class="book">
                        <div class="book-cover">
                            <img src="assets/images/books/<?php echo $row['Cover']; ?>" alt="Book Cover">
                        </div>
                        <div class="book-details">
                            <div><strong>Title:</strong> <?php echo $row['Title']; ?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        if (empty($rows)) {
            echo "<div style='text-align: center; color: red;'>No books found matching your search</div>";
        }
        ?>
    </div>
    <?php include 'assets/js/script_navbar.php'; ?>
</body>
</html>