<?php

session_start();

if(!isset($_SESSION['user_email'])){
    header("location:register.php");
}

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

if(isset($_GET['id'])){
    $p_id = $_GET['id'];
    $del_sql = "DELETE from products where id='$p_id' ";
    $data = mysqli_query($conn, $del_sql);

    if($data){
        header("location:display_product.php");
    }
}

$sql = "SELECT * from products";
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
                    <a href="#">Users</a>
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
                <h1>All Products</h1>

                <table>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>

                    <?php

                    while($row=mysqli_fetch_assoc($result)){
                        

                    ?>   

                    <tr>
                        <td><?php  echo $row['title'] ?></td>
                        <td><?php  echo $row['description'] ?></td>
                        <td><?php  echo $row['quantity'] ?></td>
                        <td><?php  echo $row['price'] ?></td>
                        <td>
                            <img height="100" width="100" src="images/<?php  echo $row['image'] ?>">
                        </td>
                        <td>
                            <a onclick="return confirm('Are you sure you want to delete?'); " class="del_btn" href="display_product.php?id=<?php echo $row['id']  ?>">Delete</a>
                        </td>
                        <td>
                            <a class="upd_btn" href="update_product.php?id=<?php echo $row['id'] ?>">Update</a>
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