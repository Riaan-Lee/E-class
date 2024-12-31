<?php
session_start();
include('connectDB.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacher_id = $_POST['teacher_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $parent_id = $_SESSION['id'];

    $query = "INSERT INTO parent_messages (parent_id, teacher_id, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("iiss", $parent_id, $teacher_id, $subject, $message);
    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "<script>alert('Error sending message.');</script>";
    }
}

// Fetch teachers
$teachers = $connect->query("SELECT * FROM users WHERE role = 'teacher'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Teacher</title>
    <link rel="stylesheet" href="parent.css">
</head>
<body>
<header>
    <nav>
        <a href="parent.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Contact Teacher</h1>
    <form method="POST">
        <label for="teacher_id">Select Teacher:</label>
        <select id="teacher_id" name="teacher_id" required>
            <option value="">-- Select Teacher --</option>
            <?php while ($teacher = $teachers->fetch_assoc()): ?>
                <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['full_name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</main>
</body>
</html>
