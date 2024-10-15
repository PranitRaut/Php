<?php
// Database connection
 include ("db_connection.php");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $category = $_POST['category'];
    $year = $_POST['year'];

    // Directory where the document will be stored
    $target_dir = "assets/docs/";

    // Get file info and create a unique name
    $doc = basename($_FILES["document"]["name"]);
    $target_file = $target_dir . uniqid() . "-" . $doc;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid document type (for example, pdf, docx, etc.)
    $allowed_types = array('pdf', 'doc', 'docx', 'txt');
    if (!in_array($fileType, $allowed_types)) {
        echo "Only PDF, DOC, DOCX, and TXT files are allowed.";
        $uploadOk = 0;
    }

    // Check if upload is ok
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
            // Store document path in the database
            $sql = "INSERT INTO document (category_docs, year, upload_docs) VALUES ('$category', '$year', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                echo "The document has been uploaded and saved.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>
