<?php
// Database connection
$host = "localhost"; 
$user = "ulohr3f0trnkg";
$pass = "x1xj7z9jz6dd";
$db   = "dbmqvyhlkdvliq";

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all news
$news = $conn->query("SELECT * FROM news ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>MyNews - Homepage</title>
<style>
body { margin:0; font-family:Arial, sans-serif; background:#f8f8f8; }

/* Header */
header { background:#cc0000; color:#fff; padding:15px 30px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; }
header h1 { margin:0; font-size:28px; cursor:pointer; }
nav a { color:#fff; margin:0 12px; text-decoration:none; font-weight:bold; }
nav a:hover { text-decoration:underline; }

/* News Grid */
.news-container { width:90%; margin:20px auto; display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px; }
.news-card { background:#fff; border-radius:10px; padding:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
.news-card img { width:100%; height:auto; display:block; border-radius:8px; } /* FULL IMAGE - NO CROPPING */
.news-card h3 { margin:10px 0; font-size:20px; }
.news-card a { text-decoration:none; color:#cc0000; font-weight:bold; }

/* Footer */
footer { text-align:center; background:#222; color:#fff; padding:15px; margin-top:20px; }
</style>
</head>
<body>

<header>
  <h1 onclick="window.location.href='index.php'">MyNews</h1>
  <nav>
    <a href="index.php">Home</a>
    <a href="category.php?id=1">Business</a>
    <a href="category.php?id=2">World</a>
    <a href="category.php?id=3">Politics</a>
    <a href="category.php?id=4">Technology</a>
    <a href="category.php?id=5">Sports</a>
    <a href="category.php?id=6">Entertainment</a>
  </nav>
</header>

<div style="text-align:right; width:90%; margin:auto; margin-top:10px;">
  <a href="add_article.php" style="background:#28a745; color:#fff; padding:10px 15px; border-radius:5px; text-decoration:none;">+ Add Article</a>
</div>

<div class="news-container">
  <?php while($row = $news->fetch_assoc()): ?>
    <div class="news-card">
      <a href="article.php?id=<?php echo $row['id']; ?>">
        <img src="<?php echo !empty($row['image']) ? $row['image'] : 'images/default.jpg'; ?>" alt="News Image">
        <h3><?php echo $row['title']; ?></h3>
      </a>
    </div>
  <?php endwhile; ?>
</div>

<footer>
  &copy; 2025 MyNews. All Rights Reserved.
</footer>

</body>
</html>
