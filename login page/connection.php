<?php
// Database connection details
$servername = "localhost";
$username = "root";  // Default MySQL username
$password = "";      // Leave empty if no password is set for MySQL
$dbname = "demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>