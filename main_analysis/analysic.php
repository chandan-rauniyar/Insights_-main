<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insight - Text Analyzer</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-3d"></script>
    <script src="sentiment.js"></script>
    <script src="emotional.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body>
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="../index.php" class="text-white text-2xl font-bold flex items-center">
                        <i class="fas fa-chart-line mr-2"></i>
                        Insight
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="../index.php" class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-home text-xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-gray-200 transition-colors px-3 py-2 rounded-md text-sm font-medium" >
                        Analysis
                    </a>
                    
                    <a href="../blog.php" class="text-white hover:text-gray-200 transition-colors px-3 py-2 rounded-md text-sm font-medium">
                        Blog
                    </a>
                    <a href="../about_us.php" class="text-white hover:text-gray-200 transition-colors px-3 py-2 rounded-md text-sm font-medium">
                        About Us
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="header">
            <h1>Text Analysis Dashboard</h1>
            <p>Analyze text for sentiment, emotions, and content patterns</p>
        </div>

        <!-- Analysis Tabs -->
        <div class="analysis-tabs">
            <button class="tab-button active" onclick="switchAnalysis('sentiment')">
                <i class="fas fa-chart-pie"></i> Sentiment Analysis
            </button>
            <button class="tab-button" onclick="switchAnalysis('emotional')">
                <i class="fas fa-heart"></i> Emotional Analysis
            </button>
        </div>

        <!-- Sentiment Analysis Section -->
        <div id="sentimentAnalysis" class="analysis-section active">
            <!-- Input Section -->
            <div class="input-section">
                <div class="input-card">
                    <h3>Text Input</h3>
                    <textarea class="text-input" placeholder="Enter text to analyze..."></textarea>
                    <button class="analyze-btn" id="analyzeTextBtn">
                        <i class="fas fa-search"></i> Analyze Text
                    </button>
                </div>
                <div class="input-card">
                    <h3>File Upload</h3>
                    <input type="file" id="fileInput" class="file-input" accept=".txt,.json">
                    <label for="fileInput" class="file-label">
                        <i class="fas fa-upload"></i> Choose File
                    </label>
                    <div id="selectedFileName" class="selected-file" style="display: none;">
                        <i class="fas fa-file-alt"></i>
                        <span id="fileName"></span>
                    </div>
                    <button class="analyze-btn" id="analyzeFileBtn">
                        <i class="fas fa-file-alt"></i> Analyze File
                    </button>
                </div>
            </div>

            <!-- Results Section -->
            <div class="results-section" id="sentimentResults" style="display: none;">
                <div class="results-header">
                    <h2>Sentiment Analysis Results</h2>
                    <div class="analysis-actions">
                        <div class="share-export-dropdown">
                            <button class="action-btn share-btn">
                                <i class="fas fa-share-alt"></i> Share
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu share-menu">
                                <div class="dropdown-section">
                                    <h4>Share Via</h4>
                                    <button class="dropdown-item" onclick="window.sentimentAnalyzer.shareToWhatsApp()">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </button>
                                    <button class="dropdown-item" onclick="window.sentimentAnalyzer.shareToEmail()">
                                        <i class="fas fa-envelope"></i> Email
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="share-export-dropdown">
                            <button class="action-btn export-btn">
                                <i class="fas fa-download"></i> Export
                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu export-menu">
                                <div class="dropdown-section">
                                    <h4>Export Format</h4>
                                    <button class="dropdown-item" onclick="window.sentimentAnalyzer.shareAnalysis('csv')">
                                        <i class="fas fa-file-csv"></i> CSV
                                    </button>
                                    <button class="dropdown-item" onclick="window.sentimentAnalyzer.shareAnalysis('json')">
                                        <i class="fas fa-file-code"></i> JSON
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sentiment Analysis Data -->
                <div class="sentiment-cards">
                    <div class="sentiment-card positive">
                        <div class="sentiment-header">
                            <div class="sentiment-icon positive">
                                <i class="fas fa-smile"></i>
                            </div>
                            <h3 class="sentiment-title">Positive Sentiment</h3>
                        </div>
                        <div class="sentiment-stats">
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Percentage</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Count</div>
                            </div>
                        </div>
                        <div class="sentiment-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>Increasing</span>
                        </div>
                    </div>

                    <div class="sentiment-card neutral">
                        <div class="sentiment-header">
                            <div class="sentiment-icon neutral">
                                <i class="fas fa-meh"></i>
                            </div>
                            <h3 class="sentiment-title">Neutral Sentiment</h3>
                        </div>
                        <div class="sentiment-stats">
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Percentage</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Count</div>
                            </div>
                        </div>
                        <div class="sentiment-trend neutral">
                            <i class="fas fa-arrow-right"></i>
                            <span>Stable</span>
                        </div>
                    </div>

                    <div class="sentiment-card negative">
                        <div class="sentiment-header">
                            <div class="sentiment-icon negative">
                                <i class="fas fa-frown"></i>
                            </div>
                            <h3 class="sentiment-title">Negative Sentiment</h3>
                        </div>
                        <div class="sentiment-stats">
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Percentage</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Count</div>
                            </div>
                        </div>
                        <div class="sentiment-trend negative">
                            <i class="fas fa-arrow-down"></i>
                            <span>Decreasing</span>
                        </div>
                    </div>
                </div>

                <!-- Statistics Summary -->
                <div class="statistics-summary">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Total Sentiments</h4>
                            <p class="stat-value">0</p>
                            <p class="stat-label">Analyzed</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-smile"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Positive Sentiments</h4>
                            <p class="stat-value">0%</p>
                            <p class="stat-label">of total</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-frown"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Negative Sentiments</h4>
                            <p class="stat-value">0%</p>
                            <p class="stat-label">of total</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Dominant Sentiment</h4>
                            <p class="stat-value">Neutral</p>
                            <p class="stat-label">0%</p>
                        </div>
                    </div>
                </div>

                <!-- Chart Grid -->
                <div class="chart-grid">
                    <div class="chart-section">
                        <h3><i class="fas fa-chart-pie"></i> Sentiment Distribution</h3>
                        <div class="chart-container">
                            <canvas id="pie3DChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-section">
                        <h3><i class="fas fa-dot-circle"></i> Sentiment Analysis</h3>
                        <div class="chart-container">
                            <canvas id="donutChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="chart-grid">
                    <div class="chart-section">
                        <h3><i class="fas fa-circle-notch"></i> Sentiment Overview</h3>
                        <div class="chart-container">
                            <canvas id="halfDonutChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-section">
                        <h3><i class="fas fa-th"></i> Sentiment Intensity</h3>
                        <div class="chart-container">
                            <canvas id="heatmapChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="chart-grid">
                    <div class="chart-section">
                        <h3><i class="fas fa-bullseye"></i> Sentiment Analysis</h3>
                        <div class="chart-container">
                            <canvas id="radarChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-section">
                        <h3><i class="fas fa-chart-bar"></i> Word Frequency</h3>
                        <div class="chart-container">
                            <canvas id="wordFrequencyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emotional Analysis Section -->
        <div id="emotionalAnalysis" class="analysis-section">
            <!-- Input Section -->
            <div class="input-section">
                <div class="input-card">
                    <h3>Text Input</h3>
                    <textarea class="text-input" placeholder="Enter text to analyze emotions..."></textarea>
                    <button class="analyze-btn" id="analyzeEmotionalTextBtn">
                        <i class="fas fa-search"></i> Analyze Text
                    </button>
                </div>
                <div class="input-card">
                    <h3>File Upload</h3>
                    <input type="file" id="emotionalFileInput" class="file-input" accept=".txt,.json">
                    <label for="emotionalFileInput" class="file-label">
                        <i class="fas fa-upload"></i> Choose File
                    </label>
                    <div id="emotionalSelectedFileName" class="selected-file" style="display: none;">
                        <i class="fas fa-file-alt"></i>
                        <span id="emotionalFileName"></span>
                    </div>
                    <button class="analyze-btn" id="analyzeEmotionalFileBtn">
                        <i class="fas fa-file-alt"></i> Analyze File
                    </button>
                </div>
            </div>

            <!-- Results Section -->
            <div class="results-section" id="emotionalResults" style="display: none;">
                <div class="results-header">
                    <h2>Emotional Analysis Results</h2>
                </div>

                <!-- Emotional Cards -->
                <div class="sentiment-cards">
                    <div class="sentiment-card positive">
                        <div class="sentiment-header">
                            <div class="sentiment-icon positive">
                                <i class="fas fa-laugh"></i>
                            </div>
                            <h3 class="sentiment-title">Positive Emotions</h3>
                        </div>
                        <div class="sentiment-stats">
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Percentage</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Count</div>
                            </div>
                        </div>
                        <div class="sentiment-trend positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>Increasing</span>
                        </div>
                    </div>

                    <div class="sentiment-card neutral">
                        <div class="sentiment-header">
                            <div class="sentiment-icon neutral">
                                <i class="fas fa-meh"></i>
                            </div>
                            <h3 class="sentiment-title">Neutral Emotions</h3>
                        </div>
                        <div class="sentiment-stats">
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Percentage</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Count</div>
                            </div>
                        </div>
                        <div class="sentiment-trend neutral">
                            <i class="fas fa-arrow-right"></i>
                            <span>Stable</span>
                        </div>
                    </div>

                    <div class="sentiment-card negative">
                        <div class="sentiment-header">
                            <div class="sentiment-icon negative">
                                <i class="fas fa-sad-tear"></i>
                            </div>
                            <h3 class="sentiment-title">Negative Emotions</h3>
                        </div>
                        <div class="sentiment-stats">
                            <div class="stat-item">
                                <div class="stat-value">0%</div>
                                <div class="stat-label">Percentage</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">0</div>
                                <div class="stat-label">Count</div>
                            </div>
                        </div>
                        <div class="sentiment-trend negative">
                            <i class="fas fa-arrow-down"></i>
                            <span>Decreasing</span>
                        </div>
                    </div>
                </div>

                <!-- Chart Grids for Emotional Analysis -->
                <div class="chart-grid">
                    <div class="chart-section">
                        <h3><i class="fas fa-chart-pie"></i> Emotional Distribution</h3>
                        <div class="chart-container">
                            <canvas id="emotionalPieChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-section">
                        <h3><i class="fas fa-dot-circle"></i> Emotional Analysis</h3>
                        <div class="chart-container">
                            <canvas id="emotionalDonutChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="chart-grid">
                    <div class="chart-section">
                        <h3><i class="fas fa-circle-notch"></i> Emotional Overview</h3>
                        <div class="chart-container">
                            <canvas id="emotionalHalfDonutChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-section">
                        <h3><i class="fas fa-th"></i> Emotional Intensity</h3>
                        <div class="chart-container">
                            <canvas id="emotionalHeatmapChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="chart-grid">
                    <div class="chart-section">
                        <h3><i class="fas fa-bullseye"></i> Emotional Analysis</h3>
                        <div class="chart-container">
                            <canvas id="emotionalRadarChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-section">
                        <h3><i class="fas fa-chart-bar"></i> Emotional Word Frequency</h3>
                        <div class="chart-container">
                            <canvas id="emotionalWordFrequencyChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Detailed Emotional Analysis Table -->
                <div class="detailed-analysis-container">
                    <div class="detailed-analysis-header">
                        <h3><i class="fas fa-table"></i> Detailed Emotional Analysis</h3>
                        <div class="analysis-controls">
                            <div class="analysis-filters">
                                <button class="filter-btn active" data-filter="all">All Emotions</button>
                                <button class="filter-btn" data-filter="positive">Positive</button>
                                <button class="filter-btn" data-filter="negative">Negative</button>
                            </div>
                            <div class="analysis-actions">
                                <button class="action-btn" id="shareBtn">
                                    <i class="fas fa-share-alt"></i> Share
                                </button>
                                <button class="action-btn" id="exportBtn">
                                    <i class="fas fa-download"></i> Export
                                </button>
                                <button class="action-btn" id="sortBtn">
                                    <i class="fas fa-sort"></i> Sort
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Summary -->
                    <div class="statistics-summary">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Total Emotions</h4>
                                <p class="stat-value">100</p>
                                <p class="stat-label">Analyzed</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-smile"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Positive Emotions</h4>
                                <p class="stat-value">35%</p>
                                <p class="stat-label">of total</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-frown"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Negative Emotions</h4>
                                <p class="stat-value">40%</p>
                                <p class="stat-label">of total</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-content">
                                <h4>Dominant Emotion</h4>
                                <p class="stat-value">Happy</p>
                                <p class="stat-label">15%</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="analysis-table-wrapper">
                        <table class="detailed-analysis-table">
                            <thead>
                                <tr>
                                    <th class="emotion-col">Emotion</th>
                                    <th class="category-col">Category</th>
                                    <th class="count-col">Count</th>
                                    <th class="percentage-col">Percentage</th>
                                    <th class="trend-col">Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="positive-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-smile"></i>
                                            <span>Happy</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag positive">Positive</span></td>
                                    <td>15</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill positive" style="width: 15%"></div>
                                            <span>15%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator up">↑</span></td>
                                </tr>
                                <tr class="positive-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-grin-stars"></i>
                                            <span>Excited</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag positive">Positive</span></td>
                                    <td>10</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill positive" style="width: 10%"></div>
                                            <span>10%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator up">↑</span></td>
                                </tr>
                                <tr class="positive-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-heart"></i>
                                            <span>Loved</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag positive">Positive</span></td>
                                    <td>8</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill positive" style="width: 8%"></div>
                                            <span>8%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator up">↑</span></td>
                                </tr>
                                <tr class="positive-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-hands-helping"></i>
                                            <span>Supportive</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag positive">Positive</span></td>
                                    <td>7</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill positive" style="width: 7%"></div>
                                            <span>7%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator neutral">→</span></td>
                                </tr>
                                <tr class="positive-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-thumbs-up"></i>
                                            <span>Encouraging</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag positive">Positive</span></td>
                                    <td>5</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill positive" style="width: 5%"></div>
                                            <span>5%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator neutral">→</span></td>
                                </tr>
                                <tr class="positive-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-surprise"></i>
                                            <span>Surprised</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag positive">Positive</span></td>
                                    <td>3</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill positive" style="width: 3%"></div>
                                            <span>3%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator neutral">→</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-sad-tear"></i>
                                            <span>Sad</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>12</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 12%"></div>
                                            <span>12%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator down">↓</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-angry"></i>
                                            <span>Angry</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>10</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 10%"></div>
                                            <span>10%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator down">↓</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-frown"></i>
                                            <span>Fearful</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>8</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 8%"></div>
                                            <span>8%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator down">↓</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-user-times"></i>
                                            <span>Lonely</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>6</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 6%"></div>
                                            <span>6%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator down">↓</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-question-circle"></i>
                                            <span>Confused</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>5</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 5%"></div>
                                            <span>5%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator neutral">→</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-grimace"></i>
                                            <span>Disgusted</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>4</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 4%"></div>
                                            <span>4%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator neutral">→</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <span>Abusive</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>3</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 3%"></div>
                                            <span>3%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator down">↓</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-ban"></i>
                                            <span>Hateful</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>2</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 2%"></div>
                                            <span>2%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator down">↓</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-exclamation-circle"></i>
                                            <span>Offensive</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>2</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 2%"></div>
                                            <span>2%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator down">↓</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-comment-dots"></i>
                                            <span>Sarcastic</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>1</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 1%"></div>
                                            <span>1%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator neutral">→</span></td>
                                </tr>
                                <tr class="negative-emotion">
                                    <td>
                                        <div class="emotion-cell">
                                            <i class="fas fa-comment-alt"></i>
                                            <span>Criticizing</span>
                                        </div>
                                    </td>
                                    <td><span class="category-tag negative">Negative</span></td>
                                    <td>1</td>
                                    <td>
                                        <div class="percentage-bar">
                                            <div class="bar-fill negative" style="width: 1%"></div>
                                            <span>1%</span>
                                        </div>
                                    </td>
                                    <td><span class="trend-indicator neutral">→</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Sort Options Dropdown -->
                    <div class="sort-options" id="sortOptions" style="display: none;">
                        <div class="sort-header">
                            <h4>Sort By</h4>
                            <button class="close-sort"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="sort-options-list">
                            <button class="sort-option" data-sort="emotion">Emotion Name</button>
                            <button class="sort-option" data-sort="category">Category</button>
                            <button class="sort-option" data-sort="count">Count</button>
                            <button class="sort-option" data-sort="percentage">Percentage</button>
                            <button class="sort-option" data-sort="trend">Trend</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Options Modal -->
    <div class="share-options" id="shareOptions">
        <div class="share-header">
            <h4>Share Analysis</h4>
            <button class="close-share"><i class="fas fa-times"></i></button>
        </div>
        <div class="share-options-list">
            <button class="share-option" data-format="csv">
                <i class="fas fa-file-csv"></i> Export as CSV
            </button>
            <button class="share-option" data-format="json">
                <i class="fas fa-file-code"></i> Export as JSON
            </button>
            <button class="share-option" data-format="pdf">
                <i class="fas fa-file-pdf"></i> Export as PDF
            </button>
        </div>
    </div>

 
</body>
</html>
