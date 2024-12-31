<?php
session_start();
include('connectDB.php');

// Fetch notifications and student progress
$parent_id = $_SESSION['id'];
$notifications = $connect->query("SELECT * FROM notifications WHERE recipient_id = $parent_id");
$students = $connect->query("SELECT * FROM users WHERE role = 'student' AND parent_id = $parent_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parent Dashboard</title>
  <link rel="stylesheet" href="parentmain.css">
</head>
<body>
  <header>
    <nav>
      <a href="parent_dashboard.php" class="logo">E-Class System</a>
      <ul>
        <li><a href="view_student_progress.php">Progress</a></li>
        <li><a href="make_payment.php">Payments</a></li>
        <li><a href="parent_notifications.php">Notifications</a></li>
        <li><a href="contact_teacher.php">Contact Teacher</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Welcome, Parent</h1>

    <section>
      <h2>Your Students</h2>
      <?php while ($student = $students->fetch_assoc()): ?>
        <div class="student-card">
          <h3><?php echo $student['full_name']; ?></h3>
          <p>Email: <?php echo $student['email']; ?></p>
          <p>Grade Level: <?php echo $student['grade_level']; ?></p>
          <a href="view_student_progress.php?student_id=<?php echo $student['id']; ?>">View Progress</a>
        </div>
      <?php endwhile; ?>
    </section>

    <section>
      <h2>Notifications</h2>
      <?php while ($notification = $notifications->fetch_assoc()): ?>
        <div class="notification">
          <p><?php echo $notification['message']; ?></p>
          <p><small><?php echo $notification['created_at']; ?></small></p>
        </div>
      <?php endwhile; ?>
    </section>
  </main>
</body>
</html>
