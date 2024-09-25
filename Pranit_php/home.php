<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

include "header.php";

?>
<!--Login form -->
<?php
$name = $_POST['email'];
$password = $_POST['password'];

?>


<div class = "container">
    <div class = "row justify-content-center">
        <div class = "col-sm-6">
        <div class="alert alert-primary" role="alert">
            Your Name: <?php echo"$name" ?>
            </div>
        <div class="alert alert-secondary" role="alert">
            Your Password: <?php echo "$password" ?>
            </div>
        </div>
    </div>

</div>
<!-- end Login form --> 


</body>
</html>