<?php
require __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

header('Content-Type: application/json');

$client = new Client("mongodb://localhost:27017");
$collection = $client->ashesi->users;

$data = $_POST;

if (!isset($data['fullname'], $data['email'], $data['username'], $data['role'], $data['password'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit;
}

// Check if username/email exists
$existing = $collection->findOne([
    '$or' => [['username' => $data['username']], ['email' => $data['email']]]
]);

if ($existing) {
    echo json_encode(['success' => false, 'message' => 'Username or email already exists']);
    exit;
}

// Hash password
$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

// Insert user
$result = $collection->insertOne($data);
echo json_encode(['success' => $result->getInsertedCount() > 0]);
