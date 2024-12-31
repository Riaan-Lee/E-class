<?php
session_start();
include('connectDB.php');

// Fetch the course to be edited
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM courses WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();

    if (!$course) {
        die("Course not found.");
    }
} else {
    die("No course ID provided.");
}

// Handle form submission for updating the course
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $updateQuery = "UPDATE courses SET title = ?, description = ?, image = ? WHERE id = ?";
    $updateStmt = $connect->prepare($updateQuery);
    $updateStmt->bind_param("sssi", $title, $description, $image, $id);

    if ($updateStmt->execute()) {
        echo "<script>alert('Course updated successfully!'); window.location.href='manage_courses.php';</script>";
    } else {
        echo "<script>alert('Error updating course: " . $connect->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link rel="stylesheet" href="manage_courses.css">
</head>
<body>
    <header>
        <nav>
            <a href="admin.php" class="logo">E-Class</a>
        </nav>
    </header>
    <main>
        <h1>Edit Course</h1>
        <form method="POST">
            <label for="title">Course Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $course['title']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $course['description']; ?></textarea>

            <label for="image">Image URL:</label>
            <input type="url" id="image" name="image" value="<?php echo $course['image']; ?>" required>

            <button type="submit">Save Changes</button>
        </form>
    </main>
</body>
</html>
