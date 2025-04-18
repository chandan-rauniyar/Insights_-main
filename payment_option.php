<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment - Insights</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .payment-popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      z-index: 1000;
    }
    .payment-popup-content {
      animation: slideIn 0.3s ease-out;
      background: white;
      border-radius: 1rem;
      padding: 2rem;
      max-width: 400px;
      width: 90%;
      margin: 2rem auto;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    .qr-container {
      background: #f8fafc;
      padding: 1.5rem;
      border-radius: 0.75rem;
      margin-bottom: 1.5rem;
      border: 1px solid #e2e8f0;
    }
    .qr-code {
      width: 200px;
      height: 200px;
      margin: 0 auto;
      background: white;
      padding: 1rem;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .countdown-timer {
      background: #f1f5f9;
      padding: 0.5rem 1rem;
      border-radius: 9999px;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-weight: 600;
      color: #475569;
    }
    .success-message {
      text-align: center;
      padding: 2rem;
    }
    .success-icon {
      width: 80px;
      height: 80px;
      background: #dcfce7;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      animation: scaleIn 0.3s ease-out;
    }
    .success-icon i {
      color: #22c55e;
      font-size: 2.5rem;
    }
    .redirect-message {
      color: #64748b;
      font-size: 0.875rem;
      margin-top: 1rem;
    }
    .upi-app {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      border: 1px solid #e2e8f0;
      border-radius: 0.75rem;
      cursor: pointer;
      transition: all 0.2s;
      background: white;
    }
    .upi-app:hover {
      border-color: #2563eb;
      background: #f8fafc;
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .upi-app img {
      width: 48px;
      height: 48px;
      object-fit: contain;
      border-radius: 8px;
      background: white;
      padding: 4px;
    }
    .upi-app span {
      font-size: 1.1rem;
      font-weight: 500;
      color: #1e293b;
    }
    .manual-upi {
      background: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      margin-top: 2rem;
      border: 1px solid #e2e8f0;
    }
    .manual-upi:hover {
      border-color: #2563eb;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .upi-input-container {
      display: flex;
      gap: 1rem;
      align-items: center;
      margin-top: 1rem;
    }
    .upi-input {
      flex: 1;
      padding: 0.75rem 1rem;
      border: 2px solid #e2e8f0;
      border-radius: 0.5rem;
      font-size: 1rem;
      transition: all 0.2s;
    }
    .upi-input:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
      outline: none;
    }
    .upi-button {
      background: #2563eb;
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .upi-button:hover {
      background: #1d4ed8;
      transform: translateY(-1px);
    }
    .upi-button i {
      width: 20px;
      height: 20px;
    }
    @keyframes slideIn {
      from { transform: translateY(-50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
    .payment-processing {
      text-align: center;
      padding: 2rem;
    }
    .processing-icon {
      width: 80px;
      height: 80px;
      background: #dbeafe;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      animation: spin 2s linear infinite;
    }
    .processing-icon i {
      color: #2563eb;
      font-size: 2.5rem;
    }
    .payment-received {
      text-align: center;
      padding: 2rem;
    }
    .received-icon {
      width: 80px;
      height: 80px;
      background: #dcfce7;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      animation: scaleIn 0.3s ease-out;
    }
    .received-icon i {
      color: #22c55e;
      font-size: 2.5rem;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    @keyframes scaleIn {
      from { transform: scale(0); }
      to { transform: scale(1); }
    }
    .payment-success {
      text-align: center;
      padding: 2rem;
    }
    .success-icon {
      width: 80px;
      height: 80px;
      background: #dcfce7;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      animation: scaleIn 0.3s ease-out;
    }
    .success-icon i {
      color: #22c55e;
      font-size: 2.5rem;
    }
    .success-message {
      font-size: 1.25rem;
      color: #1e293b;
      margin-bottom: 1rem;
    }
    .success-details {
      background: #f8fafc;
      padding: 1rem;
      border-radius: 0.5rem;
      margin: 1rem 0;
      text-align: left;
    }
    .success-details p {
      margin: 0.5rem 0;
      color: #475569;
    }
    .success-details strong {
      color: #1e293b;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 min-h-screen p-6">
  <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl p-8 shadow-2xl">
      <h2 class="text-3xl font-bold mb-3 text-center text-blue-700">Complete Your Payment</h2>
      <p class="text-sm text-center text-gray-600 mb-6">Choose your preferred UPI app to make the payment</p>
      <p id="selected-plan" class="text-center text-lg font-semibold text-blue-600 mb-8"></p>

      <!-- UPI Apps -->
      <div class="space-y-4 mb-8">
        <div class="upi-app" onclick="showQR('gpay')">
          <img src="assets\database\google_pay.png" alt="Google Pay">
          <span>Google Pay</span>
        </div>
        <div class="upi-app" onclick="showQR('paytm')">
          <img src="assets\database\paytm.png" alt="Paytm">
          <span>Paytm</span>
        </div>
        <div class="upi-app" onclick="showQR('phonepe')">
          <img src="assets\database\phonepe.png" alt="PhonePe">
          <span>PhonePe</span>
        </div>
        <div class="upi-app" onclick="showQR('bhim')">
          <img src="assets\database\BHIM.png" alt="BHIM">
          <span>BHIM UPI</span>
        </div>
      </div>

      <!-- Manual UPI ID Input -->
      <div class="manual-upi">
        <div class="text-center">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Enter UPI ID Manually</h3>
          <p class="text-gray-600 mb-4">Enter your UPI ID to generate a payment QR code</p>
        </div>
        <div class="upi-input-container">
          <input type="text" id="upi-id" class="upi-input" placeholder="yourname@bank">
          <button onclick="showQR('manual')" class="upi-button">
            <i data-lucide="arrow-right"></i>
            Pay Now
          </button>
        </div>
        <p id="upi-error" class="text-sm text-red-600 mt-2 hidden">Invalid UPI ID. Format: name@bank</p>
      </div>
    </div>
  </div>

  <!-- Payment Processing Popup -->
  <div id="payment-popup" class="payment-popup">
    <div class="payment-popup-content">
      <div class="text-center">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Complete Your Payment</h3>
        <div class="qr-container">
          <div class="qr-code">
            <img id="qr-image" src="" alt="Payment QR Code" class="w-full h-full">
          </div>
        </div>
        <p class="text-gray-600 mb-4">Scan the QR code with your payment app to complete the transaction</p>
        <div class="countdown-timer">
          <i data-lucide="clock" class="w-5 h-5"></i>
          <span id="countdown">30</span> seconds remaining
        </div>
      </div>
    </div>
  </div>

  <!-- Processing Payment -->
  <div id="processing-payment" class="payment-popup hidden">
    <div class="payment-popup-content">
      <div class="payment-processing">
        <div class="processing-icon">
          <i data-lucide="loader-2" class="w-10 h-10"></i>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Processing Payment</h3>
        <p class="text-gray-600 mb-4">Please wait while we verify your payment...</p>
      </div>
    </div>
  </div>

  <!-- Payment Received -->
  <div id="payment-received" class="payment-popup hidden">
    <div class="payment-popup-content">
      <div class="payment-received">
        <div class="received-icon">
          <i data-lucide="check" class="w-10 h-10"></i>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Payment Received!</h3>
        <p class="text-gray-600 mb-4">Your payment has been successfully processed</p>
        <p class="redirect-message">Redirecting to thank you page in <span id="redirect-countdown">5</span> seconds...</p>
      </div>
    </div>
  </div>

  <!-- Payment Success -->
  <div id="payment-success" class="payment-popup hidden">
    <div class="payment-popup-content">
      <div class="payment-success">
        <div class="success-icon">
          <i data-lucide="check" class="w-10 h-10"></i>
        </div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Payment Successful!</h3>
        <p class="success-message">Your payment has been processed successfully</p>
        <div class="success-details">
          <p><strong>Amount:</strong> ₹<span id="payment-amount">999</span></p>
          <p><strong>Transaction ID:</strong> <span id="transaction-id">TXN</span><span id="random-id"></span></p>
          <p><strong>Date:</strong> <span id="payment-date"></span></p>
        </div>
        <p class="redirect-message">Redirecting to thank you page in <span id="redirect-countdown">3</span> seconds...</p>
      </div>
    </div>
  </div>

  <script>
    // Initialize lucide icons
    lucide.createIcons();

    // Set selected plan text and amount
    const plan = new URLSearchParams(window.location.search).get("plan") || localStorage.getItem("selectedPlan") || "Premium";
    document.getElementById("selected-plan").textContent = `You've selected: ${plan}`;
    document.getElementById("payment-amount").textContent = getPlanAmount(plan);

    // Generate random transaction ID
    function generateTransactionId() {
      const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      let result = '';
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
      document.getElementById("payment-date").textContent = now.toLocaleDateString('en-IN', options);
    }

    function showQR(method) {
      let upiId = '';
      if (method === 'manual') {
        upiId = document.getElementById("upi-id").value.trim();
        const valid = /^[\w.-]{2,}@[a-zA-Z]{2,}$/.test(upiId);
        if (!valid) {
          document.getElementById("upi-error").classList.remove("hidden");
          return;
        }
        document.getElementById("upi-error").classList.add("hidden");
      }

      // Generate QR code based on method
      const qrData = method === 'manual' 
        ? `upi://pay?pa=${upiId}&pn=Insights&am=${getPlanAmount(plan)}&cu=INR`
        : `upi://pay?pa=insights@bank&pn=Insights&am=${getPlanAmount(plan)}&cu=INR`;
      
      document.getElementById("qr-image").src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(qrData)}&bgcolor=ffffff&color=2563eb`;
      document.getElementById("payment-popup").style.display = "block";
      
      // Start countdown
      let countdown = 30;
      const countdownElement = document.getElementById("countdown");
      const countdownInterval = setInterval(() => {
        countdown--;
        countdownElement.textContent = countdown;
        
        // Random success between 15-30 seconds
        if (countdown <= 15 && Math.random() < 0.1) { // 10% chance each second after 15 seconds
          clearInterval(countdownInterval);
          document.getElementById("payment-popup").style.display = "none";
          
          // Generate transaction details
          document.getElementById("random-id").textContent = generateTransactionId();
          setCurrentDate();
          
          // Show success message
          document.getElementById("payment-success").classList.remove("hidden");
          
          // Redirect after 3 seconds
          setTimeout(() => {
            window.location.href = "payment_thankyou.php";
          }, 500);
        }
        
        if (countdown <= 0) {
          clearInterval(countdownInterval);
          document.getElementById("payment-popup").style.display = "none";
          // Reset for next attempt
          setTimeout(() => {
            alert("Payment time expired. Please try again.");
          }, 500);
        }
      }, 1000);
    }

    function getPlanAmount(plan) {
      const prices = {
        'Premium': '999',
        'Professional': '499',
        'Basic': '199'
      };
      return prices[plan] || '999';
    }
  </script>
</body>
</html>
