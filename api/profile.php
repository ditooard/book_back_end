<?php
//error_reporting(0);
header("Access-Control-Allow-Methods: PUT");
if (!isset($_GET['userid'])) {
    $response = array('status' => 'failed', 'message' => 'Missing parameters');
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_GET['userid'];

$getUserById = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userid'";

$result = mysqli_query($conn, $getUserById);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $response = array(
            'status' => 'success', 'data' => $user
        );
        sendJsonResponse($response);
    } else {
        // Jika tidak ada baris yang terpengaruh, maka `user_id` tidak ditemukan
        $response = array('status' => 'failed', 'message' => 'User not found');
        sendJsonResponse($response);
    }
} else {
    $response = array('status' => 'failed', 'message' => 'Database query error');
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}