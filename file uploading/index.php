<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Example</title>
</head>
<body>
    <h2>Upload a File</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="fileUpload">Choose file:</label>
        <input type="file" name="fileUpload" id="fileUpload">
        <button type="submit" name="submit">Upload</button>
    </form>

</body>
</html>