<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php

    include "header.php";

    ?>
<!--Login form -->
    <div class = "conatiner">
        <div class = "row justify-content-center">
            <div class = "col-sm-6">
            <form action ="home.php" method ="post">
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                    <button type="submit" class="btn btn-primary">Login</button>
            </form>

        </div>
    </div>

<!-- end Login form -->


<!-- register form-->
<div class = "conatiner">
        <div class = "row justify-content-center">
            <div class = "col-sm-6">
            <form action ="about.php" method ="post">
                <div class="mb-3">
                    <label class="form-label">Your name</label>
                    <input type="fname" class="form-control" name="fname">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                    <button type="submit" class="btn btn-primary">register</button>
            </form>

        </div>
    </div>



<!-- end register form-->




</body>
</html>