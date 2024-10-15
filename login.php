<?php
session_start();
// Include your database connection
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the email and password from POST request
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    // Fetch user from the database (ensure to hash passwords in production)
    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Store user details in session
        $_SESSION['email'] = $user['email'];
        $_SESSION['is_admin'] = $user['is_admin']; // 1 if admin, 0 if not
        $_SESSION['name'] = $user['name']; // Store username in session
        $_SESSION['user_id'] = $user['id']; // Store user ID in session

        // Redirect based on the user's role
        if ($user['is_admin'] == 1) {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: user.php"); // User dashboard
            exit();
        }
    } else {
        echo "Invalid login credentials!";
    }
}

?>
