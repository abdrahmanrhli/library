<?php
include('config.php');
get_data();
session_admin();

$stmt = $conn->query("SELECT * FROM covers");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$i = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Covers</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/manage-covers.css">
</head>
<body>
<?php include 'include/nav-admin.php'; ?>
    <div class="container">
        <h1>Manage Covers</h1>
        <a href="add-cover.php" class="add"><i class="ri-image-add-fill icon"></i> Add Cover</a>
        <?php foreach ($rows as $row) : ?>
            <div class="content" id="<?php echo $row["CoverID"]; ?>">
                <?php if (!empty($row['Cover'])) : ?>
                    <a href="<?php echo $row['Url']; ?>"><img src="assets/images/covers/<?php echo $row['Cover']; ?>" alt="Cover"></a>
                <?php else : ?>
                    <img src="assets/images/covers/nocover.png" alt="Cover">
                <?php endif; ?>
                <button type="button" class="delete" onclick="DeleteCover(<?php echo $row['CoverID']; ?>);"><i class="ri-delete-bin-fill icon"></i> Delete</button>
            </div>
        <?php endforeach; ?>
    </div>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include 'assets/js/script_book.php'; ?>
<?php include 'assets/js/script_navbar.php'; ?>
</body>
</html>