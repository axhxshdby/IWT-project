<?php
session_start();

$usersFile = 'users.json';
$petsFile = 'pets.json';

// Ensure the files exist
if (!file_exists($usersFile)) {
    file_put_contents($usersFile, json_encode([]));
}
if (!file_exists($petsFile)) {
    file_put_contents($petsFile, json_encode([]));
}

// Determine the action
$action = $_GET['action'] ?? '';

// Route based on session status
if (empty($action)) {
    if (isset($_SESSION['user_email'])) {
        header('Location: home.php');
    } else {
        header('Location: landing.php');
    }
    exit();
}

// Register
if ($_GET['action'] === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $petName = $_POST['petname'] ?? '';
    $petType = $_POST['pettype'] ?? '';
    $petBreed = $_POST['petbreed'] ?? '';

    if ($name && $email && $password && $petName && $petType && $petBreed) {
        // Load existing users and pets
        $users = json_decode(file_get_contents($usersFile), true);
        $pets = json_decode(file_get_contents($petsFile), true);

        // Check if the email is already registered
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                header('Location: /?error=Email already registered');
                exit;
            }
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add the user to the users.json
        $users[] = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ];
        file_put_contents($usersFile, json_encode($users));

        // Add the pet to the pets.json
        $pets[] = [
            'name' => $petName,
            'type' => $petType,
            'breed' => $petBreed,
            'owner' => $name
        ];
        file_put_contents($petsFile, json_encode($pets));

        // Redirect to the landing page after success
        header('Location: /login.php?success=Registration successful');
        exit;
    }

    // Redirect to the landing page for invalid input
    header('Location: /register.php?error=Invalid input');
    exit;
}

// Logout
if ($action === 'logout') {
    session_destroy();
    header('Location: landing.php');
    exit();
}
?>
