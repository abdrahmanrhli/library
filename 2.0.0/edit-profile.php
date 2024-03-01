<?php
require 'config.php';

session_start();

if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION["UserID"];
$roll = $_SESSION["Roll"];
$username = $_SESSION["Username"];
$email = $_SESSION["Email"];
$avatar = $_SESSION["Avatar"];
$fullname = $_SESSION["FullName"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/edit-profile.css">
</head>
<body>
  <div class="container">
      <h1>Edit Profile</h1>
      <form autocomplete="off" enctype="multipart/form-data" action="" method="post">
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
          <div class="input-container">
              <i class="ri-user-fill"></i>
              <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>
          </div>
          <div class="input-container">
              <i class="ri-mail-fill"></i>
              <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
          </div>
          <div class="input-container">
              <i class="ri-user-fill"></i>
              <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>" required>
          </div>
          <div class="input-container">
              <i class="ri-lock-password-fill"></i>
              <input type="password" id="password" name="password" placeholder="Your Password" required>
          </div>
          <div class="input-container">
              <label for="avatar" class="upload-button"><i class="ri-image-add-fill" style="color: #ffffff;"></i><span class="ptn-upload">Upload Avatar</span></label>
              <input type="file" id="avatar" name="avatar" style="display: none;">
          </div>
          <button type="button" onclick="EditUserMe('edituserme');" class="btn"><i class="ri-user-add-fill" style="margin-right: 5px;"></i> Save Changes</button>
      </form>
      <br>
      <a href="profile.php" style="color: #ff6456; border-bottom: none;"><i class="ri-arrow-left-line" style="margin-right: 5px;"></i> Profile</a>
      <?php require 'assets/js/script_user.php'; ?>
  </div>
</body>
</html>