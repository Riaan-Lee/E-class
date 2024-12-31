<?php
session_start();
include('connectDB.php');

// Fetch assignments, announcements, and meetings
$teacher_id = $_SESSION['id']; // Assuming session holds teacher ID
$assignments = $connect->query("SELECT * FROM assignments WHERE teacher_id = $teacher_id");
$announcements = $connect->query("SELECT * FROM announcements WHERE teacher_id = $teacher_id");
$meetings = $connect->query("SELECT * FROM meetings WHERE id = $teacher_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Dashboard</title>
  <link rel="stylesheet" href="teachermain.css">
</head>
<body>
  <header>
    <nav>
      <a href="teacher_dashboard.php" class="logo">E-Class System</a>
      <ul>
        <li><a href="create_assignment.php">Assignments</a></li>
        <li><a href="post_announcement.php">Announcements</a></li>
        <li><a href="schedule_meeting.php">Meetings</a></li>
        <li><a href="grade_students.php">Grades</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Welcome, Teacher</h1>

    <section>
      <h2>Your Assignments</h2>
      <?php while ($assignment = $assignments->fetch_assoc()): ?>
        <div class="assignment">
          <h3><?php echo $assignment['title']; ?></h3>
          <p><?php echo $assignment['description']; ?></p>
          <p><strong>Due Date:</strong> <?php echo $assignment['due_date']; ?></p>
        </div>
      <?php endwhile; ?>
    </section>

    <section>
      <h2>Your Announcements</h2>
      <?php while ($announcement = $announcements->fetch_assoc()): ?>
        <div class="announcement">
          <p><?php echo $announcement['content']; ?></p>
        </div>
      <?php endwhile; ?>
    </section>

    <section>
      <h2>Scheduled Meetings</h2>
      <?php while ($meeting = $meetings->fetch_assoc()): ?>
        <div class="meeting">
          <h3><?php echo $meeting['title']; ?></h3>
          <p><a href="<?php echo $meeting['meeting_link']; ?>" target="_blank">Join Meeting</a></p>
          <p><strong>Scheduled At:</strong> <?php echo $meeting['scheduled_at']; ?></p>
        </div>
      <?php endwhile; ?>
    </section>
  </main>
</body>
</html>
