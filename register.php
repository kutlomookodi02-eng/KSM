<?php
// Connect to your database (specify only the database name, not the table)
$conn = new mysqli('localhost', 'root', '', 'careers_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and insert data (matching your table columns: name, email)
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Note: Ensure your table columns match what you are inserting, 
// e.g., using 'name' and 'email' or updating your table to have 'username' and 'password'
$sql = "INSERT INTO users (name, email) VALUES ('$username', '$password')";

// Fixed missing $ sign before sql variable
if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php?success=1");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>