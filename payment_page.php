<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle form submission here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process payment here
    // For demo purposes, we'll assume payment was successful
    header('Location: view_orders.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Joy Dental</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header>
        <div class="logo"><h1>Joy Dental</h1></div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Payment Information</h2>
        <form action="payment_page.php" method="POST">
            <label for="cardName">Name on Card:</label>
            <input type="text" id="cardName" name="cardName" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required>
            
            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber" pattern="\d{16}" title="Card number must be 16 digits" required>
            
            <label for="expMonth">Expiry Month:</label>
            <input type="text" id="expMonth" name="expMonth" pattern="(0[1-9]|1[0-2])" title="Enter a valid month (01 to 12)" required>

            <label for="expYear">Expiry Year:</label>
            <input type="text" id="expYear" name="expYear" pattern="\d{4}" title="Enter a valid 4-digit year" required>
            
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" pattern="\d{3}" title="CVV must be 3 digits" required>
            
            <button type="submit">Submit Payment</button>
        </form>
    </main>
    <footer>
        <p>Contact us at (787)-607-4477 | email: megretdental@gmail.com</p>
    </footer>
</body>
</html>