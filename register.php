<html>
    
<?php 
$conn = mysqli_connect("localhost", "root", "", "user");

if (!$conn) {
    echo "<script>alert('Connection failed.');</script>";
    exit();
}

$name = $_POST['Name'];
$mail = $_POST['Email'];
$mono = $_POST['MoNo'];
$pass = $_POST['Password'];
$pass1 = $_POST['re-password'];

if ($pass !== $pass1) {
    echo "<script>alert('Passwords do not match.');</script>";
    exit();
}

$qry = "INSERT INTO userdb (Name, Email, MoNo, Pass) VALUES ('$name', '$mail', '$mono', '$pass')";

if (mysqli_query($conn, $qry)) {
    echo "<script> alert('New record created successfully');window.location.href = 'index.html';</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
}
?>
</html>