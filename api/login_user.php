<?php
// error_reporting(0);
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $response = array('status' => 'failed', 'message' => 'Invalid request', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$email = $_POST['email'];
$password = sha1($_POST['password']);

$sqllogin = "SELECT * FROM `tbl_users` WHERE `user_email` = '$email' AND `user_password` = '$password'";
$result = $conn->query($sqllogin);
if ($result->num_rows > 0) {
    $userlist = array();
    while ($row = $result->fetch_assoc()) {
        $userlist['userid'] = $row['user_id'];
        $userlist['useremail'] = $row['user_email'];
        $userlist['username'] = $row['user_name'];
        $userlist['userpassword'] = $_POST['password'];
        $userlist['userdatereg'] = $row['user_datereg'];
    }
    $response = array('status' => 'success', 'message' => 'Login successful', 'data' => $userlist);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'message' => 'Login failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    http_response_code(200); // Set kode status HTTP 200 OK
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>
