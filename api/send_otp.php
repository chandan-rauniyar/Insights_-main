<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Function to generate a random 4-digit OTP
function generateOTP() {
    return str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
}

// Function to send email using PHPMailer
function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = ' '; // Your Gmail address
        $mail->Password = ' '; // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Insights');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for Password Reset';
        
        $message = "
        <html>
        <head>
            <title>Password Reset OTP</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .otp-box { 
                    background: #f8f9fa; 
                    padding: 20px; 
                    border-radius: 5px; 
                    text-align: center;
                    margin: 20px 0;
                }
                .otp { 
                    font-size: 24px; 
                    font-weight: bold; 
                    color: #667eea;
                    letter-spacing: 5px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Password Reset Request</h2>
                <p>You have requested to reset your password. Please use the following OTP to verify your identity:</p>
                <div class='otp-box'>
                    <div class='otp'>$otp</div>
                </div>
                <p>This OTP is valid for 10 minutes. If you didn't request this, please ignore this email.</p>
                <p>Best regards,<br>Insights Team</p>
            </div>
        </body>
        </html>
        ";
        
        $mail->Body = $message;
        $mail->AltBody = "Your OTP for password reset is: $otp\nThis OTP is valid for 10 minutes.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email)) {
    $email = $data->email;
    
    // Generate OTP
    $otp = generateOTP();
    
    // Store OTP in database
    $query = "INSERT INTO password_resets 
              SET email = :email,
                  token = :otp,
                  expires_at = DATE_ADD(NOW(), INTERVAL 10 MINUTE)
              ON DUPLICATE KEY UPDATE 
                  token = :otp,
                  expires_at = DATE_ADD(NOW(), INTERVAL 10 MINUTE)";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":otp", $otp);
    
    if($stmt->execute()) {
        // Send OTP email
        if(sendOTPEmail($email, $otp)) {
            http_response_code(200);
            echo json_encode(array(
                "status" => "success",
                "message" => "OTP has been sent to your email"
            ));
        } else {
            http_response_code(503);
            echo json_encode(array(
                "status" => "error",
                "message" => "Unable to send OTP email"
            ));
        }
    } else {
        http_response_code(503);
        echo json_encode(array(
            "status" => "error",
            "message" => "Unable to store OTP"
        ));
    }
} else {
    http_response_code(400);
    echo json_encode(array(
        "status" => "error",
        "message" => "Unable to send OTP. Email is required."
    ));
}
?> 