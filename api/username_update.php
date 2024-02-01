<?php
//error_reporting(0);
header("Access-Control-Allow-Methods: PUT");
if (!isset($_GET['userid']) || !isset($_GET['username'])) {
    $response = array('status' => 'failed', 'message' => 'Missing parameters');
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_GET['userid'];
$username = $_GET['username'];

$getUserById = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userid'";

$result = mysqli_query($conn, $getUserById);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        //Update email
        $sqlupdate = "UPDATE `tbl_users` SET `user_name` = '$username' WHERE `user_id` = '$userid'";

        if ($conn->query($sqlupdate)) {
            if ($conn->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Username updated successfully');
                sendJsonResponse($response);
            } else {
                // Jika tidak ada baris yang terpengaruh, maka `user_id` tidak ditemukan
                $response = array('status' => 'failed', 'message' => 'User not found');
                sendJsonResponse($response);
            }
        } else {
            $response = array(
                'status' => 'failed', 'message' => 'Error updating user: ' . $conn->error
            );
            sendJsonResponse($response);
        }
    }
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
