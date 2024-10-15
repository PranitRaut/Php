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

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch download logs from the database
$sql = "SELECT download.id, user.email, document.category_docs, document.year, download.download_time 
        FROM download 
        JOIN user ON download.user_id = user.id 
        JOIN document ON download.document_id = document.id
        ORDER BY download.download_time DESC";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin - Documents</title>
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
        <?php

        include "layout.php";

        ?>
        <div class="main-panel">
            <div class="content">
                <h2> Download Logs</h2>
                <div class="card">
                    <div class="card-header">
                        <h4>User Downloads</h4>
                    </div>
                    <div class="card-body">
                        <!-- Display download logs -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>User Email</th>
                                    <th>Document Category</th>
                                    <th>Year</th>
                                    <th>Download Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    // Output data for each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['category_docs'] . "</td>";
                                        echo "<td>" . $row['year'] . "</td>";
                                        echo "<td>" . $row['download_time'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No downloads found</td></tr>";
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
    <script src="assets/js/ready.min.js"></script>
</body>

</html>