<?php
require 'config.php';

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION["Roll"] == 0) {
    header("Location: books.php");
    exit();
}

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT * FROM users WHERE UserID = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/edit-user.css">
</head>
<body>
  <div class="container">
      <h1>Edit User</h1>
      <form autocomplete="off" enctype="multipart/form-data" action="" method="post">
          <input type="hidden" id="id" name="id" value="<?php echo $rows['UserID']; ?>">
          <div class="input-container">
              <i class="ri-user-fill"></i>
              <input type="text" id="username" name="username" value="<?php echo $rows['Username']; ?>" required>
          </div>
          <div class="input-container">
              <i class="ri-mail-fill"></i>
              <input type="email" id="email" name="email" value="<?php echo $rows['Email']; ?>" required>
          </div>
          <div class="input-container">
              <i class="ri-user-fill"></i>
              <input type="text" id="fullname" name="fullname" value="<?php echo $rows['FullName']; ?>" required>
          </div>
          <div class="input-container">
              <i class="ri-lock-password-fill"></i>
              <input type="password" id="password" name="password" placeholder="Your Password" required>
          </div>
          <div class="input-container">
              <i class="ri-admin-fill"></i>
              <select id="usertype" name="usertype">
                  <option value="0" <?php if ($rows["Roll"] == "0") echo "selected"; ?>>No Admin</option>
                  <option value="1" <?php if ($rows["Roll"] == "1") echo "selected"; ?>>Admin</option>
              </select>
          </div>
          <div class="input-container">
          <label for="avatar" class="upload-button"><i class="ri-image-add-fill" style="color: #ffffff;"></i><span class="ptn-upload">Upload Avatar</span></label>
              <input type="file" id="avatar" name="avatar" style="display: none;">
          </div>
          <button type="button" onclick="submitData('edituser')"; class="btn"><i class="ri-user-add-fill" style="margin-right: 5px;"></i> Edit</button>
      </form>
      <br>
      <a href="manage-users.php" style="color: #ff6456; border-bottom: none;"><i class="ri-arrow-left-line" style="margin-right: 5px;"></i> Manage Users</a>
      <?php require 'assets/js/script_user.php'; ?>
  </div>
</body>
</html>