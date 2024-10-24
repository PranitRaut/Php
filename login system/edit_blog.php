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

// Define variables and initialize with empty values
$title = $date = $description = $image = "";
$id = $_GET['id'];

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // Image upload handling (if a new image is uploaded)
    if ($_FILES['image']['name']) {
        $target_dir = "img/Gallery/";
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        // If no new image is uploaded, keep the current image
        $image = $_POST['current_image'];
    }

    // Update the blog post in the database
    $sql = "UPDATE blog SET title = ?, date = ?, description = ?, image = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $title, $date, $description, $image, $id);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the view page after successful update
            header("location: view_blog.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
}

// Fetch the current blog post data to display in the form
$sql = "SELECT * FROM blog WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $date = $row['date'];
            $description = $row['description'];
            $image = $row['image'];
        } else {
            echo "Blog post not found.";
            exit();
        }
    }
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
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
        <h2>Edit Blog Post</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($date); ?>" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="form-group">
                <label>Current Image</label><br>
                <img src="img/Gallery/<?php echo htmlspecialchars($image); ?>" width="200" alt="Blog Image"><br>
                <label>Upload New Image</label>
                <input type="file" name="image" class="form-control">
                <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($image); ?>">
            </div>
            <input type="submit" class="btn btn-primary" value="Update">
            <a href="view_blog.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
