<?php
include 'db.php';

$sql = "SELECT problems.*, users.username FROM problems JOIN users ON problems.user_id = users.user_id ORDER BY problems.content_id DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo '
    <div class="problem-card" onclick="window.location.href=\'problem.php?id=' . $row['content_id'] . '\'">
        <h1 class="pname">' . htmlspecialchars($row['title']) . '</h1>
        <p class="pdiscription">' . htmlspecialchars(substr($row['description'], 0, 100)) . '...</p>
        <hr />
        <div class="author-info">
            <span>@' . htmlspecialchars($row['username']) . '</span>
        </div>
    </div>';
}
?>
