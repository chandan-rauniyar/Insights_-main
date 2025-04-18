<?php
session_start();
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Insights</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .content-section {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .section-title {
            position: relative;
            padding-left: 1rem;
        }
        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, #667eea, #764ba2);
            border-radius: 2px;
        }
        .hover-effect {
            transition: all 0.3s ease;
        }
        .hover-effect:hover {
            transform: translateX(5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="index.php" class="text-white text-2xl font-bold flex items-center">
                        <i class="fas fa-chart-line mr-2"></i>
                        Insights
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="index.php" class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-home text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Privacy Policy</h1>
                <p class="text-gray-600">Last updated: <?php echo date('F d, Y'); ?></p>
            </div>

            <!-- Content Sections -->
            <div class="space-y-8">
                <!-- Introduction -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Introduction</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Welcome to Insights. We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.
                    </p>
                </div>

                <!-- Information We Collect -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Information We Collect</h2>
                    <div class="space-y-4">
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Personal Information</h3>
                            <p class="text-gray-600">We may collect personal information such as your name, email address, and contact details when you register or use our services.</p>
                        </div>
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Usage Data</h3>
                            <p class="text-gray-600">We collect information about how you use our website, including your browsing patterns and preferences.</p>
                        </div>
                    </div>
                </div>

                <!-- How We Use Your Information -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">How We Use Your Information</h2>
                    <div class="space-y-4">
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Service Provision</h3>
                            <p class="text-gray-600">To provide and maintain our services, including processing your requests and managing your account.</p>
                        </div>
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Communication</h3>
                            <p class="text-gray-600">To communicate with you about our services, updates, and promotional offers.</p>
                        </div>
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Improvement</h3>
                            <p class="text-gray-600">To improve our website and services based on your feedback and usage patterns.</p>
                        </div>
                    </div>
                </div>

                <!-- Data Security -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Data Security</h2>
                    <p class="text-gray-600 leading-relaxed">
                        We implement appropriate security measures to protect your personal information from unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the Internet is 100% secure, and we cannot guarantee absolute security.
                    </p>
                </div>

                <!-- Your Rights -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Your Rights</h2>
                    <div class="space-y-4">
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Access</h3>
                            <p class="text-gray-600">You have the right to request access to your personal data.</p>
                        </div>
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Correction</h3>
                            <p class="text-gray-600">You have the right to request correction of your personal data.</p>
                        </div>
                        <div class="hover-effect p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Deletion</h3>
                            <p class="text-gray-600">You have the right to request deletion of your personal data.</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Us -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Contact Us</h2>
                    <p class="text-gray-600 leading-relaxed">
                        If you have any questions about this Privacy Policy, please contact us at:
                        <a href="mailto:privacy@insights.com" class="text-blue-600 hover:text-blue-800">codewithmyself2@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p>&copy; <?php echo date('Y'); ?> Insights. All rights reserved.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="privacy_policy.php" class="hover:text-gray-300">Privacy Policy</a>
                    <a href="terms.php" class="hover:text-gray-300">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> 