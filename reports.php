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
$query = "SELECT DISTINCT subject FROM grades WHERE student_id = '$user_id'";
$result = mysqli_query($connect, $query);

// Handle report view submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_course = $_POST['course'];

    // Fetch grades for the selected course
    $grades_query = "SELECT * FROM grades WHERE student_id = '$user_id' AND subject = '$selected_course'";
    $grades_result = mysqli_query($connect, $grades_query);

    if (!$grades_result) {
        echo "<script>alert('Error retrieving grades.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Report Form</title>
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
  
  <section class="report-form">
    <h1>View Report Form</h1>
    <form action="view_report_form.php" method="post">
      <label for="course">Select Course:</label>
      <select name="course" id="course" required>
        <?php while ($course = mysqli_fetch_assoc($result)): ?>
          <option value="<?php echo $course['subject']; ?>"><?php echo $course['subject']; ?></option>
        <?php endwhile; ?>
      </select>

      <button type="submit">View Report</button>
    </form>

    <?php if (isset($grades_result) && mysqli_num_rows($grades_result) > 0): ?>
      <section class="grades-table">
        <h2>Grades for <?php echo htmlspecialchars($selected_course); ?></h2>
        <table border="1" cellpadding="10">
          <thead>
            <tr>
              <th>Subject</th>
              <th>Grade</th>
              <th>Comments</th>
              <th>Teacher</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($grade = mysqli_fetch_assoc($grades_result)): ?>
              <tr>
                <td><?php echo htmlspecialchars($grade['subject']); ?></td>
                <td><?php echo htmlspecialchars($grade['grade']); ?></td>
                <td><?php echo htmlspecialchars($grade['comments']); ?></td>
                <td>
                  <?php
                  // Fetch the teacher's name
                  $teacher_query = "SELECT name FROM users WHERE id = '{$grade['teacher_id']}'";
                  $teacher_result = mysqli_query($connect, $teacher_query);
                  $teacher = mysqli_fetch_assoc($teacher_result);
                  echo htmlspecialchars($teacher['name']);
                  ?>
                </td>
                <td><?php echo htmlspecialchars($grade['created_at']); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </section>
    <?php elseif (isset($grades_result)): ?>
      <p>No grades found for the selected course.</p>
    <?php endif; ?>
  </section>

  <footer>
    <p>&copy; 2024 Online Learning Center. All rights reserved.</p>
  </footer>
</body>
</html>
