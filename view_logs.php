<?php
session_start();
include('connectDB.php');

// Fetch system logs
$logs = $connect->query("SELECT * FROM logs ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Logs</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<header>
    <nav>
        <a href="admin.php" class="logo">E-Class Admin</a>
    </nav>
</header>

<main>
    <h1>System Logs</h1>
    <section>
        <?php while ($log = $logs->fetch_assoc()): ?>
            <div class="log-entry">
                <p><strong>User:</strong> <?php echo $log['user_id']; ?></p>
                <p><strong>Action:</strong> <?php echo $log['action']; ?></p>
                <p><small><?php echo date("F j, Y, g:i a", strtotime($log['created_at'])); ?></small></p>
            </div>
        <?php endwhile; ?>
    </section>
</main>
</body>
</html>
