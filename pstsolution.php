<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];
$content_id = $_POST['content_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$media_url = $_POST['media_url'];
$solution_link = $_POST['solution_link'];

$sql = "INSERT INTO solutions (content_id, user_id, title, description, media_url, solution_link)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissss", $content_id, $user_id, $title, $description, $media_url, $solution_link);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Solution posted successfully!";
} else {
    echo "Error posting solution.";
}
?>
