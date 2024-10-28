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

// Fetch all blog posts from the database ordered by id (ascending) and date (descending)
$sql = "SELECT * FROM blog ORDER BY id ASC, date DESC";
$result = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Blogs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }

        table {
            width: 100%;
        }

        table th,
        table td {
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
                    <a class="nav-link" href="welcome.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog_view.php">Blog</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="reset_password.php" class="btn btn-warning">Reset Password</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Blog Posts</h2>

        <!-- Back Button -->
        <a href="add_blog.php" class="btn btn-secondary mb-3">Back to Add Blog</a>

        <?php
        if (mysqli_num_rows($result) > 0) {
            // Start the table
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Image</th>';
            echo '<th>Title</th>';
            echo '<th>Date</th>';
            echo '<th>Description</th>';
            echo '<th>Created At</th>';
            echo '<th>Actions</th>';  // Column for actions
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';  // Displaying blog post ID
                echo '<td><img src="img/Gallery/' . htmlspecialchars($row['image']) . '" class="img-fluid" alt="Blog Image"></td>';
                echo '<td>' . htmlspecialchars($row['title']) . '</td>';

                // Format the date for display
                $formattedDate = date('F j, Y', strtotime($row['date']));
                echo '<td>' . htmlspecialchars($formattedDate) . '</td>'; // Display formatted date
        
                echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
                echo '<td>';
                echo '<a href="edit_blog.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Edit</a> ';
                echo '<a href="delete_blog.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this blog post?\')">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "<p>No blog posts found.</p>";
        }

        // Close connection
        mysqli_close($link);
        ?>
    </div>
</body>

</html>