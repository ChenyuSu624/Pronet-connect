<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    // Dummy implementation for password reset
    $message = 'If this email is registered, a password reset link will be sent.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5; /* Match login page background */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            margin: 0;
            width: 100%; /* Ensure the page fits the browser window width */
            overflow-x: hidden; /* Prevent horizontal scroll bars */
        }
        .header {
            width: 100%;
            background-color: white;
            padding: 10px 20px; /* Adjust padding to fit within the viewport */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Align content to the left */
            box-sizing: border-box; /* Ensure padding is included in width calculation */
        }
        .header img {
            height: 40px; /* Increase icon size */
            margin-right: 10px; /* Move icon further to the right */
            margin-left: 10px;
        }
        .header span {
            font-size: 24px;
            font-weight: bold;
            color: black; /* Match login page color */
        }
        .container {
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            width: 90%; /* Adjust width to fit within the viewport */
            max-width: 400px; /* Maintain a maximum width */
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container form input {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .container form button {
            padding: 10px;
            background-color: #4a00e0; /* Match login page button color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .container form button:hover {
            background-color: #3a00b0; /* Match login page hover color */
        }
        .container p {
            font-size: 14px;
        }
        .container a {
            color: #4a00e0; /* Match login page link color */
            text-decoration: none;
        }
        .container a:hover {
            text-decoration: underline;
        }
        .footer {
            font-size: 14px;
            text-align: center;
        }
        .footer a {
            margin: 0 10px;
            color: #000;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="../icons/pronet.gif" alt="ProNet Connect">
        <span>ProNet Connect</span>
    </div>
    <div class="container">
        <h2>Forgot Password?</h2>
        <p>Enter your email address to reset your password</p>
        <?php if (!empty($message)): ?>
            <p style="color: green;"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Send Reset Link</button>
        </form>
        <p>Remember your password? <a href="../index.php">Log in</a></p>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        <p>Need help? <a href="#">Contact Support</a></p>
    </div>
    <div class="footer">
        <p>&copy; 2025 ProNet Connect. All rights reserved.</p>
        <p>
            <a href="#">Terms</a>
            <a href="#">Privacy</a>
            <a href="#">Security</a>
        </p>
    </div>
</body>
</html>
