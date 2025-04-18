<!-- thankyou.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Thank You - Insights</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }
    .thank-you-card {
      background: white;
      border-radius: 1.5rem;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      transform: translateY(0);
      transition: transform 0.3s ease;
    }
    .thank-you-card:hover {
      transform: translateY(-5px);
    }
    .success-icon {
      background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
      border-radius: 50%;
      padding: 1.5rem;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.5rem;
      animation: scaleIn 0.5s ease-out;
    }
    .invoice-card {
      background: #f8fafc;
      border-radius: 1rem;
      padding: 1.5rem;
      margin-top: 2rem;
      border: 1px solid #e2e8f0;
      transition: all 0.3s ease;
    }
    .invoice-card:hover {
      border-color: #2563eb;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .invoice-detail {
      display: flex;
      justify-content: space-between;
      padding: 0.75rem 0;
      border-bottom: 1px solid #e2e8f0;
    }
    .invoice-detail:last-child {
      border-bottom: none;
    }
    .home-button {
      background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
      color: white;
      padding: 0.75rem 2rem;
      border-radius: 0.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
    .home-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    @keyframes scaleIn {
      from { transform: scale(0); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
    .confetti {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1000;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="max-w-md w-full">
    <div class="thank-you-card p-8 text-center">
      <div class="success-icon">
        <i data-lucide="check" class="w-12 h-12 text-green-500"></i>
      </div>
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Payment Successful!</h1>
      <p class="text-gray-600 mb-6">Thank you for subscribing to Insights Premium</p>

      <div class="invoice-card">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Invoice Details</h3>
        <div class="invoice-detail">
          <span class="text-gray-600">Invoice No:</span>
          <span class="font-semibold text-gray-800" id="invoice-no"></span>
        </div>
        <div class="invoice-detail">
          <span class="text-gray-600">Date:</span>
          <span class="font-semibold text-gray-800" id="invoice-date"></span>
        </div>
        <div class="invoice-detail">
          <span class="text-gray-600">Plan:</span>
          <span class="font-semibold text-blue-600">Premium</span>
        </div>
        <div class="invoice-detail">
          <span class="text-gray-600">Amount:</span>
          <span class="font-semibold text-gray-800">$9.99</span>
        </div>
      </div>

      <a href="index.php" class="home-button mt-8">
        <i data-lucide="home" class="w-5 h-5"></i>
        Go to Homepage
      </a>
    </div>
  </div>

  <div class="confetti" id="confetti"></div>

  <script>
    // Initialize lucide icons
    lucide.createIcons();

    // Generate random invoice number
    function generateInvoiceNumber() {
      const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      let result = 'INV-';
      for (let i = 0; i < 8; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return result;
    }

    // Set current date
    function setCurrentDate() {
      const now = new Date();
      const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      };
      return now.toLocaleDateString('en-IN', options);
    }

    // Set invoice details
    document.getElementById("invoice-no").textContent = generateInvoiceNumber();
    document.getElementById("invoice-date").textContent = setCurrentDate();

    // Create confetti effect
    function createConfetti() {
      const confettiContainer = document.getElementById("confetti");
      for (let i = 0; i < 100; i++) {
        const confetti = document.createElement("div");
        confetti.style.position = "absolute";
        confetti.style.width = "10px";
        confetti.style.height = "10px";
        confetti.style.backgroundColor = getRandomColor();
        confetti.style.left = Math.random() * 100 + "%";
        confetti.style.top = "-10px";
        confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
        confetti.style.animation = `fall ${Math.random() * 3 + 2}s linear forwards`;
        confettiContainer.appendChild(confetti);
      }
    }

    function getRandomColor() {
      const colors = ["#2563eb", "#22c55e", "#f59e0b", "#ef4444", "#8b5cf6"];
      return colors[Math.floor(Math.random() * colors.length)];
    }

    // Add confetti animation
    const style = document.createElement("style");
    style.textContent = `
      @keyframes fall {
        0% { transform: translateY(0) rotate(0deg); opacity: 1; }
        100% { transform: translateY(100vh) rotate(360deg); opacity: 0; }
      }
    `;
    document.head.appendChild(style);

    // Trigger confetti
    createConfetti();
  </script>
</body>
</html>
