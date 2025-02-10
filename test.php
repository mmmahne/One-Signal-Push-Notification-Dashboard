<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'u964374799_eden';
$pass = 'edenadmin123@#A';
$db   = 'u964374799_eden';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully!";
    $conn->close();
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
} 