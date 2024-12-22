<?php
session_start();

$usersFile = 'users.json';

if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}

// Determine the action
$action = $_GET['action'] ?? '';

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $users = json_decode(file_get_contents($usersFile), true);

        // Validate user credentials
        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                $_SESSION['user_email'] = $email;
                header('Location: home.php');
                exit();
            }
        }

        // Redirect with an error message for invalid credentials
        header('Location: login.php?error=Invalid email or password');
        exit();
    }

    // Redirect with an error message for invalid input
    header('Location: login.php?error=Invalid input');
    exit();
}

// Logout handling (Optional but related)
if ($action === 'logout') {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Handle other actions...
?>
