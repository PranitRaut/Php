<?php
if (isset($_POST['submit'])) {
    // Check if the file was uploaded without errors
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
        $file = $_FILES['fileUpload'];
        $filename = basename($file['name']); // Get the original file name
        $targetDir = "uploads/"; // Define the target directory

        // Ensure the upload directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFilePath = $targetDir . $filename;

        // Check the file type (image or other file)
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validate if the file is an image or a supported file type
        if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'pdf'])) {
            // Move the file
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                echo "The file " . htmlspecialchars($filename) . " has been uploaded successfully.<br>";
                
                // Show the view file link
                echo "<a href='" . $targetFilePath . "' target='_blank'>View File</a><br>";
                
                // Hide the upload form after successful upload
                echo "<style>form { display: none; }</style>";
            } else {
                echo "Error: Unable to move the uploaded file.";
            }
        } else {
            // For unsupported file types
            echo "File type not supported for inline viewing.<br>";
        }
    } else {
        echo "Error: File upload failed. Error code: " . $_FILES['fileUpload']['error'];
    }
} else {
    echo "No file uploaded.";
}
?>

<!-- File Upload Form -->
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileUpload" required>
    <button type="submit" name="submit">Upload</button>
</form>
