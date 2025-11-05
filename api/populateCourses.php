<?php
require __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

$client = new Client("mongodb://localhost:27017");
$collection = $client->ashesi->courses;

$data = json_decode(file_get_contents(__DIR__ . '/Courses.json'), true);

if (is_array($data)) {
    foreach ($data as $item) {
        $collection->insertOne($item);
    }
}
echo "Courses inserted successfully!";
