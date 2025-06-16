<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];

// Remove file from server
$result = $conn->query("SELECT avatar FROM users WHERE id = $user_id");
$row = $result->fetch_assoc();
if ($row && file_exists($row['avatar'])) {
    unlink($row['avatar']);
}

// Update DB
$conn->query("UPDATE users SET avatar = NULL WHERE id = $user_id");

header("Location: profile.php");
exit();
