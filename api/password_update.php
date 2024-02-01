<?php
//error_reporting(0);
header("Access-Control-Allow-Methods: PUT");
if (!isset($_GET['password']) || !isset($_GET['userid']) || !isset($_GET['current_password'])) {
    $response = array('status' => 'failed', 'message' => 'Missing parameters');
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_GET['userid'];
$current_password = $_GET['current_password'];
$password = $_GET['password'];

$getUserById = "SELECT * FROM `tbl_users` WHERE `user_id` = '$userid'";

$result = mysqli_query($conn, $getUserById);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $storedPassword = $user['user_password'];

        // Mengecek kecocokan current password dengan password yang tersimpan dalam database
        $isPasswordMatch = false;

        if (sha1($current_password) == $storedPassword) {
            $isPasswordMatch = true;
        }

        $hashPassword = sha1($password);

        if ($isPasswordMatch) {
            // Password cocok
            $sqlupdate = "UPDATE `tbl_users` SET `user_password` = '$hashPassword' WHERE `user_id` = '$userid'";

            if ($conn->query($sqlupdate)) {
                if ($conn->affected_rows > 0) {
                    $response = array('status' => 'success', 'message' => 'User password updated successfully');
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
        } else {
            // Password tidak cocok
            $response = array(
                'status' => 'failed', 'message' => 'Current Password not same with password recently'
            );
            sendJsonResponse($response);
        }
    } else {
        // Pengguna tidak ditemukan
        $response = array(
            'status' => 'failed', 'message' => 'User not found'
        );
        sendJsonResponse($response);
    }
} else {
    // Terjadi kesalahan dalam eksekusi query
    $response = array(
        'status' => 'failed', 'message' => 'Error updating user: ' . $conn->error
    );
    sendJsonResponse($response);
}



function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
