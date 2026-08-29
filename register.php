<?php
$input_username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Check username and assign the correct database
if (strtolower($input_username) === 'hr') {
    $db_name = 'careers_db';
    $redirect_page = 'careers_dashboard.html'; 
} elseif (strtolower($input_username) === 'mgt') {
    $db_name = 'KSM';
    $redirect_page = 'management.html';
} else {
    // Default fallback database 
    $db_name = 'KSM';
    $redirect_page = 'dashboard.html';
}

$conn = new mysqli('localhost', 'root', '', $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//prepared statement to prevent SQL Injection
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $input_username, $password);

if ($stmt->execute() === TRUE) {
    header("Location: " . $redirect_page);
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
