<?php
// TEMPORARY ERROR REPORTING FOR DEBUGGING
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (Exception $e) {
    die('Error loading .env file: ' . $e->getMessage());
}

// OneSignal Configuration
define('ONESIGNAL_APP_ID', $_ENV['ONESIGNAL_APP_ID'] ?? '');
define('ONESIGNAL_REST_API_KEY', $_ENV['ONESIGNAL_REST_API_KEY'] ?? '');

// Database Configuration
define('DB_HOST', $_ENV['DB_HOST'] ?? '');
define('DB_USER', $_ENV['DB_USER'] ?? '');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? '');

// Test database connection with more detailed error reporting
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Add detailed error reporting
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Print connection details (REMOVE IN PRODUCTION)
    error_log("Attempting connection with:");
    error_log("Host: " . DB_HOST);
    error_log("User: " . DB_USER);
    error_log("Database: " . DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    $conn->close();
} catch (Exception $e) {
    die('Database connection error: ' . $e->getMessage() . 
        '<br>Error code: ' . $e->getCode());
}

// Start session
session_start(); 