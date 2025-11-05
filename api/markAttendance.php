<?php
header('Content-Type: application/json');
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$course = $data['course'] ?? '';
$student = $data['student'] ?? '';
$status = $data['status'] ?? '';

if (!$course || !$student || !$status) {
    http_response_code(400);
    echo json_encode(['error' => 'All fields are required']);
    exit;
}

$result = $db->attendance->insertOne([
    'course' => $course,
    'student' => $student,
    'status' => $status,
    'date' => new MongoDB\BSON\UTCDateTime()
]);

echo json_encode(['success' => true, 'message' => 'Attendance marked']);
?>
