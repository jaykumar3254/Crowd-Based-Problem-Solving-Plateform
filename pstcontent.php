<?php
session_start();
header('Content-Type: text/plain');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "You must be logged in to post a problem.";
    exit;
}


$host = "localhost";
$user = "root";
$pass = ""; // Set your DB password
$db = "cspsp"; // Change if needed

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed: " . $conn->connect_error;
    exit;
}


$title = trim($_POST['prname'] ?? '');
$description = trim($_POST['description'] ?? '');
$reference_link = trim($_POST['reference_link'] ?? '');
$selected_tag = $_POST['tag'] ?? '';
$custom_tag = trim($_POST['custom_tag'] ?? '');
$user_id = $_SESSION['user_id']; // assumed user ID is stored in session

if (empty($title) || empty($description)) {
    http_response_code(400);
    echo "Problem title and description are required.";
    exit;
}

$tag = ($selected_tag === 'custom' && !empty($custom_tag)) ? $custom_tag : $selected_tag;

/*
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $filename = basename($_FILES["file"]["name"]);
    $target_dir = "uploads/";
    $target_file = $target_dir . uniqid() . "_" . $filename;
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
}
*/

$stmt = $conn->prepare("INSERT INTO problems (title, description, reference_link, tags, user_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssi", $title, $description, $reference_link, $tag, $user_id);

if ($stmt->execute()) {
    echo "✅ Problem submitted successfully!";
} else {
    http_response_code(500);
    echo "❌ Failed to post problem: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
