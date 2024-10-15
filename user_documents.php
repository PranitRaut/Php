<?php
session_start();

// Check if the user is logged in and is not an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == '1') {
    header("Location: login.html"); // Redirect to login if not a valid user
    exit();
}

$user_id = $_SESSION['user_id']; // Assuming you store user_id in session

// Database connection
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "login_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Log download if a file is downloaded
if (isset($_GET['download_id'])) {
    $document_id = $_GET['download_id'];
    $download_time = date('Y-m-d H:i:s');

    $log_sql = "INSERT INTO download (user_id, document_id, download_time) VALUES ('$user_id', '$document_id', '$download_time')";
    $conn->query($log_sql);

    // Redirect to the document for download
    $doc_sql = "SELECT upload_docs FROM document WHERE id = '$document_id'";
    $doc_result = $conn->query($doc_sql);
    if ($doc_result->num_rows > 0) {
        $doc_row = $doc_result->fetch_assoc();
        $file_path = $doc_row['upload_docs'];
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        readfile($file_path);
        exit();
    }
}

// Fetch only active documents for the current logged-in user
$sql = "SELECT id, category_docs, year, upload_docs FROM document WHERE is_active = 1 AND user_id = '$user_id'";
$result = $conn->query($sql);

$conn->close();
?>

<?php

if (isset($_SESSION['name'])) {
    echo "Welcome, " . $_SESSION['name'] . "!";
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>User Dashboard</title>
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
        <!-- Main Header -->
        <div class="main-header">
            <div class="logo-header">
                <a href="user.php" class="logo">
                    User Dashboard
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <!-- Search Bar -->
                    <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </span>
                            </div>
                        </div>
                    </form>

                    <!-- User Profile -->
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle">
                                <span><?php echo  $_SESSION['name'];?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4><?php echo  $_SESSION['name'];?></h4>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item ">
                        <a href="user.php">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a href="user_documents.php">
                            <i class="la la-file"></i>
                            <p>View Documents</p>
                        </a>
                    </li>
                    <!-- Removed admin-specific sections like 'Admin Dashboard' -->
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <div class="content">
                <h2>View Documents</h2>
                <div class="card">
                    <div class="card-header">
                        <h4>Available Documents</h4>
                    </div>
                    <div class="card-body">
                        <!-- Display documents for users to view and download -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Year</th>
                                    <th>Document</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    // Output data for each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['category_docs']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                                        echo "<td><a href='" . htmlspecialchars($row['upload_docs']) . "' target='_blank'>View Document</a></td>";
                                        echo "<td><a href='user_documents.php?download_id=" . $row['id'] . "' class='btn btn-success btn-sm'>Download</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No active documents found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php
            include "footer.php";
            ?>
        </div>
    </div>

    <!-- JS Files -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
</body>

</html>