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

// Initialize variables
$id = $category = $year = $is_active = "";

// Get the document ID from the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure it's an integer

    // Fetch the document details
    $sql = "SELECT category_docs, year, is_active FROM document WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($category, $year, $is_active);
    $stmt->fetch();
    $stmt->close();
}

// Handle the form submission for updating the document
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $year = $_POST['year'];
    $is_active = $_POST['is_active'];

    // Update the document in the database
    $update_query = "UPDATE document SET category_docs = ?, year = ?, is_active = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssii", $category, $year, $is_active, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Document updated successfully.";
        header("Location: documents.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to update document.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Edit Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
   
</head>

<body>
    <div class="wrapper">
        <?php include "layout.php"; // Include your sidebar and layout ?>
        
        <div class="main-panel">
            <div class="content">
                <div class="container mt-5">
                    <h2>Edit Document</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="category">Document Category:</label>
                            <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($category); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="year">Year:</label>
                            <input type="text" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars($year); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Status:</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1" <?php echo ($is_active == 1) ? 'selected' : ''; ?>>Active</option>
                                <option value="0" <?php echo ($is_active == 0) ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Document</button>
                        <a href="documents.php" class="btn btn-secondary">Back</a>
                    </form>
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
    <script src="assets/js/core/bootstrap.min.js"></script>
</body>

</html>
