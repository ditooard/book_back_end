<?php
//error_reporting(0);
include_once("dbconnect.php");
$userid = $_GET['userid'];
$phone = $_GET['phone'];
$amount = $_GET['amount'];
$email = $_GET['email'];
$name = $_GET['name'];

$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];
if ($paidstatus=="true"){
    $paidstatus = "Success";
}else{
    $paidstatus = "Failed";
}
$receiptid = $_GET['billplz']['id'];
$signing = '';
foreach ($data as $key => $value) {
    $signing.= 'billplz'.$key . $value;
    if ($key === 'paid') {
        break;
    } else {
        $signing .= '|';
    }
}
 
$signed= hash_hmac('sha256', $signing, 'S-wzNn8FTL0endIB4wgi728w');
if ($signed === $data['x_signature']) {
    if ($paidstatus == "Success"){ //payment success
     
        $sqlcart = "SELECT * FROM `tbl_carts` WHERE `cart_status`='New' AND `buyer_id` = '$userid' ORDER BY `seller_id`;";
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
                $cartarray['buyer_id'] = $row['buyer_id'];
                $cartarray['seller_id'] = $row['seller_id'];
                $cartarray['book_id'] = $row['book_id'];
                $cartarray['book_price'] = $row['book_price'];
                $cartarray['cart_qty'] = $row['cart_qty'];
                $cartarray['cart_status'] = $row['cart_status'];
                $cartarray['order_id'] = $row['order_id'];
                $cartarray['cart_date'] = $row['cart_date'];  
               // print_r($cartarray);
                array_push($cartslist["carts"],$cartarray);
                if ($rows == 1){
                    $status = "New";
                    $seller = $cartarray['seller_id'];
                    $price = $cartarray['book_price'];
                    $qty = $cartarray['cart_qty'];
                    $total = $price * $qty;
                    $sqlinsertorder = "INSERT INTO `tbl_orders`(`buyer_id`, `seller_id`, `order_total`, `order_status`) VALUES ('$userid','$seller','$total','$status')";
                    $conn->query($sqlinsertorder);   
                }else{
                    if ($i == 1 ){
                        $seller = $row['seller_id'];
                        $total = $total + ($cartarray['cart_qty'] * $cartarray['book_price']); 
                    }else{
                        if ($seller == $row['seller_id']){
                            $total = $total+ $cartarray['cart_qty'] * $cartarray['book_price'];
                            if ($i == $rows){
                             $status = "New";
                             $sqlinsertorder = "INSERT INTO `tbl_orders`(`buyer_id`, `seller_id`, `order_total`, `order_status`) VALUES ('$userid','$seller','$total','$status')";
                             $conn->query($sqlinsertorder);   
                            }
                        }else{
                             $status = "New";
                             $sqlinsertorder = "INSERT INTO `tbl_orders`(`buyer_id`, `seller_id`, `order_total`, `order_status`) VALUES ('$userid','$seller','$total','$status')";
                             $conn->query($sqlinsertorder);
                             $seller = $row['seller_id'];
                             $total = 0;
                        }    
                    } 
                }
            }
        }
        
        //update cart paid status
        $sqlupdatecart = "UPDATE `tbl_carts` SET `cart_status`='Paid' WHERE `buyer_id` = '$userid' AND `cart_status` = 'New'";
        $conn->query($sqlupdatecart);
        
        //print receipt for success transaction
        echo "
        <html><meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">
        <body>
        <center><h4>Receipt</h4></center>
        <table class='w3-table w3-striped'>
        <th>Item</th><th>Description</th>
        <tr><td>Receipt</td><td>$receiptid</td></tr>
        <tr><td>Name</td><td>$name</td></tr>
        <tr><td>Email</td><td>$email</td></tr>
        <tr><td>Phone</td><td>$phone</td></tr>
        <tr><td>Paid Amount</td><td>RM$amount</td></tr>
        <tr><td>Paid Status</td><td class='w3-text-green'>$paidstatus</td></tr>
        </table><br>
        </body>
        </html>";
    }
    else 
    {
        //print receipt for failed transaction
         echo "
        <html><meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">
        <body>
        <center><h4>Receipt</h4></center>
        <table class='w3-table w3-striped'>
        <th>Item</th><th>Description</th>
        <tr><td>Receipt</td><td>$receiptid</td></tr>
        <tr><td>Name</td><td>$name</td></tr>
        <tr><td>Email</td><td>$email</td></tr>
        <tr><td>Phone</td><td>$phone</td></tr>
        <tr><td>Paid</td><td>RM $amount</td></tr>
        <tr><td>Paid Status</td><td class='w3-text-red'>$paidstatus</td></tr>
        </table><br>
        
        </body>
        </html>";
    }
}

?>
