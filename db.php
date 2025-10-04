<?php
$servername = "localhost";
$username = "ulohr3f0trnkg";
$password = "x1xj7z9jz6dd";
$database = "dbmqvyhlkdvliq";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
