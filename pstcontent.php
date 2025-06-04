<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id']; // Assume user is logged in
$title = $_POST['title'];
$description = $_POST['description'];
$media_url = $_POST['media_url']; // Path to image/video
$reference_link = $_POST['reference_link'];

$sql = "INSERT INTO contents (user_id, title, description, media_url, reference_link) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issss", $user_id, $title, $description, $media_url, $reference_link);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Content posted successfully!";
} else {
    echo "Error posting content.";
}
?>
