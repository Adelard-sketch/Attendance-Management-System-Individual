<?php
header('Content-Type: application/json');
require 'config.php';

$users = $db->users->find([], ['projection' => ['password' => 0]])->toArray();
echo json_encode($users);
?>
