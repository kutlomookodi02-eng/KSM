<?php
session_start();

// Check if form fields are submitted
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Please fill in both username and password.");
}

$input_username = trim($_POST['username']);
$input_password = $_POST['password'];

// Centralize all regular users and general app logic to 'ksm'
$db_name = 'ksm';

// Connect to MySQL centrally
$conn = new mysqli('localhost', 'root', '', $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare statement to fetch user and check if they exist anywhere in 'ksm'
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $input_username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Verify the hashed password against input
    if (password_verify($input_password, $row['password'])) {
        $_SESSION['username'] = $input_username;

        // Route based on user role or username destination
        if (strtolower($input_username) === 'admin') {
            $redirect_page = 'careers_dashboard.html';
        } elseif (strtolower($input_username) === 'kutlo') {
            $redirect_page = 'manager.html';
        } else {
            $redirect_page = 'home.html';
        }

        header("Location: " . $redirect_page);
        exit();
    } else {
        echo "Invalid password. <a href='index.html'>Try again</a>";
    }
} else {
    echo "User not found in database '$db_name'. <a href='SignUp.html'>Sign up here</a>";
}

$stmt->close();
$conn->close();
?>