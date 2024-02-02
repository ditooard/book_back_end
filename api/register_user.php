<?php
//error_reporting(0);
if (!isset($_POST['email']) && !isset($_POST['name']) && !isset($_POST['password'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = sha1($_POST['password']);

$sqlinsert = "INSERT INTO `tbl_users`(`user_email`, `user_name`, `user_phone`,`user_password`) VALUES ('$email','$name','$phone','$password')";

if ($conn->query($sqlinsert) === TRUE) {
    $response = array('status' => 'success', 'message' => 'User has been registered');
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => 'User failed registered');
    sendJsonResponse($response);
}


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
