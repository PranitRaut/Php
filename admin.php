<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != '1') {
    header("Location: login.html"); // Redirect to login if not admin
    exit();
}

// Database connection
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "login_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count total non-admin users
$sql_users = "SELECT COUNT(*) AS total_users FROM user WHERE is_admin != '1'";
$result_users = $conn->query($sql_users);
$total_users = 0; // Default count

if ($result_users && $row_users = $result_users->fetch_assoc()) {
    $total_users = $row_users['total_users']; // Get the total users count
}

// Query to count total documents
$sql_documents = "SELECT COUNT(*) AS total_documents FROM document";
$result_documents = $conn->query($sql_documents);
$total_documents = 0; // Default count

if ($result_documents && $row_documents = $result_documents->fetch_assoc()) {
    $total_documents = $row_documents['total_documents']; // Get the total documents count
}

// Query to count total downloads
$sql_downloads = "SELECT COUNT(*) AS total_downloads FROM download";
$result_downloads = $conn->query($sql_downloads);
$total_downloads = 0; // Default count

if ($result_downloads && $row_downloads = $result_downloads->fetch_assoc()) {
    $total_downloads = $row_downloads['total_downloads']; // Get the total downloads count
}

// Close the database connection
$conn->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <div class="wrapper">
        <?php include "layout.php"; ?>

        <!-- Main Panel -->
        <div class="main-panel">
            <?php
            // Check for a session message
            if (isset($_SESSION['message'])) {
                echo '<script type="text/javascript">', 'alert("' . $_SESSION['message'] . '");', '</script>';
                unset($_SESSION['message']);
            }
            ?>
            <div class="content">
                <div class="container-fluid">
                    <!-- Dashboard Widgets -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card hover-effect">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Total Users</h4>
                                    <i class="fas fa-users fa-2x"></i> <!-- User icon -->
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $total_users; ?></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card hover-effect">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Total Documents</h4>
                                    <i class="fas fa-file-alt fa-2x"></i> <!-- Document icon -->
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $total_documents; ?></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card text-dark hover-effect">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Total Downloads</h4>
                                    <i class="fas fa-download fa-2x"></i> <!-- Download icon -->
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $total_downloads; ?></h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include "footer.php"; ?>
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