<?php
$conn = new mysqli('localhost', 'root', '', 'KSM');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST['username']);
$stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Generate secure random token
    $token = bin2hex(random_bytes(32));
    $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // Save token and expiry to database
    $updateStmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE username = ?");
    $updateStmt->bind_param("sss", $token, $expires, $username);
    $updateStmt->execute();

    // Output the reset link (for local development; normally sent via email)
    echo "Password reset link: <a href='reset_password.php?token=$token'>Reset Your Password</a>";
    $updateStmt->close();
} else {
    echo "Username not found.";
}
$stmt->close();
$conn->close();
?>