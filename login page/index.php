<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
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
            border: 1px solid rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.8);
            color: white;
            outline: none;
            text-align: center;
        }

        .input-group input::placeholder {
            color: rgba(0, 0, 0, 0.5);
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

        .social-login {
            margin-top: 1.5rem;
        }

        .social-login button {
            width: 45%;
            padding: 0.75rem;
            border-radius: 30px;
            background-color: white;
            border: none;
            color: black;
            cursor: pointer;
            margin-right: 10px;
        }

        .social-login button:last-child {
            margin-right: 0;
        }

        .social-login button:hover {
            background-color: #ddd;
        }

        .divider {
            margin: 1.5rem 0;
            color: black;
        }

        .login-container h2 {
            font-size: 32px;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 500;
            letter-spacing: 1px;
            padding-top: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">

            <div class="input-group">
                <input type="text" name="Username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button class="login-btn" type="submit">SIGN IN</button>
            <div class="options">
                <label><input type="checkbox"> Remember Me</label>
            </div>
            <div class="options" style="margin-top: 1rem;">
                <a href="index2.php" style="color: white;">Register Here</a>
            </div>
        </form>
    </div>
</body>

</html>
