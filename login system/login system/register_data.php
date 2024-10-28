<?php
// Include config file
require_once "config.php";

// Attempt select query execution to fetch id, username, and password
$sql = "SELECT id, username, password FROM users";
$result = mysqli_query($link, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Registered Users</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password (Hashed)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if the result has data
                if(mysqli_num_rows($result) > 0){
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>"; // Displaying hashed password
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // Close the connection
    mysqli_close($link);
    ?>
</body>
</html>
