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
            background-image: url('https://img.freepik.com/free-photo/keyboard-tea-cup-apple-office-stationeries-black-background_23-2148042011.jpg?t=st=1727954028~exp=1727957628~hmac=deabde28e52260bd6220e939a2547124fd74da9e521267b355fc81551abb70d4&w=996');
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
        <form action="register.php" id="registrationForm" method="POST">

            <div class="input-group">
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-group">
                <input type="text" name="Username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <input type="number" id="mobile" name="phone" placeholder="Enter Your Number" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Enter your email id" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button class="login-btn" type="submit">SIGN UP</button>
            <div class="options">
                <label><input type="checkbox"> Already A User? </label>
                <a href="index.php" style="color: white;">Log In</a>
            </div>

    </div>
    </form>
    </div>
    <script>
    function validateMobile() {
        const mobileInput = document.getElementById('mobile');
        const mobileValue = mobileInput.value;

        // Check if the first digit is between 6 and 9
        if (mobileValue.length === 1) {
            const firstDigit = mobileValue.charAt(0);
            if (firstDigit < '6' || firstDigit > '9') {
                mobileInput.value = ''; // Clear the input if the first digit is invalid
                alert('The first digit must be between 6 and 9.');
                return;
            }
        }

        // Block input after 10 digits
        if (mobileValue.length > 10) {
            mobileInput.value = mobileValue.slice(0, 10);
        }
    }

    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        const mobile = document.getElementById('mobile').value;

        // Ensure mobile number is exactly 10 digits before submitting
        if (mobile.length !== 10) {
            alert('Mobile number must be exactly 10 digits.');
            event.preventDefault();
            return;
        }

        // Ensure the first digit is between 6 and 9 before submitting
        if (mobile.charAt(0) < '6' || mobile.charAt(0) > '9') {
            alert('The first digit must be between 6 and 9.');
            event.preventDefault();
        }
    });
</script>

</body>

</html>
