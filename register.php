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
    // Default fallback database or user
    $db_name = 'KSM';
    $redirect_page = 'dashboard.html';
}

// Connect to whichever database was selected above
$conn = new mysqli('localhost', 'root', '', $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert into the users/management table of that specific database
$sql = "INSERT INTO users (username, password) VALUES ('$input_username', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: " . $redirect_page);
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
