<?php
session_start();
include('connectDB.php');

// Check if the course ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the course
    $query = "DELETE FROM courses WHERE id = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Course deleted successfully!'); window.location.href='manage_courses.php';</script>";
    } else {
        echo "<script>alert('Error deleting course: " . $connect->error . "');</script>";
    }
} else {
    die("No course ID provided.");
}
?>
