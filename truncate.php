<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "cspsp";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Disable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

// Fetch all table names
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Truncate each table
foreach ($tables as $table) {
    $conn->query("TRUNCATE TABLE `$table`");
    echo "Truncated table: $table<br>";
}

// Re-enable foreign key checks
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

$conn->close();
?>
