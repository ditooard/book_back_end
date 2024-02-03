<?php
//error_reporting(0);

include_once("dbconnect.php");

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

$userid = $_GET['userid'];
$phone = $_GET['phone'];
$amount = $_GET['amount'];
$email = $_GET['email'];
$name = $_GET['name'];

$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'],
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];
if ($paidstatus == true) {
    $paidstatus = "Success";
} else {
    $paidstatus = "Failed";
}

$receiptid = $_GET['billplz']['id'];
$signing = '';
foreach ($data as $key => $value) {
    $signing .= 'billplz' . $key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}

$signed = hash_hmac('sha256', $signing, 'S-_ur0hR84xm7Mvs84oVLQ4g');
if ($signed === $data['x_signature']) {
    if ($paidstatus == "Success") { //payment success
        $sqlcart = "SELECT * FROM `tbl_carts` JOIN `tbl_books` ON `tbl_carts`.`book_id` = `tbl_books`.`book_id` WHERE `tbl_carts`.`cart_status` = 'New' AND `tbl_carts`.`user_id` = '$userid' ORDER BY `tbl_carts`.`user_id`";
        $result = $conn->query($sqlcart);
        $seller = "0";
        $total = 0;
        $rows = $result->num_rows;
        if ($rows > 0) {
            $cartslist["carts"] = array();
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                $cartarray = array();
                $cartarray['cart_id'] = $row['cart_id'];
                $cartarray['user_id'] = $row['user_id'];
                $bookId = $row['book_id'];
                $cartarray['book_qty'] = $row['book_qty'];
                $cartarray['book_price'] = $row['book_price'];
                $cartarray['cart_qty'] = $row['cart_qty'];
                $cartarray['cart_status'] = $row['cart_status'];

                $bookQuantity = $row['book_qty'];
                $remainingQuantity = $cartarray['book_qty'] - $cartarray['cart_qty'];
                // $cartarray['order_id'] = $row['order_id'];
                // $cartarray['cart_date'] = $row['cart_date'];
                // print_r($cartarray);

                // Update the book quantity in tbl_books
                $updateQuery = "UPDATE `tbl_books` SET `book_qty` = '$remainingQuantity' WHERE `book_id` = '$bookId'";
                $conn->query($updateQuery);
                array_push($cartslist["carts"], $cartarray);
                if ($rows == 1) {
                    $status = "New";
                    $price = $cartarray['book_price'];
                    $qty = $cartarray['cart_qty'];
                    $cartid = $cartarray['cart_id'];
                    $total = $price * $qty;
                    $sqlinsertorder = "INSERT INTO `tbl_orders`(`user_id`, `order_total`, `order_status`, `cart_id`) VALUES ('$userid','$total','$status', '$cartid')";
                    $conn->query($sqlinsertorder);
                } else {
                    if ($i == 1) {
                        $total = $total + ($cartarray['cart_qty'] * $cartarray['book_price']);
                    } else {
                        $total = $total + $cartarray['cart_qty'] * $cartarray['book_price'];
                        $status = "New";
                        $sqlinsertorder = "INSERT INTO `tbl_orders`(`user_id`, `order_total`, `order_status`, `cart_id`) VALUES ('$userid','$total','$status', '$cartid')";
                        $conn->query($sqlinsertorder);
                        $total = 0;
                    }
                }
            }
        }

        //update cart paid status
        $sqlupdatecart = "UPDATE `tbl_carts` SET `cart_status`='Paid' WHERE `user_id` = '$userid' AND `cart_status` = 'New'";

        $updatecart = $conn->query($sqlupdatecart);

        $redirectUrl = "https://www.billplz-sandbox.com/bills/$receiptid";
        header("Location: $redirectUrl");
        exit();
    } else {
        //print receipt for failed transaction
        $response = ['status' => 'error', 'data' => 'failed transaction your authentication server error'];
    }
}
