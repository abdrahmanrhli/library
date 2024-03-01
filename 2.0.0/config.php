<?php
$host = "localhost";
$dbname = "library";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

function session_admin() {
  if (!isset($_SESSION["UserID"])) {
      header("Location: login.php");
      exit();
  } elseif ($_SESSION["Roll"] == 0) {
      header("Location: books.php");
      exit();
  }
}

function session_user_log() {
  if (!isset($_SESSION["UserID"])) {
    header("Location: login.php");
    exit();
  }
}

function session_user() {
  session_start();
  if (isset($_SESSION["UserID"])) {
      $UserID = $_SESSION["UserID"];
  } else {
      $UserID = "null";
  }
}



function get_data() {
  session_start();
  if (isset($_SESSION["UserID"]) && isset($_SESSION["Roll"])) {
    global $suserid, $sroll, $susername, $semail, $sfullname, $savatar;
    $suserid = $_SESSION["UserID"];
    $sroll = $_SESSION["Roll"];
    $susername = $_SESSION["Username"];
    $semail = $_SESSION["Email"];
    $sfullname = $_SESSION["FullName"];
    $savatar = $_SESSION["Avatar"];
  } else {
    $suserid = "null";
  }
}

?>