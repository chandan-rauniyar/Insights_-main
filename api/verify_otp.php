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

if(!empty($data->email) && !empty($data->otp)) {
    $user->email = $data->email;
    $otp = $data->otp;

    // Verify OTP
    $query = "SELECT email 
            FROM password_resets 
            WHERE email = :email 
            AND token = :otp 
            AND expires_at > NOW() 
            LIMIT 1";

    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $user->email);
    $stmt->bindParam(":otp", $otp);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        http_response_code(200);
        echo json_encode(array(
            "status" => "success",
            "message" => "OTP verified successfully"
        ));
    } else {
        http_response_code(400);
        echo json_encode(array(
            "status" => "error",
            "message" => "Invalid or expired OTP"
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Unable to verify OTP. Data is incomplete."
    ));
}
?> 