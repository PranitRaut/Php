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
            <!-- Search form -->
            <form class="form-inline my-2 my-lg-0" method="post" action="">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search"
                    value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                        class="fas fa-search"></i></button>
            </form>

            <ul class="navbar-nav ml-2">
                <li class="nav-item">
                    <a href="reset_password.php" class="btn btn-warning"><i class="fas fa-key"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-2">
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Blog Posts</h2>

        <!-- Back Button -->
        <a href="add_blog.php" class="btn btn-secondary mb-3">Back to Add Blog</a>

        <?php
        // Check if there are any blog posts to display
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

        // Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        ?>
    </div>
</body>

</html>