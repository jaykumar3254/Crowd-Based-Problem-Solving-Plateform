<?php
session_start();
include 'db.php';

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to post content.";
    exit;
}

// Get input values from the form
$title = $_POST['prname'];
$description = $_POST['description'];

$reference_link = $_POST['reference_link'];
$user_id = $_SESSION['user_id'];

// Insert into your database
$sql = "INSERT INTO problems (user_id, title, description, reference_link) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $title, $description, $reference_link);

if ($stmt->execute()) {
    echo "Content submitted successfully!";
} else {
    echo "Error submitting content.";
}

$conn->close();
?>
