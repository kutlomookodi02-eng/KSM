<?php
session_start();
// Check if form fields are submitted
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Please fill in both username and password.");
}
$input_username = trim($_POST['username']);
$input_password = $_POST['password'];
// Determine database and redirect page based on username
if (strtolower($input_username) === 'hr') {
    $db_name = 'careers_db';
    $redirect_page = 'careers_dashboard.html'; 
} elseif (strtolower($input_username) === 'mgt') {
    $db_name = 'KSM';
    $redirect_page = 'management.html';
} else {
    $db_name = 'KSM';
    $redirect_page = 'dashboard.html';
}
// Connect to MySQL
$conn = new mysqli('localhost', 'root', 'Student@26', $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Prepare statement to fetch user
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $input_username);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    // Verify the hashed password against input
    if (password_verify($input_password, $row['password'])) {
        // Store session data if needed
        $_SESSION['username'] = $input_username;
        header("Location: " . $redirect_page);
        exit();
    } else {
        echo "Invalid password. <a href='login.html'>Try again</a>";
    }
} else {
    echo "User not found in database '$db_name'. <a href='SignUp.html'>Sign up here</a>";
}
$stmt->close();
$conn->close();
?>