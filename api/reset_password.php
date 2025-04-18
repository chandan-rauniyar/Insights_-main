<?php
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
    !empty($data->newPassword) &&
    !empty($data->confirmPassword)
) {
    $user->email = $data->email;
    $newPassword = $data->newPassword;
    $confirmPassword = $data->confirmPassword;

    // Verify passwords match
    if($newPassword !== $confirmPassword) {
        http_response_code(400);
        echo json_encode(array(
            "status" => "error",
            "message" => "Passwords do not match"
        ));
        return;
    }

    // Verify password length
    if(strlen($newPassword) < 8) {
        http_response_code(400);
        echo json_encode(array(
            "status" => "error",
            "message" => "Password must be at least 8 characters long"
        ));
        return;
    }

    // Update password
    $user->password = $newPassword;
    if($user->updatePassword()) {
        // Delete used OTP
        $query = "DELETE FROM password_resets WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $user->email);
        $stmt->execute();

        http_response_code(200);
        echo json_encode(array(
            "status" => "success",
            "message" => "Password updated successfully"
        ));
    } else {
        http_response_code(503);
        echo json_encode(array(
            "status" => "error",
            "message" => "Unable to update password"
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Unable to update password. Data is incomplete."
    ));
}
?> 