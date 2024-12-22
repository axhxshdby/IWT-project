<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: landing.php');
    exit();
}

$petsFile = 'pets.json';

// Ensure the pets file exists
if (file_exists($petsFile)) {
    $pets = json_decode(file_get_contents($petsFile), true);
} else {
    $pets = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Owners Club - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <h1>Pet Owners Club</h1>
        </div>
        <div class="header-right">
            <a href="logout.php" class="login-btn">LogOut</a>
        </div>
    </header>

    <main>
        <h2 style="text-align:center;">Registered Pets</h2>
        <?php if (count($pets) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Breed</th>
                        <th>Owner</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pets as $pet): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pet['name']); ?></td>
                            <td><?php echo htmlspecialchars($pet['type']); ?></td>
                            <td><?php echo htmlspecialchars($pet['breed']); ?></td>
                            <td><?php echo htmlspecialchars($pet['owner']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align:center;">No pets are currently registered.</p>
        <?php endif; ?>
    </main>
</body>
</html>
