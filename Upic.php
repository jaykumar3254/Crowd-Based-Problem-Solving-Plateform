<?php
session_start();
include 'db.php';

$user_id = $_SESSION['user_id'];
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $filename = "uploads/avatar_$user_id." . $ext;

    move_uploaded_file($_FILES['avatar']['tmp_name'], $filename);

    $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
    $stmt->bind_param("si", $filename, $user_id);
    $stmt->execute();
}

header("Location: profile.php");
exit();
