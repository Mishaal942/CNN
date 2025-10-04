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

$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = $conn->query("SELECT * FROM news WHERE id=$article_id");
if(!$query || $query->num_rows == 0){
    die("<h2>Article not found</h2>");
}

$article = $query->fetch_assoc();
$image = !empty($article['image']) ? $article['image'] : 'images/default.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $article['title']; ?> - MyNews</title>
<style>
body { margin:0; font-family:Arial, sans-serif; background:#f8f8f8; }

.full-image {
    width: 100%;
    height: auto; /* NO CROPPING */
    display: block;
}

.container {
    width: 90%;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
}

.back-btn {
    background:#cc0000; color:#fff; padding:10px 15px;
    border-radius:5px; text-decoration:none; font-weight:bold;
}
</style>
</head>
<body>

<img src="<?php echo $image; ?>" class="full-image">

<div class="container">
    <h2><?php echo $article['title']; ?></h2>
    <p><?php echo nl2br($article['content']); ?></p>
    <a href="index.php" class="back-btn">← Back to Home</a>
</div>

</body>
</html>
