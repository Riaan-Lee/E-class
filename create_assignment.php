<?php
session_start();
include('connectDB.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $teacher_id = $_SESSION['id']; // Assuming session stores user ID

    $query = "INSERT INTO assignments (teacher_id, title, description, due_date) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("isss", $teacher_id, $title, $description, $due_date);
    if ($stmt->execute()) {
        echo "<script>alert('Assignment created successfully!');</script>";
    } else {
        echo "<script>alert('Error creating assignment.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assignment</title>
    <link rel="stylesheet" href="teacher.css">
</head>
<body>
<header>
    <nav>
        <a href="teacher.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Create Assignment</h1>
    <form method="POST">
        <label for="title">Assignment Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required>

        <button type="submit">Create Assignment</button>
    </form>
</main>
</body>
</html>
