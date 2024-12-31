<?php
session_start();
include('connectDB.php');

$parent_id = $_SESSION['id'];
$notifications = $connect->query("SELECT * FROM notifications WHERE recipient_id = $parent_id OR target_group = 'Parents' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Notifications</title>
    <link rel="stylesheet" href="parent.css">
</head>
<body>
<header>
    <nav>
        <a href="parent.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Notifications</h1>
    <section>
        <?php if ($notifications->num_rows > 0): ?>
            <?php while ($notification = $notifications->fetch_assoc()): ?>
                <div class="notification">
                    <p><?php echo $notification['message']; ?></p>
                    <p><small><?php echo date("F j, Y, g:i a", strtotime($notification['created_at'])); ?></small></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No notifications at the moment.</p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
