<?php
include 'db.php'; // your DB connection

// DEBUG: Check if database connection failed
if (!$conn) {
    die('<div class="recenttop">Database connection failed: ' . mysqli_connect_error() . '</div>');
}

// Fetch all problems by solution count (no limit)
$sql = "
  SELECT p.contentid, p.title, COUNT(s.solutionid) AS solution_count 
  FROM problems p 
  LEFT JOIN solutions s ON p.contentid = s.contentid 
  GROUP BY p.contentid, p.title 
  ORDER BY solution_count DESC
";

$result = mysqli_query($conn, $sql);

// DEBUG: Check for SQL error
if (!$result) {
    die('<div class="recenttop">SQL Error: ' . mysqli_error($conn) . '</div>');
}

// Check if any rows returned
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $title = htmlspecialchars($row['title']);
        $id = urlencode($row['contentid']);

        echo '
        <div  style=" border-bottom: 1px solid rgb(61, 68, 78);  border-radius:0px; margin:15px; padding:5px;">
          <a  href="problem.php?id=' . $id . '" style=" font-weight:100;  font-family: "Open Sans", sans-serif; color: white; text-decoration: none;">' . $title . '</a>
        </div>';
    }
} else {
    echo '<div class="recenttop">No problems found</div>';
}
?>
