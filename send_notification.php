<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    
    // Prepare the basic notification payload
    $payload = [
        'app_id' => ONESIGNAL_APP_ID,
        'included_segments' => ['Subscribed Users'],
        'contents' => ['en' => $message],
        'headings' => ['en' => $title]
    ];
    
    // Add additional parameters based on notification type
    switch ($type) {
        case 'image':
            // For notifications with image
            $image_url = $_POST['image_url'];
            $payload['big_picture'] = $image_url;  // For Android
            $payload['ios_attachments'] = ['id1' => $image_url];  // For iOS
            break;
            
        case 'scheduled':
            // For scheduled notifications
            $scheduled_at = $_POST['scheduled_at'];
            $payload['send_after'] = date('Y-m-d H:i:s', strtotime($scheduled_at)) . ' GMT-0700';
            break;
            
        case 'subtitle':
            // For notifications with subtitle
            $subtitle = $_POST['subtitle'];
            $payload['subtitle'] = ['en' => $subtitle];
            break;
    }
    
    // Send to OneSignal
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Basic ' . ONESIGNAL_REST_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    // Store in database
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        $status = ($httpcode === 200) ? 'success' : 'failed';
        
        $stmt = $conn->prepare("INSERT INTO notifications (title, message, type, image_url, scheduled_at, subtitle, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : null;
        $scheduled_at = isset($_POST['scheduled_at']) ? $_POST['scheduled_at'] : null;
        $subtitle = isset($_POST['subtitle']) ? $_POST['subtitle'] : null;
        
        $stmt->bind_param("sssssss", $title, $message, $type, $image_url, $scheduled_at, $subtitle, $status);
        $stmt->execute();
        
        $conn->close();
        
        // Redirect back with status
        header('Location: index.php?status=' . $status);
    } catch (Exception $e) {
        header('Location: index.php?status=error&message=' . urlencode($e->getMessage()));
    }
    exit();
} 