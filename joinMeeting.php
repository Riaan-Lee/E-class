<?php
session_start();
include('connectDB.php'); // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Fetch courses for the logged-in user
$user_id = $_SESSION['id'];
$query = "SELECT DISTINCT c.id, c.title 
          FROM courses c
          INNER JOIN enrollments e ON c.id = e.course_id
          WHERE e.user_id = '$user_id'";
$result = mysqli_query($connect, $query);

// Handle meeting join
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course'];

    // Fetch the meeting link for the selected course
    $meeting_query = "SELECT meeting_link FROM meetings WHERE course_id = '$course_id'";
    $meeting_result = mysqli_query($connect, $meeting_query);

    if ($meeting_result && mysqli_num_rows($meeting_result) > 0) {
        $meeting = mysqli_fetch_assoc($meeting_result);
        $meeting_link = $meeting['meeting_link'];
        // Redirect to the meeting link
        header("Location: $meeting_link");
        exit();
    } else {
        echo "<script>alert('No meeting link found for the selected course.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Meeting</title>
  <link rel="stylesheet" href="assignment.css">
</head>
<body>
  <header>
    <nav>
      <a href="home.php" class="logo">Learning Center</a>
      <ul>
        <li><a href="studentPortal.php">Dashboard</a></li>
        <li><a href="course.php">Courses</a></li>
        <li><a href="library.php">Library</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  
  <section class="join-meeting">
    <h1>Join Meeting</h1>
    <form action="join_meeting.php" method="post">
      <label for="course">Select Course:</label>
      <select name="course" id="course" required>
        <?php while ($course = mysqli_fetch_assoc($result)): ?>
          <option value="<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['title']); ?></option>
        <?php endwhile; ?>
      </select>

      <button type="submit">Join Meeting</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2024 Online Learning Center. All rights reserved.</p>
  </footer>
</body>
</html>
