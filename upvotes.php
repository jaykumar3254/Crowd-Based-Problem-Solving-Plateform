<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Login required to upvote.");
}

$user_id = $_SESSION['user_id'];
$solution_id = $_POST['solutionid'] ?? null;

if (!$solution_id || !is_numeric($solution_id)) {
    die("Invalid request.");
}

// Prevent multiple upvotes
$stmt = $conn->prepare("SELECT id FROM solutionupvotes WHERE userid = ? AND solutionid = ?");
$stmt->bind_param("ii", $user_id, $solution_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt = $conn->prepare("INSERT INTO solutionupvotes (userid, solutionid) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $solution_id);
    $stmt->execute();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
