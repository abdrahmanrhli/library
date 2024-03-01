<?php
require 'config.php';
get_data();
session_user_log()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/profile.css">
    <!-- style css -->
</head>
<body>
  <div class="container">
      <h1>Profile</h1>
        <img src="<?php echo "assets/images/avatars/" . $savatar; ?>" alt="Profile Picture" class="profile-image">
        <h2 class="fullname"><?php echo $sfullname; ?></h2>
      <div class="info-container">
          <i class="ri-user-fill"></i>
          <h3><?php echo $susername; ?></h3>
      </div>
      <div class="info-container">
          <i class="ri-mail-fill"></i>
          <h3><?php echo $semail; ?></h3>
      </div>
      <?php if ($sroll == 1) : ?>
        <div class="info-container">
            <i class="ri-admin-fill"></i>
            <h3>Admin</h3>
        </div>
      <?php endif; ?>
      <a href="edit-profile.php" class="btn"><i class="ri-user-settings-fill"></i><span>Edit</span></a>
      <a href="change-password.php" class="btn" style="margin-top: 10px;"><i class="ri-lock-fill"></i><span>Change Password</span></a>
  </div>
</body>
</html>