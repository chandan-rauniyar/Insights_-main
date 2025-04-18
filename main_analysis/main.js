// Function to switch between analysis types
function switchAnalysis(type) {
    // Update tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    event.target.classList.add('active');

    // Show/hide analysis sections
    document.querySelectorAll('.analysis-section').forEach(section => {
        section.classList.remove('active');
    });
    document.getElementById(type + 'Analysis').classList.add('active');
}

// Function to analyze text
function analyzeText(type) {
    const text = document.querySelector('#' + type + 'Analysis .text-input').value;
    if (!text.trim()) {
        alert('Please enter some text to analyze');
        return;
    }
    showResults(type);
}

// Function to analyze file
function analyzeFile(type) {
    const fileInput = document.getElementById(type === 'sentiment' ? 'fileInput' : 'emotionalFileInput');
    const file = fileInput.files[0];
    if (!file) {
        alert('Please select a file to analyze');
        return;
    }
    showResults(type);
}

// Function to show results
function showResults(type) {
    document.getElementById(type + 'Results').style.display = 'block';
    initializeCharts(type);
}

// File input handling
document.getElementById('fileInput').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    if (fileName) {
        document.getElementById('selectedFileName').style.display = 'flex';
        document.getElementById('fileName').textContent = fileName;
    } else {
        document.getElementById('selectedFileName').style.display = 'none';
    }
});

document.getElementById('emotionalFileInput').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    if (fileName) {
        document.getElementById('emotionalSelectedFileName').style.display = 'flex';
        document.getElementById('emotionalFileName').textContent = fileName;
    } else {
        document.getElementById('emotionalSelectedFileName').style.display = 'none';
    }
});

// Initialize charts with sample data
function initializeCharts(type) {
    if (type === 'sentiment') {
        // Sample data for sentiment analysis
        const sentimentCategories = ['Positive', 'Neutral', 'Negative'];
        const sentimentData = {
            labels: sentimentCategories,
            datasets: [{
                label: 'Sentiment Distribution',
                data: [45, 30, 25],
                backgroundColor: [
                    'rgba(76, 175, 80, 0.8)',    // Positive
                    'rgba(255, 193, 7, 0.8)',    // Neutral
                    'rgba(255, 107, 107, 0.8)'   // Negative
                ]
            }]
        };

        // 3D Pie Chart
        new Chart(document.getElementById('pie3DChart'), {
            type: 'pie',
            data: sentimentData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Donut Chart
        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: sentimentData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Half Donut Chart
        new Chart(document.getElementById('halfDonutChart'), {
            type: 'doughnut',
            data: sentimentData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Heatmap
        new Chart(document.getElementById('heatmapChart'), {
            type: 'bar',
            data: {
                labels: sentimentCategories,
                datasets: [{
                    label: 'Sentiment Intensity',
                    data: [85, 50, 25],
                    backgroundColor: [
                        'rgba(76, 175, 80, 0.8)',    // Positive
                        'rgba(255, 193, 7, 0.8)',    // Neutral
                        'rgba(255, 107, 107, 0.8)'   // Negative
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Radar Chart
        new Chart(document.getElementById('radarChart'), {
            type: 'radar',
            data: {
                labels: ['Emotional', 'Content', 'Contextual', 'Tone', 'Impact'],
                datasets: [{
                    label: 'Positive',
                    data: [85, 75, 65, 80, 70],
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderColor: 'rgba(76, 175, 80, 1)'
                }, {
                    label: 'Neutral',
                    data: [50, 60, 70, 55, 45],
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    borderColor: 'rgba(255, 193, 7, 1)'
                }, {
                    label: 'Negative',
                    data: [25, 35, 45, 30, 20],
                    backgroundColor: 'rgba(255, 107, 107, 0.2)',
                    borderColor: 'rgba(255, 107, 107, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Word Frequency Chart
        new Chart(document.getElementById('wordFrequencyChart'), {
            type: 'bar',
            data: {
                labels: ['Happy', 'Good', 'Great', 'Excellent', 'Positive', 'Neutral', 'Negative', 'Bad', 'Poor', 'Terrible'],
                datasets: [{
                    label: 'Word Frequency',
                    data: [25, 20, 15, 10, 8, 30, 12, 15, 10, 5],
                    backgroundColor: [
                        'rgba(76, 175, 80, 0.8)',    // Happy
                        'rgba(76, 175, 80, 0.8)',    // Good
                        'rgba(76, 175, 80, 0.8)',    // Great
                        'rgba(76, 175, 80, 0.8)',    // Excellent
                        'rgba(76, 175, 80, 0.8)',    // Positive
                        'rgba(255, 193, 7, 0.8)',    // Neutral
                        'rgba(255, 107, 107, 0.8)',  // Negative
                        'rgba(255, 107, 107, 0.8)',  // Bad
                        'rgba(255, 107, 107, 0.8)',  // Poor
                        'rgba(255, 107, 107, 0.8)'   // Terrible
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    } else {
        // Emotional Analysis Charts
        const emotionalCategories = ['Positive', 'Neutral', 'Negative'];
        const emotionalData = {
            labels: emotionalCategories,
            datasets: [{
                label: 'Emotional Distribution',
                data: [35, 25, 40],
                backgroundColor: [
                    'rgba(76, 175, 80, 0.8)',    // Positive
                    'rgba(255, 193, 7, 0.8)',    // Neutral
                    'rgba(255, 107, 107, 0.8)'   // Negative
                ]
            }]
        };

        // Emotional Pie Chart
        new Chart(document.getElementById('emotionalPieChart'), {
            type: 'pie',
            data: emotionalData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Emotional Donut Chart
        new Chart(document.getElementById('emotionalDonutChart'), {
            type: 'doughnut',
            data: emotionalData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Emotional Half Donut Chart
        new Chart(document.getElementById('emotionalHalfDonutChart'), {
            type: 'doughnut',
            data: emotionalData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Emotional Heatmap
        new Chart(document.getElementById('emotionalHeatmapChart'), {
            type: 'bar',
            data: {
                labels: emotionalCategories,
                datasets: [{
                    label: 'Emotional Intensity',
                    data: [85, 50, 25],
                    backgroundColor: [
                        'rgba(76, 175, 80, 0.8)',    // Positive
                        'rgba(255, 193, 7, 0.8)',    // Neutral
                        'rgba(255, 107, 107, 0.8)'   // Negative
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Emotional Radar Chart
        new Chart(document.getElementById('emotionalRadarChart'), {
            type: 'radar',
            data: {
                labels: ['Intensity', 'Frequency', 'Impact', 'Duration', 'Context'],
                datasets: [{
                    label: 'Positive',
                    data: [85, 75, 65, 80, 70],
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderColor: 'rgba(76, 175, 80, 1)'
                }, {
                    label: 'Neutral',
                    data: [50, 60, 70, 55, 45],
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    borderColor: 'rgba(255, 193, 7, 1)'
                }, {
                    label: 'Negative',
                    data: [25, 35, 45, 30, 20],
                    backgroundColor: 'rgba(255, 107, 107, 0.2)',
                    borderColor: 'rgba(255, 107, 107, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Emotional Word Frequency Chart
        new Chart(document.getElementById('emotionalWordFrequencyChart'), {
            type: 'bar',
            data: {
                labels: ['Happy', 'Excited', 'Loved', 'Supportive', 'Encouraging', 'Surprised', 'Sad', 'Angry', 'Fearful', 'Lonely'],
                datasets: [{
                    label: 'Word Frequency',
                    data: [25, 20, 15, 12, 10, 8, 30, 25, 20, 15],
                    backgroundColor: [
                        'rgba(76, 175, 80, 0.8)',    // Happy
                        'rgba(76, 175, 80, 0.8)',    // Excited
                        'rgba(76, 175, 80, 0.8)',    // Loved
                        'rgba(76, 175, 80, 0.8)',    // Supportive
                        'rgba(76, 175, 80, 0.8)',    // Encouraging
                        'rgba(76, 175, 80, 0.8)',    // Surprised
                        'rgba(255, 107, 107, 0.8)',  // Sad
                        'rgba(255, 107, 107, 0.8)',  // Angry
                        'rgba(255, 107, 107, 0.8)',  // Fearful
                        'rgba(255, 107, 107, 0.8)'   // Lonely
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
}

// Add filter functionality
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');

        const filter = this.dataset.filter;
        const rows = document.querySelectorAll('.detailed-analysis-table tbody tr');

        rows.forEach(row => {
            if (filter === 'all') {
                row.style.display = '';
            } else if (filter === 'positive' && row.classList.contains('positive-emotion')) {
                row.style.display = '';
            } else if (filter === 'negative' && row.classList.contains('negative-emotion')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

// Sort functionality
document.getElementById('sortBtn').addEventListener('click', function() {
    document.getElementById('sortOptions').style.display = 'block';
});

document.querySelector('.close-sort').addEventListener('click', function() {
    document.getElementById('sortOptions').style.display = 'none';
});

document.querySelectorAll('.sort-option').forEach(option => {
    option.addEventListener('click', function() {
        const sortBy = this.dataset.sort;
        const tbody = document.querySelector('.detailed-analysis-table tbody');
        const rows = Array.from(tbody.querySelectorAll('tr'));

        rows.sort((a, b) => {
            let aValue, bValue;

            switch(sortBy) {
                case 'emotion':
                    aValue = a.querySelector('.emotion-cell span').textContent;
                    bValue = b.querySelector('.emotion-cell span').textContent;
                    return aValue.localeCompare(bValue);
                case 'category':
                    aValue = a.querySelector('.category-tag').textContent;
                    bValue = b.querySelector('.category-tag').textContent;
                    return aValue.localeCompare(bValue);
                case 'count':
                    aValue = parseInt(a.querySelector('td:nth-child(3)').textContent);
                    bValue = parseInt(b.querySelector('td:nth-child(3)').textContent);
                    return bValue - aValue;
                case 'percentage':
                    aValue = parseInt(a.querySelector('.percentage-bar span').textContent);
                    bValue = parseInt(b.querySelector('.percentage-bar span').textContent);
                    return bValue - aValue;
                case 'trend':
                    aValue = a.querySelector('.trend-indicator').textContent;
                    bValue = b.querySelector('.trend-indicator').textContent;
                    return aValue.localeCompare(bValue);
            }
        });

        rows.forEach(row => tbody.appendChild(row));
        document.getElementById('sortOptions').style.display = 'none';
    });
});

// Export functionality
document.getElementById('exportBtn').addEventListener('click', function() {
    const table = document.querySelector('.detailed-analysis-table');
    const rows = Array.from(table.querySelectorAll('tr'));
    let csv = 'Emotion,Category,Count,Percentage,Trend\n';

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length) {
            const emotion = cells[0].querySelector('.emotion-cell span').textContent;
            const category = cells[1].querySelector('.category-tag').textContent;
            const count = cells[2].textContent;
            const percentage = cells[3].querySelector('.percentage-bar span').textContent;
            const trend = cells[4].querySelector('.trend-indicator').textContent;
            
            csv += `${emotion},${category},${count},${percentage},${trend}\n`;
        }
    });

    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.setAttribute('hidden', '');
    a.setAttribute('href', url);
    a.setAttribute('download', 'emotional-analysis.csv');
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});

// Share functionality
document.getElementById('shareBtn').addEventListener('click', function() {
    document.getElementById('shareOptions').style.display = 'block';
});

document.querySelector('.close-share').addEventListener('click', function() {
    document.getElementById('shareOptions').style.display = 'none';
});

document.querySelectorAll('.share-option').forEach(option => {
    option.addEventListener('click', function() {
        const format = this.dataset.format;
        const analysisType = document.querySelector('.analysis-section.active').id;
        let data, filename;

        if (analysisType === 'sentimentAnalysis') {
            data = getSentimentAnalysisData();
            filename = 'sentiment-analysis';
        } else {
            data = getEmotionalAnalysisData();
            filename = 'emotional-analysis';
        }

        switch(format) {
            case 'csv':
                exportToCSV(data, filename);
                break;
            case 'json':
                exportToJSON(data, filename);
                break;
            case 'pdf':
                exportToPDF(data, filename);
                break;
        }

        document.getElementById('shareOptions').style.display = 'none';
    });
});

function getSentimentAnalysisData() {
    const data = {
        summary: {
            positive: document.querySelector('.sentiment-card.positive .stat-value').textContent,
            neutral: document.querySelector('.sentiment-card.neutral .stat-value').textContent,
            negative: document.querySelector('.sentiment-card.negative .stat-value').textContent
        },
        charts: {
            pieChart: getChartData('pie3DChart'),
            donutChart: getChartData('donutChart'),
            halfDonutChart: getChartData('halfDonutChart'),
            heatmapChart: getChartData('heatmapChart'),
            radarChart: getChartData('radarChart'),
            wordFrequencyChart: getChartData('wordFrequencyChart')
        }
    };
    return data;
}

function getEmotionalAnalysisData() {
    const data = {
        summary: {
            total: document.querySelector('.stat-card:nth-child(1) .stat-value').textContent,
            positive: document.querySelector('.stat-card:nth-child(2) .stat-value').textContent,
            negative: document.querySelector('.stat-card:nth-child(3) .stat-value').textContent,
            dominant: document.querySelector('.stat-card:nth-child(4) .stat-value').textContent
        },
        detailed: [],
        charts: {
            pieChart: getChartData('emotionalPieChart'),
            donutChart: getChartData('emotionalDonutChart'),
            halfDonutChart: getChartData('emotionalHalfDonutChart'),
            heatmapChart: getChartData('emotionalHeatmapChart'),
            radarChart: getChartData('emotionalRadarChart'),
            wordFrequencyChart: getChartData('emotionalWordFrequencyChart')
        }
    };

    // Get detailed analysis data
    document.querySelectorAll('.detailed-analysis-table tbody tr').forEach(row => {
        data.detailed.push({
            emotion: row.querySelector('.emotion-cell span').textContent,
            category: row.querySelector('.category-tag').textContent,
            count: row.querySelector('td:nth-child(3)').textContent,
            percentage: row.querySelector('.percentage-bar span').textContent,
            trend: row.querySelector('.trend-indicator').textContent
        });
    });

    return data;
}

function getChartData(chartId) {
    const chart = Chart.getChart(chartId);
    if (chart) {
        return {
            labels: chart.data.labels,
            datasets: chart.data.datasets.map(dataset => ({
                label: dataset.label,
                data: dataset.data
            }))
        };
    }
    return null;
}

function exportToCSV(data, filename) {
    let csv = '';
    
    if (filename === 'sentiment-analysis') {
        csv = 'Category,Percentage,Count,Trend\n';
        csv += `Positive,${data.summary.positive},${data.summary.positive.replace('%', '')},Increasing\n`;
        csv += `Neutral,${data.summary.neutral},${data.summary.neutral.replace('%', '')},Stable\n`;
        csv += `Negative,${data.summary.negative},${data.summary.negative.replace('%', '')},Decreasing\n`;
    } else {
        csv = 'Emotion,Category,Count,Percentage,Trend\n';
        data.detailed.forEach(item => {
            csv += `${item.emotion},${item.category},${item.count},${item.percentage},${item.trend}\n`;
        });
    }

    downloadFile(csv, filename + '.csv', 'text/csv');
}

function exportToJSON(data, filename) {
    const json = JSON.stringify(data, null, 2);
    downloadFile(json, filename + '.json', 'application/json');
}

function exportToPDF(data, filename) {
    // This is a placeholder for PDF export functionality
    alert('PDF export functionality will be implemented in the future');
}

function downloadFile(content, filename, type) {
    const blob = new Blob([content], { type });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.setAttribute('hidden', '');
    a.setAttribute('href', url);
    a.setAttribute('download', filename);
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

// Sentiment Analysis Share functionality
document.getElementById('sentimentShareBtn').addEventListener('click', function() {
    document.getElementById('sentimentShareOptions').style.display = 'block';
});

document.querySelector('#sentimentShareOptions .close-share').addEventListener('click', function() {
    document.getElementById('sentimentShareOptions').style.display = 'none';
});

document.querySelectorAll('#sentimentShareOptions .share-option').forEach(option => {
    option.addEventListener('click', function() {
        const format = this.dataset.format;
        const data = getSentimentAnalysisData();
        const filename = 'sentiment-analysis';

        switch(format) {
            case 'csv':
                exportToCSV(data, filename);
                break;
            case 'json':
                exportToJSON(data, filename);
                break;
            case 'pdf':
                exportToPDF(data, filename);
                break;
        }

        document.getElementById('sentimentShareOptions').style.display = 'none';
    });
});

// Sentiment Analysis Export functionality
document.getElementById('sentimentExportBtn').addEventListener('click', function() {
    const data = getSentimentAnalysisData();
    exportToCSV(data, 'sentiment-analysis');
});

// Sentiment Analysis Sort functionality
document.getElementById('sentimentSortBtn').addEventListener('click', function() {
    const sortOptions = document.createElement('div');
    sortOptions.className = 'sort-options';
    sortOptions.innerHTML = `
        <div class="sort-header">
            <h4>Sort By</h4>
            <button class="close-sort"><i class="fas fa-times"></i></button>
        </div>
        <div class="sort-options-list">
            <button class="sort-option" data-sort="category">Category</button>
            <button class="sort-option" data-sort="percentage">Percentage</button>
            <button class="sort-option" data-sort="count">Count</button>
            <button class="sort-option" data-sort="trend">Trend</button>
        </div>
    `;
    document.body.appendChild(sortOptions);
    sortOptions.style.display = 'block';

    sortOptions.querySelector('.close-sort').addEventListener('click', function() {
        sortOptions.style.display = 'none';
        setTimeout(() => sortOptions.remove(), 300);
    });

    sortOptions.querySelectorAll('.sort-option').forEach(option => {
        option.addEventListener('click', function() {
            const sortBy = this.dataset.sort;
            const cards = Array.from(document.querySelectorAll('.sentiment-card'));
            
            cards.sort((a, b) => {
                let aValue, bValue;
                switch(sortBy) {
                    case 'category':
                        aValue = a.querySelector('.sentiment-title').textContent;
                        bValue = b.querySelector('.sentiment-title').textContent;
                        return aValue.localeCompare(bValue);
                    case 'percentage':
                        aValue = parseInt(a.querySelector('.stat-value').textContent);
                        bValue = parseInt(b.querySelector('.stat-value').textContent);
                        return bValue - aValue;
                    case 'count':
                        aValue = parseInt(a.querySelector('.stat-item:nth-child(2) .stat-value').textContent);
                        bValue = parseInt(b.querySelector('.stat-item:nth-child(2) .stat-value').textContent);
                        return bValue - aValue;
                    case 'trend':
                        aValue = a.querySelector('.sentiment-trend span').textContent;
                        bValue = b.querySelector('.sentiment-trend span').textContent;
                        return aValue.localeCompare(bValue);
                }
            });

            const container = document.querySelector('.sentiment-cards');
            cards.forEach(card => container.appendChild(card));
            
            sortOptions.style.display = 'none';
            setTimeout(() => sortOptions.remove(), 300);
        });
    });
});
 