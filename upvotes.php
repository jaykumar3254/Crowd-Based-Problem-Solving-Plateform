<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Login required to upvote.");
}

$user_id = $_SESSION['user_id'];
$solution_id = $_POST['solution_id'] ?? null;

if (!$solution_id || !is_numeric($solution_id)) {
    die("Invalid request.");
}

// Prevent multiple upvotes
$stmt = $conn->prepare("SELECT id FROM solution_upvotes WHERE user_id = ? AND solution_id = ?");
$stmt->bind_param("ii", $user_id, $solution_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt = $conn->prepare("INSERT INTO solution_upvotes (user_id, solution_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $solution_id);
    $stmt->execute();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
