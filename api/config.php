<?php
// config.php — MongoDB connection setup

require 'vendor/autoload.php'; 
use MongoDB\Client;

// MongoDB connection
try {
    // Change "attendance_db" to your desired database name
    $mongoClient = new Client("mongodb://localhost:27017");
    $db = $mongoClient->attendance_db; 
} catch (Exception $e) {
    die(json_encode([
        "success" => false,
        "message" => "MongoDB connection failed: " . $e->getMessage()
    ]));
}
?>
