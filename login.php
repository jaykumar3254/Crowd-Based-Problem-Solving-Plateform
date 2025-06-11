<?php
session_start();
include 'db.php';

// Get form input safely
$email = $_POST['email'];
$password = $_POST['password'];

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM userdb WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Simple password check (replace with password_verify() if hashed)
    if ($password === $row['Pass']) {
        // Set session variables
        $_SESSION['user_id'] = $row['user_id'];       // replace with your actual column name
        $_SESSION['username'] = $row['Name'];    // replace if needed
        $_SESSION['email'] = $row['Email'];

        // Redirect to index.html on success
        echo "Login successful" ;
        //header("Location: index.html");
        exit;
    } else {
        // Plain text message for JavaScript alert
        echo "Invalid password";
    }
} else {
    echo "Email not found";
}

$conn->close();
?>
