<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Regular Expression Validation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Registration Form</h2>
        <form id="registrationForm" class="needs-validation" novalidate>
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                <div class="invalid-feedback">Please enter a valid name (only alphabets and spaces).</div>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
            </div>
            <!-- Mobile Number -->
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile" placeholder="Enter your mobile number" required>
                <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
            </div>
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                <div class="invalid-feedback">
                    Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.
                </div>
            </div>
            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                <div class="invalid-feedback">Passwords do not match.</div>
            </div>
            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();

            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const mobile = document.getElementById('mobile');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');

            // Regular Expressions
            const nameRegex = /^[a-zA-Z\s]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobileRegex = /^\d{10}$/; // Exactly 10 digits
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            let isValid = true;

            // Name Validation
            if (!nameRegex.test(name.value)) {
                name.classList.add('is-invalid');
                isValid = false;
            } else {
                name.classList.remove('is-invalid');
                name.classList.add('is-valid');
            }

            // Email Validation
            if (!emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
                email.classList.add('is-valid');
            }

            // Mobile Number Validation
            if (!mobileRegex.test(mobile.value)) {
                mobile.classList.add('is-invalid');
                isValid = false;
            } else {
                mobile.classList.remove('is-invalid');
                mobile.classList.add('is-valid');
            }

            // Password Validation
            if (!passwordRegex.test(password.value)) {
                password.classList.add('is-invalid');
                isValid = false;
            } else {
                password.classList.remove('is-invalid');
                password.classList.add('is-valid');
            }

            // Confirm Password Validation
            if (password.value !== confirmPassword.value || confirmPassword.value === "") {
                confirmPassword.classList.add('is-invalid');
                isValid = false;
            } else {
                confirmPassword.classList.remove('is-invalid');
                confirmPassword.classList.add('is-valid');
            }

            if (isValid) {
                alert('Form submitted successfully!');
                // Proceed with form submission or other logic here
            }
        });
    </script>
</body>

</html>
