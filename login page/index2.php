<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body,
        html {
            height: 100%;
            background-color: #f5f5f5;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .login-container h2 {
            color: white;
            margin-bottom: 2rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            outline: none;
            text-align: center;
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .login-btn {
            width: 100%;
            padding: 0.75rem;
            border-radius: 30px;
            background-color: #feb900;
            color: black;
            border: none;
            cursor: pointer;
            margin-top: 1rem;
        }

        .login-btn:hover {
            background-color: #e0a800;
        }

        .options {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            color: white;
        }

        .login-container h2 {
            font-size: 32px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 500;
            letter-spacing: 1px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="register.php" id="registrationForm" method="POST">
            <div class="input-group">
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-group">
                <input type="text" name="Username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="number" id="mobile" name="mobile" placeholder="Enter Your Mobile" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Enter your email id" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button class="login-btn" type="submit">SIGN UP</button>
        </form>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', function (event) {
            const mobile = document.getElementById('mobile').value;

            // Ensure mobile number is exactly 10 digits before submitting
            if (mobile.length !== 10) {
                alert('Mobile number must be exactly 10 digits.');
                event.preventDefault();
            }
        });
    </script>

</body>

</html>
