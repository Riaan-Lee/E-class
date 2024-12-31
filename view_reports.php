<?php
session_start();
include('connectDB.php');

// Fetch system statistics for reports
$total_users = $connect->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$total_courses = $connect->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$total_payments = $connect->query("SELECT SUM(amount) AS total FROM payments")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<header>
    <nav>
        <a href="admin.php" class="logo">E-Class Admin</a>
    </nav>
</header>

<main>
    <h1>System Usage Reports</h1>

    <section>
        <h2>Total Users</h2>
        <p><?php echo $total_users; ?></p>

        <h2>Total Courses</h2>
        <p><?php echo $total_courses; ?></p>

        <h2>Total Payments</h2>
        <p><?php echo $total_payments; ?></p>
    </section>
</main>
</body>
</html>
