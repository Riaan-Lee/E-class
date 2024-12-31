<?php
session_start();
include('connectDB.php'); // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id'])) {
    $course_id = $_POST['course_id'];
    $id = $_SESSION['id']; // Use `id` from session

    // Check if the user exists in the users table
    $check_user_query = "SELECT id FROM users WHERE id = '$id'";
    $user_result = mysqli_query($connect, $check_user_query);

    if (mysqli_num_rows($user_result) > 0) {
        // Check if the user is already enrolled in the course
        $check_query = "SELECT * FROM enrollments WHERE user_id = '$id' AND course_id = '$course_id'";
        $check_result = mysqli_query($connect, $check_query);

        if (mysqli_num_rows($check_result) == 0) {
            // If not already enrolled, add to enrollments
            $query = "INSERT INTO enrollments (user_id, course_id) VALUES ('$id', '$course_id')";
            $result = mysqli_query($connect, $query);

            if ($result) {
                echo "<script>alert('You have successfully enrolled in the course!'); window.location.href = 'course.php';</script>";
            } else {
                echo "<script>alert('Error enrolling in the course! Please try again.'); window.location.href = 'course.php';</script>";
            }
        } else {
            echo "<script>alert('You are already enrolled in this course!'); window.location.href = 'course.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid user! Please log in again.'); window.location.href = 'login.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request or session expired!'); window.location.href = 'login.php';</script>";
}
?>
