<?php
header("Content-Type: application/json");
require_once "config.php";

try {
    $collections = $db->listCollections();
    $collectionNames = [];

    foreach ($collections as $collection) {
        $collectionNames[] = $collection->getName();
    }

    echo json_encode([
        "success" => true,
        "message" => "MongoDB connection successful!",
        "collections" => $collectionNames
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Error: " . $e->getMessage()
    ]);
}
?>
