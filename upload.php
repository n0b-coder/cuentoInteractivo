<?php

$IMG_Name = $_FILES['ImageToUpload']['name'];
$target_base_dir = $_SERVER['DOCUMENT_ROOT'].'/cuentoInteractivo/IMG_NEW/';
if(isset($_POST['tipoimagen']))
{
  $Folder = $_POST['tipoimagen'];
}
$target_dir = $target_base_dir.$Folder.'/';
$target_file = $target_dir . basename($_FILES["ImageToUpload"]["name"]);


$target_file_4_db = 'IMG_NEW/'.$Folder.'/'. basename($_FILES["ImageToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  echo "pinche kk mala";
    $check = getimagesize($_FILES["ImageToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
  
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["ImageToUpload"]["size"] > 3000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["ImageToUpload"]["tmp_name"], $target_file)) {
      $nameimg = basename($_FILES["ImageToUpload"]["name"]);
      $sql= "INSERT INTO fondos (`Id_fondo`, `Name`, `fondo_img`, `Type`) VALUES (NULL,'$nameimg','$target_file_4_db','$Folder');";
        require_once("Conexion.php");
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);


    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  

  

?>

