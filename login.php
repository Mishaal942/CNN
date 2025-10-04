session_start(); // Always start the session at the very top of the PHP file
<?php
session_start();

// Dummy credentials (replace with real database checking in production)
$correct_username = "admin";
$correct_password = "password123";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the credentials match
    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['loggedin'] = true; // Set session variable for login status
        $_SESSION['username'] = $username; // Store the username in session
        header("Location: dashboard.php"); // Redirect to dashboard after successful login
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>

    <div class="login-box">
        <h2>Admin Login</h2>
        
        <!-- Display error message if login fails -->
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <div class="textbox">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="textbox">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

</body>
</html>
