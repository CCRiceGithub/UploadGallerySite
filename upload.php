<!DOCTYPE html>
<title>File Upload</title>
<?php

if ( file_get_contents("maintenanceStatus.txt") == "true" && $_SERVER['REMOTE_ADDR'] != "127.0.0.1" ) {
  header("Location: /maintenance");
  exit;
}

if($_SERVER['REMOTE_ADDR']=="127.0.0.1")
{
  error_reporting(1);
}
else
{
  error_reporting(0);
}

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".\t\n<br>\t\n";
    $uploadOk = 1;
  } else {
    echo "File is not an image.\t\n<br>\t\n";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.\t\n<br>\t\n";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 900000) { //was originally 500000b (500kb)
  echo "Sorry, your file is too large.\t\n<br>\t\n";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "svg" ) {
  echo "Sorry, only JPG, JPEG, PNG, GIF & SVG files are allowed.\t\n<br>\t\n";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.\t\n<br>\t\n";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.\t\n<br>\t\n";
  } else {
    echo "Sorry, there was an error uploading your file.\t\n<br>\t\n";
  }
}
?>