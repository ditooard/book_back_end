<?php
include_once("dbconnect.php");
$userid = $_GET['userid'];
$dataCart = "SELECT * FROM `tbl_carts` INNER JOIN tbl_books ON tbl_carts.book_id = tbl_books.book_id WHERE tbl_carts.user_id = '$userid'";
$result = $conn->query($dataCart);

if ($result) {
    if ($result->num_rows > 0) {
        $cartlist["carts"] = [];
        while ($row = $result->fetch_assoc()) {
            $cart = array();
            $cart['cart_id'] = $row['cart_id'];
            $cart['book_id'] = $row['book_id'];
            $cart['cart_qty'] = $row['cart_qty'];
            $cart['book_title'] = $row['book_title'];
            $cart['book_price'] = $row['book_price'];
            array_push($cartlist["carts"], $cart);
        }
        $response = array('status' => 'success', 'data' => $cartlist);
        sendJsonResponse($response);
    } else {
        $response = array('status' => 'failed', 'message' => 'No carts found for the specified user');
        sendJsonResponse($response);
    }
} else {
    $response = array('status' => 'failed', 'message' => $conn->error);
    sendJsonResponse($response);
}


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
