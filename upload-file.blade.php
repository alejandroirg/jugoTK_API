<?php
header('Access-Control-Allow-Origin: *');

$_POST["submit"] = 1;
$response["message"] = "";

$target_dir = "img/ingredientes/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $response["message"] = $response["message"] . "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $response["message"] = $response["message"] . "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $response["message"] = $response["message"] . "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $response["message"] = $response["message"] . "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $response["message"] = $response["message"] . "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $response["message"] = $response["message"] . "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $response["message"] = $response["message"] . "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $response["message"] = $response["message"] .  "Sorry, there was an error uploading your file.";
    }
}
$response["filename"] = $_FILES["fileToUpload"]["name"];
$response["status"] = 1;

echo json_encode($response);