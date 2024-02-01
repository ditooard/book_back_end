<?php
//error_reporting(0);

if (!isset($_POST['userid']) && !isset($_POST['isbn']) && !isset($_POST['title'])) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");

$userid = $_POST['userid'];
$isbn = $_POST['isbn'];
$title = addslashes($_POST['title']);
$desc = addslashes($_POST['desc']);
$author = addslashes($_POST['author']);
$price = $_POST['price'];
$qty = $_POST['qty'];
$status = $_POST['status'];
$image = $_POST['image'];
$decoded_string = base64_decode($image);

$sqlinsert = "INSERT INTO `tbl_books`(`user_id`, `book_isbn`, `book_title`, `book_desc`, `book_author`, `book_price`, `book_qty`, `book_status`) 
VALUES ('$userid','$isbn','$title','$desc','$author',$price,$qty,'$status')";

if ($conn->query($sqlinsert) === TRUE) {
    $filename = mysqli_insert_id($conn);
    $path = '../assets/books/' . $filename . '.png';
    file_put_contents($path, $decoded_string);
    $response = array('status' => 'success', 'message' => 'Book has been added successfully', 'data' => $sqlinsert);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'error', 'message' => 'Book has been failed added');
    sendJsonResponse($response);
}


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
