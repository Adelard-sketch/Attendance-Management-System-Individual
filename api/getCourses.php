<?php
header('Content-Type: application/json');
require 'config.php';

$courses = $db->courses->find()->toArray();
echo json_encode($courses);
?>
