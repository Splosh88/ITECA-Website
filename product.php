<?php

session_start();
error_reporting(0);

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

if(isset($_GET['search'])){

    $search_value = $_GET['my_search'];

    $sql = "SELECT * from products Where concat(title,description) LIKE '%$search_value%' ";
    $result = mysqli_query($conn,$sql);

}else{

    $sql = "SELECT * from products";

    $result = mysqli_query($conn,$sql);
}





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

            <li>
                <a href="sell.php">Sell</a>
            </li>

            <?php

                if ($_SESSION['user_email']){
                    ?>

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


    <!--products-->

    <div>
        <h3 class="p_title">products</h3>   
    </div>

    <div style="margin-left: 750px; padding: 100px;">
        <form action="" method="GET">
            <input type="text" name="my_search" class="search-input" placeholder="Search">
            <input type="submit" name="search" value = "Search">
        </form>
    </div>


    <div class="my_card">

        <?php

            while($row=mysqli_fetch_assoc($result)){
                ?>

                <div class="card">
                    <img class="p_image" src="images/<?php echo $row['image']?>">

                    <h4><?php echo $row['title']  ?></h4>

                    <p><?php echo $row['description']  ?></p>

                    <p>R<?php echo $row['price']  ?></p>

                    <?php

                    if($_SESSION['user_email']){
                        ?>

                        <a href="my_order.php?id=<?php echo $row['id'] ?>&email=<?php echo $_SESSION['user_email'] ?>">Buy Now</a>

                        <?php
                    }else{
                        ?>
                        <a href="register.php">Buy Now</a>

                        <?php
                    }

                    ?>

                    

                </div>

                <?php
            }

        ?>





            


    </div>

    <!--footer-->

    <div>
        <div class="footer">
            

            <div class="footer_title">
                <h3>My Ecom</h3>
            </div>


            <div class="footer_content">

                <div>
                    <h4>Services</h4>
                    <p>
                        <a href="#">Card Grading</a>
                    </p>

                    <p>
                        <a href="#">Events</a>
                    </p>

                </div>


                <div>
                    <h4>Socail</h4>
                    <p>
                        <a href="#">Facebook</a>
                    </p>

                    <p>
                        <a href="#">Instagram</a>
                    </p>

                    <p>
                        <a href="#">Twitter/ X</a>
                    </p>

                </div>


                <div>
                    <h4>Quick Links</h4>
                    <p>
                        <a href="#">Home</a>
                    </p>

                    <p>
                        <a href="#">Products</a>
                    </p>

                    <p>
                        <a href="#">Contacts</a>
                    </p>

                    <p>
                        <a href="#">Register</a>
                    </p>

                    <p>
                        <a href="#">Login</a>
                    </p>

                </div>


                <div>
                    <h4>Location</h4>
                    <p>
                        Address
                    </p>

                    <p>
                        Email. email@gmail.com
                    </p>

                    <p>
                        Phone: 123456789
                    </p>

                </div>


            </div>


        </div>


    </div>




</body>
</html>