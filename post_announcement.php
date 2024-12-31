<?php
session_start();
include('connectDB.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $teacher_id = $_SESSION['id']; // Assuming session stores user ID

    $query = "INSERT INTO announcements (teacher_id, content) VALUES (?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("is", $teacher_id, $content);
    if ($stmt->execute()) {
        echo "<script>alert('Announcement posted successfully!');</script>";
    } else {
        echo "<script>alert('Error posting announcement.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Announcement</title>
    <link rel="stylesheet" href="teacher.css">
</head>
<body>
<header>
    <nav>
        <a href="teacher.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Post Announcement</h1>
    <form method="POST">
        <label for="content">Announcement Content:</label>
        <textarea id="content" name="content" required></textarea>

        <button type="submit">Post Announcement</button>
    </form>
</main>
</body>
</html>
