<?php
session_start();
include('connectDB.php');

// Handle form submission for notifications
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $target_group = $_POST['target_group'];

    $query = "INSERT INTO notifications (message, target_group) VALUES (?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ss", $message, $target_group);
    if ($stmt->execute()) {
        echo "<script>alert('Notification sent successfully!');</script>";
    } else {
        echo "<script>alert('Error sending notification.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notifications</title>
    <link rel="stylesheet" href="not.css">
</head>
<body>
<header>
    <nav>
        <a href="admin.php" class="logo">E-Class Admin</a>
    </nav>
</header>

<main>
    <h1>Send Notification</h1>
    <form method="POST">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <label for="target_group">Target Group:</label>
        <select id="target_group" name="target_group" required>
            <option value="All">All</option>
            <option value="Students">Students</option>
            <option value="Parents">Parents</option>
            <option value="Teachers">Teachers</option>
            <option value="E-Librarians">E-Librarians</option>
        </select>

        <button type="submit">Send Notification</button>
    </form>
</main>
</body>
</html>
