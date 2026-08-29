<?php
$conn = new mysqli('localhost', 'root', '', 'KSM');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    // Check if user exists
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->fetch_assoc()) {
        // Update password directly
        $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $updateStmt->bind_param("ss", $new_password, $username);
        
        if ($updateStmt->execute()) {
            echo "Password successfully updated! <a href='index.html'>Login here</a>";
        } else {
            echo "Error updating password.";
        }
        $updateStmt->close();
    } else {
        echo "Username not found in database. <a href='forgotPassword'>Try again</a>";
    }
    $stmt->close();
    $conn->close();
    exit();
}
?>