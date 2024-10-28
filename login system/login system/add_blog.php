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
$title = $description = $date = $image = "";
$title_err = $description_err = $date_err = $image_err = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter a title.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter a description.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Validate date
    if (empty(trim($_POST["date"]))) {
        $date_err = "Please enter a date.";
    } else {
        $date = trim($_POST["date"]);
    }

    // Validate and upload image
    if ($_FILES["image"]["error"] == 0) {
        $target_dir = "img/Gallery/";
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;

        // Move uploaded file to the uploads directory
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_err = "There was an error uploading the file.";
        }
    } else {
        $image_err = "Please upload an image.";
    }

    // Check for errors before inserting into database
    if (empty($title_err) && empty($description_err) && empty($date_err) && empty($image_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO blog (title, description, date, image) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_title, $param_description, $param_date, $param_image);

            // Set parameters
            $param_title = $title;
            $param_description = $description;
            $param_date = $date;
            $param_image = $image;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the view blog page
                header("location: view_blog.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 500px;
            margin: 0 auto;
            border: 2px solid blue;
            /* Blue border */
            padding: 20px;
            /* Padding for inner spacing */
            border-radius: 10px;
            /* Rounded corners */
            background-color: #f9f9f9;
            /* Light background color */
        }

        .btn-back {
            border: 2px solid blue;
            /* Blue border */
            background-color: white;
            /* White background */
            color: blue;
            /* Blue text color */
        }

        .btn-back:hover {
            background-color: blue;
            /* Blue background on hover */
            color: white;
            /* White text color on hover */
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

    <div class="wrapper">
        <h2>Add Blog</h2>
        <p>Please fill this form to create a new blog post.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title"
                    class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $title; ?>">
                <span class="invalid-feedback"><?php echo $title_err; ?></span>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description"
                    class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                <span class="invalid-feedback"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date"
                    class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $date; ?>">
                <span class="invalid-feedback"><?php echo $date_err; ?></span>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image"
                    class="form-control-file <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $image_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <!-- Back Button -->
                <a href="view_blog.php" class="btn btn-secondary ml-2">Back</a>
            </div>
        </form>
    </div>
</body>

</html>