<?php
require __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

header('Content-Type: application/json');

$section = $_GET['section'] ?? 'courses';

$client = new Client("mongodb://localhost:27017");
$db = $client->ashesi;

$collections = [
    'courses' => 'courses',
    'sessions' => 'sessions',
    'reports' => 'reports',
    'auditors' => 'auditors'
];

if (!isset($collections[$section])) {
    echo json_encode([]);
    exit;
}

$collection = $db->{$collections[$section]};
$items = $collection->find()->toArray();

// Convert BSON to JSON
$result = array_map(fn($doc) => json_decode(json_encode($doc), true), $items);
echo json_encode($result);
