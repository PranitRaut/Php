<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="logout.php">Logout</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                 <li class="nav-item">
                <a href="reset_password.php" class="btn btn-warning">Reset Password</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1> -->
    <!-- <p> 
        <a href="reset_password.php" class="btn btn-warning">Reset Your Password</a>
         <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a> 
    </p> -->

    <a class="btn btn-outline-warning" href="register_data.php">view</a>
</body>

</html>