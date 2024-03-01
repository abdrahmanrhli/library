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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <!-- icon -->
    <link rel="stylesheet" href="assets/lib/icon/remixicon/remixicon.css">
    <link rel="stylesheet" href="assets/lib/icon/fontawesome-free-6.5.1-web/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/add-book.css">
</head>
<body>
  <div class="container">
      <h1>Add Book</h1>
      <form autocomplete="off" enctype="multipart/form-data" action="" method="post">
          <div class="input-container">
              <i class="ri-edit-fill"></i>
              <input type="text" id="title" name="title" value="" placeholder="Title">
          </div>
          <div class="input-container">
              <i class="ri-links-fill"></i>
              <input type="text" id="url" name="url" value="" placeholder="URL">
          </div>
          <div class="input-container">
              <i class="ri-book-2-fill"></i>
              <select id="category" name="category">
                <option value="Literature">Literature</option>
                <option value="Science">Science</option>
                <option value="Biography and Memoir">Biography and Memoir</option>
                <option value="Politics">Politics</option>
                <option value="Philosophy">Philosophy</option>
            </select>
          </div>
          <div class="input-container">
                <i class="ri-file-text-fill" id="txt"></i>
                <textarea type="text" id="text" name="text" placeholder="Description"></textarea>
          </div>
          <div class="input-container">
              <label for="cover" class="upload-button"><i class="ri-image-add-fill" style="color: #ffffff;"></i><span class="ptn-upload">Upload Cover</span></label>
              <input type="file" id="cover" name="cover" style="display: none;">
          </div>
          <button type="button" onclick="submitData('addbook');" class="btn"><i class="ri-contacts-book-upload-fill icon"></i> Insert</button>
      </form>
      <br>
      <a href="manage-books.php" style="color: #ff6456; border-bottom: none;"><i class="ri-arrow-left-line icon"></i> Manage Book</a>
      <?php require 'assets/js/script_book.php'; ?>
  </div>
</body>
</html>