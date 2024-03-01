<?php
require 'config.php';

if (isset($_POST["action"])) {
         if ($_POST["action"] == "signin") {
    signin();
  } else if ($_POST["action"] == "addbook") {
    addbook();
  } else if ($_POST["action"] == "editbook") {
    editbook();
  } else if ($_POST["action"] == "addcover") {
    addcover();
  } else if ($_POST["action"] == "deletecover") {
    deletecover();
  } else if ($_POST["action"] == "favorites") {
    favorites();
  } else if ($_POST["action"] == "deletefavorites") {
    deletefavorites();
  } else if ($_POST["action"] == "addcomment") {
    addcomment();
  } else if ($_POST["action"] == "deletebook") {
    deletebook();
  } else if ($_POST["action"] == "adduser") {
    adduser();
  } else if ($_POST["action"] == "edituser") {
    edituser();
  } else if ($_POST["action"] == "edituserme") {
    edituserme();
  } else if ($_POST["action"] == "deleteuser") {
    deleteuser();
  } else if ($_POST["action"] == "changepw") {
    changepw();
  } else if ($_POST["action"] == "deletemessage") {
    deletemessage();
  }
}

function sanitize($data) {
  global $conn;
  return htmlspecialchars(strip_tags($data), ENT_QUOTES, 'UTF-8');
}

function signin()
{
    global $conn;

    $loginIdentifier = sanitize($_POST["login_identifier"]);
    $password = sanitize($_POST["password"]);

    $query = "SELECT * FROM users WHERE (Username = :loginIdentifier OR Email = :loginIdentifier)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":loginIdentifier", $loginIdentifier, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (md5($password) === $result["Password"]) {
            session_start();
            $_SESSION["UserID"] = $result["UserID"];
            $_SESSION["Roll"] = $result["Roll"];
            $_SESSION["Username"] = $result["Username"];
            $_SESSION["Email"] = $result["Email"];
            $_SESSION["FullName"] = $result["FullName"];
            $_SESSION["Avatar"] = $result["Avatar"];

            echo ($result["Roll"] == 1) ? "admin" : "user";
            exit();
        } else {
            echo "Invalid password.";
            exit();
        }
    } else {
        $usernameCheckQuery = "SELECT * FROM users WHERE Username = :username";
        $emailCheckQuery = "SELECT * FROM users WHERE Email = :email";

        $checkStmt = function ($query, $param) use ($conn, $loginIdentifier) {
            $stmt = $conn->prepare($query);
            $stmt->bindParam($param, $loginIdentifier, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount() == 0;
        };

        if ($checkStmt($usernameCheckQuery, ":username") && $checkStmt($emailCheckQuery, ":email")) {
            echo "Invalid username/email.";
            exit();
        } elseif ($checkStmt($usernameCheckQuery, ":username")) {
            echo "Invalid username.";
            exit();
        } elseif ($checkStmt($emailCheckQuery, ":email")) {
            echo "Invalid email.";
            exit();
        }
    }
}

function addbook()
{
  global $conn;

  $title = trim(sanitize($_POST["title"]));
  $text = trim(sanitize($_POST["text"]));
  $category = $_POST["category"];
  $url = trim(sanitize($_POST["url"]));
  
  $cover = uploadImage('cover', 'assets/images/books/');

  $currentDate = date("Y-m-d");

  $query = "INSERT INTO books (Title, Description, Url, Category, Cover, Date)
            VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->execute([$title, $text, $url, $category, $cover, $currentDate]);

  echo "Inserted Successfully";
  exit;
}

function editbook()
{
    global $conn;

    $id = $_POST["id"];
    $title = trim(sanitize($_POST["title"]));
    $text = trim(sanitize($_POST["text"]));
    $category = $_POST["category"];
    $url = trim(sanitize($_POST["url"]));
    $cover = uploadImage('cover', 'assets/images/books/');

    if (!empty($cover)) {
        $coverQuery = "SELECT Cover FROM books WHERE BookID = ?";
        $coverStmt = $conn->prepare($coverQuery);
        $coverStmt->execute([$id]);
        $oldCoverFilename = $coverStmt->fetchColumn();

        if (!empty($oldCoverFilename)) {
            $oldCoverPath = "assets/images/books/" . $oldCoverFilename;
            if (file_exists($oldCoverPath)) {
                unlink($oldCoverPath);
            }
        }
    }

    $query = "UPDATE books SET Title = ?, Description = ?, Category = ?, Url = ?, Cover = ? WHERE BookID = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$title, $text, $category, $url, $cover, $id]);

    echo "Updated Successfully";
    exit;
}

function addcover()
{
  global $conn;

  session_start();
  $userid = $_SESSION["UserID"];
  $url = trim(sanitize($_POST["url"]));
  $cover = uploadImage('cover', 'assets/images/covers/');

  $query = "INSERT INTO covers (UserIDF, Cover, Url)
            VALUES (?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->execute([$userid, $cover, $url]);

  echo "Inserted Successfully";
  exit;
}

function deletecover()
{
  global $conn;

  $id = $_POST["id"];

  $coverQuery = "SELECT Cover FROM covers WHERE CoverID = ?";
  $coverStmt = $conn->prepare($coverQuery);
  $coverStmt->execute([$id]);
  $coverFilename = $coverStmt->fetchColumn();

  $query = "DELETE FROM covers WHERE CoverID = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$id]);

  if (!empty($coverFilename)) {
    $coverPath = "assets/images/covers/" . $coverFilename;
    if (file_exists($coverPath)) {
      unlink($coverPath);
    }
  }

  echo "Deleted Successfully";
  exit;
}

function favorites() {
  global $conn;

  $userId = $_POST['userid'];
  if ($userId === "null") { echo "login"; exit; }
  $bookId = $_POST['bookid'];

  $query = "SELECT * FROM favorites WHERE UserIDF = ? AND BookIDF = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$userId, $bookId]);
  $count = $stmt->rowCount();

  if ($count > 0) {
      $deleteQuery = "DELETE FROM favorites WHERE UserIDF = ? AND BookIDF = ?";
      $deleteStmt = $conn->prepare($deleteQuery);
      $deleteStmt->execute([$userId, $bookId]);
      echo "Book removed from favorites successfully";
      exit;
  } else {
      $insertQuery = "INSERT INTO favorites (UserIDF, BookIDF) VALUES (?, ?)";
      $insertStmt = $conn->prepare($insertQuery);
      $insertStmt->execute([$userId, $bookId]);
      echo "Book added to favorites successfully";
      exit;
  }
}

function deletefavorites() {
  global $conn;

  $id = $_POST["id"];

  $query = "DELETE FROM favorites WHERE FavID = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$id]);

  echo "Book removed from favorites successfully";
  exit;
}

function addcomment() {
  global $conn;

  $userId = $_POST['userid'];
  $bookId = $_POST['bookid'];
  $comment = trim(sanitize($_POST['comment']));

  $query = "INSERT INTO interactions (UserIDF, BookIDF, Comment, Date)
            VALUES (?, ?, ?, NOW())";
  $stmt = $conn->prepare($query);
  $stmt->execute([$userId, $bookId, $comment]);

  echo "Comment added successfully";
}

function deletebook()
{
  global $conn;

  $id = $_POST["id"];

  $coverQuery = "SELECT Cover FROM books WHERE BookID = ?";
  $coverStmt = $conn->prepare($coverQuery);
  $coverStmt->execute([$id]);
  $coverFilename = $coverStmt->fetchColumn();

  $query = "DELETE FROM books WHERE BookID = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$id]);

  // Delete the cover file from the filesystem
  if (!empty($coverFilename)) {
    $coverPath = "assets/images/books/" . $coverFilename;
    if (file_exists($coverPath)) {
      unlink($coverPath);
    }
  }

  echo "Deleted Successfully";
}

function isFieldExists($field, $value, $excludeId = null)
{
  global $conn;

  $query = "SELECT COUNT(*) FROM users WHERE $field = ?";
  $params = [$value];

  if ($excludeId !== null) {
    $query .= " AND UserID != ?";
    $params[] = $excludeId;
  }

  $stmt = $conn->prepare($query);
  $stmt->execute($params);
  return $stmt->fetchColumn() > 0;
}

function adduser()
{
  global $conn;

  $username = trim(sanitize($_POST["username"]));
  $email    = trim(sanitize($_POST["email"]));

  if (isFieldExists('Username', $username)) {
      echo "Username already exists";
      exit();
  } elseif (isFieldExists('Email', $email)) {
      echo "Email already exists";
      exit();
  }

  $password = trim(md5(sanitize($_POST["password"])));
  $fullname = trim(sanitize($_POST["fullname"]));
  $avatar   = uploadImage('avatar', 'assets/images/avatars/');
  $usertype = sanitize($_POST["usertype"]);

  $query = "INSERT INTO users (Username, Email, Password, FullName, Avatar, Roll) 
            VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->execute([$username, $email, $password, $fullname, $avatar, $usertype]);

  echo "Inserted Successfully";
}

function edituser()
{
  global $conn;

  $id = $_POST["id"];
  $username = trim(sanitize($_POST["username"]));
  $email    = trim(sanitize($_POST["email"]));

  if (isFieldExists('Username', $username, $id)) {
      echo "Username already exists";
      exit();
  } elseif (isFieldExists('Email', $email, $id)) {
      echo "Email already exists";
      exit();
  }

  $password = trim(md5(sanitize($_POST["password"])));
  $fullname = trim(sanitize($_POST["fullname"]));
  $usertype = sanitize($_POST["usertype"]);
  $avatar   = uploadImage('avatar', 'assets/images/avatars/');

  if (!empty($avatar)) {
    $avatarQuery = "SELECT Avatar FROM users WHERE UserID = ?";
    $avatarStmt = $conn->prepare($avatarQuery);
    $avatarStmt->execute([$id]);
    $oldAvatarFilename = $avatarStmt->fetchColumn();

    if (!empty($oldAvatarFilename)) {
        $oldAvatarPath = "assets/images/avatars/" . $oldAvatarFilename;
        if (file_exists($oldAvatarPath)) {
            unlink($oldAvatarPath);
        }
    }
  }

  $query = "UPDATE users SET Username = ?, Email = ?, Password = ?, FullName = ?, Avatar = ?, Roll = ? WHERE UserID = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$username, $email, $password, $fullname, $avatar, $usertype, $id]);
  
  echo "Updated Successfully";
}

function edituserme()
{
    global $conn;

    $id = $_POST["id"];
    $username = trim(sanitize($_POST["username"]));
    $email = trim(sanitize($_POST["email"]));
    $password = trim(sanitize($_POST["password"]));
    $fullname = trim(sanitize($_POST["fullname"]));
    $avatar = uploadImage('avatar', 'assets/images/avatars/');

    $check_query = "SELECT Password FROM users WHERE UserID = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->execute([$id]);
    $user = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if (md5($password) !== $user['Password']) {
        echo "Incorrect password";
        exit();
    }

    if (isFieldExists('Username', $username, $id)) {
        echo "Username already exists";
        exit();
    } elseif (isFieldExists('Email', $email, $id)) {
        echo "Email already exists";
        exit();
    }

    if (!empty($avatar)) {
        $avatarQuery = "SELECT Avatar FROM users WHERE UserID = ?";
        $avatarStmt = $conn->prepare($avatarQuery);
        $avatarStmt->execute([$id]);
        $oldAvatarFilename = $avatarStmt->fetchColumn();

        if (!empty($oldAvatarFilename)) {
            $oldAvatarPath = "assets/images/avatars/" . $oldAvatarFilename;
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }
    }

    $query = "UPDATE users SET Username = ?, Email = ?, FullName = ?, Avatar = ? WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$username, $email, $fullname, $avatar, $id]);

    session_start();
    
    $_SESSION["Username"] = $username;
    $_SESSION["Email"] = $email;
    $_SESSION["FullName"] = $fullname;
    $_SESSION["Avatar"] = $avatar;
    $_SESSION["UserID"] = $id;

    echo "Updated Successfully";
}

function deleteuser()
{
  global $conn;

  $id = $_POST["id"];

  $avatarQuery = "SELECT Avatar FROM users WHERE UserID = ?";
  $avatarStmt = $conn->prepare($avatarQuery);
  $avatarStmt->execute([$id]);
  $avatarFilename = $avatarStmt->fetchColumn();

  $query = "DELETE FROM users WHERE UserID = ?";
  $stmt = $conn->prepare($query);
  $stmt->execute([$id]);

  // Delete the avatar file from the filesystem
  if (!empty($avatarFilename)) {
    $avatarPath = "assets/images/avatars/" . $avatarFilename;
    if (file_exists($avatarPath)) {
      unlink($avatarPath);
    }
  }

  echo "Deleted Successfully";
}

function changepw()
{
    global $conn;
    
    session_start();
    $id = $_SESSION["UserID"];
    $oldPassword = trim(sanitize($_POST["old_password"]));
    $newPassword = trim(sanitize($_POST["new_password"]));
    $confirmPassword = trim(sanitize($_POST["confirm_password"]));

    $query = "SELECT Password FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (md5($oldPassword) !== $userData['Password']) {
        echo "Incorrect old password";
        exit();
    }

    // Check if the new password matches the confirm password
    if ($newPassword !== $confirmPassword) {
        echo "New password and confirm password do not match";
        exit();
    }

    // Update the password in the database
    $hashedNewPassword = md5($newPassword);
    $updateQuery = "UPDATE users SET Password = ? WHERE UserID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->execute([$hashedNewPassword, $id]);

    echo "Password changed successfully";
}

function uploadImage($file, $uploadPath)
{
  if (isset($_FILES[$file])) {
    $img_name = $_FILES[$file]['name'];
    $img_size = $_FILES[$file]['size'];
    $tmp_name = $_FILES[$file]['tmp_name'];
    $error = $_FILES[$file]['error'];

    if ($error === 0) {
      if ($img_size > 2000000) {
        echo "Image size should be less than 2MB.";
        exit();
      } else {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
          $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
          $img_upload_path = $uploadPath . $new_img_name;

          move_uploaded_file($tmp_name, $img_upload_path);

          return $new_img_name;
        } else {
          echo "You can't upload files of this type";
          exit();
        }
      }
    } else {
      echo "Unknown error occurred!";
      exit();
    }
  }

  return null; // If no image uploaded
}

function deletemessage() {
  global $conn;
  if (isset($_POST['id'])) {
      $message_id = $_POST['id'];
      $sql = "DELETE FROM messages WHERE MessageID = :id";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':id', $message_id, PDO::PARAM_INT);
      if ($stmt->execute()) {
          echo "Deleted Successfully";
      } else {
          echo "Error Deleting Message";
      }
  }
}

?>