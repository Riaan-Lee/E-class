<?php
include('connectDB.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $role = $_POST['role'];

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($password) && !empty($confirmPassword) && !empty($role)) {
        if ($password === $confirmPassword) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

            // Insert user into database
            $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $connect->prepare($query);
            $stmt->bind_param('ssss', $name, $email, $hashedPassword, $role);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: Could not register.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match!');</script>";
        }
    } else {
        echo "<script>alert('Please fill all fields!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registration page for E-Class System, the platform for students, tutors, parents, and e-librarians.">
    <title>Register - E-Class System</title>
    <link rel="stylesheet" href="E-REG.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
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

    <main>
        <section id="register" class="form">
            <h2>Register</h2>
            <form id="registerform" class="registerform" method="POST" action="register.php">
                <div class="formgroup">
                    <label for="name" class="formlabel">Name</label>
                    <input type="text" id="name" name="name" class="forminput" required>
                </div>

                <div class="formgroup">
                    <label for="email" class="formlabel">Email</label>
                    <input type="email" id="email" name="email" class="forminput" required>
                </div>
                
                <div class="formgroup">
                    <label for="password" class="formlabel">Password</label>
                    <input type="password" id="password" name="password" class="forminput" autocomplete="off" required>
                </div>

                <div class="formgroup">
                    <label for="confirm-password" class="formlabel">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="forminput" autocomplete="off" required>
                </div>

                <div class="formgroup">
                    <label for="role" class="formlabel">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="Student">Student</option>
                        <option value="Tutor">Tutor</option>
                        <option value="Parent">Parent</option>
                        <option value="E-librarian">E-librarian</option>
                        <option value="Admin">admin</option>
                        
                    </select>
                </div>

                <button type="submit" class="form-button" id="register-button">Register</button>
            </form>
            <p>Already have an account? <a href="login.php" class="form-link" id="loginlink">Login here</a></p>
        </section>
    </main>

    <script src="E-REG.js"></script>
</body>
</html>
