<?php
require 'config.php';

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/change-password.css">
</head>
<body>
  <div class="container">
      <h1>Change Password</h1>
      <form autocomplete="off" enctype="multipart/form-data" action="" method="post">
          <div class="input-container">
              <i class="ri-lock-password-fill"></i>
              <input type="password" id="old_password" name="old_password" placeholder="Old Password" required>
          </div>
          <div class="input-container">
              <i class="ri-lock-password-fill"></i>
              <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
          </div>
          <div class="input-container">
              <i class="ri-lock-password-fill"></i>
              <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
          </div>
          <button type="button" onclick="ChangePw('changepw');" class="btn"><i class="ri-user-add-fill" style="margin-right: 5px;"></i> Save Changes</button>
      </form>
      <br>
      <a href="profile.php" style="color: #ff6456; border-bottom: none;"><i class="ri-arrow-left-line" style="margin-right: 5px;"></i> Profile</a>
      <?php require 'assets/js/script_user.php'; ?>
  </div>
</body>
</html>