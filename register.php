<?php
session_start();
if (isset($_SESSION['user_email'])) {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Owners Club - Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><a href="landing.php">Pet Owners Club</a> - Registration</h1>
    </header>

    <main>
        <form action="index.php?action=register" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="petname">Pet's Name:</label>
            <input type="text" id="petname" name="petname" required>

            <label for="pettype">Pet Type:</label>
            <input type="text" id="pettype" name="pettype" required>

            <label for="petbreed">Pet Breed:</label>
            <input type="text" id="petbreed" name="petbreed" required>
            
            <button type="submit">Register</button>
        </form>
        <p>Already a Member? <a href="login.php">Login here</a></p>
    </main>
</body>
</html>
