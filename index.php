<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Dummy credentials for demonstration
    $validEmail = 'user@example.com';
    $validPassword = 'password123';

    if ($email === $validEmail && $password === $validPassword) {
        $_SESSION['user'] = $email;
        header('Location: pages/dashboard.php'); // Redirect to dashboard
        exit;
    } else {
        $error = 'Invalid email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProNet Connect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .left-panel {
            background-color: #4a00e0;
            color: white;
            padding: 40px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .left-panel h1 {
            margin: 0 0 20px;
            font-size: 24px;
        }
        .left-panel p {
            margin: 10px 0;
            font-size: 16px;
        }
        .left-panel .features {
            margin-top: 20px;
        }
        .left-panel .features p {
            display: flex;
            align-items: center;
            margin: 10px 0;
            font-size: 14px;
        }
        .left-panel .features p img {
            margin-right: 10px;
            width: 30px; /* Adjusted size */
            height: 30px; /* Adjusted size */
        }
        .left-panel .footer {
            display: flex;
            align-items: center;
            margin-top: 40px;
        }
        .left-panel .footer img {
            border-radius: 50%;
            margin-right: 10px;
        }
        .right-panel {
            background-color: white;
            padding: 40px;
            width: 50%;
        }
        .right-panel h2 {
            margin: 0 0 20px;
            font-size: 24px;
        }
        .right-panel p {
            font-size: 16px;
        }
        .right-panel form {
            display: flex;
            flex-direction: column;
        }
        .right-panel form input {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .right-panel form button {
            padding: 10px;
            background-color: #4a00e0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .right-panel form button:hover {
            background-color: #3a00b0;
        }
        .right-panel form button,
        .right-panel .social-login button {
            width: 100%; /* Match the width of the "Sign in" button */
        }
        .right-panel .social-login {
            display: flex;
            justify-content: space-between; /* Adjust alignment */
            gap: 10px; /* Maintain spacing between buttons */
            margin-top: 20px;
        }
        .right-panel .social-login button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px; /* Adjust padding for better size */
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            font-size: 14px; /* Adjust font size */
            text-align: center;
        }
        .right-panel .social-login button img {
            margin-right: 10px;
            width: 20px; /* Ensure consistent icon size */
            height: 20px;
        }
        .right-panel .signup-link {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
        .left-panel .features p img {
            filter: brightness(0) invert(1); /* Ensures white color for icons */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div>
                <h1>ProNet Connect</h1>
                <p>Connect, grow, and advance your professional journey with the network that works for you.</p>
                <div class="features">
                    <p><img src="icons/human-greeting-proximity.png" alt="icon"> Connect with industry professionals</p>
                    <p><img src="icons/bag-checked.png" alt="icon"> Discover career opportunities</p>
                    <p><img src="icons/account-group.png" alt="icon"> Join professional communities</p>
                </div>
            </div>
            <div class="footer">
                <img src="icons/user/white-man.png" alt="user" width="40">
                <img src="icons/user/woman.png" alt="user" width="40">
                <img src="icons/user/black-man.png" alt="user" width="40">
                <p>Join 1M+ professionals</p>
            </div>
        </div>
        <div class="right-panel">
            <h2>Welcome back</h2>
            <p>Sign in to your account</p>
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter your password" required>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <input type="checkbox" id="remember-me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <a href="pages/forgot-password.php" style="color: #4a00e0;">Forgot password?</a>
                </div>
                <button type="submit">Sign in</button>
            </form>
            <p>Or continue with</p>
            <div class="social-login">
                <button><img src="icons/google.svg" alt="Google" width="20"> Google</button>
                <button><img src="icons/linkedin.svg" alt="LinkedIn" width="20"> LinkedIn</button>
            </div>
            <div class="signup-link">
                <p>Don't have an account? <a href="pages/signup.php" style="color: #4a00e0;">Sign up for free</a></p>
            </div>
        </div>
    </div>
</body>
</html>