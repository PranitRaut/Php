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

// Fetch users from the database (only non-admin users)
$user_query = "SELECT id, email FROM user WHERE is_admin = 0";
$user_result = $conn->query($user_query);

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $selected_user = $_POST['user_id']; // Get the selected user ID
    $year = $_POST['year']; // Year for the document
    
    // Directory to store the document or image
    $target_dir = "assets/docs/";

    // Loop through each document-category pair
    $categories = $_POST['category']; // Array of categories
    $documents = $_FILES['documents']; // Array of uploaded documents

    $file_count = count($documents['name']);
    $uploadOk = 1;
    $allowed_types = array('pdf', 'doc', 'docx', 'txt', 'jpg', 'jpeg', 'png', 'gif');

    for ($i = 0; $i < $file_count; $i++) {
        $category = $categories[$i]; // Get the category for the current document
        $doc_name = basename($documents['name'][$i]);
        $target_file = $target_dir . uniqid() . "-" . $doc_name;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow only specific document and image types
        if (!in_array($fileType, $allowed_types)) {
            $_SESSION['message'] = "Only PDF, DOC, DOCX, TXT, JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
            break; // Stop uploading if any invalid file is found
        }

        // Upload the file if valid
        if ($uploadOk == 1 && move_uploaded_file($documents['tmp_name'][$i], $target_file)) {
            // Insert the document details into the database, with the user ID and category
            $sql = "INSERT INTO document (category_docs, year, upload_docs, user_id) VALUES ('$category', '$year', '$target_file', '$selected_user')";
            if (!$conn->query($sql)) {
                $_SESSION['message'] = "Database error: " . $conn->error;
                break; // Stop if there is a database error
            }
        } else {
            $_SESSION['message'] = "Sorry, there was an error uploading your file.";
            break; // Stop if there is an error uploading any file
        }
    }

    if ($uploadOk == 1) {
        $_SESSION['message'] = "All documents have been uploaded successfully.";
        echo '<script type="text/javascript">
                window.location.href = "documents.php";
              </script>';
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin - Add Documents</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/css/ready.css">
    <link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <?php include "layout.php"; ?>

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Upload Documents</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Document Upload Form -->
                                    <form action="add_document.php" method="POST" enctype="multipart/form-data" id="documentForm">
                                        <div class="form-group">
                                            <label for="user_id">Select User</label>
                                            <select name="user_id" class="form-control" required>
                                                <option value="">-- Select User --</option>
                                                <?php
                                                if ($user_result->num_rows > 0) {
                                                    while ($user_row = $user_result->fetch_assoc()) {
                                                        echo "<option value='" . $user_row['id'] . "'>" . $user_row['email'] . "</option>";
                                                    }
                                                } else {
                                                    echo "<option disabled>No users found</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="year">Year</label>
                                            <input type="number" name="year" class="form-control" required>
                                        </div>

                                        <!-- Dynamic Document-Category Fields -->
                                        <div id="documentFields">
                                            <div class="document-field">
                                                <div class="form-group">
                                                    <label for="category">Category</label>
                                                    <select name="category[]" class="form-control" required>
                                                        <option value="">-- Select Category --</option>
                                                        <option value="Photo">Photo</option>
                                                        <option value="Aadhaar Card">Aadhaar Card</option>
                                                        <option value="PAN Card">PAN Card</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="documents">Document</label>
                                                    <input type="file" name="documents[]" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-secondary" id="addDocumentBtn">Add Document</button>
                                        <br><br>
                                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                        <a class="btn btn-secondary" href="documents.php">Back</a>
                                    </form>
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
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/ready.min.js"></script>

    <!-- Custom JS to Add More Document Fields -->
    <script>
        document.getElementById('addDocumentBtn').addEventListener('click', function() {
            // Create a new document fieldset
            var newField = document.createElement('div');
            newField.classList.add('document-field');

            newField.innerHTML = `
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category[]" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        <option value="Photo">Photo</option>
                        <option value="Aadhaar Card">Aadhaar Card</option>
                        <option value="PAN Card">PAN Card</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="documents">Document</label>
                    <input type="file" name="documents[]" class="form-control" required>
                </div>`;

            // Append the new fieldset to the documentFields div
            document.getElementById('documentFields').appendChild(newField);
        });
    </script>
</body>

</html>
