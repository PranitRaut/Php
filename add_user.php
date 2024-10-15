<?php
session_start();
// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != '1') {
    header("Location: login.html"); // Redirect to login if not admin
    exit();
}

// Include database connection
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0; // Set admin status based on checkbox

    // Hash the password (important for security)
    $password = md5($password);

    // Insert the new user into the database
    $query = "INSERT INTO user (name, email, password, is_admin) VALUES ('$name', '$email', '$password', '$is_admin')";

    if (mysqli_query($conn, $query)) {
        // Set success message
        $_SESSION['message'] = "User added successfully.";
        // Redirect to admin.php after successfully adding the user
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin Dashboard</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <?php

        include "layout.php";

        ?>

        <!-- Main Panel -->
        <div class="main-panel">

        <div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Add User</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter user's name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter user's email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter user's password" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4"> <!-- Flexbox for button arrangement -->
                        <button type="submit" class="btn btn-primary">Add User</button>
                        <a class="btn btn-secondary" href="admin.php">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


            <!-- Footer -->
            <!-- Footer -->
            <?php
            include "footer.php";
            ?>
        </div>
    </div>

    <!-- JS Files -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/chartist/chartist.min.js"></script>
    <script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/js/ready.min.js"></script>
    <script src="assets/js/demo.js"></script>
</body>

</html>