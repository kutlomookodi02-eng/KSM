<?php
// Connect to the 'ksm' database where your user accounts belong
$conn = new mysqli('localhost', 'root', '', 'ksm');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure form fields are set before processing
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Please fill in both fields.");
}

$username = trim($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Use prepared statements to prevent SQL injection and target the 'username' column safely
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    // Redirect to index page upon success
    header("Location: index.html?success=1");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>