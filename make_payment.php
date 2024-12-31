<?php
session_start();
include('connectDB.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $method = $_POST['payment_method'];
    $parent_id = $_SESSION['id'];

    $query = "INSERT INTO payments (parent_id, amount, payment_method) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ids", $parent_id, $amount, $method);
    if ($stmt->execute()) {
        echo "<script>alert('Payment successful!');</script>";
    } else {
        echo "<script>alert('Error processing payment.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Payment</title>
    <link rel="stylesheet" href="parent.css">
</head>
<body>
<header>
    <nav>
        <a href="parent.php" class="logo">E-Class System</a>
    </nav>
</header>

<main>
    <h1>Make Payment</h1>
    <form method="POST">
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="Card">Card</option>
            <option value="Mpesa">Mpesa</option>
        </select>

        <button type="submit">Pay Now</button>
    </form>
</main>
</body>
</html>
