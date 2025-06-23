<?php
include 'db.php';
$tag = $_GET['tag'] ?? '';

if ($tag === '') {
  $sql = "SELECT p.*, u.username FROM problems p JOIN users u ON p.user_id = u.user_id ORDER BY p.content_id DESC";
  $stmt = $conn->prepare($sql);
} else {
  $sql = "SELECT p.*, u.username FROM problems p JOIN users u ON p.user_id = u.user_id WHERE p.tags = ? ORDER BY p.content_id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $tag);
}

$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  echo "<div class='problem-card' onclick=\"window.location.href='problem.php?id={$row['content_id']}'\">
          <h1 class='pname'>" . htmlspecialchars($row['title']) . "</h1>
          <p class='pdiscription'>" . nl2br(htmlspecialchars(substr($row['description'], 0, 100))) . "...</p>
          <hr><div class='author-info'><span>@" . htmlspecialchars($row['username']) . "</span></div>
        </div>";
}
?>
