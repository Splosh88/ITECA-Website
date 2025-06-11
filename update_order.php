<?php

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

$order_id = $_GET['id'];

$delivered = "Delivered";

$sql = "UPDATE orders set status = '$delivered' Where id = '$order_id' ";

$result = mysqli_query($conn,$sql);

if($result){
    header("location:all_orders.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCG Store</title>
</head>
<body>
    
</body>
</html>