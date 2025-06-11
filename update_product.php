<?php

session_start();

if(!isset($_SESSION['user_email'])){
    header("location:register.php");
}

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

$p_id = $_GET['id'];
$sql = "SELECT * from products where id='$p_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_product'])){
    $p_title = $_POST['title'];
    $p_des = $_POST['description'];
    $p_price = $_POST['price'];
    $p_quantity = $_POST['quantity'];

    $image_name = $_FILES['my_image']['name'];

    if($image_name){
        $tmp = explode(".", $image_name);
        $newfilename = round(microtime(true)).'.'.end($tmp);
        $uploadpath = "images/".$newfilename;
        move_uploaded_file($_FILES['my_image']['tmp_name'], $uploadpath);     
        
        $update_sql = "Update products set title = '$p_title', description = '$p_des', price = '$p_price', quantity = '$p_quantity', image = '$newfilename' where id='$p_id' ";
        $data = mysqli_query($conn, $update_sql);

        if($data){
        header("location:display_product.php");
        }
    } else {
        $update_sql = "Update products set title = '$p_title', description = '$p_des', price = '$p_price', quantity = '$p_quantity', image = '$newfilename' where id='$p_id' ";
        $data = mysqli_query($conn, $update_sql);

        if($data){
            header("location:display_product.php");
        }
    }



    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
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
                    <a href="add_product.php">Add products</a>
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

            <div class="info">
                <h1>Update page</h1>

                <div class="my_form">

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="div_deg">
                            <label>Title</label>
                            <input type="text" value="<?php echo $row['title'] ?>" name="title">
                        </div>

                        <div class="div_deg">
                            <label>Description</label>
                            <textarea name="description"><?php echo $row['description'] ?>
                            </textarea>
                        </div>

                        <div class="div_deg">
                            <label>Price</label>
                            <input type="number" value="<?php echo $row['price'] ?>" name="price">
                        </div>

                        <div class="div_deg">
                            <label>Quantity</label>
                            <input type="number" value="<?php echo $row['quantity'] ?>" name="quantity">
                        </div>

                        <div>
                            <label>Current Image</label>
                            <img height="80" width="80" src="images/<?php echo $row['image'] ?>">
                        </div>

                        <div class="div_deg">
                            <label> change Image</label>
                            <input type="file" name="my_image">
                        </div>                        
                        
                        <div class="div_deg">
                            <input type="submit" class="upd_btn" name="update_product" value="update product">
                        </div>
                    </form>
                </div>
            </div>



        </div>

    </div>

</body>
</html>