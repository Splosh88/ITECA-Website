<?php

session_start();

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

if(!isset($_SESSION['user_email'])){
    header("location:register.php");
}

$sql = "SELECT * from orders";

$result = mysqli_query($conn,$sql);

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
                <h1>All Orders</h1>

                <table>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </tr>

                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo $row['title'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td>
                                        <img width="100" height="100" src="images/<?php echo $row['image'] ?>">
                                    </td>
                                    <td><?php echo $row['status'] ?></td>

                                    <td>
                                        <a class="del_btn" href="update_order.php?id=<?php echo $row['id'] ?>">Delivered</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>


                </table>
            </div>



        </div>

    </div>

</body>
</html>