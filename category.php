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

// Get category ID
$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$category = $conn->query("SELECT name FROM categories WHERE id=$category_id")->fetch_assoc();
$category_name = $category ? $category['name'] : "Unknown Category";

// Fetch articles from category
$news = $conn->query("SELECT * FROM news WHERE category_id=$category_id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $category_name; ?> - MyNews</title>
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
.news-card img { width:100%; height:auto; display:block; border-radius:8px; } /* FULL IMAGE */
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
    <a href="category.php?id=1">Business</a>
    <a href="category.php?id=2">World</a>
    <a href="category.php?id=3">Politics</a>
    <a href="category.php?id=4">Technology</a>
    <a href="category.php?id=5">Sports</a>
    <a href="category.php?id=6">Entertainment</a>
  </nav>
</header>

<div style="width:90%; margin:auto; margin-top:10px;">
  <h2><?php echo $category_name; ?></h2>
</div>

<div class="news-container">
  <?php if($news->num_rows > 0): ?>
    <?php while($row = $news->fetch_assoc()): ?>
      <div class="news-card">
        <a href="article.php?id=<?php echo $row['id']; ?>">
          <img src="<?php echo !empty($row['image']) ? $row['image'] : 'images/default.jpg'; ?>" alt="News Image">
          <h3><?php echo $row['title']; ?></h3>
        </a>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p style="text-align:center; width:100%;">No articles found in this category.</p>
  <?php endif; ?>
</div>

<footer>
  &copy; 2025 MyNews. All Rights Reserved.
</footer>

</body>
</html>
