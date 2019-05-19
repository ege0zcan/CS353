/**
* Created by PhpStorm.
* User: Yagiz
* Date: 05/20/2019
* Time: 01:20
*/

<?php
include("config.php");
session_start();
if (!empty($_SESSION))
{
    $_SESSION["jobID"] = "";
    $userID = $_SESSION["userID"];
    $sql = "SELECT * FROM comp_user NATURAL JOIN general_user WHERE user_ID = '$userID'";
    $result = mysqli_query($db,$sql);
    $compUser = mysqli_fetch_object($result);
    $name = $compUser->company_name;
    $desc = $compUser->description;
    $phone= $compUser->phone_no;
    $pplink =$compUser->pp_link;
    $email = $compUser->email;
}
else
{
    header("location: home.php");
}

$target_dir = "C:\Users\Yagiz\PhpstormProjects\CS353\code\php\images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
if ($_FILES["fileToUpload"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $uploaded_file = "images/" . basename($_FILES["fileToUpload"]["name"]);

        $sql = "UPDATE general_user SET pp_link = '$uploaded_file' WHERE user_ID = '$userID'";
        $result = mysqli_query($db,$sql);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
