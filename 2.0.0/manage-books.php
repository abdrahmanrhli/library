<?php
include('config.php');
get_data();
session_admin();

$stmt = $conn->query("SELECT * FROM books");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/manage-books.css">
</head>
<body>
<?php include 'include/nav-admin.php'; ?>
<div class="container">
    <h1>Manage Books</h1>
    <div style="text-align: left; margin-bottom: 20px;">
        <a href="add-book.php" class="add"><i class="ri-add-line icon"></i>Add Book</a>
    </div>
    <div class="book-container">
        <?php foreach ($rows as $row) : ?>
            <div class="book" id="<?php echo $row["BookID"]; ?>">
                <div class="book-cover">
                    <?php if (!empty($row['Cover'])) : ?>
                        <img src="assets/images/books/<?php echo $row['Cover']; ?>" alt="Book Cover">
                    <?php else : ?>
                        <img src="assets/images/books/nobook.png" alt="Book Cover">
                    <?php endif; ?>
                </div>
                <div class="book-details">
                    <div><strong><?php echo $i++; ?></strong></div>
                    <div><strong><i class="ri-edit-line icon"></i> Title:</strong> <?php echo $row["Title"]; ?></div>
                    <div><strong><i class="ri-file-text-line icon"></i> Description:</strong> <?php echo substr($row['Description'], 0, 20); ?>...</div>
                    <div><strong><i class="ri-book-2-line icon"></i> Category:</strong> <?php echo $row["Category"]; ?></div>
                </div>
                <div class="actions">
                    <a href="view-book.php?id=<?php echo $row['BookID']; ?>" class="open"><i class="ri-book-open-fill icon"></i>Open</a>
                    <a href="edit-book.php?id=<?php echo $row['BookID']; ?>" class="edit"><i class="ri-pencil-fill icon"></i>Edit</a>
                    <button type="button" onclick="DeleteBook(<?php echo $row['BookID']; ?>);" class="delete"><i class="ri-delete-bin-fill icon"></i>Delete</button>
                </div>
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