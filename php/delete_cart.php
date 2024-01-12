<?php
//error_reporting(0);
header("Access-Control-Allow-Methods: DELETE");
if (!isset($_GET['userid']) && !isset($_GET['cartid'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_GET['userid'];
$cartid = $_GET['cartid'];

$sqldelete = "DELETE FROM `tbl_carts` WHERE `cart_id` = '$cartid' AND `user_id` = '$userid'";

if ($conn->query($sqldelete)) {
    if ($conn->affected_rows > 0) {
        $response = array('status' => 'success', 'data' => $sqldelete);
        sendJsonResponse($response);
    } else {
        // Jika tidak ada baris yang terpengaruh, maka `cart_id` tidak ditemukan
        $response = array('status' => 'failed', 'message' => 'Cart not found');
        sendJsonResponse($response);
    }
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
