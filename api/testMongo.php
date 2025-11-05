<?php
require __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

$client = new Client("mongodb://localhost:27017");
$collection = $client->ashesi->users;

// Insert a test document
$result = $collection->insertOne([
    'fullname' => 'Test User',
    'email' => 'test@example.com',
    'username' => 'testuser',
    'role' => 'student',
    'password' => '1234'
]);

echo "Inserted ID: " . $result->getInsertedId();
