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
            background-image: url('https://img.freepik.com/free-photo/workplace-with-smartphone-laptop-black-table-top-view-copyspace-background_144627-24860.jpg?t=st=1727953955~exp=1727957555~hmac=fbe41ff173fb33b311265cf25b24baedfd30eefb22d1cebc72c6edb18196e95d&w=996');
            /* Replace with your image path */
            background-size: cover;
            background-position: center;
            backdrop-filter: blur(3px);
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.2);
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

        .social-login {
            margin-top: 1.5rem;
        }

        .social-login button {
            width: 45%;
            padding: 0.75rem;
            border-radius: 30px;
            background-color: white;
            border: none;
            color: #555;
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
            color: white;
        }

        .login-container h2 {
            font-size: 32px;
            color: rgba(255, 255, 255, 0.9);
            /* Slight opacity */
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 500;
            letter-spacing: 1px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            /* Adds subtle shadow for better readability */
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
                <a href="#" style="color: white;">Forgot Password?</a>
            </div>
            <div class="options" style="margin-top: 1rem;">
                <span style="color: white;">New User? </span>
                <a href="index2.php" style="color: white;">Register Here</a>
            </div>
        </div>
        </form>
    </div>
</body>

</html>
