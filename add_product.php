<?php

session_start();

if(!isset($_SESSION['user_email'])){
    header("location:register.php");
}


$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 




if(isset($_POST['add_product'])){
    
    $title = $_POST['title'];
    $des = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image_name = $_FILES['my_image']['name'];
    $tmp = explode(".", $image_name);
    $newfilename = round(microtime(true)).'.'.end($tmp);
    $uploadpath = "images/".$newfilename;
    move_uploaded_file($_FILES['my_image']['tmp_name'], $uploadpath);

    $sql = "INSERT INTO products(title, description, price, quantity,image) Values('$title','$des','$price','$quantity','$newfilename')";

    $data = mysqli_query($conn, $sql);

    if($data){
        header("location:add_product.php");
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
    <link rel="stylesheet" type="text/css" href="sellstyle.css">
    <title>TCG Store</title>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>Admin</h2>
            <ul>
                <li>
                    <a href="admin.php">Dashboard</a>
                </li>

                <li>
                    <a href="users.php">Users</a>
                </li>

                <li>
                    <a href="add_prodcut.php">Add products</a>
                </li>

                <li>
                    <a href="display_product.php">view Products</a>
                </li>                

                <li>
                    <a href="all_orders.php">Orders</a>
                </li>   

            </ul>
        </div>

        <div class="header">
            <div class="admin_header">
                <a href="logout.php">Logout</a>
            </div>

            <h1>Add Products</h1>

            <div class="info">

                <div class="my_form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="div_deg">
                            <label>Title</label>
                            <input type="text" name="title" required>
                        </div>

                        <div class="div_deg">
                            <label>Description</label>
                            <textarea name="description" required></textarea>
                        </div>

                        <div class="div_deg">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" required>
                        </div>

                        <div class="div_deg">
                            <label>Quantity</label>
                            <input type="number" name="quantity" required>
                        </div>

                        <div class="div_deg">
                            <label>Image</label>
                            <input type="file" name="my_image" accept="image/*" required>
                        </div>

                        <div class="div_deg">
                            <input type="submit" name="add_product" value="Add Product">
                        </div>
                    </form>
                </div>
            </div>

    </div>

</body>
</html>