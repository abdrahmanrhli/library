<?php
include('config.php');
get_data();
session_admin();

$stmt = $conn->query("SELECT * FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/manage-users.css">
</head>
<body>
<?php include 'include/nav-admin.php'; ?>
<div class="container">
    <h1>Manage Users</h1>
    <div class="add-user-link">
        <a href="add-user.php" class="add"><i class="ri-user-add-fill"></i> Add User</a>
    </div>
    <div class="users-container">
        <?php foreach ($rows as $row) : ?>
            <div class="user" id="<?php echo $row["UserID"]; ?>">
                <div class="avatar">
                    <?php if (!empty($row['Avatar'])) : ?>
                        <img src="assets/images/avatars/<?php echo $row['Avatar']; ?>" alt="User Avatar">
                    <?php else : ?>
                        <img src="assets/images/avatars/avatar.png" alt="User Avatar">
                    <?php endif; ?>
                </div>
                <div class="user-details">
                    <div class="fullname"><i class="ri-user-fill"></i> <?php echo $row["FullName"]; ?></div>
                    <div class="username"><i class="ri-user-line"></i> <?php echo "@" . $row["Username"]; ?></div>
                    <div class="user-type"><i class="ri-admin-line"></i> <?php echo $row["Roll"] == "0" ? "No Admin" : "Admin"; ?></div>
                </div>
                <div class="actions">
                    <a href="edit-user.php?id=<?php echo $row['UserID']; ?>" class="edit" ><i class="ri-pencil-fill"></i> Edit</a>
                    <button type="button" class="delete" onclick="deleteUser(<?php echo $row['UserID']; ?>);"><i class="ri-delete-bin-fill"></i> Delete</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php require 'assets/js/script_user.php'; ?>
<?php include 'assets/js/script_navbar.php'; ?>
</body>
</html>