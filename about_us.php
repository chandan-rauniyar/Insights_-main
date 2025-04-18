<?php
session_start();
require_once 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Insights</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .developer-card {
            transition: transform 0.3s ease;
        }
        .developer-card:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin: 0 auto;
        }
        .graph-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .sentiment-bar {
            height: 20px;
            border-radius: 10px;
            background: linear-gradient(90deg, #4CAF50 0%, #FFC107 50%, #F44336 100%);
        }
        .emotion-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
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

    <!-- Website Overview -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Insights is dedicated to providing powerful analytics and data visualization tools to help users make informed decisions. 
                Our platform combines cutting-edge technology with user-friendly interfaces to deliver meaningful insights.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="feature-icon mb-4">
                    <i class="fas fa-chart-bar text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Advanced Analytics</h3>
                <p class="text-gray-600">Powerful tools for data analysis and visualization</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="feature-icon mb-4">
                    <i class="fas fa-shield-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Secure Platform</h3>
                <p class="text-gray-600">Your data is protected with enterprise-grade security</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                <div class="feature-icon mb-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">User-Friendly</h3>
                <p class="text-gray-600">Intuitive interface designed for all skill levels</p>
            </div>
        </div>
    </div>

    <!-- Analytics Features Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Our Analytics Features</h2>
            
            <!-- Sentiment Analysis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                <div class="graph-container">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Sentiment Analysis</h3>
                    <div class="mb-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Positive</span>
                            <span class="text-sm text-gray-600">45%</span>
                        </div>
                        <div class="sentiment-bar" style="width: 45%; background: #4CAF50;"></div>
                    </div>
                    <div class="mb-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Neutral</span>
                            <span class="text-sm text-gray-600">30%</span>
                        </div>
                        <div class="sentiment-bar" style="width: 30%; background: #FFC107;"></div>
                    </div>
                    <div class="mb-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-600">Negative</span>
                            <span class="text-sm text-gray-600">25%</span>
                        </div>
                        <div class="sentiment-bar" style="width: 25%; background: #F44336;"></div>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Real-time Sentiment Analysis</h3>
                    <p class="text-gray-600 mb-4">
                        Our platform provides comprehensive sentiment analysis with multiple visualization options:
                    </p>
                    <ul class="space-y-2">
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
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-chart-radar text-blue-500 mr-2"></i>
                            Radar charts for multi-dimensional analysis
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Emotional Analysis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                <div class="flex flex-col justify-center">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Emotional Analysis</h3>
                    <p class="text-gray-600 mb-4">
                        Deep dive into emotional patterns with our advanced emotional analysis tools:
                    </p>
                    <ul class="space-y-2">
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
                <div class="graph-container">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Emotional Distribution</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-24 text-sm text-gray-600">Joy</div>
                            <div class="flex-1 h-4 bg-gray-200 rounded-full">
                                <div class="h-4 bg-green-500 rounded-full" style="width: 40%"></div>
                            </div>
                            <div class="w-12 text-sm text-gray-600 ml-2">40%</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-24 text-sm text-gray-600">Anger</div>
                            <div class="flex-1 h-4 bg-gray-200 rounded-full">
                                <div class="h-4 bg-red-500 rounded-full" style="width: 25%"></div>
                            </div>
                            <div class="w-12 text-sm text-gray-600 ml-2">25%</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-24 text-sm text-gray-600">Sadness</div>
                            <div class="flex-1 h-4 bg-gray-200 rounded-full">
                                <div class="h-4 bg-blue-500 rounded-full" style="width: 20%"></div>
                            </div>
                            <div class="w-12 text-sm text-gray-600 ml-2">20%</div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-24 text-sm text-gray-600">Fear</div>
                            <div class="flex-1 h-4 bg-gray-200 rounded-full">
                                <div class="h-4 bg-yellow-500 rounded-full" style="width: 15%"></div>
                            </div>
                            <div class="w-12 text-sm text-gray-600 ml-2">15%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Input Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="graph-container">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Flexible Input Options</h3>
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
                            <i class="fas fa-keyboard text-2xl text-blue-500 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">Direct Text Input</h4>
                                <p class="text-sm text-gray-600">Enter text directly for instant analysis</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
                            <i class="fas fa-file-alt text-2xl text-blue-500 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800">File Upload</h4>
                                <p class="text-sm text-gray-600">Upload .txt or .json files for analysis</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Export & Share</h3>
                    <p class="text-gray-600 mb-4">
                        Share your insights with others through multiple formats:
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-file-csv text-green-500 mr-2"></i>
                            Export to CSV
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-file-code text-green-500 mr-2"></i>
                            Export to JSON
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fab fa-whatsapp text-green-500 mr-2"></i>
                            Share via WhatsApp
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-envelope text-green-500 mr-2"></i>
                            Share via Email
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Developer Profiles -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Meet Our Team</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Developer 1 -->
            <div class="developer-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                        <img src="assets\developers\dev1_chnadan.png" alt="Developer 1" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Chandan Kumar Gupta</h3>
                    <p class="text-gray-600 text-center mb-4">Lead Developer</p>
                    <div class="flex justify-center space-x-4">
                        <a href="https://github.com/chandan-rauniyar" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/chandan-rauniyar/" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="https://x.com/Chandan_Gupta0" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Developer 2 -->
            <div class="developer-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                        <img src="assets/developers/dev2.png" alt="Developer 2" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Sarah Johnson</h3>
                    <p class="text-gray-600 text-center mb-4">UI/UX Designer</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Developer 3 -->
            <div class="developer-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                        <img src="assets/developers/dev3.png" alt="Developer 3" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Michael Brown</h3>
                    <p class="text-gray-600 text-center mb-4">Backend Developer</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Developer 4 -->
            <div class="developer-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                        <img src="assets/developers/dev4.png" alt="Developer 4" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-2">Emily Davis</h3>
                    <p class="text-gray-600 text-center mb-4">Data Analyst</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" target="_blank" class="text-gray-600 hover:text-blue-500">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
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