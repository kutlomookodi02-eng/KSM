<?php
// Connect to your database (specify only the database name, not the table)
$conn = new mysqli('localhost', 'root', '', 'careers_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and get the username and password
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Insert data into your users table
$sql = "INSERT INTO users (name, email) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    
    // Check if the username is exactly 'mgt'
    if (strtolower($username) === 'mgt') {
        header("Location: management.html");
        exit();
    } else {
        // Default redirect for regular users
        header("Location: dashboard.php?success=1");
        exit();
    }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
