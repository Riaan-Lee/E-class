<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Learning Center - Home</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <header>
        <nav>
            <a href="home.php" class="logo">Learning Center</a>
            <ul>
                <li><a href="course.php">Courses</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="help.php">Help</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="studentPortal.php" class="button">Dashboard</a></li>
                    <li><a href="logout.php" class="button">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="button">Login</a></li>
                    <li><a href="register.php" class="button">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <h1>Welcome to Our Online Learning Center</h1>
        <p>Empowering students with top-quality online courses and resources.</p>
        <a href="register.php" class="cta">Join Us Now</a>
    </section>
    <section class="features">
        <h2>Our Features</h2>
        <div class="feature">
            <img src="home page photo.jpg" alt="Quality Courses">
            <h3>Quality Courses</h3>
            <p>Learn from experts with hands-on projects.</p>
        </div>
        <!-- More features here -->
    </section>
    <section class="testimonials">
        <h2>What Our Students Say</h2>
        <div class="carousel">
            <p class="testimonial">"This platform has changed my life!" - Jane Doe</p>
            <!-- More testimonials here -->
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Online Learning Center. All rights reserved.</p>
    </footer>
</body>
</html>
