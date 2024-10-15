<?php
// Database credentials
$servername = "localhost"; // Your database server (usually 'localhost')
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "login_db"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can set the character set to utf8 for better encoding support
$conn->set_charset("utf8");
?>
