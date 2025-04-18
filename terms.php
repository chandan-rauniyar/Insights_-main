<?php
session_start();
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - Insights</title>
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
        .term-item {
            counter-increment: term-counter;
            position: relative;
            padding-left: 2.5rem;
        }
        .term-item::before {
            content: counter(term-counter);
            position: absolute;
            left: 0;
            top: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
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
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Terms of Service</h1>
                <p class="text-gray-600">Last updated: <?php echo date('F d, Y'); ?></p>
            </div>

            <!-- Content Sections -->
            <div class="space-y-8">
                <!-- Introduction -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Introduction</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Welcome to Insights. By accessing or using our website, you agree to be bound by these Terms of Service. Please read these terms carefully before using our services.
                    </p>
                </div>

                <!-- Acceptance of Terms -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Acceptance of Terms</h2>
                    <div class="space-y-4">
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">By accessing or using our services, you agree to be bound by these Terms of Service and all applicable laws and regulations.</p>
                        </div>
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">If you do not agree with any of these terms, you are prohibited from using or accessing our services.</p>
                        </div>
                    </div>
                </div>

                <!-- User Accounts -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">User Accounts</h2>
                    <div class="space-y-4">
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">You are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.</p>
                        </div>
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">You agree to notify us immediately of any unauthorized use of your account or any other breach of security.</p>
                        </div>
                    </div>
                </div>

                <!-- Use of Services -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Use of Services</h2>
                    <div class="space-y-4">
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">You agree to use our services only for lawful purposes and in accordance with these Terms of Service.</p>
                        </div>
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">You must not use our services in any way that could damage, disable, overburden, or impair our website or interfere with any other party's use of our services.</p>
                        </div>
                    </div>
                </div>

                <!-- Intellectual Property -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Intellectual Property</h2>
                    <div class="space-y-4">
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">All content, features, and functionality of our services are owned by Insights and are protected by international copyright, trademark, and other intellectual property laws.</p>
                        </div>
                        <div class="term-item hover-effect p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">You may not reproduce, distribute, modify, create derivative works of, publicly display, or otherwise exploit any of our content without our prior written consent.</p>
                        </div>
                    </div>
                </div>

                <!-- Limitation of Liability -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Limitation of Liability</h2>
                    <p class="text-gray-600 leading-relaxed">
                        In no event shall Insights, its directors, employees, partners, agents, suppliers, or affiliates be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.
                    </p>
                </div>

                <!-- Changes to Terms -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Changes to Terms</h2>
                    <p class="text-gray-600 leading-relaxed">
                        We reserve the right to modify or replace these Terms of Service at any time. We will provide notice of any changes by posting the new Terms of Service on this page and updating the "Last updated" date.
                    </p>
                </div>

                <!-- Contact Us -->
                <div class="content-section rounded-xl shadow-lg p-8">
                    <h2 class="section-title text-2xl font-semibold text-gray-800 mb-4">Contact Us</h2>
                    <p class="text-gray-600 leading-relaxed">
                        If you have any questions about these Terms of Service, please contact us at:
                        <a href="mailto:terms@insights.com" class="text-blue-600 hover:text-blue-800">codewithmyself2@gmail.com</a>
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