<?php
session_start();
require_once 'config/database.php';
require_once 'models/User.php';
require_once 'models/UserProfile.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$database = new Database();
$conn = $database->getConnection();

$userProfile = new UserProfile($conn);
$profile = $userProfile->getProfileByUserId($_SESSION['user_id']);

// Initialize profile if it doesn't exist
if (!$profile) {
    $user = new User($conn);
    $userData = $user->getUserById($_SESSION['user_id']);
    
    $initialProfile = [
        'user_id' => $_SESSION['user_id'],
        'profile_photo' => null,
        'age' => null,
        'gender' => null,
        'bio' => null,
        'phone_number' => null,
        'address' => null,
        'date_of_birth' => null
    ];
    
    $userProfile->createProfile($initialProfile);
    $profile = $userProfile->getProfileByUserId($_SESSION['user_id']);
    
    // Add basic user data from the users table
    $profile['name'] = $userData['name'] ?? '';
    $profile['email'] = $userData['email'] ?? '';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $profileData = [
            'user_id' => $_SESSION['user_id'],
            'age' => $_POST['age'],
            'gender' => $_POST['gender'],
            'bio' => $_POST['bio'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'date_of_birth' => $_POST['date_of_birth'],
            'profile_photo' => $profile['profile_photo']
        ];

        // Handle profile photo upload
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === 0) {
            $uploadDir = 'uploads/profile_photos/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileExtension = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
            $fileName = $_SESSION['user_id'] . '_' . time() . '.' . $fileExtension;
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $targetPath)) {
                $profileData['profile_photo'] = $targetPath;
            }
        }

        if ($profile) {
            $userProfile->updateProfile($profileData);
        } else {
            $userProfile->createProfile($profileData);
        }

        // Set success message in session
        $_SESSION['success_message'] = 'Profile updated successfully!';
        header('Location: profile.php?mode=view');
        exit();
    }
}

// Get updated profile data
$profile = $userProfile->getProfileByUserId($_SESSION['user_id']);

// Check for success message in session
$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
if ($successMessage) {
    unset($_SESSION['success_message']); // Clear the message after displaying
}

// Determine current mode (view or edit)
$currentMode = isset($_GET['mode']) ? $_GET['mode'] : 'view';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Insights</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            transform: translateX(5px);
        }
        .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .tab-content {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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
                <div class="flex items-center">
                    <a href="index.php" class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-home text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar with Profile Info -->
            <div class="md:w-1/4">
                <div class="profile-card rounded-xl shadow-xl p-6 border border-gray-100">
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                            <img src="<?php echo $profile['profile_photo'] ?? 'assets/default-avatar.png'; ?>" 
                                 alt="Profile Photo" 
                                 class="w-full h-full object-cover">
                        </div>
                        <h2 class="text-xl font-bold mb-2 text-gray-800"><?php echo htmlspecialchars($profile['name']); ?></h2>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($profile['email']); ?></p>
                        
                        <!-- Subscription Badge -->
                        <div class="inline-block bg-gradient-to-r from-blue-500 to-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            <?php echo ucfirst($profile['subscription_status'] ?? 'Free'); ?> Plan
                        </div>
                    </div>

                    <!-- Profile Navigation -->
                    <div class="mt-8 space-y-2">
                        <button onclick="showTab('profile')" class="nav-link w-full text-left px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors flex items-center text-gray-700">
                            <i class="fas fa-user mr-3 text-purple-500"></i> Edit Profile
                        </button>
                        <button onclick="showTab('security')" class="nav-link w-full text-left px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors flex items-center text-gray-700">
                            <i class="fas fa-lock mr-3 text-purple-500"></i> Security
                        </button>
                        <button onclick="showTab('subscription')" class="nav-link w-full text-left px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors flex items-center text-gray-700">
                            <i class="fas fa-crown mr-3 text-purple-500"></i> Subscription
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="md:w-3/4">
                <!-- Success Message -->
                <?php if ($successMessage): ?>
                    <div id="successMessage" class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg transition-all duration-500 transform translate-y-0 opacity-100">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span><?php echo htmlspecialchars($successMessage); ?></span>
                        </div>
                    </div>
                    <script>
                        // Auto-dismiss success message after 3 seconds
                        setTimeout(function() {
                            const successMessage = document.getElementById('successMessage');
                            if (successMessage) {
                                successMessage.style.transform = 'translateY(-20px)';
                                successMessage.style.opacity = '0';
                                setTimeout(() => successMessage.remove(), 500);
                            }
                        }, 3000);
                    </script>
                <?php endif; ?>

                <!-- Profile Edit Tab -->
                <div id="profile-tab" class="tab-content profile-card rounded-xl shadow-xl p-8 border border-gray-100">
                    <?php if ($currentMode === 'view'): ?>
                        <!-- View Mode -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-800">Profile Information</h3>
                            <button onclick="window.location.href='profile.php?mode=edit'" class="bg-blue-500 text-white px-3 py-1.5 rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                <i class="fas fa-edit mr-1"></i> Edit Profile
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Name</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['name']); ?></p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Email</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['email']); ?></p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Age</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['age'] ?? 'Not set'); ?></p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Gender</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['gender'] ?? 'Not set'); ?></p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Phone Number</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['phone_number'] ?? 'Not set'); ?></p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Date of Birth</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['date_of_birth'] ?? 'Not set'); ?></p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Address</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['address'] ?? 'Not set'); ?></p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <label class="block text-gray-500 text-sm mb-1">Bio</label>
                                    <p class="text-gray-800 font-medium"><?php echo htmlspecialchars($profile['bio'] ?? 'Not set'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Edit Mode -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold text-gray-800">Edit Profile</h3>
                            <button onclick="window.location.href='profile.php?mode=view'" class="text-gray-600 hover:text-gray-800 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <form action="profile.php" method="POST" enctype="multipart/form-data">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Profile Photo Section -->
                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 mb-2 font-medium">Profile Photo</label>
                                    <div class="flex items-center space-x-4">
                                        <!-- Current Profile Photo -->
                                        <div class="relative">
                                            <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-gray-200 shadow-sm">
                                                <img src="<?php echo $profile['profile_photo'] ?? 'assets/default-avatar.png'; ?>" 
                                                     alt="Current Profile Photo" 
                                                     class="w-full h-full object-cover"
                                                     id="profilePhotoPreview">
                                            </div>
                                        </div>

                                        <!-- Upload Area -->
                                        <div class="w-48">
                                            <div class="border border-dashed border-gray-300 rounded-lg p-2 hover:border-blue-400 transition-colors cursor-pointer bg-gray-50" id="uploadContainer">
                                                <input type="file" name="profile_photo" accept="image/*" class="hidden" id="profilePhotoInput">
                                                <div class="flex items-center space-x-2">
                                                    <i class="fas fa-cloud-upload-alt text-blue-500 text-sm"></i>
                                                    <span class="text-sm text-gray-600">Upload photo</span>
                                                </div>
                                            </div>
                                            <div id="fileNameDisplay" class="text-xs text-gray-500 mt-1 truncate"></div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Age</label>
                                    <input type="number" name="age" value="<?php echo htmlspecialchars($profile['age'] ?? ''); ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-300 transition-colors">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Gender</label>
                                    <select name="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-300 transition-colors">
                                        <option value="">Select Gender</option>
                                        <option value="male" <?php echo ($profile['gender'] ?? '') === 'male' ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?php echo ($profile['gender'] ?? '') === 'female' ? 'selected' : ''; ?>>Female</option>
                                        <option value="other" <?php echo ($profile['gender'] ?? '') === 'other' ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Phone Number</label>
                                    <input type="tel" name="phone_number" value="<?php echo htmlspecialchars($profile['phone_number'] ?? ''); ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-300 transition-colors">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Date of Birth</label>
                                    <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($profile['date_of_birth'] ?? ''); ?>" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-300 transition-colors">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 mb-2 font-medium">Address</label>
                                    <textarea name="address" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-300 transition-colors"><?php echo htmlspecialchars($profile['address'] ?? ''); ?></textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-gray-700 mb-2 font-medium">Bio</label>
                                    <textarea name="bio" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent hover:border-blue-300 transition-colors"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end space-x-4">
                                <button type="button" onclick="window.location.href='profile.php?mode=view'" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors text-sm">
                                    Cancel
                                </button>
                                <button type="submit" name="update_profile" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                    <i class="fas fa-save mr-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>

                <!-- Security Tab -->
                <div id="security-tab" class="tab-content profile-card rounded-xl shadow-xl p-8 border border-gray-100 hidden">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Security Settings</h3>
                    <form action="api/change_password.php" method="POST" id="passwordForm">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">Current Password</label>
                                <input type="password" name="current_password" required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">New Password</label>
                                <input type="password" name="new_password" required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">Confirm New Password</label>
                                <input type="password" name="confirm_password" required 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors text-sm">
                                    <i class="fas fa-key mr-1"></i> Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Subscription Tab -->
                <div id="subscription-tab" class="tab-content profile-card rounded-xl shadow-xl p-8 border border-gray-100 hidden">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Subscription Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-xl border border-gray-100">
                            <h4 class="font-semibold mb-2 text-gray-700">Current Plan</h4>
                            <p class="text-2xl font-bold text-purple-600"><?php echo ucfirst($profile['subscription_status'] ?? 'Free'); ?></p>
                        </div>
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-xl border border-gray-100">
                            <h4 class="font-semibold mb-2 text-gray-700">Valid Until</h4>
                            <p class="text-2xl font-bold text-purple-600"><?php echo $profile['subscription_end_date'] ?? 'N/A'; ?></p>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="subscription.php" class="inline-block bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors text-sm">
                            <i class="fas fa-crown mr-1"></i> Upgrade Plan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function showTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Show selected tab
        document.getElementById(tabName + '-tab').classList.remove('hidden');
    }

    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const newPassword = this.querySelector('[name="new_password"]').value;
        const confirmPassword = this.querySelector('[name="confirm_password"]').value;
        
        if (newPassword !== confirmPassword) {
            alert('New passwords do not match!');
            return;
        }
        
        this.submit();
    });

    // Show profile tab by default
    document.addEventListener('DOMContentLoaded', function() {
        showTab('profile');
    });

    // Profile photo preview functionality
    document.getElementById('uploadContainer').addEventListener('click', function() {
        document.getElementById('profilePhotoInput').click();
    });

    document.getElementById('profilePhotoInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePhotoPreview').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
            
            // Display file name
            const fileName = e.target.files[0].name;
            document.getElementById('fileNameDisplay').textContent = fileName;
        }
    });

    // Drag and drop functionality
    const uploadContainer = document.getElementById('uploadContainer');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadContainer.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        uploadContainer.classList.add('border-blue-400', 'bg-blue-50');
    }

    function unhighlight(e) {
        uploadContainer.classList.remove('border-blue-400', 'bg-blue-50');
    }

    uploadContainer.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('profilePhotoInput').files = files;
        
        if (files && files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePhotoPreview').src = e.target.result;
            }
            reader.readAsDataURL(files[0]);
            
            // Display file name
            const fileName = files[0].name;
            document.getElementById('fileNameDisplay').textContent = fileName;
        }
    }
    </script>
</body>
</html> 