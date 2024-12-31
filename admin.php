<?php
session_start();
include('connectDB.php');

// Fetch system stats
$total_users = $connect->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$total_courses = $connect->query("SELECT COUNT(*) AS total FROM courses")->fetch_assoc()['total'];
$total_logs = $connect->query("SELECT COUNT(*) AS total FROM logs")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="adminmain.css">
</head>
<body>
  <header>
    <nav>
      <a href="admin_dashboard.php" class="logo">E-Class System</a>
      <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="manage_courses.php">Manage Courses</a></li>
        <li><a href="view_reports.php">Reports</a></li>
        <li><a href="send_notifications.php">Notifications</a></li>
        <li><a href="view_logs.php">Logs</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Welcome, Admin</h1>

    <section class="dashboard-stats">
      <div class="stat-card">
        <h3>Total Users</h3>
        <p><?php echo $total_users; ?></p>
      </div>
      <div class="stat-card">
        <h3>Total Courses</h3>
        <p><?php echo $total_courses; ?></p>
      </div>
      <div class="stat-card">
        <h3>System Logs</h3>
        <p><?php echo $total_logs; ?></p>
      </div>
    </section>
  </main>
</body>
</html>
