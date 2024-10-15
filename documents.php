<?php
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != '1') {
    header("Location: login.html"); // Redirect to login if not admin
    exit();
}

// Database connection
include("db_connection.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle document deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Fetch the file path
    $file_query = "SELECT upload_docs FROM document WHERE id = ?";
    $stmt = $conn->prepare($file_query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->bind_result($file_path);
    $stmt->fetch();
    $stmt->close();

    // Delete the file from the server
    if (file_exists($file_path)) {
        unlink($file_path); // Delete the file
    }

    // Delete the document from the database
    $delete_query = "DELETE FROM document WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Document deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete document.";
    }
    $stmt->close();

    // Redirect with a message
    echo '<script type="text/javascript">
            window.location.href = "documents.php";
          </script>';
    exit();
}

// Fetch documents from the database
$sql = "SELECT id, category_docs, year, upload_docs, is_active FROM document";
$result = $conn->query($sql);

// Check for a session message
if (isset($_SESSION['message'])) {
    echo '<script type="text/javascript">alert("' . $_SESSION['message'] . '");</script>';
    unset($_SESSION['message']);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin - Documents</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">

</head>

<body>
    <div class="wrapper">
        <?php
        include "layout.php";
        ?>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Uploaded Documents</h4>
                                    <a href="add_document.php" class="btn btn-primary float-right">Add Document</a>
                                </div>
                                <div class="card-body">
                                    <!-- Display uploaded documents -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Year</th>
                                                <th>Document</th>
                                                <th>Status</th>
                                                <th>Actions</th>
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
                                                    echo "<td>" . ($row['is_active'] == 1 ? 'Active' : 'Inactive') . "</td>";
                                                    echo "<td>
                                                            <a href='edit_document.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                                            <form method='POST' action='' style='display:inline-block;'>
                                                                <input type='hidden' name='delete_id' value='" . $row['id'] . "' />
                                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                            </form>
                                                          </td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>No documents found</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
