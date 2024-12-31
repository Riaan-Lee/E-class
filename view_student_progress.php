<?php
session_start();
include('connectDB.php');

$parent_id = $_SESSION['id'];
$students = $connect->query("SELECT * FROM users WHERE parent_id = $parent_id AND role = 'student'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Progress</title>
    <link rel="stylesheet" href="parent.css">
</head>
<body>
<header>
    <nav>
        <a href="parent.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Student Progress</h1>
    <?php while ($student = $students->fetch_assoc()): ?>
        <div class="student-progress">
            <h3><?php echo $student['full_name']; ?></h3>
            <p>Email: <?php echo $student['email']; ?></p>
            <p>Grade Level: <?php echo $student['grade_level']; ?></p>
            <a href="student_progress_detail.php?student_id=<?php echo $student['id']; ?>">View Details</a>
        </div>
    <?php endwhile; ?>
</main>
</body>
</html>
