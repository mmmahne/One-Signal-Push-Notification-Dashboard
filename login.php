<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['username'];
    $password = $_POST['password'];
    
    // Hardcoded credentials for testing
    if (($login === 'admin@eden.com' || $login === 'admin') && $password === 'admineden') {
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'admin';
        header('Location: index.php');
        exit();
    }
    
    $error = 'Invalid username or password';
}
?>

<?php include 'includes/header.php'; ?>

<div class="login-container">
    <div class="login-box">
        <div class="text-center mb-4">
            <i class="fas fa-bell fa-2x mb-3" style="color: var(--primary-color)"></i>
            <h2>Welcome Back</h2>
            <p class="text-secondary">Sign in to your account</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="mb-4">
                <label class="form-label">Email or Username</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent">
                        <i class="fas fa-user text-secondary"></i>
                    </span>
                    <input type="text" name="username" class="form-control border-start-0" 
                           placeholder="Enter your email or username" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0 bg-transparent">
                        <i class="fas fa-lock text-secondary"></i>
                    </span>
                    <input type="password" name="password" class="form-control border-start-0" 
                           placeholder="Enter your password" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
                Sign In
                <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 