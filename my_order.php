<?php

session_start();
$_SESSION['user_email'] = $_GET['email'];

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

$p_id = $_GET['id'];
$u_email = $_GET['email'];

$p_sql = "SELECT * from products Where id = '$p_id' ";

$p_result = mysqli_query($conn,$p_sql);

$p_row = mysqli_fetch_assoc($p_result);

$p_title = $p_row['title'];
$p_price = $p_row['price'];
$p_image = $p_row['image'];

$u_sql = "SELECT * from users Where email = '$u_email' ";
$u_result = mysqli_query($conn,$u_sql);

$u_row = mysqli_fetch_assoc($u_result);

$u_name = $u_row['name'];
$u_email = $u_row['email'];
$u_phone = $u_row['phone'];
$u_address = $u_row['address'];
$status = "In progress";

$order_sql = "INSERT into orders(title,price,image,username,email,phone,address,status) VALUES ('$p_title','$p_price','$p_image','$u_name','$u_email','$u_phone','$u_address','$status') ";

$order_result = mysqli_query($conn,$order_sql);

if($order_result){

    $_SESSION['user_email'] = $_GET['email'];
    header("location:user_order.php");
}

?>