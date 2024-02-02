<?php
if (!isset($_POST['userid']) || !isset($_POST['book_id']) || !isset($_POST['cart_qty'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_POST['userid'];
$book_id = $_POST['book_id'];
$cart_qty = $_POST['cart_qty'];
$cart_status = 'New';

// Check if the book is already in the cart for the user
$checkCart = "SELECT * FROM `tbl_carts` WHERE `user_id` = '$userid' AND `book_id` = '$book_id'";
$result = $conn->query($checkCart);

if ($result->num_rows > 0) {
    // Book is already in the cart, update cart_qty
    $row = $result->fetch_assoc();
    $existingQty = $row['cart_qty'];
    $newQty = $existingQty + $cart_qty;

    $updateCart = "UPDATE `tbl_carts` SET `cart_qty` = '$newQty' WHERE `user_id` = '$userid' AND `book_id` = '$book_id'";
    if ($conn->query($updateCart)) {
        $response = ['status' => 'success', 'data' => $updateCart];
        sendJsonResponse($response);
    } else {
        $response = ['status' => 'failed', 'data' => 'Failed to update cart'];
        sendJsonResponse($response);
    }
} else {
    // Book is not in the cart, insert a new entry
    $insertCart = "INSERT INTO `tbl_carts`(`user_id`, `book_id`, `cart_qty`, `cart_status`) VALUES ('$userid','$book_id','$cart_qty', '$cart_status')";
    if ($conn->query($insertCart)) {
        $response = ['status' => 'success', 'data' => $insertCart];
        sendJsonResponse($response);
    } else {
        $response = ['status' => 'failed', 'data' => 'Failed to insert into cart'];
        sendJsonResponse($response);
    }
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
