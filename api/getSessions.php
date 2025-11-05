<?php
header('Content-Type: application/json');
require 'config.php';

$sessions = $db->sessions->find()->toArray();
echo json_encode($sessions);
?>
