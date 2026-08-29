<?php
// Connect to the KSM database
$conn = new mysqli('localhost', 'root', '', 'KSM');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data safely
$product_name = $_POST['product_name'];
$size = $_POST['size'];
$colour = $_POST['colour'];
$price = $_POST['price'];
$quantity_available = $_POST['quantity_available'];
$quantity_sold = $_POST['quantity_sold'];

// Insert into the management table
$sql = "INSERT INTO management (product_name, size, colour, price, quantity_available, quantity_sold) 
        VALUES ('$product_name', '$size', '$colour', '$price', '$quantity_available', '$quantity_sold')";

if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.html?success=1");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>