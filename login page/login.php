<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "demo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['Username'];
    $input_password = $_POST['password'];

    // Hash the input password using MD5
    $input_password_md5 = md5($input_password);

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM user WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User exists, verify password
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Compare the MD5 hash of the input password with the stored hash
        if ($input_password_md5 === $hashed_password) {
            // Set session variables
            $_SESSION['username'] = $input_username;
            $_SESSION['loggedin'] = true;

            // Optionally, set a cookie to remember the user for 7 days
            if (!empty($_POST['remember_me'])) {
                setcookie("username", $input_username, time() + (7 * 24 * 60 * 60), "/"); // 7 days
            }

            // Redirect to ../admin on success
            header("Location: home.php");
            exit(); // Always exit after a redirect to prevent further script execution
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
    $stmt->close();
}

$conn->close();
?>
