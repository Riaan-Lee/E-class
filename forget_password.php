<!-- Forgot Password Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forgot_password.css">
    <title>Forgot Password - HEARTFELT TOUCH</title>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav id="main-navbar" class="navbar">
            <ul class="nav-links">
                <li><a href="home.php" class="nav-link" id="home-link">Home</a></li>
                <li><a href="contact.php" class="nav-link" id="contact-link">Contact Us</a></li>
                <li><a href="help.php" class="nav-link" id="help-link">Help</a></li>
                <li><a href="login.php" class="nav-link" id="login-link">Login</a></li>
                <li><a href="https://wa.me/yourwhatsapplink" target="_blank" class="nav-link"><i class="fa-brands fa-whatsapp fa-beat" style="color: #63E6BE;"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
        <h2>Reset Your Password</h2>
        <p>Enter your email address below, and we'll send you a link to reset your password.</p>
        <form action="forgot_password_process.php" method="POST">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Send Reset Link</button>
        </form>
        <p><a href="login.php" class="back-button">Back to Login</a></p>
    </div>
</body>
</html>
