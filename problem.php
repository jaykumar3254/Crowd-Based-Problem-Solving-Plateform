<?php
session_start();
include 'db.php';

// Validate and get content_id from query string
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid problem ID!");
}

$content_id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'] ?? null;

// Fetch problem and poster's user info
$stmt = $conn->prepare("
    SELECT p.*, u.username, u.profilepicture
    FROM problems p
    JOIN users u ON p.user_id = u.user_id
    WHERE p.contentid = ?
");
$stmt->bind_param("i", $content_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Problem not found.");
}

$problem = $result->fetch_assoc();

// Fetch community solutions with upvotes and user info
$sql2 = "
    SELECT s.solutionid, s.title AS sol_title, s.description AS sol_desc,
           s.mediaurl, s.solutionlink, u.username AS sol_user,
           (SELECT COUNT(*) FROM solution_upvotes su WHERE su.solutionid = s.solutionid) AS upvotes,
           EXISTS (SELECT 1 FROM solution_upvotes su WHERE su.solutionid = s.solutionid AND su.user_id = ?) AS already_upvoted
    FROM solutions s
    JOIN users u ON s.userid = u.user_id
    WHERE s.contentid = ?
    ORDER BY upvotes DESC, s.solutionid DESC
";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("ii", $user_id, $content_id);
$stmt2->execute();
$solutions = $stmt2->get_result();
?>

<!doctype html>
<html>
<head>
  <title><?= htmlentities($problem['title']) ?></title>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="navbar.css">
  <style>
    .container { max-width: 800px; margin: auto; padding: 20px; }
    .solution-card { border:1px solid #444; padding:15px; margin:10px 0; border-radius:6px; background:#222; }
    .upvote-btn { background:#28a745; color:#fff; border:none; padding:5px 10px; cursor:pointer; border-radius: 4px; }
    .upvote-btn[disabled] { background: #555; cursor: not-allowed; }
    #newSolutionForm { margin-top:20px; border:1px solid #555; padding:15px; background: #222; border-radius: 6px; }
    .author-info { display: flex; align-items: center; margin-top: 10px; }
    .author-info img.avatar { width: 40px; height: 40px; border-radius: 50%; margin-right: 10px; object-fit: cover; }
    input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; border-radius: 4px; border: 1px solid #666; background: #111; color: #fff; }
    button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
  </style>
</head>
<body>
  <div class="navbar">
              <div class="left-icons">
                <button class="menu-icon" onclick="toggleSidebar()">☰</button>
                <img src="src/image.svg" alt="Logo" class="logo">
                <h2 class="wename">SOLUTION STORE</h2>
              </div>
              <div>
<!--<input type="text" class="search" placeholder="Search...">-->
              </div>
              <div class="nav-right">
                <button class="post-btn" id="postBtn">Post</button>
                <a id="profilelink" href="#">
                  <img id="avatar" src="src/profile.jpg" alt="Avatar" class="profile-pic">
                </a>

                <a href="logout.php" class="logout-button">Logout</a>
                <script>
                  fetch('dp.php')
                    .then(res => res.json())
                    .then(data => {
                      if (data.avatar) {
                        document.getElementById('avatar').src = data.avatar;
                        document.getElementById('profilelink').href = 'profile.php';
                      }
                    })
                    .catch(err => {
                      console.error("Failed to load profile image:", err);
                    });
                </script>
              </div>
            </div>
                 
    <h1 style="
    padding: 20px;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    border: 1px solid rgb(61, 68, 78);
    text-align: center;
    border-radius: 5px;
  ">Problem Details</h1>
              
  <main class="container">
    <section class="problem-detail">
      <h1><?= htmlentities($problem['title']) ?></h1>
      <p><?= nl2br(htmlentities($problem['description'])) ?></p>
      <?php if (!empty($problem['reference_link'])): ?>
        <p><a href="<?= htmlentities($problem['reference_link']) ?>" target="_blank">Reference</a></p>
      <?php endif; ?>
      <div class="author-info">
        <img src="<?= htmlentities($problem['profilepicture']) ?>" alt="@<?= htmlentities($problem['username']) ?>" class="avatar">
        <span>@<?= htmlentities($problem['username']) ?></span>
      </div>
    </section>

    <section class="problem-card">
      <h2>Community Solutions</h2>
      <?php if ($solutions->num_rows === 0): ?>
        <p>No solutions yet. Be the first to submit one!</p>
      <?php endif; ?>
      <?php while ($s = $solutions->fetch_assoc()): ?>
        <div class="problem-card">
          <h4><?= htmlentities($s['sol_title']) ?> </h4>
          
          <p><?= nl2br(htmlentities($s['sol_desc'])) ?></p>
          <?php if ($s['mediaurl']): ?>
            <p><img src="<?= htmlentities($s['mediaurl']) ?>" alt="Solution Media" style="max-width:200px;"></p>
          <?php endif; ?>
          <?php if ($s['solutionlink']): ?>
            <p><a class="post-btn" href="<?= htmlentities($s['solutionlink']) ?>" target="_blank" >View Solution</a></p>
          <?php endif; ?>
          <p>By: @<?= htmlentities($s['sol_user']) ?></p>
          <h3>&#9829 <?= $s['upvotes'] ?></h3>

          <!-- ✅ Upvote Button -->
          <?php if ($user_id): ?>
            <form method="POST" action="upvotes.php" style="margin-top:10px;">
              <input type="hidden" name="solutionid" value="<?= $s['solutionid'] ?>">
              <button class="post-btn" <?= $s['already_upvoted'] ? 'disabled' : '' ?>>
                <?= $s['already_upvoted'] ? 'Upvoted' : '⬆Upvote' ?>
              </button>
            </form>
          <?php else: ?>
            <p><a href="login.html">Login to upvote</a></p>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </section>

    <?php if ($user_id): ?>
    <section class="problem-card" id="newSolutionForm">
      <h3>Submit Your Solution</h3>
      <form class="problem-card" id="solutionForm">
        <input type="hidden" name="content_id" value="<?= $content_id ?>">
        <input type="text" name="title" placeholder="Solution Title" required>
        <textarea name="description" placeholder="Solution Description" required></textarea>
        <input type="url" name="media_url" placeholder="Media URL (optional)">
        <input type="url" name="solution_link" placeholder="Solution Link (optional)">
        <button type="submit">Post Solution</button>
      </form>
    </section>
    <?php else: ?>
      <p><a href="login.html">Login</a> to submit a solution.</p>
    <?php endif; ?>
  </main>

  <script>
  document.getElementById("solutionForm")?.addEventListener("submit", function(e) {
    e.preventDefault();
    fetch("pstsolution.php", {
      method: "POST",
      body: new FormData(this)
    })
    .then(res => res.text())
    .then(msg => {
      alert(msg);
      if (msg.toLowerCase().includes("success")) {
        location.reload();
      }
    })
    .catch(err => alert("Failed to submit solution."));
  });
  </script>
</body>
</html>
