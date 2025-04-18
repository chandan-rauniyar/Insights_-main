<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/google_oauth.php';

$client = new Google_Client();
$client->setClientId(" ");
$client->setClientSecret(" ");
$client->setRedirectUri("http://localhost/insights/auth/google_callback.php");
$client->addScope("email");
$client->addScope("profile");

// Create the authorization URL
$auth_url = $client->createAuthUrl();

// Redirect to Google's OAuth page
header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
exit; 