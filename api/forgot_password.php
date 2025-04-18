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

if(!empty($data->email)) {
    $user->email = $data->email;

    if($user->emailExists()) {
        // Generate OTP (4 digits)
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Store OTP in database (you should create a table for OTPs)
        $query = "INSERT INTO password_resets 
                SET email = :email, 
                    token = :otp,
                    expires_at = DATE_ADD(NOW(), INTERVAL 1 HOUR)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":otp", $otp);

        if($stmt->execute()) {
            // In a real application, you would send the OTP via email
            // For now, we'll just return it in the response
            http_response_code(200);
            echo json_encode(array(
                "status" => "success",
                "message" => "OTP sent successfully",
                "otp" => $otp // Remove this in production
            ));
        } else {
            http_response_code(503);
            echo json_encode(array(
                "status" => "error",
                "message" => "Unable to send OTP"
            ));
        }
    } else {
        http_response_code(404);
        echo json_encode(array(
            "status" => "error",
            "message" => "Email not found"
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Unable to process request. Email is required."
    ));
}
?> 