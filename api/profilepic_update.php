<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods");

include_once("dbconnect.php"); // include database connection file

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format

$userid = $_GET['userid'];
$fileName = $_POST['avatar'];
$decoded_string = base64_decode($fileName);

$hashFileName = sha1($fileName);

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

        $path = '../assets/avatar/' . $hashFileName . '.png';
        file_put_contents($path, $decoded_string);
        // valid image extensions

        $files = $hashFileName . '.png';
        $query = mysqli_query($conn, "UPDATE tbl_users SET user_photo ='$files' WHERE user_id='$userid'");

        echo json_encode(array("message" => "Image Uploaded Successfully", "status" => "success"));
    }
} else {
    $errorMSG = json_encode(["status" => "error", "message" => "User Not Found!"]);
    echo $errorMSG;
}
