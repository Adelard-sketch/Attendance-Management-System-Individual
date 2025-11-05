<?php
require __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

header('Content-Type: application/json');

$client = new Client("mongodb://localhost:27017");
$collection = $client->ashesi->users;

$data = $_POST;

if (!isset($data['username'], $data['password'], $data['userType'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Find user
$user = $collection->findOne(['username' => $data['username']]);
if (!$user) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

// Verify password & role
if (password_verify($data['password'], $user['password']) && $data['userType'] === $user['role']) {
    echo json_encode(['success' => true, 'username' => $user['username'], 'role' => $user['role']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials or role']);
}
