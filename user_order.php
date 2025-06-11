<?php

error_reporting(0);

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

session_start();

$my_email = $_SESSION['user_email'];
$user_email = $_GET['email'];

if($my_email){
    $sql = "SELECT * from orders where email = '$my_email' ";

    $result = mysqli_query($conn,$sql);
}

else if($user_email){
    $sql = "SELECT * from orders where email = '$user_email' ";

    $result = mysqli_query($conn,$sql);
}else{
    header("location:register.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>TCG Store</title>
</head>
<body>
    <nav>
        <input type="checkbox" id="check">

        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>

        <label class="my_logo">
            <a href="index.php"><img src="images/op-tcg-slider.png"></a>
        </label>
        
        <ul>
            <li>
                <a href="index.php">Home </a>
            </li>

            <li>
                <a href="product.php">Products</a>
            </li>

            <li>
                <a href="#">Contacts</a>
            </li>

            <?php

                if ($_SESSION['user_email']){
                    ?>

                    <a class="logout_btn" href="sell.php?email=<?php echo$_SESSION['user_email'] ?>">Sell</a>

                    <a class="logout_btn" href="user_order.php?email=<?php echo$_SESSION['user_email'] ?>">Orders</a>

                    <a class="logout_btn" href="logout.php">Logout</a>

                    <?php
                }else{
                    ?>

                    <li>
                        <a href="register.php">Register</a>
                    </li>

                    <li>
                        <a href="register.php">Login</a>
                    </li>

                    <?php
                }

            ?>

            
        </ul>
    </nav>

    <table>

        <tr>
            <th>Product Title</th>
            <th>Price</th>
            <th>Image</th>
        </tr>

        <?php

            while($row = mysqli_fetch_assoc($result)){
                ?>

                <tr>
                    <td><?php echo $row['title'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td>
                        <img width="100" height="100" src="images/<?php echo $row['image'] ?>">
                    </td>
                </tr>

                <?php
            }

        ?>


    </table>

    <div class="add_order">
        <form action="index.php">
            <input type="submit" name="add_product" value="Place Order">
        </form>
        
    </div>

</body>
</html>