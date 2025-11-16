<?php
session_start();

include 'db.php';

// Fetch all content
$content_sql = "SELECT c.*, u.username, u.profile_picture 
                FROM contents c
                JOIN users u ON c.user_id = u.user_id
                ORDER BY c.createdat DESC";

$content_result = $conn->query($content_sql);

while ($content = $content_result->fetch_assoc()) {
    echo "<h2>{$content['title']}</h2>";
    echo "<p>{$content['description']}</p>";
    echo "<p>By: {$content['username']}</p>";
    if ($content['media_url']) echo "<img src='{$content['media_url']}' width='300'>";
    if ($content['reference_link']) echo "<p><a href='{$content['reference_link']}'>Reference</a></p>";

    // Fetch solutions sorted by upvotes
    $solution_sql = "
        SELECT s.*, u.username,
            (SELECT COUNT(*) FROM solution_upvotes su WHERE su.solution_id = s.solution_id) AS upvotes
        FROM solutions s
        JOIN users u ON s.user_id = u.user_id
        WHERE s.content_id = ?
        ORDER BY upvotes DESC, s.createdat DESC";

    $stmt = $conn->prepare($solution_sql);
    $stmt->bind_param("i", $content['contentid']);
    $stmt->execute();
    $solutions = $stmt->get_result();

    echo "<h3>Solutions:</h3>";
    while ($solution = $solutions->fetch_assoc()) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>";
        echo "<strong>{$solution['title']}</strong> ({$solution['upvotes']} upvotes)<br>";
        echo "<p>{$solution['description']}</p>";
        echo "<p>By: {$solution['username']}</p>";
        if ($solution['media_url']) echo "<img src='{$solution['media_url']}' width='200'><br>";
        if ($solution['solution_link']) echo "<a href='{$solution['solution_link']}'>Solution Link</a>";
        echo "</div>";
    }

    echo "<hr>";
}
?>
