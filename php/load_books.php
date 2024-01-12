<?php
//error_reporting(0);
include_once("dbconnect.php");
$title = $_GET['title'];
$author = $_GET['author'];

//step 1
$results_per_page = 10;
//step 2
if (isset($_GET['pageno'])){
	$pageno = (int)$_GET['pageno'];
}else{
	$pageno = 1;
}
//step 3
$page_first_result = ($pageno - 1) * $results_per_page;

//step 4
$sqlloadbooks = "SELECT * FROM `tbl_books` WHERE `book_title` LIKE '%$title%' OR `book_author` LIKE '%$author%'";
$result = $conn->query($sqlloadbooks);
$number_of_result = $result->num_rows;
$number_of_page = ceil($number_of_result / $results_per_page);

//step 5
$sqlloadbooks = $sqlloadbooks . " LIMIT $page_first_result , $results_per_page";

$result = $conn->query($sqlloadbooks);
if ($result->num_rows > 0) {
    $booklist["books"] = array();
    while ($row = $result->fetch_assoc()) {
        $book = array();
        $book['book_id'] = $row['book_id'];
        $book['user_id'] = $row['user_id'];
        $book['book_isbn'] = $row['book_isbn'];
        $book['book_title'] = $row['book_title'];
        $book['book_desc'] = $row['book_desc'];
        $book['book_author'] = $row['book_author'];
        $book['book_status'] = $row['book_status'];
        $book['book_price'] = $row['book_price'];
        $book['book_qty'] = $row['book_qty'];
        $book['book_qty'] = $row['book_qty'];
        $book['book_date'] = $row['book_date'];
        array_push( $booklist["books"],$book);
    }
    $response = array('status' => 'success', 'data' => $booklist, 'numofpage'=>$number_of_page,'numberofresult'=>$number_of_result);
    sendJsonResponse($response);
}else{
	$response = array('status' => 'failed', 'data' => null);
	sendJsonResponse($response);
}


function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>