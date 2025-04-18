<?php
session_start();
require_once 'config/database.php';
require_once 'models/User.php';
require_once 'models/UserProfile.php';

$database = new Database();
$conn = $database->getConnection();

// Get user data if logged in
$userName = '';
$initial = '';
$isLoggedIn = isset($_SESSION['user_id']);

if ($isLoggedIn) {
    $user = new User($conn);
    $userData = $user->getUserById($_SESSION['user_id']);
    $userName = $userData['name'] ?? '';
    $initial = strtoupper(substr($userName, 0, 1));
}

$userEmail = isset($_SESSION["email"]) ? $_SESSION["email"] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insights - Sentiment Analysis Tool</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            animation: fadeIn 0.3s ease-in-out;
        }

        .auth-content {
            position: relative;
            background: white;
            width: 90%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-in-out;
        }

        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .result-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }

            100% {
                transform: scale(1);
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            background: white;
            border-radius: 8px;
            padding: 16px 24px;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            transform: translateX(120%);
            transition: transform 0.3s ease-in-out;
            min-width: 300px;
            max-width: 400px;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast.success {
            border-left: 4px solid #10B981;
        }

        .toast.error {
            border-left: 4px solid #EF4444;
        }

        .toast.info {
            border-left: 4px solid #3B82F6;
        }

        .toast-icon {
            font-size: 20px;
        }

        .toast.success .toast-icon {
            color: #10B981;
        }

        .toast.error .toast-icon {
            color: #EF4444;
        }

        .toast.info .toast-icon {
            color: #3B82F6;
        }

        .toast-content {
            flex: 1;
        }

        .toast-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .toast-message {
            color: #6B7280;
            font-size: 14px;
        }

        .toast-close {
            background: none;
            border: none;
            color: #9CA3AF;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }

        .toast-close:hover {
            color: #4B5563;
        }

        /* Mobile Menu Styles */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            animation: fadeIn 0.3s ease-in-out;
        }

        .mobile-menu-content {
            position: fixed;
            top: 0;
            right: 0;
            width: 80%;
            max-width: 300px;
            height: 100%;
            background: white;
            padding: 20px;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }

        .mobile-menu.show {
            display: block;
        }

        .mobile-menu.show .mobile-menu-content {
            transform: translateX(0);
        }

        .mobile-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .mobile-menu-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .mobile-menu-link {
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mobile-menu-link:hover {
            background-color: #f3f4f6;
        }

        .mobile-menu-link i {
            width: 20px;
            text-align: center;
        }

        .mobile-menu-divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 15px 0;
        }

        .mobile-menu-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border-radius: 8px;
            background-color: #f3f4f6;
            margin-top: 15px;
        }

        .mobile-menu-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .mobile-menu-profile-info {
            flex: 1;
        }

        .mobile-menu-profile-name {
            font-weight: 600;
            color: #111827;
        }

        .mobile-menu-profile-email {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .hamburger-menu {
            display: none;
        }

        @media (max-width: 768px) {
            .hamburger-menu {
                display: block;
            }

            .desktop-menu {
                display: none;
            }
        }

        /* OTP Form Styles */
        .otp-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            animation: fadeIn 0.3s ease-in-out;
        }

        .otp-content {
            position: relative;
            background: white;
            width: 90%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-in-out;
        }

        .otp-form.show {
            display: block;
        }

        .contact-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            animation: fadeIn 0.3s ease-in-out;
        }

        .contact-content {
            position: relative;
            background: white;
            width: 90%;
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-in-out;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }

        .contact-form textarea {
            height: 150px;
            resize: vertical;
        }

        .contact-form button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 500;
            transition: transform 0.2s;
        }

        .contact-form button:hover {
            transform: translateY(-2px);
        }

        .close-contact {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #666;
        }

        /* Add these new styles for profile picture */
        .profile-pic-container {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-pic-container:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .profile-container:hover {
            transform: scale(1.1);
         }

        .profile-pic-container:active {
            transform: scale(0.95);
        }

        .profile-pic-initial {
            color: white;
            font-weight: bold;
            font-size: 18px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .profile-pic-container::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-pic-container:hover::after {
            opacity: 0.5;
        }

        .profile-pic-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            border: 2px solid transparent;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            transition: all 0.3s ease;
        }

        .profile-pic-container:hover::before {
            border-width: 3px;
        }

        /* Mobile menu profile section styles */
        .mobile-menu-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            margin: 16px 0;
            transition: all 0.3s ease;
        }

        .mobile-menu-profile:hover {
            background: rgba(102, 126, 234, 0.15);
            transform: translateX(4px);
        }

        .mobile-menu-profile-info {
            flex: 1;
        }

        .mobile-menu-profile-name {
            font-weight: 600;
            color: #111827;
            font-size: 16px;
            margin-bottom: 2px;
        }

        .mobile-menu-profile-email {
            font-size: 14px;
            color: #6b7280;
        }

        /* Profile picture styles for both desktop and mobile */
        .profile-pic-container {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Mobile specific styles */
        @media (max-width: 768px) {
            .profile-pic-container {
                width: 48px;
                height: 48px;
            }

            .profile-pic-initial {
                font-size: 22px;
            }

            .mobile-menu-profile .profile-pic-container {
                width: 56px;
                height: 56px;
            }

            .mobile-menu-profile .profile-pic-initial {
                font-size: 24px;
            }
        }

        .profile-pic-initial {
            color: white;
            font-weight: bold;
            font-size: 18px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Mobile menu profile section styles */
        .mobile-menu-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            margin: 16px 0;
        }

        .mobile-menu-profile-info {
            flex: 1;
        }

        .mobile-menu-profile-name {
            font-weight: 600;
            color: #111827;
            font-size: 16px;
            margin-bottom: 2px;
        }

        .mobile-menu-profile-email {
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Toast Container -->
    <div class="toast-container"></div>

    <!-- OTP Form -->
    <div class="otp-form" id="otpForm">
        <div class="otp-content">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold gradient-text">Reset Password</h2>
                <button onclick="closeOTPForm()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="otpRequestForm" onsubmit="requestOTP(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email Address
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email"
                        type="email"
                        placeholder="Enter your email"
                        required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Send OTP
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold gradient-text">Insights</h1>
                    </div>
                    <!-- Desktop Menu -->
                    <div class="hidden md:block desktop-menu">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="#" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <a href="main_analysis/analysic.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Analysis</a>
                            <?php else: ?>
                                <a href="#" onclick="showAnalysisLoginPopup(); return false;" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Analysis</a>
                            <?php endif; ?>
                            <a href="blog.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Blog</a>
                            <a href="about_us.php" class="nav-link text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">About Us</a>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <!-- Mobile Menu Button -->
                    <button class="hamburger-menu md:hidden text-gray-700 hover:text-blue-600 p-2 rounded-md" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <?php if (!$isLoggedIn): ?>
                        <!-- Auth Buttons -->
                        <div id="authButtons" class="hidden md:flex items-center">
                            <button id="loginBtn" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Login</button>
                            <button id="signupBtn" class="ml-4 gradient-bg text-white px-4 py-2 rounded-md text-sm font-medium hover:opacity-90 transition duration-300">Sign Up</button>
                        </div>
                    <?php else: ?>
                        <!-- Profile Dropdown -->
                        <div id="profileDropdown" class="hidden md:flex items-center relative">
                            <!-- Profile Button -->
                            <button id="profileButton11"
                                class="group flex items-center text-gray-700 hover:text-blue-600 focus:outline-none">

                                <div class=" profile-container relative w-10 h-10 rounded-full overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 group">
                                    <?php 
                                    // Get user profile data
                                    $userProfile = new UserProfile($conn);
                                    $profile = $userProfile->getProfileByUserId($_SESSION['user_id']);
                                    
                                    if ($profile && !empty($profile['profile_photo'])): ?>
                                        <img src="<?= htmlspecialchars($profile['profile_photo']) ?>" 
                                             alt="Profile" 
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                    <?php elseif ($userName): ?>
                                        <div class="profile-pic-container w-full h-full flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold text-lg group-hover:scale-110 transition-transform duration-300">
                                            <?= htmlspecialchars($initial) ?>
                                        </div>
                                    <?php else: ?>
                                        <img id="navProfileImage" 
                                             src="assets/default-avatar.png" 
                                             alt="Profile" 
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                    <?php endif; ?>
                                </div>

                                <div class="text-sm ml-3 font-semibold text-gray-800 group-hover:text-blue-600" id="profileName">
                                    <?= htmlspecialchars($userName) ?>
                                </div>

                                <svg class="ml-2 w-4 h-4 text-gray-700 group-hover:text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.586l3.71-4.355a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>


                            <!-- Dropdown Content -->
                            <div id="dropdownMenu11"
                                class="absolute right-0 mt-[200px] w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-50 overflow-hidden">

                                <!-- 👤 User Info with Inline Close -->
                                <div class="flex justify-between items-start px-4 py-3 border-b border-gray-200">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-800" id="profileName">
                                            <?= htmlspecialchars($userName) ?>
                                        </div>
                                        <div class="text-xs text-gray-500" id="profileEmail">
                                            <?= htmlspecialchars($_SESSION["email"] ?? '') ?>
                                        </div>
                                    </div>
                                    <button id="closeDropdownBtn" class="text-gray-400 hover:text-gray-500 text-sm font-bold leading-none focus:outline-none">
                                        &times;
                                    </button>
                                </div>

                                <!-- 🔗 Menu Items -->
                                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="profileButton">
                                    <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">My Profile</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="openContactPopup()">Contact</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="showForgotPassword()">Forgot Password?</a>

                                    <form method="POST" action="api/logout.php">
                                        <button id="logoutBtn" type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" role="menuitem">Logout</button>
                                    </form>
                                </div>
                            </div>




                        </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu">
        <div class="mobile-menu-content">
            <div class="mobile-menu-header">
                <h1 class="text-2xl font-bold gradient-text">Insights</h1>
                <button onclick="toggleMobileMenu()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Profile Section -->
            <div class="mobile-menu-profile">
                <div class="profile-pic-container">
                    <?php if ($userName): ?>
                        <span class="profile-pic-initial"><?= htmlspecialchars($initial) ?></span>
                    <?php else: ?>
                        <img src="https://via.placeholder.com/40" alt="Profile" id="profileImage">
                    <?php endif; ?>
                </div>
                <div class="mobile-menu-profile-info">
                    <div class="mobile-menu-profile-name" id="profileName"><?= htmlspecialchars($userName) ?></div>
                    <div class="mobile-menu-profile-email" id="profileEmail"><?= htmlspecialchars($_SESSION["email"] ?? '') ?></div>
                </div>
            </div>

            <div class="mobile-menu-links">
                <a href="#" class="mobile-menu-link text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <a href="#" class="mobile-menu-link text-gray-700 hover:text-blue-600">
                    <i class="fas fa-chart-line"></i>
                    Analysis
                </a>
                <a href="#" class="mobile-menu-link text-gray-700 hover:text-blue-600">
                    <i class="fas fa-blog"></i>
                    Blog
                </a>
                <a href="#" class="mobile-menu-link text-gray-700 hover:text-blue-600" onclick="openContactPopup()">
                    <i class="fas fa-envelope"></i>
                    Contact
                </a>

                <div class="mobile-menu-divider"></div>

                <?php if (!$isLoggedIn): ?>
                    <button id="mobileLoginBtn" class="mobile-menu-link text-gray-700 hover:text-blue-600">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </button>
                    <button id="mobileSignupBtn" class="mobile-menu-link gradient-bg text-white rounded-lg">
                        <i class="fas fa-user-plus"></i>
                        Sign Up
                    </button>
                <?php else: ?>
                    <a href="api/logout.php" class="mobile-menu-link text-red-600 hover:text-red-700">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8 pt-24">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="floating inline-block mb-4">
                <i class="fas fa-brain text-6xl gradient-text"></i>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Analyze Text Sentiment with AI</h2>
            <p class="text-xl text-gray-600">Get instant insights into the emotional tone of any text</p>
        </div>

        <!-- Analysis Section -->
        <div class="space-y-8">
            <!-- Input Section -->
            <div class="bg-white p-6 rounded-lg shadow-md transform transition duration-300 hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 gradient-text">Enter Your Text</h3>
                <textarea id="inputText" class="w-full h-48 p-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 resize-none" placeholder="Type or paste your text here..."></textarea>
                <button id="analyzeBtn" class="mt-4 w-full gradient-bg text-white py-2 px-4 rounded-lg hover:opacity-90 transition duration-300 transform hover:scale-105">
                    Analyze Sentiment
                </button>
            </div>

            <!-- Results Section -->
            <div class="bg-white p-6 rounded-lg shadow-md transform transition duration-300 hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 gradient-text">Analysis Results</h3>
                <div id="resultContainer" class="min-h-[200px] p-4 border rounded-lg result-animation transition-all duration-300">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-line text-4xl mb-4 gradient-text"></i>
                        <p>Results will appear here...</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mt-16 grid md:grid-cols-3 gap-8">
            <div class="feature-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-chart-line text-4xl gradient-text mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Real-time Analysis</h3>
                <p class="text-gray-600">Get instant sentiment analysis results for any text input</p>
            </div>
            <div class="feature-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-brain text-4xl gradient-text mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">AI-Powered</h3>
                <p class="text-gray-600">Advanced machine learning algorithms for accurate analysis</p>
            </div>
            <div class="feature-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-shield-alt text-4xl gradient-text mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Secure & Private</h3>
                <p class="text-gray-600">Your data is always protected and never shared</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <a href="index.php" class="text-white text-xl font-bold flex items-center">
                        <i class="fas fa-chart-line mr-2"></i>
                        Insights
                    </a>
                </div>
                <div class="flex space-x-6">
                    <a href="about_us.php" class="text-gray-300 hover:text-white transition-colors">About Us</a>
                    <a href="blog.php" class="text-gray-300 hover:text-white transition-colors">Blog</a>
                    <a href="privacy_policy.php" class="text-gray-300 hover:text-white transition-colors">Privacy Policy</a>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-400 text-sm">
                &copy; <?php echo date('Y'); ?> Insights. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Login Popup -->
    <div id="loginPopup" class="auth-popup">
        <div class="auth-content">
            <button class="absolute top-0 right-0 p-2 text-gray-500 hover:text-gray-700" onclick="closeAuthPopup('loginPopup')">×</button>
            <h2 class="text-2xl font-bold mb-6 gradient-text">Welcome Back</h2>

            <!-- Email Login Form -->
            <form id="loginForm" onsubmit="handleLogin(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="loginEmail">Email</label>
                    <input type="email" id="loginEmail" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="loginPassword">Password</label>
                    <div class="relative">
                        <input type="password" id="loginPassword" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 pr-10" required>
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" onclick="togglePassword('loginPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                        <span class="ml-2 text-gray-700">Remember me</span>
                    </label>
                    <a href="#" class="text-blue-600 hover:underline transition duration-300" onclick="showForgotPassword()">Forgot Password?</a>
                </div>
                <button type="submit" class="w-full gradient-bg text-white py-3 rounded-lg hover:opacity-90 transition duration-300 font-medium">Sign In</button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or continue with</span>
                </div>
            </div>

            <!-- Google Sign In -->
            <div class="mb-6">
                <a href="auth/google_login.php" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-50 transition duration-300 shadow-sm">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5">
                    <span>Continue with Google</span>
                </a>
            </div>

            <p class="mt-6 text-center text-gray-600">
                Don't have an account?
                <a href="#" class="text-blue-600 hover:underline transition duration-300" onclick="switchToSignup()">Sign up</a>
            </p>
        </div>
    </div>

    <!-- Signup Popup -->
    <div id="signupPopup" class="auth-popup">
        <div class="auth-content">
            <button class="absolute top-0 right-0 p-2 text-gray-500 hover:text-gray-700" onclick="closeAuthPopup('signupPopup')">×</button>
            <h2 class="text-2xl font-bold mb-6 gradient-text">Create Account</h2>

            <!-- Email Sign Up Form -->
            <form id="signupForm" onsubmit="handleSignup(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="signupName">Full Name</label>
                    <input type="text" id="signupName" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="signupEmail">Email</label>
                    <input type="email" id="signupEmail" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="signupPassword">Password</label>
                    <div class="relative">
                        <input type="password" id="signupPassword" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 pr-10" required>
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" onclick="togglePassword('signupPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long</p>
                </div>
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" required>
                        <span class="ml-2 text-gray-700">I agree to the <a href="terms.php" class="text-blue-600 hover:underline">Terms of Service</a> and <a href="privacy_policy.php" class="text-blue-600 hover:underline">Privacy Policy</a></span>
                    </label>
                </div>
                <button type="submit" class="w-full gradient-bg text-white py-3 rounded-lg hover:opacity-90 transition duration-300 font-medium">Create Account</button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Or sign up with</span>
                </div>
            </div>

            <!-- Google Sign Up -->
            <div class="mb-6">
                <a href="auth/google_login.php" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-50 transition duration-300 shadow-sm">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5">
                    <span>Continue with Google</span>
                </a>
            </div>

            <p class="mt-6 text-center text-gray-600">
                Already have an account?
                <a href="#" class="text-blue-600 hover:underline transition duration-300" onclick="switchToLogin()">Sign in</a>
            </p>
        </div>
    </div>

    <!-- Forgot Password Popup -->
    <div id="forgotPasswordPopup" class="auth-popup">
        <div class="auth-content">
            <button class="absolute top-0 right-0 p-2 text-gray-500 hover:text-gray-700" onclick="closeAuthPopup('forgotPasswordPopup')">×</button>
            <h2 class="text-2xl font-bold mb-4 gradient-text">Reset Password</h2>

            <!-- Email Input Form -->
            <form id="forgotPasswordForm">
                <p class="text-gray-600 mb-6">Enter your email address and we'll send you an OTP to verify your identity.</p>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="resetEmail">Email</label>
                    <input type="email" id="resetEmail" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" required>
                </div>
                <button type="submit" class="w-full gradient-bg text-white py-3 rounded-lg hover:opacity-90 transition duration-300 font-medium">Send OTP</button>
            </form>

            <!-- OTP Verification Form (Initially Hidden) -->
            <form id="otpVerificationForm" class="hidden">
                <p class="text-gray-600 mb-6">Please enter the 4-digit verification code sent to your email.</p>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2" for="otp">Verification Code</label>
                    <div class="flex gap-2 justify-center">
                        <input type="text" id="otp1" class="w-12 h-12 text-center border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" maxlength="1" required>
                        <input type="text" id="otp2" class="w-12 h-12 text-center border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" maxlength="1" required>
                        <input type="text" id="otp3" class="w-12 h-12 text-center border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" maxlength="1" required>
                        <input type="text" id="otp4" class="w-12 h-12 text-center border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300" maxlength="1" required>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <button type="submit" class="w-full gradient-bg text-white py-3 rounded-lg hover:opacity-90 transition duration-300 font-medium">Verify OTP</button>
                </div>
                <div class="text-center">
                    <p class="text-gray-600 mb-2">Didn't receive the code?</p>
                    <button type="button" id="resendOTP" class="text-blue-600 hover:underline transition duration-300" disabled>
                        Resend OTP (<span id="resendTimer">30</span>s)
                    </button>
                </div>
            </form>

            <!-- New Password Form (Initially Hidden) -->
            <form id="newPasswordForm" class="hidden">
                <p class="text-gray-600 mb-6">Please enter your new password.</p>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="newPassword">New Password</label>
                    <div class="relative">
                        <input type="password" id="newPassword" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 pr-10" required>
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" onclick="togglePassword('newPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2" for="confirmPassword">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" id="confirmPassword" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 pr-10" required>
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700" onclick="togglePassword('confirmPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full gradient-bg text-white py-3 rounded-lg hover:opacity-90 transition duration-300 font-medium">Reset Password</button>
            </form>

            <p class="mt-6 text-center text-gray-600">
                Remember your password?
                <a href="#" class="text-blue-600 hover:underline transition duration-300" onclick="switchToLogin()">Sign in</a>
            </p>
        </div>
    </div>

    <!-- Contact Form Popup -->
    <div id="contactPopup" class="contact-popup">
        <div class="contact-content">
            <span class="close-contact" onclick="closeContactPopup()">&times;</span>
            <h2 class="text-2xl font-bold mb-6 gradient-text">Contact Us</h2>
            <form class="contact-form" id="contactForm" action="save_contact.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

    <script>
        // Authentication Popup Functions
        function showLogin() {
            document.getElementById('loginPopup').style.display = 'block';
            document.getElementById('signupPopup').style.display = 'none';
            document.getElementById('forgotPasswordPopup').style.display = 'none';
        }

        function showSignup() {
            document.getElementById('signupPopup').style.display = 'block';
            document.getElementById('loginPopup').style.display = 'none';
            document.getElementById('forgotPasswordPopup').style.display = 'none';
        }

        function showForgotPassword() {
            document.getElementById('forgotPasswordPopup').style.display = 'block';
            document.getElementById('loginPopup').style.display = 'none';
            document.getElementById('signupPopup').style.display = 'none';
        }

        function switchToSignup() {
            closeAuthPopup('loginPopup');
            showSignup();
        }

        function switchToLogin() {
            closeAuthPopup('signupPopup');
            closeAuthPopup('forgotPasswordPopup');
            showLogin();
        }

        function closeAuthPopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
        }

        // Event Listeners for Auth Buttons
        document.getElementById('loginBtn')?.addEventListener('click', showLogin);
        document.getElementById('signupBtn')?.addEventListener('click', showSignup);

        // Add event listeners for switching between popups
        document.querySelectorAll('.switch-to-signup').forEach(button => {
            button.addEventListener('click', switchToSignup);
        });

        document.querySelectorAll('.switch-to-login').forEach(button => {
            button.addEventListener('click', switchToLogin);
        });

        document.querySelectorAll('.show-forgot-password').forEach(button => {
            button.addEventListener('click', showForgotPassword);
        });

        // Toast Notification System
        function showToast(title, message, type = 'info') {
            const container = document.querySelector('.toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;

            const icon = type === 'success' ? '✓' :
                type === 'error' ? '✕' : 'ℹ';

            toast.innerHTML = `
                <span class="toast-icon">${icon}</span>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">×</button>
            `;

            container.appendChild(toast);

            // Trigger animation
            setTimeout(() => toast.classList.add('show'), 10);

            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Update form submission handlers to use PHP backend
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            if (!email || !password) {
                showToast(
                    'Error',
                    'Please enter both email and password',
                    'error'
                );
                return;
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Signing in...';

            // Send data to PHP backend
            fetch('api/login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success toast
                        showToast(
                            'Welcome Back!',
                            `Successfully logged in as ${data.user.email}`,
                            'success'
                        );

                        // Close login popup and mobile menu
                        closeAuthPopup('loginPopup');
                        toggleMobileMenu();

                        // Update UI immediately
                        updateProfileInfo(data.user.name, data.user.email);

                        // Reload the page after a short delay to ensure session is set
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showToast(
                            'Login Failed',
                            data.message || 'Invalid email or password. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    showToast(
                        'Error',
                        'An error occurred during login. Please try again.',
                        'error'
                    );
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
        });

        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('signupName').value;
            const email = document.getElementById('signupEmail').value;
            const password = document.getElementById('signupPassword').value;

            if (!name || !email || !password) {
                showToast(
                    'Error',
                    'Please fill in all fields',
                    'error'
                );
                return;
            }

            if (password.length < 8) {
                showToast(
                    'Error',
                    'Password must be at least 8 characters long',
                    'error'
                );
                return;
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Creating account...';

            // Send data to PHP backend
            fetch('api/signup.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Update profile info
                        updateProfileInfo(data.user.name, data.user.email);

                        // Show success toast
                        showToast(
                            'Account Created!',
                            `Welcome ${data.user.name}! Your account has been created successfully.`,
                            'success'
                        );

                        // Close signup popup and mobile menu
                        closeAuthPopup('signupPopup');
                        toggleMobileMenu();

                        // Reload the page after a short delay to ensure session is set
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showToast(
                            'Signup Failed',
                            data.message || 'Failed to create account. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    showToast(
                        'Error',
                        'An error occurred during signup. Please try again.',
                        'error'
                    );
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
        });

        // OTP Resend Timer
        let resendTimer;
        let timeLeft = 30;

        function startResendTimer() {
            const resendButton = document.getElementById('resendOTP');
            const timerDisplay = document.getElementById('resendTimer');

            resendButton.disabled = true;
            timeLeft = 30;

            resendTimer = setInterval(() => {
                timeLeft--;
                timerDisplay.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(resendTimer);
                    resendButton.disabled = false;
                    timerDisplay.textContent = '';
                }
            }, 1000);
        }

        // Forgot Password Form Handler
        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('resetEmail').value;

            if (!email) {
                showToast(
                    'Error',
                    'Please enter your email address',
                    'error'
                );
                return;
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Sending...';

            // Send data to PHP backend
            fetch('api/send_otp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success toast for OTP sent
                        showToast(
                            'OTP Sent Successfully!',
                            `A verification code has been sent to ${email}. Please check your inbox.`,
                            'success'
                        );

                        // Show OTP verification form
                        this.classList.add('hidden');
                        document.getElementById('otpVerificationForm').classList.remove('hidden');

                        // Start resend timer
                        startResendTimer();
                    } else {
                        showToast(
                            'Error',
                            data.message || 'Failed to send OTP. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    showToast(
                        'Error',
                        'An error occurred while sending OTP. Please try again.',
                        'error'
                    );
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
        });

        // Resend OTP Handler
        document.getElementById('resendOTP').addEventListener('click', function() {
            const email = document.getElementById('resetEmail').value;

            if (!email) {
                showToast(
                    'Error',
                    'Email address not found. Please try again.',
                    'error'
                );
                return;
            }

            // Show loading state
            this.disabled = true;
            const originalText = this.textContent;
            this.textContent = 'Sending...';

            // Send data to PHP backend
            fetch('api/send_otp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success toast for OTP sent
                        showToast(
                            'OTP Resent Successfully!',
                            `A new verification code has been sent to ${email}. Please check your inbox.`,
                            'success'
                        );

                        // Start resend timer
                        startResendTimer();
                    } else {
                        showToast(
                            'Error',
                            data.message || 'Failed to resend OTP. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    showToast(
                        'Error',
                        'An error occurred while resending OTP. Please try again.',
                        'error'
                    );
                })
                .finally(() => {
                    // Reset button state
                    this.textContent = originalText;
                });
        });

        // OTP Input Handling
        const otpInputs = document.querySelectorAll('#otpVerificationForm input[type="text"]');
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1) {
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                }
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value.length === 0) {
                    if (index > 0) {
                        otpInputs[index - 1].focus();
                    }
                }
            });
        });

        // OTP Verification Handler
        document.getElementById('otpVerificationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('resetEmail').value;
            const otp = Array.from(otpInputs).map(input => input.value).join('');

            if (otp.length !== 4) {
                showToast(
                    'Invalid OTP',
                    'Please enter a complete 4-digit verification code',
                    'error'
                );
                return;
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Verifying...';

            // Send data to PHP backend
            fetch('api/verify_otp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email,
                        otp: otp
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success message
                        showToast(
                            'OTP Verified!',
                            'Please set your new password.',
                            'success'
                        );

                        // Show new password form
                        this.classList.add('hidden');
                        document.getElementById('newPasswordForm').classList.remove('hidden');
                    } else {
                        showToast(
                            'Invalid OTP',
                            data.message || 'The verification code is incorrect. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    showToast(
                        'Error',
                        'An error occurred during OTP verification. Please try again.',
                        'error'
                    );
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
        });

        // New Password Form Handler
        document.getElementById('newPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('resetEmail').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (!newPassword || !confirmPassword) {
                showToast(
                    'Error',
                    'Please enter both password fields',
                    'error'
                );
                return;
            }

            if (newPassword.length < 8) {
                showToast(
                    'Error',
                    'Password must be at least 8 characters long',
                    'error'
                );
                return;
            }

            if (newPassword !== confirmPassword) {
                showToast(
                    'Password Mismatch',
                    'The passwords you entered do not match. Please try again.',
                    'error'
                );
                return;
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Resetting...';

            // Send data to PHP backend
            fetch('api/reset_password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: email,
                        newPassword: newPassword,
                        confirmPassword: confirmPassword
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success message
                        showToast(
                            'Password Reset Successful!',
                            'Your password has been updated successfully. You can now login with your new password.',
                            'success'
                        );

                        // Close popup and show login
                        setTimeout(() => {
                            closeAuthPopup('forgotPasswordPopup');
                            showLogin();
                        }, 1500);
                    } else {
                        showToast(
                            'Error',
                            data.message || 'Failed to reset password. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    showToast(
                        'Error',
                        'An error occurred while resetting password. Please try again.',
                        'error'
                    );
                })
                .finally(() => {
                    // Reset button state
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                });
        });

        // Update Google Sign In handler
        document.querySelectorAll('.google-signin').forEach(button => {
            button.addEventListener('click', function() {
                showToast(
                    'Google Sign In',
                    'Redirecting to Google Sign In...',
                    'info'
                );
            });
        });

        // Update sentiment analysis handler
        document.getElementById('analyzeBtn').addEventListener('click', function() {
            const text = document.getElementById('inputText').value;
            if (!text) {
                showToast(
                    'Empty Text',
                    'Please enter some text to analyze',
                    'error'
                );
                return;
            }

            // Show analysis in progress message
            showToast(
                'Analyzing Text',
                'Processing your text for sentiment analysis...',
                'info'
            );

            // Simple sentiment analysis (can be replaced with actual API call)
            const resultContainer = document.getElementById('resultContainer');
            const words = text.toLowerCase().split(/\s+/);
            const positiveWords = [
                "amazing", "outstanding", "incredible", "fantastic", "superb", "wonderful", "excellent", "awesome", "delightful", "brilliant", "magnificent", "inspiring",
                "remarkable", "impressive", "fabulous", "top-notch", "flawless", "splendid", "marvelous", "out-of-this-world", "best", "perfect", "beautiful", "stunning",
                "breathtaking", "positive", "great", "joyful", "happy", "cheerful", "content", "exciting", "optimistic", "radiant", "peaceful", "pleasant",
                "light", "bright", "reliable", "fun", "enthusiastic", "comfortable", "elegant", "trustworthy", "successful", "friendly", "outgoing", "joyous", "lively",
                "blissful", "satisfying", "rewarding", "delicious", "luxurious", "high-end", "vibrant", "convenient", "refreshing", "heavenly", "smooth", "rejuvenating",
                "elevated", "thrilling", "sweet", "flattering", "exquisite", "bold", "admirable", "classy", "lovely", "graceful", "brightened", "harmony", "secure", "dependable",
                "clean", "brave", "carefree", "encouraging", "uplifting", "affordable", "fit", "fit-to-serve", "efficient", "beautifully", "loyal", "sophisticated", "stylish",
                "genuine", "charming", "magical", "wholesome", "pristine", "inviting", "radiant", "grateful", "admired", "secure", "funny", "awesome", "splendid", "excellent",
                "friendly", "classy", "elegant", "helpful", "generous", "wealthy", "refreshing", "playful", "good", "sophisticated", "dazzling", "wonderful", "unstoppable",
                "cheerful", "active", "easy", "timeless", "refreshing", "gracious", "well-behaved", "neat", "vibrant", "honest", "caring", "balanced", "engaging", "creative",
                "supportive", "motivated", "peaceful", "hearty", "vibrant", "fit", "courageous", "fun-filled", "fresh", "motivational", "affirming", "mindful", "impressive", "resourceful",
                "efficient", "innovative", "successful", "reliable", "spiritual", "trusting", "loving", "engaging", "dependable", "charitable", "outgoing", "adventurous", "talented", "peace",
                "subtle", "charming", "playful", "thankful", "vivid", "positive", "satisfying", "resilient", "confident", "innovative", "valuable", "mind-blowing", "incredible", "winning",
                "bright", "strong", "exceeding", "shining", "secure", "trusting", "outstanding", "sparkling", "stellar", "premium", "lovely", "super", "top-tier", "exceptional",
                "superior", "perfect", "valuable", "amazing", "timeless", "highly-rated", "one-of-a-kind", "phenomenal", "gorgeous", "radiant", "dynamic", "rewarding", "motivated", "successful",
                "inspirational", "top-notch", "out-of-the-box", "excellent", "superb", "celebrated", "impressive", "gratifying", "unbeatable", "effective", "real", "thriving", "bright", "generous",
                "active", "unique", "loving", "successful", "comfortable", "reliable", "creative", "brilliant", "modern", "consistent", "helpful", "luxurious", "first-rate", "enthusiastic",
                "positive", "successful", "pristine", "warm", "dynamic", "forward-thinking", "rich", "inspiring", "exceptional", "unstoppable", "charming", "elegant", "glowing", "trustworthy",
                "rewarding", "top-tier", "delightful", "flawless", "genuine", "energetic", "visionary", "dependable", "highly-rated", "encouraging", "tasty", "delicious", "lasting", "timeless",
                "blissful", "successful", "wholesome", "celebrated", "easy", "creative", "independent", "radiant", "unstoppable", "dynamic", "respectable", "sincere", "groundbreaking", "classic",
                "prosperous", "perfect", "flawless", "honest", "encouraging", "inspirational", "talented", "active", "invaluable", "motivating", "beautiful", "innovative", "motivational", "leading",
                "outstanding", "luxurious", "sparkling", "valuable", "successful", "leading-edge", "reliable", "remarkable", "timeless", "spectacular", "thrilled", "impressive", "flourishing", "prosperous",
                "glamorous", "honorable", "exhilarating", "radiant", "uplifting", "flawless", "exceptional", "profound", "elite", "optimistic", "happy", "refined", "refreshed", "rewarding",
                "outperforming", "groundbreaking", "motivated", "successful", "affectionate", "outstanding", "convenient", "smart", "elegance", "wholesome", "superior", "carefree", "top-tier", "cutting-edge",
                "brilliant", "bright", "luxuriant", "incredible", "rejuvenating", "commendable", "efficient", "timeless", "genuine", "unmatched", "gratified", "sparkling", "winning", "tender",
                "outdo", "thriving", "elevating", "enduring", "phenomenal", "graceful", "secure", "charming", "splendid", "reliable", "noble", "impressive", "breathtaking", "innovative",
                "sustainable", "brightened", "reliable", "flourishing", "grace", "harmonious", "exquisite", "soothing", "creative", "generous", "vibrant", "heartwarming", "top-notch", "impactful",
                "compelling", "encouraging", "dynamic", "clear", "fresh", "classy", "motivating", "careful", "active", "benevolent", "supportive", "good-hearted", "nurturing", "alluring", "inspiring",
                "caring", "rising", "dependable", "expressive", "visionary", "care", "exceptional", "glistening", "refreshing", "energetic", "steady", "positive", "imposing", "successful", "optimistic",
                "winning", "beneficial", "brisk", "reliable", "motivational", "gleaming", "heartening", "flourishing", "luxurious", "optimistic", "engaging", "hospitable", "charismatic", "upbeat",
                "balanced", "vibrating", "persevering", "steady", "powerful", "accomplished", "outstanding", "encouraging", "admirable", "efficient", "top-tier", "effortless", "creative", "substantial",
                "appealing", "high-quality", "beautiful", "elevated", "classic", "upbeat", "striking", "grand", "remarkable", "impeccable", "celebrated", "captivating", "successful", "satisfying",
                "trustworthy", "exceptional", "bright", "comforting", "engrossing", "great", "compassionate", "unique", "heartfelt", "appreciated", "unbelievable", "splendid", "refreshing", "phenomenal",
                "significant", "impactful", "radiating", "brilliant", "glorious", "magnetic", "successful", "powerful", "admired", "sought-after", "joyous", "amazing", "fascinating", "magnificent",
                "brave", "brightening", "peaceful", "stunning", "outperforming", "fruitful", "gracious", "super", "peaceful", "acclaimed", "flourish", "celebrated", "mature", "reliable",
                "rewarding", "generous", "outstanding", "resourceful", "phenomenal", "formidable", "meaningful", "prospering", "satisfying", "prestigious", "highly-rated", "skilled", "virtuous", "high-class",
                "advanced", "positive", "reliable", "dynamic", "everlasting", "stable", "graceful", "elevated", "acclaimed", "legendary", "intelligent", "refined", "optimistic", "encouraging",
                "noble", "rewarding", "authentic", "productive", "efficient", "visionary", "distinguished", "sophisticated", "successful", "admirable", "elevating", "attractive", "soothing", "brightened",
                "trusted", "fascinating", "unbeatable", "inspiring", "adorable", "affectionate", "agreeable", "appreciative", "attentive", "blissful", "brave", "calm", "caring", "charming",
                "cheerful", "compassionate", "considerate", "content", "courteous", "creative", "delightful", "devoted", "diligent", "eager", "encouraging", "endearing", "engaging", "enthusiastic",
                "flattering", "friendly", "grateful", "genuine", "helpful", "hospitable", "humble", "impressive", "inspiring", "loving", "mindful", "motivating", "nurturing", "optimistic",
                "passionate", "polite", "respectful", "supportive", "thoughtful", "tolerant", "trustworthy", "understanding", "vibrant", "warm", "welcoming", "wise", "zealous", "zestful",
                "thoughtful", "elegant", "precious", "gracious", "handsome", "sincere", "remarkable", "splendid", "considerate", "compelling", "outgoing", "lively", "engrossing", "reliable",
                "dependable", "conscientious", "encouraging", "positive", "friendly", "helpful", "genuine", "playful", "trusting", "respectful", "optimistic", "reliable", "gentle", "patient",
                "joyful", "resourceful", "innovative", "well-meaning", "supportive", "dedicated", "calming", "charming", "uplifting", "balanced", "compassionate", "informed", "open-minded", "engaging",
                "thought-provoking", "amusing", "playful", "considerate", "accommodating", "affable", "gracious", "empathetic", "bright", "generous", "enthusiastic", "hopeful", "mindful", "articulate",
                "strong", "creative", "inviting", "dependable", "motivated", "receptive", "humorous", "admired", "polished", "hilarious", "refreshing", "elevated", "sophisticated", "dazzling",
                "successful", "enlightened", "peaceful", "pleasant", "generous", "flattering", "caring", "courageous", "joyful", "intelligent", "curious", "optimistic", "sparkling", "enthusiastic",
                "radiant", "motivated", "supportive", "mindful", "accepting", "respectful", "noble", "captivating", "supportive", "appreciated", "trustworthy", "determined", "committed", "polite",
                "graceful", "magnanimous", "affirmative", "joyous", "secure", "unique", "insightful", "proactive", "committed", "exemplary", "charming", "well-rounded", "engaged", "exceptional",
                "resourceful", "inspiring", "passionate", "creative", "assured", "resilient", "elevating", "genuine", "reliable"
            ];
            const negativeWords = [
                "angry", "annoyed", "bitter", "blunt", "cold", "confused", "critical", "disappointed", "disturbed", "doubtful", "dull",
                "empty", "envious", "evil", "fail", "fake", "frustrated", "guilty", "harsh", "hopeless", "hostile", "ignorant", "imperfect",
                "impolite", "incompetent", "inconvenient", "indifferent", "insensitive", "intolerant", "irritated", "jealous", "lazy",
                "liar", "lonely", "mean", "misleading", "negative", "negligent", "nervous", "noisy", "numb", "obnoxious", "offensive",
                "overwhelmed", "pathetic", "poor", "pretentious", "resentful", "rude", "sad", "selfish", "shallow", "shocked", "sick",
                "stale", "stressed", "stubborn", "subpar", "superficial", "suspicious", "tense", "troubled", "ugly", "uncomfortable",
                "ungrateful", "unhappy", "unimpressed", "unpleasant", "unsatisfied", "unsuccessful", "useless", "vicious", "violent",
                "weak", "weary", "worried", "wretched", "yelling", "zombie", "abusive", "aggressive", "apathetic", "awkward", "bad",
                "bankrupt", "broke", "chaotic", "clumsy", "contemptuous", "cruel", "disgusted", "disliked", "disrespectful", "distrusting",
                "empty", "enraged", "failing", "false", "fake", "feeble", "frustrating", "grief-stricken", "helpless", "hostile", "hurting",
                "ill", "insufferable", "irate", "lacking", "lousy", "mean-spirited", "miserable", "offended", "outdated", "overbearing",
                "overconfident", "pathetic", "poorly", "regretful", "resentful", "sad", "shameful", "sickening", "silent", "skeptical",
                "slow", "unacceptable", "unappreciated", "unbelievable", "unreliable", "untidy", "untrustworthy", "useless", "vile",
                "weak", "worthless", "yuck", "abandoned", "apathetic", "crushed", "disaster", "disgusting", "exhausted", "helpless",
                "inadequate", "indecisive", "indifferent", "ineffective", "insincere", "irresponsible", "nonchalant", "obnoxious",
                "resentment", "shattered", "sickly", "toxic", "unbearable", "unimpressed", "uninspired", "unprofessional", "unsure",
                "unsuccessful", "worn-out", "wrong", "apathetic", "horrible", "hopeless", "impolite", "insensitive", "lazy", "misleading",
                "noisy", "offensive", "ruthless", "selfish", "stale", "stubborn", "unpredictable", "untidy", "untrustworthy", "violent",
                "wrong", "wrecked", "discontent", "desperate", "difficult", "unresponsive", "harassing", "obstructive", "disconnected",
                "unfriendly", "discouraging", "irritable", "unsympathetic", "displeased", "unsatisfactory", "cranky", "disillusioned",
                "unsure", "inconsiderate", "neglectful", "ungrateful", "disorganized", "insecure", "unstable", "unrelenting", "abysmal",
                "apathetic", "baffled", "bitterly", "bland", "burdened", "chaotic", "clueless", "coldhearted", "condemnatory",
                "confrontational", "corrupt", "deceived", "defeated", "dejected", "delusional", "dismal", "dissatisfied", "disheartening",
                "distrustful", "downhearted", "downturn", "dragging", "emaciated", "embarrassing", "empty-hearted", "exasperated",
                "exhausted", "faulty", "fatal", "feeble-minded", "flawed", "forlorn", "fraudulent", "grumpy", "guilty-conscious",
                "heartbroken", "hostile", "hypocritical", "inadequate", "indignant", "ineffective", "insincere", "insufferable",
                "intolerable", "irrelevant", "irrevocable", "jeering", "joyless", "lacking", "languid", "lazy-minded", "lost", "malicious",
                "meaningless", "misaligned", "misbehaving", "misguided", "mournful", "nasty", "non-constructive", "non-committal",
                "obfuscating", "overbearing", "overemotional", "overwhelmed", "pathetic", "perplexing", "pitiful", "resentful",
                "revolting", "ruthless", "sadistic", "sensitive", "shaky", "sham", "shameful", "shocking", "skeptical", "sluggish",
                "snide", "sore", "suspicious", "tedious", "tense", "threatening", "tiring", "toxic", "unapproachable", "unbearable",
                "uncooperative", "uncomfortable", "uncontrollable", "unempathetic", "unfriendly", "ungracious", "unhelpful",
                "uninspiring", "unjust", "unkind", "unmotivated", "unproductive", "unreliable", "unresponsive", "unsatisfactory",
                "unsympathetic", "untamed", "untrustworthy", "useless", "vague", "vexing", "violent", "volatile", "worthless", "wretched",
                "zombie-like", "burned-out", "dismissive", "disenfranchised", "insensitive", "irritating", "patronizing", "repulsive",
                "resigned", "self-centered", "shattered", "shut-out", "submissive", "suffering", "unruly", "upsetting", "vulnerable",
                "worn-out", "zapped", "abhorrent", "disillusioned", "disenchanting", "degrading", "detrimental", "incoherent",
                "irresponsible", "jealous", "misleading", "unremarkable", "unrewarding", "unworthy", "overworked", "prolonged",
                "repressed", "unfulfilled", "troublesome", "unresolved", "overwhelming", "undesirable", "unpredictable", "unsolved",
                "unwanted", "unsure", "abrasive", "aggravating", "alarming", "annoyed", "anxious", "appalling", "atrocious", "awkward",
                "baffling", "banal", "belligerent", "bleak", "brutal", "careless", "chaos", "clunky", "combative", "complaining", "cranky",
                "creepy", "critical", "crude", "crummy", "damaged", "dangerous", "dark", "deafening", "defiant", "deplorable", "deranged",
                "desperate", "dirty", "disagreeable", "disastrous", "discontent", "discouraged", "disgusted", "distorted", "dizzy",
                "dreadful", "dreary", "dry", "egotistical", "embittered", "enraged", "erratic", "evil", "excruciating", "fake", "fearful",
                "fickle", "filthy", "flimsy", "foolish", "forgetful", "frantic", "frozen", "glaring", "glum", "gross", "haggard", "harsh",
                "haunted", "horrendous", "idiotic", "ignorant", "immature", "impatient", "impolite", "impulsive", "inattentive",
                "inconvenient", "inept", "infuriated", "inhuman", "insane", "insidious", "insufficient", "intimidating", "irate",
                "jittery", "joyless", "jumpy", "lousy", "manipulative", "messy", "mindless", "moody", "mushy", "naive", "nervous",
                "noisy", "obnoxious", "offensive", "outrageous", "overhyped", "panicked", "paranoid", "peculiar", "petty", "phony",
                "pointless", "prickly", "problematic", "raunchy", "reckless", "redundant", "regretful", "rigid", "rough", "rowdy",
                "rusty", "sarcastic", "scary", "shady", "shaky", "shattered", "shrill", "sloppy", "smelly", "snappy", "sneaky",
                "snobbish", "spiteful", "stale", "stiff", "stormy", "stressful", "stuck", "stupid", "tacky", "tedious", "terrifying",
                "thoughtless", "timid", "tough", "trivial", "uncertain", "unclear", "uncouth", "undermined", "uneasy", "unethical",
                "unfair", "unfocused", "unhinged", "unimpressed", "uninvited", "unkempt", "unloved", "unmotivated", "unnerving",
                "unpleasant", "unreliable", "unsure", "untidy", "unwelcoming", "vicious", "vindictive", "wary", "weak", "weird",
                "whiny", "wobbly", "worried", "yucky", "zealous", "absurd", "afraid", "agony", "allegation", "anguish", "anomaly",
                "antagonistic", "apprehensive", "arrogant", "ashamed", "atrophy", "backlash", "badger", "barbaric", "begrudge",
                "belittle", "bitter", "blame", "blunder", "boastful", "bother", "breakdown", "buggy", "bulky", "bully", "burden",
                "burnout", "catastrophe", "chaotic", "cheap", "clueless", "collapse", "complaint", "condescending", "confined",
                "conflict", "confused", "contaminated", "contentious", "cranky", "crisis", "crippled", "crooked", "cumbersome",
                "damaging", "deceit", "defaced", "defeated", "defensive", "degraded", "dejected", "demanding", "denied", "denounce",
                "dense", "desolate", "despise", "destroyed", "detest", "detrimental", "devastated", "difficult", "discredited",
                "disgraced", "dishonest", "disoriented", "disrespected", "disrupted", "distress", "disturbed", "dodgy", "downfall",
                "downtime", "dragging", "dreaded", "drenched", "dull", "dumped", "egocentric", "embarrassed", "emotionless", "erroneous",
                "excluded", "exhausted", "exploit", "failing", "faulty", "fearsome", "feeble", "fiasco", "fidgety", "fool", "forgotten",
                "fractured", "friction", "frightened", "frivolous", "frustrated", "furious", "garbage", "gloomy", "greedy", "grim",
                "grossly", "grumpy", "gullible", "hapless", "hate", "hazard", "helpless", "hesitant", "hostile", "humiliated", "hurt",
                "hypocrite", "ignorance", "ignored", "illogical", "immoral", "imperfect", "impractical", "inaccurate", "inadequate",
                "inappropriate", "incompetent", "indifferent", "ineffective", "inexcusable", "infamous", "inferior", "infuriating",
                "inhumane", "injured", "insecure", "insensitive", "insult", "intolerant", "irresponsible", "isolated", "jealous",
                "judgmental", "lackluster", "lame", "lethargic", "lifeless", "lopsided", "lost", "malfunction", "malicious", "mediocre",
                "meltdown", "menacing", "mess", "miserable", "misguided", "mismanaged", "misplaced", "misused", "nagging", "needy",
                "nonsense", "notorious", "obscene", "oppressive", "outdated", "overbearing", "overlooked", "overrated", "painful",
                "panicky", "pathetic", "perilous", "perplexing", "pessimistic", "petulant", "pitiful", "pointless", "polluted",
                "poorly", "possessive", "powerless", "precarious", "prejudice", "pressured", "problem", "protest", "provocative",
                "puzzling", "questionable", "rage", "rebellious", "regret", "reject", "reluctant", "remorse", "repugnant", "resentful",
                "resistance", "retaliation", "ridiculed", "rigorous", "rude", "ruined", "sadness", "savage", "scam", "scarce", "screwed",
                "selfish", "shallow", "shameful", "shattered", "shortage", "shrunk", "skeptical", "sluggish", "smug", "snide", "sorry",
                "sorrow", "spoil", "standoffish", "stubborn", "subpar", "superficial", "suspect", "suspicious", "tainted", "tense",
                "terrible", "tiring", "toxic", "tragic", "troubled", "unacceptable", "unappealing", "unapproved", "uncertain",
                "uncomfortable", "uncool", "undelivered", "undesirable", "unequal", "unfairness", "unfit", "unforgiving",
                "unfriendly", "ungrateful", "unhappy", "unhelpful", "unjust", "unkind", "unknown", "unlucky", "unnecessary",
                "unpredictable", "unproductive", "unprofessional", "unreliable", "unsatisfied", "unsettled", "unsuccessful",
                "untested", "untrustworthy", "unusual", "unwanted", "upset", "useless", "vague", "vengeful", "vexed", "villain",
                "vulgar", "wasteful", "weakness", "weep", "withdrawn", "withered", "worthless", "wound", "wrecked", "bad", "mad",
                "sad", "ugh", "ick", "lame", "poor", "hate", "pain", "fail", "junk", "yuck", "grim", "weak", "dull", "noob", "slow",
                "mean", "hurt", "mess", "cold", "buggy", "lost", "sick", "bore", "blah", "lazy", "foul", "rude", "dupe", "grim", "blip",
                "glum", "whack", "sour", "down", "rant", "snub", "off", "drab", "icky", "skip", "worn", "blah", "void", "crap", "snag",
                "yell", "flop", "iffy", "meh", "nope", "oops", "ouch", "spam", "crud", "wimp", "fuss", "gripe", "crude", "moan", "darn",
                "bleh", "blah", "bump", "irk", "grit", "iffy", "whine", "vile", "spit", "fake", "wail", "blah", "snit", "blow", "pout",
                "rant", "grit", "dumb", "grim", "sulk", "trap", "lose", "buzz", "trap", "iffy"
            ];

            let positiveCount = 0;
            let negativeCount = 0;

            words.forEach(word => {
                if (positiveWords.includes(word)) positiveCount++;
                if (negativeWords.includes(word)) negativeCount++;
            });

            const sentiment = positiveCount > negativeCount ? 'Positive' :
                negativeCount > positiveCount ? 'Negative' : 'Neutral';

            // Show analysis complete message
            showToast(
                'Analysis Complete',
                `The text has been analyzed as ${sentiment}`,
                'success'
            );

            // Create detailed analysis content
            const analysisContent = `
                <div class="space-y-6">
                    <div class="text-center">
                        <h4 class="text-xl font-semibold mb-2 gradient-text">Overall Sentiment</h4>
                        <div class="text-3xl font-bold ${sentiment === 'Positive' ? 'text-green-600' : 
                            sentiment === 'Negative' ? 'text-red-600' : 'text-yellow-600'}">
                            ${sentiment}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h5 class="text-green-700 font-semibold mb-2">Positive Words</h5>
                            <p class="text-2xl font-bold text-green-600">${positiveCount}</p>
                        </div>
                        <div class="bg-red-50 p-4 rounded-lg">
                            <h5 class="text-red-700 font-semibold mb-2">Negative Words</h5>
                            <p class="text-2xl font-bold text-red-600">${negativeCount}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h5 class="text-gray-700 font-semibold mb-2">Word Count</h5>
                        <p class="text-2xl font-bold text-gray-600">${words.length}</p>
                    </div>

                    <div class="text-sm text-gray-500">
                        <p>Analysis completed at ${new Date().toLocaleTimeString()}</p>
                    </div>
                </div>
            `;

            // Update result container with animation
            resultContainer.style.opacity = '0';
            setTimeout(() => {
                resultContainer.innerHTML = analysisContent;
                resultContainer.style.opacity = '1';
            }, 300);
        });

        // Mobile Menu Functions
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            if (mobileMenu.classList.contains('show')) {
                mobileMenu.classList.remove('show');
            } else {
                mobileMenu.classList.add('show');
            }
        }

        // Update profile information when logged in
        function updateProfileInfo(name, email) {
            const profileName = document.getElementById('profileName');
            const profileEmail = document.getElementById('profileEmail');
            const profileImage = document.getElementById('profileImage');
            const navProfileImage = document.getElementById('navProfileImage');
            const navProfileName = document.getElementById('navProfileName');
            const dropdownProfileName = document.getElementById('dropdownProfileName');
            const dropdownProfileEmail = document.getElementById('dropdownProfileEmail');
            const authButtons = document.getElementById('authButtons');
            const profileDropdown = document.getElementById('profileDropdown');
            const mobileLoginBtn = document.getElementById('mobileLoginBtn');
            const mobileSignupBtn = document.getElementById('mobileSignupBtn');

            if (name && email) {
                // Update mobile menu profile
                if (profileName) profileName.textContent = name;
                if (profileEmail) profileEmail.textContent = email;

                // Update navigation profile
                if (navProfileName) navProfileName.textContent = name;
                if (dropdownProfileName) dropdownProfileName.textContent = name;
                if (dropdownProfileEmail) dropdownProfileEmail.textContent = email;

                // Create profile image with first letter of name
                const firstLetter = name.charAt(0).toUpperCase();
                const profileImageStyle = `
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    font-weight: bold;
                    border-radius: 50%;
                `;

                // Update mobile profile image
                if (profileImage) {
                    profileImage.style = profileImageStyle;
                    profileImage.style.width = '40px';
                    profileImage.style.height = '40px';
                    profileImage.style.fontSize = '20px';
                    profileImage.textContent = firstLetter;
                }

                // Update nav profile image
                if (navProfileImage) {
                    navProfileImage.style = profileImageStyle;
                    navProfileImage.style.width = '32px';
                    navProfileImage.style.height = '32px';
                    navProfileImage.style.fontSize = '16px';
                    navProfileImage.textContent = firstLetter;
                }

                // Show profile dropdown and hide auth buttons
                if (authButtons) authButtons.style.display = 'none';
                if (profileDropdown) {
                    profileDropdown.style.display = 'flex';
                    profileDropdown.classList.remove('hidden');
                }

                // Hide mobile auth buttons
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'none';
                if (mobileSignupBtn) mobileSignupBtn.style.display = 'none';
            } else {
                // Reset to guest state
                if (profileName) profileName.textContent = 'Guest User';
                if (profileEmail) profileEmail.textContent = 'Not logged in';
                if (navProfileName) navProfileName.textContent = '';
                if (dropdownProfileName) dropdownProfileName.textContent = '';
                if (dropdownProfileEmail) dropdownProfileEmail.textContent = '';

                // Reset profile images to default
                if (profileImage) {
                    profileImage.style = '';
                    profileImage.src = 'https://via.placeholder.com/40';
                }
                if (navProfileImage) {
                    navProfileImage.style = '';
                    navProfileImage.src = 'https://via.placeholder.com/32';
                }

                // Show auth buttons and hide profile dropdown
                if (authButtons) authButtons.style.display = 'flex';
                if (profileDropdown) {
                    profileDropdown.style.display = 'none';
                    profileDropdown.classList.add('hidden');
                }

                // Show mobile auth buttons
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'flex';
                if (mobileSignupBtn) mobileSignupBtn.style.display = 'flex';
            }
        }

        // Initialize profile info on page load
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($isLoggedIn): ?>
                // Update profile info from session data
                updateProfileInfo('<?= htmlspecialchars($userName) ?>', '<?= htmlspecialchars($userEmail) ?>');

                // Hide auth buttons and show profile dropdown
                const authButtons = document.getElementById('authButtons');
                const profileDropdown = document.getElementById('profileDropdown');
                const mobileLoginBtn = document.getElementById('mobileLoginBtn');
                const mobileSignupBtn = document.getElementById('mobileSignupBtn');

                if (authButtons) authButtons.style.display = 'none';
                if (profileDropdown) {
                    profileDropdown.style.display = 'flex';
                    profileDropdown.classList.remove('hidden');
                }
                if (mobileLoginBtn) mobileLoginBtn.style.display = 'none';
                if (mobileSignupBtn) mobileSignupBtn.style.display = 'none';
            <?php endif; ?>
        });

        // Profile dropdown toggle
        document.getElementById('profileButton').addEventListener('click', function() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');
            if (!profileDropdown.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Logout functionality
        document.getElementById('logoutBtn').addEventListener('click', function() {
            fetch('api/logout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Clear user data
                        updateProfileInfo(null, null);

                        // Show success message
                        showToast(
                            'Logged Out',
                            'You have been successfully logged out.',
                            'success'
                        );

                        // Close any open popups
                        closeAuthPopup('loginPopup');
                        closeAuthPopup('signupPopup');
                        closeAuthPopup('forgotPasswordPopup');

                        // Reload the page to update session state
                        window.location.reload();
                    } else {
                        showToast(
                            'Error',
                            'Failed to logout. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    showToast(
                        'Error',
                        'An error occurred during logout. Please try again.',
                        'error'
                    );
                });
        });

        // Mobile auth button handlers
        document.getElementById('mobileLoginBtn').addEventListener('click', function() {
            toggleMobileMenu();
            showLogin();
        });

        document.getElementById('mobileSignupBtn').addEventListener('click', function() {
            toggleMobileMenu();
            showSignup();
        });

        // Password Toggle Function
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling;
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // OTP Form Functions
        function showOTPForm() {
            document.getElementById('otpForm').classList.add('show');
        }

        function closeOTPForm() {
            document.getElementById('otpForm').classList.remove('show');
        }

        async function requestOTP(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;

            try {
                const response = await fetch('api/send_otp.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    showToast('OTP has been sent to your email', 'success');
                    closeOTPForm();
                } else {
                    showToast(data.message || 'Failed to send OTP', 'error');
                }
            } catch (error) {
                showToast('An error occurred while sending OTP', 'error');
                console.error('Error:', error);
            }
        }

        // Add event listener for password reset link
        document.addEventListener('DOMContentLoaded', function() {
            const resetPasswordLink = document.querySelector('a[href="#reset-password"]');
            if (resetPasswordLink) {
                resetPasswordLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    showOTPForm();
                });
            }
        });

        function openContactPopup() {
            document.getElementById('contactPopup').style.display = 'block';
        }

        function closeContactPopup() {
            document.getElementById('contactPopup').style.display = 'none';
        }

        // Close popup when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('contactPopup')) {
                closeContactPopup();
            }
        }

        // Handle form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Show loading toast
            showToast(
                'Sending Message',
                'Please wait while we process your message...',
                'info'
            );

            fetch('save_contact.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success toast
                        showToast(
                            'Message Sent!',
                            'Thank you for your message! We will get back to you soon.',
                            'success'
                        );
                        
                        // Close contact popup
                        closeContactPopup();
                        
                        // Reset form
                        this.reset();
                    } else {
                        showToast(
                            'Error',
                            data.message || 'There was an error sending your message. Please try again.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast(
                        'Error',
                        'There was an error sending your message. Please try again.',
                        'error'
                    );
                });
        });

        // Profile dropdown toggle
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.getElementById('profileButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const profileDropdown = document.getElementById('profileDropdown');

            if (profileButton && dropdownMenu && profileDropdown) {
                // Show dropdown when clicking profile button
                profileButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropdownMenu.classList.remove('hidden');
                });

                // Show dropdown when clicking profile dropdown
                profileDropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropdownMenu.classList.remove('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!profileDropdown.contains(e.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });

                // Prevent dropdown from closing when clicking inside it
                dropdownMenu.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });

                // Handle logout button click
                const logoutBtn = document.getElementById('logoutBtn');
                if (logoutBtn) {
                    logoutBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        fetch('api/logout.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    // Clear user data
                                    updateProfileInfo(null, null);

                                    // Show success message
                                    showToast(
                                        'Logged Out',
                                        'You have been successfully logged out.',
                                        'success'
                                    );

                                    // Reload the page to update session state
                                    window.location.reload();
                                } else {
                                    showToast(
                                        'Error',
                                        'Failed to logout. Please try again.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                showToast(
                                    'Error',
                                    'An error occurred during logout. Please try again.',
                                    'error'
                                );
                            });
                    });
                }
            }
        });

        // Remove any existing dropdown event listeners
        document.removeEventListener('click', function() {});
        document.getElementById('profileButton')?.removeEventListener('click', function() {});
        document.getElementById('profileDropdown')?.removeEventListener('click', function() {});
        document.getElementById('dropdownMenu')?.removeEventListener('click', function() {});

        // Profile dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const profileButton = document.getElementById('profileButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const profileDropdown = document.getElementById('profileDropdown');
            const logoutBtn = document.getElementById('logoutBtn');

            // Function to show dropdown
            function showDropdown() {
                if (dropdownMenu) {
                    dropdownMenu.classList.remove('hidden');
                }
            }

            // Function to hide dropdown
            function hideDropdown() {
                if (dropdownMenu) {
                    dropdownMenu.classList.add('hidden');
                }
            }

            // Toggle dropdown when clicking profile button
            if (profileButton) {
                profileButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    showDropdown();
                });
            }

            // Show dropdown when clicking profile area
            if (profileDropdown) {
                profileDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                    showDropdown();
                });
            }

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (profileDropdown && !profileDropdown.contains(e.target)) {
                    hideDropdown();
                }
            });

            // Prevent dropdown from closing when clicking inside it
            if (dropdownMenu) {
                dropdownMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // Handle logout
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    fetch('api/logout.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Clear user data
                                updateProfileInfo(null, null);

                                // Show success message
                                showToast(
                                    'Logged Out',
                                    'You have been successfully logged out.',
                                    'success'
                                );

                                // Reload the page to update session state
                                window.location.reload();
                            } else {
                                showToast(
                                    'Error',
                                    'Failed to logout. Please try again.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            showToast(
                                'Error',
                                'An error occurred during logout. Please try again.',
                                'error'
                            );
                        });
                });
            }
        });
    </script>

    <script>
        const profileButton = document.getElementById('profileButton11');
        const dropdownMenu = document.getElementById('dropdownMenu11');

        profileButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Optional: Hide dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!profileButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    <script>
        // Close dropdown when clicking the "X" button
        document.getElementById('closeDropdownBtn').addEventListener('click', function() {
            document.getElementById('dropdownMenu11').classList.add('hidden');
        });
    </script>

    <!-- Add this JavaScript code to handle URL parameters -->
    <script>
        // Check URL parameters on page load
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('show_login') === 'true') {
                showLogin();
            }
        });
    </script>

    <script>
        function showAnalysisLoginPopup() {
            // Remove any existing popup first
            const existingPopup = document.getElementById('loginPopup');
            if (existingPopup) {
                existingPopup.remove();
            }

            // Show login popup
            const loginPopup = document.createElement('div');
            loginPopup.id = 'loginPopup';
            loginPopup.innerHTML = `
                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-xl p-8 max-w-md w-full transform transition-all duration-300 scale-100 opacity-100 relative overflow-hidden">
                        <!-- Progress Bar -->
                        <div class="absolute top-0 left-0 h-1 bg-gradient-to-r from-blue-500 to-blue-600 progress-bar" style="width: 100%"></div>
                        
                        <!-- Timer Circle -->
                        <div class="absolute top-4 right-4 w-8 h-8">
                            <svg class="w-full h-full transform -rotate-90">
                                <circle class="text-gray-200" stroke-width="3" stroke="currentColor" fill="transparent" r="12" cx="16" cy="16"/>
                                <circle class="text-blue-500 timer-circle" stroke-width="3" stroke-dasharray="75.4" stroke-dashoffset="75.4" stroke-linecap="round" stroke="currentColor" fill="transparent" r="12" cx="16" cy="16"/>
                            </svg>
                            <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-sm font-semibold text-blue-500 timer-text">5</span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                    <i class="fas fa-lock text-blue-500 text-xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">Login Required</h2>
                                    <p class="text-sm text-gray-500">Access to analysis features</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-8">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <div class="flex items-center text-blue-600">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    <span class="text-sm">Secure login required for access</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-4">
                            <a href="index.php?show_login=true" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2.5 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login Now
                            </a>
                            <button onclick="closeLoginPopup()" class="bg-gray-100 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-200 transition-all duration-300 flex items-center">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(loginPopup);

            // Timer functionality
            let timeLeft = 5;
            const timerCircle = loginPopup.querySelector('.timer-circle');
            const timerText = loginPopup.querySelector('.timer-text');
            const progressBar = loginPopup.querySelector('.progress-bar');
            const circumference = 2 * Math.PI * 12;
            
            // Clear any existing timer
            if (window.timerInterval) {
                clearInterval(window.timerInterval);
            }
            
            window.timerInterval = setInterval(() => {
                timeLeft--;
                timerText.textContent = timeLeft;
                const offset = circumference - (timeLeft / 5) * circumference;
                timerCircle.style.strokeDashoffset = offset;
                progressBar.style.width = `${(timeLeft / 5) * 100}%`;
                
                if (timeLeft <= 0) {
                    clearInterval(window.timerInterval);
                    closeLoginPopup();
                }
            }, 1000);
        }

        function closeLoginPopup() {
            const popup = document.getElementById('loginPopup');
            if (popup) {
                // Clear any existing timer
                if (window.timerInterval) {
                    clearInterval(window.timerInterval);
                    window.timerInterval = null;
                }
                
                const popupContent = popup.querySelector('.bg-white');
                popupContent.style.transform = 'scale(0.95)';
                popupContent.style.opacity = '0';
                setTimeout(() => {
                    popup.remove();
                    // Reset the analysis link click handler
                    const analysisLink = document.getElementById('analysisLink');
                    if (analysisLink) {
                        analysisLink.onclick = null;
                        analysisLink.addEventListener('click', function(e) {
                            e.preventDefault();
                            <?php if(!isset($_SESSION['user_id'])): ?>
                                showAnalysisLoginPopup();
                            <?php else: ?>
                                window.location.href = 'main_analysis/analysic.php';
                            <?php endif; ?>
                        });
                    }
                }, 300);
            }
        }
    </script>

    <script>
        // Check if we should show the login popup
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('show_login') === 'true') {
            // Remove the parameter from URL without refreshing
            window.history.replaceState({}, document.title, window.location.pathname);
            // Show the login popup
            showLogin();
        }

        function showLogin() {
            document.getElementById('loginPopup').style.display = 'block';
            document.getElementById('signupPopup').style.display = 'none';
            document.getElementById('forgotPasswordPopup').style.display = 'none';
        }
    </script>

</body>

</html>