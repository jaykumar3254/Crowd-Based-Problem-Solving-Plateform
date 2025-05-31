<?php
session_start();
header('Content-Type: text/plain');

$conn = new mysqli("localhost", "root", "", "user");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];

$sql = "SELECT * FROM userdb WHERE Email = '$email'";
$result = mysqli_query($conn,$sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if ($password === $row['Pass']){
        echo "Login successful";
    } else {
        echo "Invalid password";
    }
} else {
    echo "Email not found";
}

$conn->close();
?>
