<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/User.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

if (!$db) {
    http_response_code(500);
    echo json_encode(array(
        "status" => "error",
        "message" => "Database connection failed"
    ));
    exit();
}

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

// Check if data is valid JSON
if (!$data) {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Invalid data format. Please provide valid JSON"
    ));
    exit();
}

// Validate required fields
if (empty($data->name) || empty($data->email) || empty($data->password)) {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "All fields are required"
    ));
    exit();
}

// Validate email format
if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Invalid email format"
    ));
    exit();
}

// Validate password length
if (strlen($data->password) < 8) {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Password must be at least 8 characters long"
    ));
    exit();
}

// Set user properties
$user->name = $data->name;
$user->email = $data->email;
$user->password = $data->password;

// Check if email exists
if ($user->emailExists()) {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Email already exists"
    ));
    exit();
}

// Create user
if ($user->createUser()) {
    // Get the newly created user's data
    $userData = $user->getUserByEmail($data->email);
    
    if ($userData) {
        // Start session and set session variables
        session_start();
        $_SESSION["logged_in"] = true;
        $_SESSION["user_id"] = $userData['id'];
        $_SESSION["name"] = $userData['name'];
        $_SESSION["email"] = $userData['email'];
        $_SESSION["login_type"] = 'manual';

        http_response_code(201);
        echo json_encode(array(
            "status" => "success",
            "message" => "User created successfully",
            "user" => array(
                "id" => $userData['id'],
                "name" => $userData['name'],
                "email" => $userData['email'],
                "login_type" => 'manual'
            )
        ));
    } else {
        http_response_code(500);
        echo json_encode(array(
            "status" => "error",
            "message" => "Unable to retrieve user data after creation"
        ));
    }
} else {
    http_response_code(500);
    echo json_encode(array(
        "status" => "error",
        "message" => "Unable to create user. Please try again."
    ));
}
?> 