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

// Initialize the search variable
$search = "";

// Check if the search form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim and store the search input from the form
    $search = trim($_POST['search']);
}

// Prepare the SQL statement to fetch blog posts based on the search term
$sql = "SELECT * FROM blog WHERE title LIKE ? ORDER BY id ASC, date DESC";
$stmt = mysqli_prepare($link, $sql);

// Bind parameters for the prepared statement
$searchParam = '%' . $search . '%'; // Add wildcards for partial matches
mysqli_stmt_bind_param($stmt, 's', $searchParam);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result set from the executed statement
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Blogs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        img {
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Navbar content here -->
    </nav>

    <div class="container">
        <h2>Blog Posts</h2>

        <a href="add_blog.php" class="btn btn-secondary mb-3">Back to Add Blog</a>

        <?php
        // Check if there are any blog posts to display
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Image</th>';
            echo '<th>Title</th>';
            echo '<th>Date</th>';
            echo '<th>Description</th>';
            echo '<th>Created At</th>';
            echo '<th>Actions</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td><img src="img/Gallery/' . htmlspecialchars($row['image']) . '" class="img-fluid" alt="Blog Image"></td>';
                echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                $formattedDate = date('F j, Y', strtotime($row['date']));
                echo '<td>' . htmlspecialchars($formattedDate) . '</td>';
                echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
                echo '<td>';
                echo '<div class="d-flex justify-content-center">';
                echo '<a href="edit_blog.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>';
                echo '<a href="delete_blog.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this blog post?\')"><i class="fas fa-trash-alt"></i></a>';
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "<p>No blog posts found.</p>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);
        ?>
    </div>

    <!-- jQuery and DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "searching": true,
                "ordering": true,
                "info": true,
                "order": [[0, 'asc']]
            });
        });
    </script>
</body>
</html>
