<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Check if the `id` parameter is set in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Prepare the delete query
    $sql = "DELETE FROM blog WHERE id = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the blog view page after successful deletion
            header("location: view_blog.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    // If the `id` parameter is missing, redirect to the view page
    header("location: view_blog.php");
    exit();
}

// Close the database connection
mysqli_close($link);
?>
