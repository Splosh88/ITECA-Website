<?php

session_start();
error_reporting(0);

$conn = mysqli_connect("localhost","root","","php_ecom");

/*$conn = mysqli_connect("ssql210.infinityfree.com","if0_39156924","ZeX5OUmeMuqMUo","if0_39156924_database_php");*/ 

if(isset($_POST['register'])){
    $u_name = $_POST['name'];
    $u_email = $_POST['email'];
    $u_address = $_POST['address'];
    $u_phone = $_POST['phone'];
    $u_pass = $_POST['password'];
    $usertype = "user";

    $sql = "INSERT INTO users (name, email,password,phone, address,usertype) VALUES ('$u_name','$u_email','$u_pass', '$u_phone', '$u_address','$usertype')";

    $data = mysqli_query($conn, $sql);

    if($data){
        echo "Success";
    }

    
} else if(isset($_POST['login'])){
    
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * from users Where email = '".$email."' AND password = '".$pass."' ";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    if($row['usertype'] == "user")
    {
        $_SESSION['user_email'] = $email;
        $_SESSION['usertype'] = "user";

        header("location:index.php");
    }

    else if($row['usertype'] == "admin")
    {
        $_SESSION['user_email'] = $email;
        $_SESSION['usertype'] = "admin";

        header("location:admin.php");
    }
    else
    {
        $_SESSION['message'] ="Username or password is wrong";

    }

    
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>TCG Store</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="" method="POST">
                <?php
                    echo $_SESSION['message']
                ?>
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="number" name="phone" placeholder="Phone">
                <input type="text" name="address" placeholder="Address">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="register" value="register">Sign Up</button>
            </form>
        </div>


        <div class="form-container sign-in">
            <form action="" method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="login" value="login">Sign In</button>
            </form>
        </div>


        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>