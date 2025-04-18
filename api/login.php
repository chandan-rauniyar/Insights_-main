<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->email) &&
    !empty($data->password)
) {
    $user->email = $data->email;
    $user->password = $data->password;

    if($user->emailExists()) {
        if(password_verify($data->password, $user->password)) {
            // Set session variables
            $_SESSION["user_id"] = $user->id;
            $_SESSION["name"] = $user->name;
            $_SESSION["email"] = $user->email;
            $_SESSION["logged_in"] = true;

            http_response_code(200);
            echo json_encode(array(
                "status" => "success",
                "message" => "Login successful",
                "user" => array(
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email
                )
            ));
        } else {
            http_response_code(401);
            echo json_encode(array(
                "status" => "error",
                "message" => "Invalid password"
            ));
        }
    } else {
        http_response_code(401);
        echo json_encode(array(
            "status" => "error",
            "message" => "Email not found"
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Unable to login. Data is incomplete."
    ));
}
?> 