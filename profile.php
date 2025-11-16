<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch profile info
$stmt = $conn->prepare("SELECT username, bio, profilepicture FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $bio, $profile_picture); // ✅ fixed variable name
$stmt->fetch();
$stmt->close();

if (empty($profile_picture)) $profile_picture = null; // ✅ prevents undefined variable

// Fetch activity
$problems = $conn->query("SELECT contentid, title FROM problems WHERE user_id = $user_id");
$solutions = $conn->query("SELECT s.solutionid, p.title FROM solutions s JOIN problems p ON s.contentid = p.contentid WHERE s.userid = $user_id");
$upvotes = $conn->query("SELECT s.solutionid, s.title FROM solutionupvotes u JOIN solutions s ON u.solutionid = s.solutionid WHERE u.userid = $user_id");

// ✅ Handle profile picture update/delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Delete picture
    if (isset($_POST['delete_picture'])) {
        $conn->query("UPDATE users SET profilepicture = NULL WHERE user_id = $user_id");
        $profile_picture = null;

    // Upload new picture
    } elseif (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {  // ✅ corrected name

        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = time() . "_" . basename($_FILES['profile_picture']['name']); // ✅ avoids duplicate filenames
        $target_path = "uploads/" . $file_name;

        move_uploaded_file($file_tmp, $target_path);

        $stmt = $conn->prepare("UPDATE users SET profilepicture = ? WHERE user_id = ?");
        $stmt->bind_param("si", $target_path, $user_id);
        $stmt->execute();
        $stmt->close();

        $profile_picture = $target_path; // ✅ update variable
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>@<?= htmlspecialchars($username) ?> | Profile</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="postform.css">
    <style>
        .problem-card {
            background-color: rgb(1,4,9);
            width: 20%;
            border: .5px solid rgb(61, 68, 78);
            padding: 25px;
            margin: 10px;
            border-radius: 10px;
        }
        .profileimg { width: 250px; height: 250px; border-radius: 12px; object-fit: cover; }
        .probuser { width: 30px; height: 30px; border-radius: 50%; margin-top: 10px; }
        .username { color: #999; font-size: 14px; margin-left: 10px; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <div class="container1">
        <div class="navbar">
            <div class="left-icons">
                <button class="menu-icon" onclick="toggleSidebar()">☰</button>
                <img src="src/image.svg" alt="Logo" class="logo">
                <h2 class="wename">SOLUTION STORE</h2>
            </div>

            <div class="nav-right">
                <img src="<?= $profile_picture ?: 'src/profile.jpg' ?>" alt="profile" class="profile-pic">
                <a href="logout.php" class="logout-button">Logout</a>
            </div>
        </div>

        <div id="menu1" class="sidebar1">
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
            <a href="login.html">Sign-Up/Log-in</a>
            <a href="logout.php" style="color: rgba(255, 0, 0, 0.735);">Log Out</a>
        </div>
    </div>

    <!-- Profile Info -->
    <div class="profileimgcontainer">
        <img class="profileimg" src="<?= $profile_picture ?: 'src/profile.jpg' ?>" alt="Profile Picture">

        <div style="background-color: transparent; width: 60%; height: auto; border-left: .5px solid rgb(61, 68, 78); margin-left: 60px;">
            <h1 class="urname"><?= htmlspecialchars($username) ?></h1>
            <h3 class="urname" style="font-size: 14px; color: #ccccccb1;"><i>uid: @<?= htmlspecialchars($username) ?></i></h3>
            <h3 class="urname" style="font-size: 14px; color: #ccccccb1;"><?= nl2br(htmlspecialchars($bio)) ?></h3>

            <!-- ✅ Upload Form -->
            <form method="post" enctype="multipart/form-data">
                <input style="margin:20px;" type="file" name="profile_picture" accept="image/*"><br>
                <button type="submit" class="post-btn" style="margin:20px;">Upload New Picture</button>
            </form>

            <!-- ✅ Delete only if picture exists -->
            <?php if ($profile_picture): ?>
            <form method="post">
                <input type="hidden" name="delete_picture" value="1">
                <button class="post-btn" style="margin:20px; background:red;">Delete Picture</button>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <hr/>

    <!-- Activity Section -->
    <h2 style="margin-left:30px; color:#fff;">Your Activity</h2>   

    <h3 style="margin-left:40px; color:#ccc;">Posted Problems</h3>
    <div style="padding: 20px; display: flex; flex-wrap: wrap; gap: 16px;">
        <?php while ($row = $problems->fetch_assoc()): ?>
        <div class="problem-card">
            <h3 class="pname"><u><?= htmlspecialchars($row['title']) ?></u></h3>
            <p class="pdiscription">You posted this problem.</p>
            <a href="problem.php?id=<?= $row['contentid'] ?>">View</a>
        </div>
        <?php endwhile; ?>
    </div>

    <h3 style="color:#ccc; margin-left:40px;">Solutions Given</h3>
    <div style="padding: 20px; display: flex; flex-wrap: wrap; gap: 16px;">
        <?php while ($row = $solutions->fetch_assoc()): ?>
        <div class="problem-card">
            <h3 class="pname"><u><?= htmlspecialchars($row['title']) ?></u></h3>
            <p class="pdiscription">You posted a solution to this problem.</p>
            <a href="problem.php?id=<?= $row['solutionid'] ?>">View</a>
        </div>
        <?php endwhile; ?>
    </div>

    <h3 style="color:#ccc; margin-left:40px;">Upvoted Problems</h3>
    <div style="padding: 20px; display: flex; flex-wrap: wrap; gap: 16px;">
        <?php while ($row = $upvotes->fetch_assoc()): ?>
        <div class="problem-card">
            <h3 class="pname"><u><?= htmlspecialchars($row['title']) ?></u></h3>
            <p class="pdiscription">You upvoted this problem.</p>
            <a href="problem.php?id=<?= $row['solutionid'] ?>">View</a>
        </div>
        <?php endwhile; ?>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("menu1").classList.toggle("open");
        }
    </script>

</body>
</html>
