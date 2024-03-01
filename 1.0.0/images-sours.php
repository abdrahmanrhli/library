<?php
  require 'config.php';
 
  $msg = "";
  if (isset($_POST['upload'])) {
  	$image = $_FILES['image']['name'];
  	$image_text = mysqli_real_escape_string($con, $_POST['image_text']);
  	$target = "upload/".basename($image);
 
  	$sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
  	mysqli_query($con, $sql);
 
  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  	$msg = "Image uploaded successfully";
  	}else{
  	$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($con, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<style type="text/css">
 
   #content{
   width: 50%;
   margin: 20px auto;
   border: 1px solid #cbcbcb;
   }
   form{
   width: 50%;
   margin: 20px auto;
   }
   form div{
   margin-top: 5px;
   }
   #img_div{
   width: 80%;
   padding: 5px;
   margin: 15px auto;
   border: 1px solid #cbcbcb;
	    background: #767272;
	   color: white;
   }
   #img_div:after{
   content: "";
   display: block;
   clear: both;
	  
   }
   img{
   float: left;
   margin: 5px;
   width: 300px;
   height: 140px;
   }
</style>
</head>
<body>
<div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
          echo "<p>".$row['image_text']."</p>";
          echo "<img src='upload/".$row['images']."' >";
         
      echo "</div>";
  ?>
  <form  method="POST" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
  	  <input type="file" name="image">
  	</div>
  	<div>
      <textarea 
      	id="text" 
      	cols="40" 
      	rows="4" 
      	name="image_text" 
      	placeholder="What's In Your Mind?"></textarea>
  	</div>
  	<div>
  	<button type="submit" name="upload">Upload</button>
  	</div>
  </form>
</div>
</body>
</html>