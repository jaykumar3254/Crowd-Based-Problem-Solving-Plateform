<?php
session_start();
header('Content-Type: application/json');

// If user is not logged in, return default avatar
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['avatar' => 'src/profile.jpg']); // fallback image
    exit();
}

include 'db.php'; // Make sure this connects to your database

$user_id = $_SESSION['user_id'];

// Get user profile picture from DB
$stmt = $conn->prepare("SELECT profilepicture FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($profile_picture);
$stmt->fetch();
$stmt->close();

$avatar = $profile_picture ? $profile_picture : 'src/profile.jpg';

echo json_encode(['avatar' => $avatar]);
