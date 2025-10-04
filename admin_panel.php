<?php
// Example session check to ensure the user is logged in
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your updated CSS file -->
</head>
<body>
    <!-- Main Container -->
    <div class="container">
        
        <!-- Header Section -->
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>

        <!-- Admin Dashboard Section -->
        <div class="dashboard">
            <div class="widget">
                <h2>Total Users</h2>
                <p>500</p>
            </div>
            <div class="widget">
                <h2>News Articles</h2>
                <p>120</p>
            </div>
            <div class="widget">
                <h2>Messages</h2>
                <p>40</p>
            </div>
            <div class="widget">
                <h2>Active Orders</h2>
                <p>8</p>
            </div>
        </div>

        <!-- News Section -->
        <div class="news-card">
            <div class="card">
                <img src="https://via.placeholder.com/600x400" alt="News Image">
                <div class="content">
                    <h3>Latest News 1</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non urna nec nunc luctus...</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/600x400" alt="News Image">
                <div class="content">
                    <h3>Latest News 2</h3>
                    <p>Donec non tortor ut odio sodales malesuada at eu ligula. Integer euismod tempor mauris...</p>
                </div>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/600x400" alt="News Image">
                <div class="content">
                    <h3>Latest News 3</h3>
                    <p>Quisque nec urna vel purus convallis varius. Aenean suscipit turpis nec mauris porttitor...</p>
                </div>
            </div>
        </div>

        <!-- Button to Log Out -->
        <a href="logout.php" class="button">Logout</a>
    </div>
</body>
</html>
