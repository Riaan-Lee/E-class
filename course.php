<?php
session_start();
include('connectDB.php'); // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM courses"; // Fetch all courses from the database
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courses - Online Learning Center</title>
  <link rel="stylesheet" href="course.css">
  <script src="scripts.js" defer></script>
</head>
<body>
  <header>
    <nav>
      <a href="home.php" class="logo">Learning Center</a>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="studentPortal.php">Dashboard</a></li>
      </ul>
    </nav>
  </header>

  <section class="course-list">
  <h1>Our Courses</h1>
  <?php while ($course = mysqli_fetch_assoc($result)): ?>
    <div class="course-card">
      <img 
        src="<?php echo htmlspecialchars($course['image']); ?>" 
        alt="Course Image" 
        onerror="this.src='assets/images/default.png';">
      <h3><?php echo htmlspecialchars($course['title']); ?></h3>
      <p><?php echo htmlspecialchars($course['description']); ?></p>
      <form method="POST" action="enroll.php">
        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['id']); ?>">
        <button type="submit">Enroll Now</button>
      </form>
    </div>
  <?php endwhile; ?>
</section>


  <footer>
    <p>&copy; 2024 Online Learning Center. All Rights Reserved.</p>
  </footer>
</body>
</html>
