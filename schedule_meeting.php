<?php
session_start();
include('connectDB.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form inputs
    $title = $_POST['title']; // Updated name attribute
    $meeting_link = $_POST['meeting_link'];
    $scheduled_at = $_POST['scheduled_at'];
    $teacher_id = $_SESSION['id']; // Assuming session stores the logged-in teacher's ID

    // Prepare and execute the SQL query
    $query = "INSERT INTO meetings (id, meeting_name, meeting_link, scheduled_at) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("isss", $teacher_id, $title, $meeting_link, $scheduled_at);

    // Check if the query was successful
    if ($stmt->execute()) {
        echo "<script>alert('Meeting scheduled successfully!');</script>";
    } else {
        echo "<script>alert('Error scheduling meeting. Please try again.');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Meeting</title>
    <link rel="stylesheet" href="teacher.css">
</head>
<body>
<header>
    <nav>
        <a href="teacher.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Schedule Meeting</h1>
    <form method="POST">
        <!-- Meeting Title -->
        <label for="title">Meeting Title:</label>
        <input type="text" id="title" name="title" required>

        <!-- Meeting Link -->
        <label for="meeting_link">Meeting Link:</label>
        <input type="url" id="meeting_link" name="meeting_link" required>

        <!-- Scheduled Date and Time -->
        <label for="scheduled_at">Scheduled At:</label>
        <input type="datetime-local" id="scheduled_at" name="scheduled_at" required>

        <!-- Submit Button -->
        <button type="submit">Schedule Meeting</button>
    </form>
</main>
</body>
</html>
