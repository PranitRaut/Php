<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "user_login"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values and sanitize them
    $name = trim($_POST['name']);
    $input_username = trim($_POST['Username']);
    $email = trim($_POST['email']);
    $input_password = trim($_POST['password']);
    $phone = trim($_POST['phone']);

    // Hash the password (use a stronger hashing method for production)
    $hashed_password = md5($input_password);

    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO users (name, username, email, password,phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $input_username, $email, $hashed_password,$phone);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful, show alert and redirect
        echo "<script>
            alert('Registration successful! Redirecting to login page...');
        </script>";
        header("location: index.php");
        exit();
    } else {
        // If there is an error, show alert and redirect back to register page
        echo "<script>
            alert('Error: Could not register. Please try again.');
            window.location.href = 'register.php';
        </script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
