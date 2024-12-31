<?php
session_start();
include('connectDB.php'); // Include your database connection file

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the enrolled courses for the logged-in user
$user_id = $_SESSION['id']; // Use `id` from session
$query = "SELECT c.* FROM courses c 
          INNER JOIN enrollments e ON c.id = e.course_id 
          WHERE e.user_id = '$user_id'";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard - Online Learning Center</title>
  <link rel="stylesheet" href="studentportal.css">
  <script src="assets/js/scripts.js" defer></script>
</head>
<body>
  <header>
    <nav>
      <a href="home.php" class="logo">Learning Center</a>
      <ul>
        <li><a href="course.php">Courses</a></li>
        <li><a href="library.php">Library</a></li>
        <li><a href="profile.html">Student Profile</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="logout.php" onclick="logout()">Logout</a></li>
      </ul>
    </nav>
  </header>
  
  <section class="dashboard">
    <img src="student dashboard photo.jpg" alt="Dashboard Banner" class="dashboard-banner">
    <p>Here you can manage your enrolled courses, assignments, and track your progress.</p>
    
    <div class="enrolled-courses">
      <h2>Your Enrolled Courses</h2>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($course = mysqli_fetch_assoc($result)): ?>
          <div class="course-card">
            <h3><?php echo $course['title']; ?></h3>
            <p>Status: In Progress</p>
            <form method="GET" action="course_details.php">
              <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
              <button type="submit">Continue Course</button>
            </form>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No courses enrolled yet. <a href="course.php">Browse Courses</a></p>
      <?php endif; ?>
    </div>

    <div class="student-portal">
      <h2>Student Portal</h2>
      <div class="portal-links">
        <a href="assignment.php" class="portal-link">Assignment Submission Portal</a>
        <a href="reports.php" class="portal-link">View Report Form</a>
        <a href="joinMeeting.php" class="portal-link">Join Meeting</a>
      </div>
    </div>
  </section>

  <footer>
    <p>&copy; 2024 Online Learning Center. All rights reserved.</p>
  </footer>
</body>
</html>
