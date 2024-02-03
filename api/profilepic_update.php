<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods");

include_once("dbconnect.php"); // include database connection file

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format

$userid = $_GET['userid'];
$fileName  =  $_FILES['avatar']['name'];
$tempPath  =  $_FILES['avatar']['tmp_name'];
$fileSize  =  $_FILES['avatar']['size'];
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get image extension

$hashFileName = sha1($fileName);
$fileStoreDatabase = $hashFileName . "." . $fileExt;

$sqlGetUser = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userid'";
$result = $conn->query($sqlGetUser);
if ($result->num_rows > 0) {
    $user = mysqli_fetch_assoc($result);

    // Check if user_photo column is not empty
    if (!empty($user['user_photo'])) {
        $oldFileName = $user['user_photo'];
        $oldFilePath = '../assets/avatar/' . $oldFileName;

        // Check if the file exists
        if (file_exists($oldFilePath)) {
            // Delete the old file
            unlink($oldFilePath);
        }
    }

    if (empty($fileName)) {
        $errorMSG = json_encode(array("message" => "please select image", "status" => "error"));
        echo $errorMSG;
    } else {
        $upload_path = '../assets/avatar/'; // set upload folder path 


        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

        // allow valid image file formats
        if (in_array($fileExt, $valid_extensions)) {
            // check file size '5MB'
            if ($fileSize < 5000000) {
                move_uploaded_file($tempPath, $upload_path . $fileStoreDatabase); // move file from system temporary path to our upload folder path 
            } else {
                $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => "error"));
                echo $errorMSG;
            }
        } else {
            $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => "error"));
            echo $errorMSG;
        }
    }

    // if no error caused, continue ....
    if (!isset($errorMSG)) {
        $query = mysqli_query($conn, "UPDATE tbl_users SET user_photo ='$fileStoreDatabase' WHERE user_id='$userid'");

        echo json_encode(array("message" => "Image Uploaded Successfully", "status" => "success"));
    }
} else {
    $errorMSG = json_encode(["status" => "error", "message" => "User Not Found!"]);
    echo $errorMSG;
}
