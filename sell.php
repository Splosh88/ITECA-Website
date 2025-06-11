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
        header("location:index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TCG Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn"><i class="fa fa-bars"></i></label>
        <label class="my_logo">
            <a href="index.php"><img src="images/op-tcg-slider.png"></a>
        </label>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="#">Contacts</a></li>

        <?php if (isset($_SESSION['user_email'])): ?>
            <li><a href="sell.php">Sell</a></li>
            <li><a href="user_order.php">Orders</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="register.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="info_sell">
    <h1>Add Products</h1>
    <div class="my_form_sell">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="sell_deg">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>

            <div class="sell_deg">
                <label>Description</label>
                <textarea name="description" required></textarea>
            </div>

            <div class="sell_deg">
                <label>Price</label>
                <input type="number" step="0.01" name="price" required>
            </div>

            <div class="sell_deg">
                <label>Quantity</label>
                <input type="number" name="quantity" required>
            </div>

            <div class="sell_deg">
                <label>Image</label>
                <input type="file" name="my_image" accept="image/*" required>
            </div>

            <div class="sell_deg">
                <input type="submit" name="add_product" value="Add Product">
            </div>
        </form>
    </div>
</div>

</body>
</html>
