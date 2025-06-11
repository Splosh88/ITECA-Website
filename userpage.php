<?php

session_start();

if(!isset($_SESSION['user_email'])){
    header("location:register.php");
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


    <h1>user page</h1>
    <a href="logout.php">Logout</a>




</body>
</html>