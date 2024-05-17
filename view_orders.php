<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Retrieve orders for the logged-in user
$sql = 'SELECT * FROM Orders WHERE patient_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Joy Dental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><h1>Joy Dental</h1></div>
    </header>
    <main>
        <h2>Details of the Order</h2>
        <?php foreach ($orders as $order): ?>
            <div>
                <p>Patient ID: <?= htmlspecialchars($order['patient_id']) ?></p>
                <p>Type of Work: <?= htmlspecialchars($order['denture_type']) ?></p>
                <p>Material: <?= htmlspecialchars($order['material']) ?></p>
                <p>Total Amount: $<?= htmlspecialchars($order['price']) ?></p>
            </div>
        <?php endforeach; ?>
    </main>
    <footer>
        <p>Contact us at (787)-607-4477 | email: megretdental@gmail.com</p>
    </footer>
</body>
</html>
