<?php
if (!isset($_POST['userid'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_POST['userid'];
$book_id = $_POST['book_id'];
$cart_qty = $_POST['cart_qty'];

$insertCart = "INSERT INTO `tbl_carts`(`user_id`, `book_id`, `cart_qty`) VALUES ('$userid','$book_id','$cart_qty')";

if ($conn->query($insertCart)) {
    $response = ['status', 'data' => $insertCart];
    sendJsonResponse($response);
}


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
