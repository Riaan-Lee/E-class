<?php
session_start();
include('connectDB.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Sanitize inputs to prevent SQL injection
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    // Query to find the user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        // Check if there is any record
        if (mysqli_num_rows($result) > 0) {
            // Fetch user details from the database
            $row = mysqli_fetch_assoc($result);
            $hash = $row['password'];
            $id = $row['id']; // Picks id from the database

            // Verify the password
            if (password_verify($password, $hash)) {
                // Store user information in session
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = strtolower($row['role']); // Normalize role to lowercase for consistency

                // Redirect based on user role
                switch ($_SESSION['role']) {
                    case 'student':
                        header("Location: studentPortal.php");
                        break;
                    case 'tutor':
                        header("Location: teacher.php");
                        break;
                    case 'parent':
                        header("Location: parent.php");
                        break;
                    case 'admin':
                        header("Location: admin.php");
                        break;
                    case 'E-librarian':
                        header("Location: librarian.php");
                        break;
                    default:
                        echo "<script>alert('Role not recognized.');</script>";
                        break;
                }
                exit(); // Ensure no further code execution after redirect
            } else {
                echo "<script>alert('Invalid credentials!');</script>";
            }
        } else {
            echo "<script>alert('User not found! Please register.');</script>";
        }
    } else {
        echo "<script>alert('Database query error! Please try again later.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Login page for E-Class System, the platform for students, parents, and teachers.">
  <title>Login - E-Class System</title>
  <link rel="stylesheet" href="E-login.css">
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
        <section id="login" class="form">
            <h2>Login</h2>
            <form id="loginform" class="loginform" method="POST" action="login.php">
                <div class="formgroup">
                    <label for="email" class="formlabel">Email</label>
                    <input type="email" id="email" name="email" class="forminput" required>
                </div>

                <div class="formgroup">
                    <label for="password" class="formlabel">Password</label>
                    <input type="password" id="password" name="password" class="forminput" autocomplete="off" required>
                </div>

                <button type="submit" class="form-button" id="login-button">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php" class="form-link" id="registerlink">Register here</a></p>
            <p><a href="forget_password.php" class="form-link" id="forgot-password-link">Forgot Password?</a></p>
        </section>
    </main>

    <!-- <script src="E-login.js"></script> -->

</body>
</html>
