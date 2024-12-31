<?php
session_start();
include('connectDB.php');

// Fetch all courses
$query = "SELECT * FROM courses";
$courses = $connect->query($query);

// Handle query errors
if (!$courses) {
    die("Error fetching courses: " . $connect->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <link rel="stylesheet" href="manage_courses.css">
</head>
<body>
    <header>
        <nav>
            <a href="admin.php" class="logo">E-Class</a>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="course.php">Courses</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Manage Courses</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($course = $courses->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $course['id']; ?></td>
                        <td><?php echo $course['title']; ?></td>
                        <td><?php echo $course['description']; ?></td>
                        <td><img src="<?php echo $course['image']; ?>" alt="Course Image" style="width: 100px; height: auto;"></td>
                        <td>
    <a href="edit_course.php?id=<?php echo $course['id']; ?>">Edit</a>
    <a href="delete_course.php?id=<?php echo $course['id']; ?>" onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
</td>

                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
