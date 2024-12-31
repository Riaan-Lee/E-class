<?php
session_start();
include('connectDB.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $grade = $_POST['grade'];
    $comments = $_POST['comments'];
    $teacher_id = $_SESSION['id']; // Assuming session stores user ID

    $query = "INSERT INTO grades (student_id, subject, grade, comments, id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("isssi", $student_id, $subject, $grade, $comments, $teacher_id);
    if ($stmt->execute()) {
        echo "<script>alert('Grade submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error submitting grade.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Students</title>
    <link rel="stylesheet" href="teacher.css">
</head>
<body>
<header>
    <nav>
        <a href="teacher.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Grade Students</h1>
    <form method="POST">
        <label for="student_id">Student ID:</label>
        <input type="number" id="student_id" name="student_id" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" required>

        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments"></textarea>

        <button type="submit">Submit Grade</button>
    </form>
</main>
</body>
</html>
