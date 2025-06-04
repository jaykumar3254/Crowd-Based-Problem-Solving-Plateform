<?php 
include 'db.php'; // Include database connection file

$name = $_POST['Name'];
$mail = $_POST['Email'];
$mono = $_POST['MoNo'];
$pass = $_POST['Password'];
$pass1 = $_POST['re-password'];

if ($pass !== $pass1) {
    echo "Passwords do not match.";
    exit();
}

$qry = "INSERT INTO userdb (Name, Email, MoNo, Pass) VALUES ('$name', '$mail', '$mono', '$pass')";

if (mysqli_query($conn, $qry)) {
    echo "New record created successfully";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>