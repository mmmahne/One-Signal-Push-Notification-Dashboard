<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Push Notification System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php
// Debug information (REMOVE IN PRODUCTION)
if (isset($_SESSION)) {
    error_log('Session exists: ' . print_r($_SESSION, true));
} else {
    error_log('No session found');
}
?>

<?php if (isset($_SESSION['user_id'])): ?>
    <nav class="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <i class="fas fa-bell me-2"></i>
                    <span>Notification System</span>
                </a>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-secondary d-none d-md-block">
                        Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
                    </span>
                    <a href="logout.php" class="nav-link d-flex align-items-center">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
<?php endif; ?> 