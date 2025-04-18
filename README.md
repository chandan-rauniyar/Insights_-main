# Insights - Sentiment Analysis Platform

Insights is a web-based sentiment analysis platform that helps users analyze text content for emotional and sentiment patterns. This guide will help you set up the project locally.

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer (PHP package manager)
- XAMPP/WAMP/MAMP (for local development)

## Installation Steps

### 1. Install Dependencies

1. Open Command Prompt/Terminal in your project directory
2. Run the following command to install all required packages:
```bash
composer install
```

This will install the following dependencies:
- Google OAuth Client (for Google login)
- PHPMailer (for email functionality)
- Other required packages as specified in composer.json

If you encounter any issues, try:
```bash
composer update
```

### 2. Database Setup

#### Option 1: Using phpMyAdmin
1. Open phpMyAdmin in your browser (usually at http://localhost/phpmyadmin)
2. Create a new database named `insights_db`
3. Import the database structure using the SQL queries below:

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS insights_db;

-- Use the database
USE insights_db;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255),
    google_id VARCHAR(255),
    login_type ENUM('manual', 'google') DEFAULT 'manual',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create password_resets table
CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create user_profiles table
CREATE TABLE IF NOT EXISTS user_profiles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    profile_photo VARCHAR(255),
    age INT,
    gender ENUM('male', 'female', 'other'),
    bio TEXT,
    phone_number VARCHAR(20),
    address TEXT,
    date_of_birth DATE,
    subscription_status ENUM('free', 'basic', 'premium') DEFAULT 'free',
    subscription_end_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### Option 2: Using MySQL Command Line
1. Open your terminal/command prompt
2. Connect to MySQL:
```bash
mysql -u root -p
```
3. Copy and paste the SQL queries from above

### 3. Configure Database Connection

1. Navigate to `config/database.php`
2. Update the database credentials:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'insights_db');
```

### 4. Configure OAuth and Email Settings

1. For Google OAuth:
   - Go to Google Cloud Console
   - Create a new project
   - Enable Google+ API
   - Create OAuth 2.0 credentials
   - Update the credentials in your project's OAuth configuration

2. For PHPMailer:
   - Update email settings in your project's mail configuration
   - Set SMTP server details
   - Configure sender email and password

### 5. Start Local Server

#### Using XAMPP:
1. Start Apache and MySQL services from XAMPP Control Panel
2. Place the project folder in `htdocs` directory
3. Access the project at `http://localhost/insights`

#### Using PHP Built-in Server:
```bash
php -S localhost:8000
```
Access the project at `http://localhost:8000`

## Project Structure

```
insights/
├── assets/
│   ├── css/
│   ├── js/
│   └── database/
├── config/
│   └── database.php
├── vendor/
│   ├── google/
│   │   └── apiclient/ (Google OAuth)
│   └── phpmailer/ (Email functionality)
├── index.php
├── blog.php
├── about_us.php
├── payment_table.php
├── payment_option.php
├── payment_thankyou.php
├── privacy_policy.php
├── terms.php
└── composer.json
```

## Features

- User Authentication (Manual & Google Login)
- Sentiment Analysis
- Subscription Plans (Free, Premium)
- Profile Management
- Contact Form
- Blog Section
- Payment Integration

## Troubleshooting

1. **Dependency Installation Issues**
   - Ensure PHP is in your system PATH
   - Check if Composer is properly installed
   - Verify internet connection
   - Try running `composer update` if `install` fails

2. **Database Connection Issues**
   - Verify database credentials in `config/database.php`
   - Ensure MySQL service is running
   - Check if database and tables are created correctly

3. **OAuth Configuration Issues**
   - Verify Google Cloud Console settings
   - Check OAuth credentials
   - Ensure proper redirect URIs are set

4. **Email Configuration Issues**
   - Verify SMTP settings
   - Check email credentials
   - Ensure proper mail server configuration

## Support

For any issues or questions, please contact our development team:

### Team Members
- **Project Lead**: [Your Name] - your.email@example.com
- **Backend Developer**: [Team Member Name] - team.member@example.com
- **Frontend Developer**: [Team Member Name] - frontend@example.com
- **Database Administrator**: [Team Member Name] - dba@example.com

### Support Channels
- **Email**: support@insights.com
- **Issue Tracking**: Please report any issues through our support email
- **Documentation**: For additional help, refer to our internal documentation

### Response Time
- Critical Issues: Within 24 hours
- General Queries: Within 48 hours
- Feature Requests: Within 1 week

## License

This project is licensed under the MIT License - see the LICENSE file for details. 