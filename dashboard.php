<?php include('db.php'); ?>
<?php
session_start();
if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
    $_SESSION['admin'] = true;
} else if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $content = $_POST['content'];
        $sql = "INSERT INTO articles (title, description, image, content) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $description, $image, $content);
        $stmt->execute();
    } else if ($_POST['action'] === 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM articles WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <label>Title:</label><input type="text" name="title" required>
        <label>Description:</label><input type="text" name="description" required>
        <label>Image URL:</label><input type="text" name="image" required>
        <label>Content:</label><textarea name="content" required></textarea>
        <button type="submit">Add Article</button>
    </form>
    <h3>Delete Articles</h3>
    <form method="POST">
        <input type="hidden" name="action" value="delete">
        <label>ID:</label><input type="number" name="id" required>
        <button type="submit">Delete Article</button>
    </form>
</body>
</html>
