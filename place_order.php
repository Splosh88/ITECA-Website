<?php
session_start();

if(!isset($_SESSION['user_email'])){
    header("location:register.php");
}

$conn = mysqli_connect("localhost","root","","php_ecom");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $email = $_POST['email'];
    $status = 'Pending';

    $name = $_SESSION['user_name'] ?? 'Customer';

    $stmt = $conn->prepare("INSERT INTO orders (title, price, image, name, email, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssss", $title, $price, $image, $name, $email, $status);

    if ($stmt->execute()) {
        header("Location: my_order.php");
    } else {
        echo "Failed to place order.";
    }
}
?>
