<?php
session_start();
include('connectDB.php');

// Handle form submission for adding, editing, or deleting users
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $user_id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;

    if ($action == 'add') {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $query = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssss", $name, $email, $password, $role);
    } elseif ($action == 'edit') {
        $query = "UPDATE users SET full_name = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("sssi", $name, $email, $role, $user_id);
    } elseif ($action == 'delete') {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("i", $user_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Action performed successfully!');</script>";
    } else {
        echo "<script>alert('Error performing action.');</script>";
    }
}

// Fetch all users
$users = $connect->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<header>
    <nav>
        <a href="admin.php" class="logo">E-Class Admin</a>
    </nav>
</header>

<main>
    <h1>Manage Users</h1>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <h2>Add User</h2>
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="student">Student</option>
            <option value="parent">Parent</option>
            <option value="teacher">Teacher</option>
            <option value="e-librarian">E-Librarian</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Add User</button>
    </form>

    <h2>Existing Users</h2>
    <?php while ($user = $users->fetch_assoc()): ?>
        <div class="user-card">
            <p><strong>Name:</strong> <?php echo $user['full_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Role:</strong> <?php echo $user['role']; ?></p>
        </div>
    <?php endwhile; ?>
</main>
</body>
</html>
