<?php
$usersFile = 'users.json';

if (!file_exists($usersFile)) {
    echo "No users registered!";
    exit();
}

$users = json_decode(file_get_contents($usersFile), true);
$currentTime = time();

foreach ($users as &$user) {
    if ($user['status'] === 'pending' && $currentTime - $user['registered_at'] >= 3600) {
        $user['status'] = 'active'; // Verify user after 1 hour
    }
}

file_put_contents($usersFile, json_encode($users));
echo "Verification process completed.";
?>
