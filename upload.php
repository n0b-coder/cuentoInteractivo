<?php

require("vendor/autoload.php");
require_once("Conexion.php");



if(isset($_POST["submit"])) 
{
  echo "recibio el submit    ";
  $IMG_Name = $_FILES['ImageToUpload']['name'];
  echo $IMG_Name;
  $IMG_Name2 =  basename($_FILES["ImageToUpload"]["name"]);
  $Type = $_POST['tipoimagen'];
  $Id_IMG = $_POST['id_imagen'];
  $Action = $_POST['accion'];
  $imageFileType = strtolower(pathinfo($IMG_Name2,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["ImageToUpload"]["tmp_name"]);
    if($check !== false)
    {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } 
    else 
    {
      echo "File is not an image.";
      $uploadOk = 0;
    }

    // Check if file already exists
    if($Type == "finales" || $Type == "facertijo" || $Type == "portada" || $Type == "historia" || $Type == "indagacion" || $Type == "post_resol" || $Type == "torre") 
    {
      $TypeNumber = 0;
      $consulta= "SELECT * FROM `fondos` WHERE `Name` LIKE '$IMG_Name2'";
    }
    if($Type == "personaje") 
    {
      $TypeNumber = 1;
      $consulta= "SELECT * FROM `personajes` WHERE `name` LIKE '$IMG_Name2'";
    }
    if($Type == "acertijo") 
    {
      $TypeNumber = 2;
      $consulta= "SELECT * FROM `acertijo` WHERE `Name_acertijo` LIKE  '$IMG_Name2'";
      $res =  $conn->query($consulta);
      if($res->num_rows>0)
      {
        $row=$res->fetch_assoc();
        $fondo_a = $row['Fondo_acertijo'];
        $sol = $row['Solucion'];
      }
    }
    $result = mysqli_query( $conn,$consulta);
    $filas = mysqli_num_rows($result);
    if($filas == 0)
    { echo "New Image";
    }
    else
    { $uploadOk = 0; echo "Sorry, file already exists."; }

    // Check file size
  if ($_FILES["ImageToUpload"]["size"] > 3000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }



    // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    echo "\n STEP 1 \n";

    try {

    $s3 = new Aws\S3\S3Client([
        'version'  => 'latest',
        'region'   => 'us-east-1',
    ]);
    echo "\n STEP 2 \n";

    $bucket = getenv('S3_BUCKET');
    // $upload = $s3->upload($bucket, $_FILES['ImageToUpload']['name'], fopen($_FILES['ImageToUpload']['tmp_name'], 'rb'), 'public-read');

    echo "\n STEP 3 \n";

        $upload = $s3->putObject([
            'Bucket' => $bucket,
            'Key'    => $_FILES['ImageToUpload']['name'],
            'Body'   => fopen($_FILES['ImageToUpload']['tmp_name'], 'rb'),
            'ACL'    => 'public-read',
        ]);
        echo "\nuploaded file \n";

        $url = $upload->get('ObjectURL');
        echo "\nuploaded file to URL:$url\n";
        $uploadOk = 3;
    } catch (exception $e) {
        echo "There was an error uploading the file. $e.message \n";
    }
  }
  if ($uploadOk == 3) {

    if($Action == 1)
    {
      if($TypeNumber == 0) 
      {
        $consulta= "UPDATE `fondos` SET `Name`= '$IMG_Name' ,`fondo_img`= '$url' WHERE  'Id_fondo' = '$Id_IMG'";   
      }
      if($TypeNumber == 1) 
      {
        $consulta= "UPDATE `personajes` SET `name`= '$IMG_Name' ,`image_personaje`= '$url' WHERE `Id_im_personaje`= '$Id_IMG'";
      }
      if($TypeNumber == 2)
      {
        $consulta= "UPDATE `acertijo` SET `Name_acertijo` = '$IMG_Name',`Image_acertijo`='$url' WHERE `Id_acertijo`= '$Id_IMG'";    
      }
      if ($conn->query($consulta) === TRUE) {
        echo "Record updated successfully ";
      } 
      else {
        echo "Error updating Image in: " . $conn->error;
      } 
    }



    if($Action==2)
    {
      if($TypeNumber == 0) 
      {
        $sql = "INSERT INTO `fondos`(`Id_fondo`, `Name`, `fondo_img`, `Type`) VALUES (NULL,'$IMG_Name','$url','$Type')";
      }
      if($TypeNumber == 1) 
      {
        $sql = "INSERT INTO `personajes`(`Id_im_personaje`, `name`, `image_personaje`, `id_personaje`) VALUES (NULL,'$IMG_Name','$url','1')";
      }
      if($TypeNumber == 2)
      {
        $sql = "INSERT INTO `acertijo`(`Id_acertijo`, `Name_acertijo`, `Image_acertijo`, `Fondo_acertijo`, `Solucion`) VALUES (NULL,'$IMG_Name','$url',$fondo_a,$sol)";     
      }


      if (mysqli_query($conn, $sql)) 
      {
        echo "New record created successfully";
      } 
      else 
      {
        echo "Error creating New: " . $sql . "<br>" . mysqli_error($conn);
      }
    }

  } 

  mysqli_close($conn);
  }

?>


