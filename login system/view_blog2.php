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
    $search = trim($_POST['search']);
}

// Prepare the SQL statement to fetch blog posts based on the search term across multiple columns
$sql = "SELECT * FROM blog 
        WHERE id LIKE ? 
        OR title LIKE ? 
        OR date LIKE ? 
        OR description LIKE ? 
        OR created_at LIKE ? 
        ORDER BY id ASC, date DESC";
$stmt = mysqli_prepare($link, $sql);
$searchParam = '%' . $search . '%';
mysqli_stmt_bind_param($stmt, 'sssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
mysqli_stmt_execute($stmt);
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
        .container { margin-top: 20px; }
        img { max-height: 100px; object-fit: cover; }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">navbar</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="welcome.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="blog_view.php">Blog</a></li>
            </ul>
            <!-- Search form -->
            <form class="form-inline my-2 my-lg-0" method="post" action="">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search"
                    value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul class="navbar-nav ml-2">
                <li class="nav-item"><a href="reset_password.php" class="btn btn-warning"><i class="fas fa-key"></i></a></li>
                <li class="nav-item"><a class="btn btn-outline-primary" href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Blog Posts</h2>
        <a href="add_blog.php" class="btn btn-secondary mb-3">Back to Add Blog</a>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table id="blogTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><img src="img/Gallery/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" alt="Blog Image"></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo date('F j, Y', strtotime($row['date'])); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="edit_blog.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                    <a href="delete_blog.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog post?')"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No blog posts found.</p>
        <?php endif; ?>

        <?php
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#blogTable').DataTable({
                "ordering": true,
                "searching": false,  // Disable DataTables search
                "order": [[0, "asc"]],
                "lengthMenu": [5, 10, 15]
            });
        });
    </script>
</body>

</html>
