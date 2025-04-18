<?php
session_start();
require_once 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & Tutorials - Insights</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .blog-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .subscription-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .step-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin: 0 auto;
        }
        .feature-highlight {
            border-left: 4px solid #667eea;
            padding-left: 1rem;
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
                    
                    
                    <a href="#" class="text-white hover:text-gray-200 transition-colors px-3 py-2 rounded-md text-sm font-medium" id="analysisLink">
                        Analysis
                    </a>
                    <a href="blog.php" class="text-white hover:text-gray-200 transition-colors px-3 py-2 rounded-md text-sm font-medium">
                        Blog
                    </a>
                    <a href="about_us.php" class="text-white hover:text-gray-200 transition-colors px-3 py-2 rounded-md text-sm font-medium">
                        About Us
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="py-16 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-blue-50 opacity-90">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAzNGM2LjYyNyAwIDEyLTUuMzczIDEyLTEyUzQyLjYyNyAxMCAzNiAxMGMtNi42MjggMC0xMiA1LjM3My0xMiAxMnM1LjM3MiAxMiAxMiAxMnptMCAyYy03LjczMiAwLTE0LTYuMjY4LTE0LTE0czYuMjY4LTE0IDE0LTE0IDE0IDYuMjY4IDE0IDE0LTYuMjY4IDE0LTE0IDE0eiIgZmlsbD0iI2Q4YjhmZiIvPjwvZz48L3N2Zz4=')] opacity-20"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-blue-600">
                    Learn How to Use Insights
                </h1>
                <p class="text-xl mb-8 text-gray-600 max-w-2xl mx-auto">
                    Discover the power of our analytics platform through our comprehensive guides and tutorials
                </p>
                <div class="flex justify-center gap-4">
                    <a href="payment_table.php" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:from-purple-700 hover:to-blue-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Get Premium Access
                    </a>
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Getting Started Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Getting Started with Insights</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Step 1 -->
            <div class="bg-white p-6 rounded-xl shadow-lg text-center blog-card">
                <div class="step-icon mb-4">
                    <i class="fas fa-sign-in-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">1. Create Your Account</h3>
                <p class="text-gray-600">Sign up for a free account to access basic features or upgrade to premium for advanced analytics</p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white p-6 rounded-xl shadow-lg text-center blog-card">
                <div class="step-icon mb-4">
                    <i class="fas fa-upload text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">2. Input Your Data</h3>
                <p class="text-gray-600">Choose between direct text input or file upload (.txt or .json) to analyze your content</p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white p-6 rounded-xl shadow-lg text-center blog-card">
                <div class="step-icon mb-4">
                    <i class="fas fa-chart-bar text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">3. Analyze & Visualize</h3>
                <p class="text-gray-600">View comprehensive sentiment and emotional analysis through interactive charts and graphs</p>
            </div>
        </div>
    </div>

    <!-- Feature Highlights -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Key Features Explained</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                <!-- Sentiment Analysis -->
                <div class="bg-white p-6 rounded-xl shadow-lg blog-card">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Sentiment Analysis</h3>
                    <div class="feature-highlight mb-4">
                        <p class="text-gray-600">Our platform provides comprehensive sentiment analysis with multiple visualization options:</p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-chart-pie text-blue-500 mr-2"></i>
                                3D Pie Charts for sentiment distribution
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-chart-donut text-blue-500 mr-2"></i>
                                Donut and Half-Donut charts
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-chart-bar text-blue-500 mr-2"></i>
                                Heatmap visualization
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Emotional Analysis -->
                <div class="bg-white p-6 rounded-xl shadow-lg blog-card">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Emotional Analysis</h3>
                    <div class="feature-highlight mb-4">
                        <p class="text-gray-600">Deep dive into emotional patterns with our advanced analysis tools:</p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-heart text-red-500 mr-2"></i>
                                Emotion intensity tracking
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-chart-line text-red-500 mr-2"></i>
                                Emotional trend analysis
                            </li>
                            <li class="flex items-center text-gray-600">
                                <i class="fas fa-chart-bar text-red-500 mr-2"></i>
                                Word frequency analysis
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription Section -->
    <div id="subscription" class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Choose Your Plan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Free Plan -->
            <div class="bg-white p-8 rounded-xl shadow-lg blog-card">
                <h3 class="text-2xl font-bold text-center mb-4">Free</h3>
                <p class="text-4xl font-bold text-center mb-6">$0<span class="text-lg text-gray-600">/month</span></p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Basic sentiment analysis
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Limited file uploads
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Basic visualizations
                    </li>
                </ul>
                <button class="w-full bg-gray-100 text-gray-800 py-3 rounded-full font-semibold hover:bg-gray-200 transition-colors">
                    Current Plan
                </button>
            </div>

            <!-- Premium Plan -->
            <div class="subscription-card p-8 rounded-xl shadow-lg blog-card transform scale-105">
                <h3 class="text-2xl font-bold text-center mb-4">Premium</h3>
                <p class="text-4xl font-bold text-center mb-6">$9.99<span class="text-lg text-white opacity-75">/month</span></p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        Advanced sentiment analysis
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        Unlimited file uploads
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        All visualization options
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        Export to multiple formats
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        Priority support
                    </li>
                </ul>
                <a href="payment_option.php">
                <button class="w-full bg-white text-purple-600 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                    Upgrade Now
                </button></a>
            </div>

            <!-- Enterprise Plan -->
            <div class="bg-white p-8 rounded-xl shadow-lg blog-card">
                <h3 class="text-2xl font-bold text-center mb-4">Enterprise</h3>
                <p class="text-4xl font-bold text-center mb-6">Custom</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        All Premium features
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Custom integrations
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        Dedicated support
                    </li>
                    <li class="flex items-center text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        API access
                    </li>
                </ul>
                <button class="w-full bg-gray-100 text-gray-800 py-3 rounded-full font-semibold hover:bg-gray-200 transition-colors">
                    Contact Sales
                </button>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Frequently Asked Questions</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">How do I upload files for analysis?</h3>
                    <p class="text-gray-600">You can upload .txt or .json files through our intuitive file upload interface. Simply click the upload button and select your file.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">What formats can I export my analysis in?</h3>
                    <p class="text-gray-600">Premium users can export their analysis in CSV and JSON formats, and share results via WhatsApp or email.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">How accurate is the sentiment analysis?</h3>
                    <p class="text-gray-600">Our sentiment analysis uses advanced algorithms to provide highly accurate results, with continuous improvements based on user feedback.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Can I cancel my subscription anytime?</h3>
                    <p class="text-gray-600">Yes, you can cancel your subscription at any time. Your premium features will remain active until the end of your billing period.</p>
                </div>
            </div>
        </div>
    </div>

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

    <!-- Add this script section before the closing body tag -->
    <script>
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

        document.getElementById('analysisLink').addEventListener('click', function(e) {
            e.preventDefault();
            <?php if(!isset($_SESSION['user_id'])): ?>
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
            <?php else: ?>
                window.location.href = 'main_analysis/analysic.php';
            <?php endif; ?>
        });
    </script>
</body>
</html> 