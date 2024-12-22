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
    <title>Pet Owners Club - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><a href="landing.php">Pet Owners Club</a> - Login</h1>
    </header>

    <main>
        <?php
        // Show error messages if provided in the query string
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
        <form action="server.php?action=login" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        <p><button onclick="window.location.href='register.php'">Become a Member</button> - Your Journey to Unforgettable Pet Moments Starts Here!</p>
    </main>
</body>
</html>
