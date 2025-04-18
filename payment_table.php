<?php
session_start();
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Plan - Insights</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .back-video {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
        }
        .video-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }
        .subscription-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }
        .feature-highlight {
            border-left: 4px solid #667eea;
            padding-left: 1rem;
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .main-content {
            background: white;
            position: relative;
            z-index: 1;
        }
        .faq-section {
            background: white;
            position: relative;
            z-index: 1;
        }
        .faq-card {
            background: #f8fafc;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        .faq-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            border-color: #667eea;
        }
        .faq-card:hover h3 {
            color: #667eea;
        }
        .faq-icon {
            transition: transform 0.3s ease;
        }
        .faq-card:hover .faq-icon {
            transform: scale(1.1);
            color: #667eea;
        }
        .home-icon {
            transition: transform 0.3s ease;
        }
        .home-icon:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body class="text-white">
    <video autoplay loop muted class="back-video">
        <source src="assets/images/Main_bg_video.mp4" type="video/mp4" />
    </video>
    <div class="video-overlay"></div>

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
                <div class="flex items-center">
                    <a href="index.php" class="home-icon text-white hover:text-gray-200 text-2xl">
                        <i class="fas fa-home"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h1 class="text-4xl font-bold mb-4 text-gray-800">Choose Your Plan</h1>
                <p class="text-xl text-gray-600">Select the perfect plan for your needs and start analyzing with confidence</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Free Plan -->
                <div class="card rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Free</h3>
                        <div class="text-4xl font-bold text-gray-800 mb-4">$0<span class="text-lg font-normal">/month</span></div>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Basic sentiment analysis</span>
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Limited file uploads</span>
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Basic visualizations</span>
                            </li>
                        </ul>
                        <button class="w-full bg-gray-100 text-gray-800 py-3 px-6 rounded-lg text-center font-semibold hover:bg-gray-200 transition-colors">
                            Current Plan
                        </button>
                    </div>
                </div>

                <!-- Premium Plan -->
                <div class="subscription-card rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="p-8">
                        <div class="absolute top-0 right-0 bg-yellow-400 text-gray-800 px-4 py-1 rounded-bl-lg font-semibold text-sm">
                            Popular
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Premium</h3>
                        <div class="text-4xl font-bold text-white mb-4">$9.99<span class="text-lg font-normal">/month</span></div>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center text-white">
                                <i class="fas fa-check text-green-300 mr-2"></i>
                                <span>Advanced sentiment analysis</span>
                            </li>
                            <li class="flex items-center text-white">
                                <i class="fas fa-check text-green-300 mr-2"></i>
                                <span>Unlimited file uploads</span>
                            </li>
                            <li class="flex items-center text-white">
                                <i class="fas fa-check text-green-300 mr-2"></i>
                                <span>All visualization options</span>
                            </li>
                            <li class="flex items-center text-white">
                                <i class="fas fa-check text-green-300 mr-2"></i>
                                <span>Export to multiple formats</span>
                            </li>
                            <li class="flex items-center text-white">
                                <i class="fas fa-check text-green-300 mr-2"></i>
                                <span>Priority support</span>
                            </li>
                        </ul>
                        <a href="payment_option.php?plan=Premium" class="block w-full bg-white text-blue-600 py-3 px-6 rounded-lg text-center font-semibold hover:bg-gray-100 transition-colors">
                            Upgrade Now
                        </a>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="card rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Enterprise</h3>
                        <div class="text-4xl font-bold text-gray-800 mb-4">Custom</div>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>All Premium features</span>
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Custom integrations</span>
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>Dedicated support</span>
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span>API access</span>
                            </li>
                        </ul>
                        <button class="w-full bg-gray-100 text-gray-800 py-3 px-6 rounded-lg text-center font-semibold hover:bg-gray-200 transition-colors">
                            Contact Sales
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <div class="container mx-auto px-4 py-12">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Frequently Asked Questions</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="faq-card p-6 rounded-xl shadow-lg">
                            <div class="flex items-start">
                                <i class="fas fa-upload faq-icon text-gray-400 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800">How do I upload files for analysis?</h3>
                                    <p class="text-gray-600">You can upload .txt or .json files through our intuitive file upload interface. Simply click the upload button and select your file.</p>
                                </div>
                            </div>
                        </div>
                        <div class="faq-card p-6 rounded-xl shadow-lg">
                            <div class="flex items-start">
                                <i class="fas fa-file-export faq-icon text-gray-400 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800">What formats can I export my analysis in?</h3>
                                    <p class="text-gray-600">Premium users can export their analysis in CSV and JSON formats, and share results via WhatsApp or email.</p>
                                </div>
                            </div>
                        </div>
                        <div class="faq-card p-6 rounded-xl shadow-lg">
                            <div class="flex items-start">
                                <i class="fas fa-chart-line faq-icon text-gray-400 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800">How accurate is the sentiment analysis?</h3>
                                    <p class="text-gray-600">Our sentiment analysis uses advanced algorithms to provide highly accurate results, with continuous improvements based on user feedback.</p>
                                </div>
                            </div>
                        </div>
                        <div class="faq-card p-6 rounded-xl shadow-lg">
                            <div class="flex items-start">
                                <i class="fas fa-user-cancel faq-icon text-gray-400 mr-4 mt-1"></i>
                                <div>
                                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Can I cancel my subscription anytime?</h3>
                                    <p class="text-gray-600">Yes, you can cancel your subscription at any time. Your premium features will remain active until the end of your billing period.</p>
                                </div>
                            </div>
                        </div>
                    </div>
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