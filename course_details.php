<?php
session_start();
include('connectDB.php'); // Include your database connection file

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


try { 
// Validate course_id
if (isset($_GET['course_id']) && is_numeric($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Fetch course details from the database (without modules)
    $query = "SELECT * FROM courses WHERE id = '$course_id'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Course not found!'); window.location.href = 'studentPortal.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid course!'); window.location.href = 'studentPortal.php';</script>";
    exit();
}
}

catch (mysqli_sql_exception) {
  echo "No course progress available yet";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $course['title']; ?> - Course Details</title>
  <link rel="stylesheet" href="course_details.css">
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
  
  <section class="course-details">
    <h1><?php echo $course['title']; ?></h1>
    <p><?php echo $course['description']; ?></p>

    <h3>Course Content:</h3>
    <p>Course content not available (No modules in database).</p>

    <h3>Progress:</h3>
    <div class="progress-bar">
      <?php
      // Check progress of the student in this course
      $user_id = $_SESSION['id'];
      $progress_query = "SELECT progress FROM progress WHERE user_id = '$user_id' AND course_id = '$course_id'";
      $progress_result = mysqli_query($connect, $progress_query);
      try{
      if (mysqli_num_rows($progress_result) > 0) {
          $progress = mysqli_fetch_assoc($progress_result)['progress'];
      } else {
          $progress = 0;
      }
    }
    catch(mysqli_sql_exception){
      echo "No course progress available yet.";
    }
      // Display progress as a percentage
      echo "<div class='progress' style='width: $progress%'>$progress%</div>";
      ?>
    </div>

    <a href="continue.php?course_id=<?php echo $course['id']; ?>" class="continue-button">Continue Course</a>
  </section>

  <footer>
    <p>&copy; 2024 Online Learning Center. All rights reserved.</p>
  </footer>
</body>
</html>
