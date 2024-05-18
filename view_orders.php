<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$patient_id = $_SESSION['user_id'];

// Retrieve orders for the logged-in user
$stmt = $conn->prepare("SELECT o.order_id, d.type, m.name as material, o.due_date, o.status, m.cost 
                        FROM Orders o 
                        JOIN Dentures d ON o.denture_id = d.denture_id
                        JOIN Materials m ON o.material_id = m.material_id
                        WHERE o.patient_id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - Joy Dental</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header>
        <div class="logo"><h1>Joy Dental</h1></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="payment_page.php">Payment Page</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Your Orders</h2>
        <?php if (empty($orders)): ?>
            <p>No orders found!</p>
        <?php else: ?>
            <div class="orders-container">
                <?php foreach ($orders as $order): ?>
                    <div class="order-box">
                        <p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']) ?></p>
                        <p><strong>Type:</strong> <?= htmlspecialchars($order['type']) ?></p>
                        <p><strong>Material:</strong> <?= htmlspecialchars($order['material']) ?></p>
                        <p><strong>Due Date:</strong> <?= htmlspecialchars($order['due_date']) ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>
                        <p><strong>Price:</strong> $<?= htmlspecialchars(number_format($order['price'], 2)) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <footer>
        <p>Contact us at (787)-607-4477 | email: megretdental@gmail.com</p>
    </footer>
</body>
</html>