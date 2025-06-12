<?php
include 'db.php';

// Join problems with users table to get username
$sql = "SELECT p.title, p.description, u.Name
        FROM problems p
        JOIN userdb u ON p.user_id = u.user_id
        ORDER BY p.content_id DESC";

$result = $conn->query($sql);

$problems = [];

while ($row = $result->fetch_assoc()) {
    $problems[] = $row;
}

header('Content-Type: application/json');
echo json_encode($problems);
?>
