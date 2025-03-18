<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php'); // Redirect to login if not authenticated
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
    <p>You have successfully logged in.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
