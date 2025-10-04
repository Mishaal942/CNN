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

// Handle form submission
if(isset($_POST['submit'])){
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $category_id = (int)$_POST['category'];

    // Handle image upload properly
    $image = 'images/default.jpg'; // Default image

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $target_dir = "images/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_type = mime_content_type($file_tmp);  // Detect file type
        $allowed_types = ['image/jpeg','image/png','image/jpg','image/webp'];

        if(in_array($file_type, $allowed_types)){
            $file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $new_file_name = time() . "_" . rand(1000,9999) . "." . $file_ext;
            $image = $target_dir . $new_file_name;
            move_uploaded_file($file_tmp, $image);
        }
    }

    $sql = "INSERT INTO news (title, content, category_id, image) VALUES ('$title','$content',$category_id,'$image')";
    if($conn->query($sql)){
        echo "<script>alert('Article added successfully'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Article</title>
<style>
body { font-family:Arial, sans-serif; background:#f4f4f4; margin:0; padding:0; }
.container { width:80%; margin:30px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.2);}
h2 { text-align:center; color:#cc0000; }
form { display:flex; flex-direction:column; }
label { margin:10px 0 5px; font-weight:bold; }
input[type=text], textarea, select { padding:10px; border-radius:5px; border:1px solid #ccc; width:100%; box-sizing:border-box; }
textarea { resize:none; height:150px; }
input[type=file] { margin-top:5px; }
input[type=submit] { background:#cc0000; color:#fff; padding:10px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; margin-top:20px; }
input[type=submit]:hover { background:#990000; }
</style>
</head>
<body>

<div class="container">
<h2>Add New Article</h2>
<form method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title" required>

    <label>Content</label>
    <textarea name="content" required></textarea>

    <label>Category</label>
    <select name="category" required>
        <option value="">-- Select Category --</option>
        <?php
        $categories = $conn->query("SELECT * FROM categories ORDER BY name ASC");
        while($cat = $categories->fetch_assoc()){
            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
        }
        ?>
    </select>

    <label>Upload Image</label>
    <input type="file" name="image" accept="image/*">

    <input type="submit" name="submit" value="Add Article">
</form>
<a href="index.php">Back to Home</a>
</div>

</body>
</html>
