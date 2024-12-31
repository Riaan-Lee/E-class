<?php
session_start();
include('connectDB.php');

// Check if the user is logged in and has the role of 'librarian'
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'librarian') {
    // Redirect unauthorized users to the login page
    header("Location: login.php");
    exit();
}

// Fetch library stats
$total_resources = $connect->query("SELECT COUNT(*) AS total FROM library_resources")->fetch_assoc()['total'];
$total_categories = $connect->query("SELECT COUNT(*) AS total FROM categories")->fetch_assoc()['total'];
$active_borrows = $connect->query("SELECT COUNT(*) AS total FROM borrowed_resources WHERE returned_at IS NULL")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Librarian Dashboard</title>
  <link rel="stylesheet" href="librarian.css">
</head>
<body>
  <header>
    <nav>
      <a href="librarian.php" class="logo">E-Class Library</a>
      <ul>
        <li><a href="manage_library.php">Manage Resources</a></li>
        <li><a href="view_borrowed_materials.php">Borrowed Materials</a></li>
        <li><a href="manage_categories.php">Manage Categories</a></li>
        <li><a href="user_activity.php">User Activity</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Welcome, E-Librarian</h1>

    <section class="dashboard-stats">
      <div class="stat-card">
        <h3>Total Resources</h3>
        <p><?php echo $total_resources; ?></p>
      </div>
      <div class="stat-card">
        <h3>Total Categories</h3>
        <p><?php echo $total_categories; ?></p>
      </div>
      <div class="stat-card">
        <h3>Active Borrows</h3>
        <p><?php echo $active_borrows; ?></p>
      </div>
    </section>
  </main>
</body>
</html>
