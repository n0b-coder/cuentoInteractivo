<?php

require("vendor/autoload.php");

$IMG_Name = $_FILES['ImageToUpload']['name'];
$target_base_dir = $_SERVER['DOCUMENT_ROOT'].'/cuentoInteractivo/IMG_NEW/';
if(isset($_POST['tipoimagen']))
{
  $Folder = $_POST['tipoimagen'];
}
$target_dir = $target_base_dir.$Folder.'/';
$target_file = $target_dir . basename($_FILES["ImageToUpload"]["name"]);
echo $target_file;

$target_file_4_db = 'IMG_NEW/'.$Folder.'/'. basename($_FILES["ImageToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  echo "recibio el submit";
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
    } catch (exception $e) {
        echo "There was an error uploading the file.\n";
        var_dump($e);
    }

    echo "\n STEP 4 \n";

    if (move_uploaded_file($_FILES["ImageToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["ImageToUpload"]["name"]). " has been uploaded.";
      $nameimg = basename($_FILES["ImageToUpload"]["name"]);
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }



?>
