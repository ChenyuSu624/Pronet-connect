<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($password === $confirmPassword) {
        // Save user to database (dummy implementation)
        header('Location: ../index.php');
        exit;
    } else {
        $error = 'Passwords do not match.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            margin: 0;
            width: 100%;
            overflow-x: hidden;
        }
        .header {
            width: 100%;
            background-color: white;
            padding: 10px 50px; /* Increase padding to move Sign In further from the right edge */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header div {
            display: flex;
            align-items: center; /* Align ProNet Connect vertically in the center */
        }
        .header img {
            height: 40px;
            margin-left: 10px;
            margin-right: 10px;
        }
        .header span {
            font-size: 24px;
            font-weight: bold;
            color: black;
        }
        .header .signin {
            font-size: 14px;
            color: white;
            background-color: #4a00e0; /* Match login page button color */
            border: none;
            border-radius: 4px;
            padding: 5px 15px;
            text-decoration: none;
            cursor: pointer;
            margin-right: 20px; /* Add spacing between ProNet Connect and Sign In */
        }
        .header .signin:hover {
            background-color: #3a00b0; /* Match login page hover color */
        }
        .container {
            background-color: white;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            width: 90%; /* Adjust width to fit within the viewport */
            max-width: 600px; /* Increase maximum width for a wider panel */
        }
        .container h2 {
            margin-bottom: 10px; /* Adjust spacing for title */
            font-size: 28px; /* Increase font size for title */
        }
        .container p.subtitle {
            margin-bottom: 30px; /* Add spacing for subtitle */
            font-size: 16px; /* Adjust font size for subtitle */
            color: #666; /* Subtle color for subtitle */
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container form .name-fields {
            display: flex;
            gap: 10px; /* Add spacing between first name and last name fields */
            margin-bottom: 5px; /* Ensure consistent gap with other fields */
        }
        .container form .name-fields input {
            flex: 1; /* Ensure both fields take equal width */
        }
        .container form input,
        .container form select {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            height: 40px; /* Ensure consistent height */
            box-sizing: border-box; /* Include padding and border in height */
        }
        .container form select {
            background-color: white;
            color: #333;
        }
        .container form button {
            padding: 10px;
            background-color: #4a00e0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .container form button:hover {
            background-color: #3a00b0;
        }
        .container p {
            font-size: 14px;
        }
        .container a {
            color: #4a00e0;
            text-decoration: none;
        }
        .container a:hover {
            text-decoration: underline;
        }
        .container .social-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .container .social-buttons button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
            font-size: 14px;
            width: 48%; /* Ensure buttons are evenly sized */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .container .social-buttons button:hover {
            background-color: #f0f0f0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .container .social-buttons button img {
            height: 20px;
            margin-right: 10px;
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
        .container form div {
            display: flex;
            align-items: center; /* Align checkbox and text vertically */
            margin-bottom: 20px;
        }
        .container form div input[type="checkbox"] {
            margin-right: 10px; /* Add spacing between checkbox and text */
        }
        .container form .terms {
            display: flex;
            align-items: center; /* Align checkbox and text on the same height */
            margin-bottom: 20px;
        }
        .container form .terms input[type="checkbox"] {
            margin-right: 10px; /* Add spacing between checkbox and text */
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <img src="../icons/pronet.gif" alt="ProNet Connect">
            <span>ProNet Connect</span>
        </div>
        <button onclick="location.href='../index.php'" class="signin">Sign In</button>
    </div>
    <div class="container">
        <h2>Join ProNet Connect</h2>
        <p class="subtitle">Connect with professionals, grow your network, and advance your career</p>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="name-fields">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="job_title" placeholder="Job Title" required>
            <select name="industry" required>
                <option value="" disabled selected>Select your industry</option>
                <option value="tech">Technology</option>
                <option value="finance">Finance</option>
                <option value="healthcare">Healthcare</option>
                <!-- Add more options as needed -->
            </select>
            <div class="terms">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
            </div>
            <button type="submit">Create Account</button>
        </form>
        <p>Or continue with</p>
        <div class="social-buttons">
            <button>
                <img src="../icons/google.svg" alt="Google"> Google
            </button>
            <button>
                <img src="../icons/linkedin.svg" alt="LinkedIn"> LinkedIn
            </button>
        </div>
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
