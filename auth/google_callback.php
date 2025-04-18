<?php
session_start();
require '../vendor/autoload.php';
require '../config/google_oauth.php';
require '../config/database.php';
require '../models/User.php';

use Google\Service\Oauth2;
use Google\Client;

$config = require __DIR__ . '/../config/google_oauth.php';

// Initialize database connection
$database = new Database();
$conn = $database->getConnection();

try {
    $client = new Client();
    $client->setClientId($config['client_id']);
    $client->setClientSecret($config['client_secret']);
    $client->setRedirectUri($config['redirect_uri']);
    
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);
        
        $oauth2 = new Oauth2($client);
        $userInfo = $oauth2->userinfo->get();
        
        $user = new User($conn);
        
        // Check if user exists by email
        $existingUser = $user->getUserByEmail($userInfo->email);
        
        if ($existingUser) {
            // Update Google ID if not set
            if (empty($existingUser['google_id'])) {
                $user->updateGoogleId($existingUser['id'], $userInfo->id);
            }
            $userData = $existingUser;
        } else {
            // Create new user
            $userData = [
                'name' => $userInfo->name,
                'email' => $userInfo->email,
                'google_id' => $userInfo->id,
                'password' => null // No password for Google users
            ];
            $user->create($userData);
            $userData = $user->getUserByEmail($userInfo->email);
        }
        
        // Set session variables
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['name'] = $userData['name'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['logged_in'] = true;
        
        header('Location: /insights/index.php');
        exit();
    }
} catch (Exception $e) {
    error_log('Google Login Error: ' . $e->getMessage());
    header('Location: /insights/index.php?error=google_login_failed');
    exit();
}

header('Location: /insights/index.php');
exit(); 