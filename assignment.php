<?php
session_start();
include('connectDB.php'); // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Fetch courses for the logged-in user
$user_id = $_SESSION['id'];
$query = "SELECT c.id, c.title FROM courses c 
          INNER JOIN enrollments e ON c.id = e.course_id 
          WHERE e.user_id = '$user_id'";
$result = mysqli_query($connect, $query);

// Handle assignment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_id = $_POST['course'];
    $file_name = $_FILES['assignment']['name'];
    $file_tmp = $_FILES['assignment']['tmp_name'];
    $upload_dir = 'uploads/assignments/';
    $upload_path = $upload_dir . basename($file_name);

    // Ensure the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($file_tmp, $upload_path)) {
        // Insert submission into the database
        $stmt = $connect->prepare("INSERT INTO submissions (user_id, course_id, file_name, file_path, submitted_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param('iiss', $user_id, $course_id, $file_name, $upload_path);

        if ($stmt->execute()) {
            echo "<script>alert('Assignment submitted successfully!');</script>";
        } else {
            echo "<script>alert('Error saving submission to the database.');</script>";
        }
    } else {
        echo "<script>alert('Error uploading file.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment Submission Portal</title>
  <link rel="stylesheet" href="assignment.css">
</head>
<body>
  <header>
    <nav>
      <a href="home.php" class="logo">Learning Center</a>
      <ul>
        <li><a href="studentPortal.php">Dashboard</a></li>
        <li><a href="course.php">Courses</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  
  <section class="assignment-portal">
    <h1>Assignment Submission Portal</h1>
    <form action="assignment_submission_portal.php" method="post" enctype="multipart/form-data">
      <label for="course">Select Course:</label>
      <select name="course" id="course" required>
        <?php while ($course = mysqli_fetch_assoc($result)): ?>
          <option value="<?php echo $course['id']; ?>"><?php echo $course['title']; ?></option>
        <?php endwhile; ?>
      </select>

      <label for="assignment">Upload Assignment:</label>
      <input type="file" name="assignment" id="assignment" required>

      <button type="submit">Submit Assignment</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2024 Online Learning Center. All rights reserved.</p>
  </footer>
</body>
</html>
