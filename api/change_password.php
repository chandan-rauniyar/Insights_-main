<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

$database = new Database();
$conn = $database->getConnection();
$user = new User($conn);

$currentPassword = $_POST['current_password'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
    http_response_code(400);
    echo json_encode(['error' => 'All fields are required']);
    exit();
}

if ($newPassword !== $confirmPassword) {
    http_response_code(400);
    echo json_encode(['error' => 'New passwords do not match']);
    exit();
}

// Verify current password
$userData = $user->getUserById($_SESSION['user_id']);
if (!$userData || !password_verify($currentPassword, $userData['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Current password is incorrect']);
    exit();
}

// Update password
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
if ($user->updatePassword($_SESSION['user_id'], $hashedPassword)) {
    echo json_encode(['message' => 'Password updated successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update password']);
} 