<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joy Dental</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Joy Dental</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="view_orders.php">View Order</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="mission-statement">
            <h1>Mission & Vision: We restore your smile for a joyful life.</h1>
        </div>
        <div class="container">
            <section>
                <h2>General Information</h2>
                <p>Joy Dental specializes exclusively in removable dentures, focusing on Full and Partial denture solutions. We are deeply committed to providing the highest quality dental restorations, ensuring that each patient enjoys a fulfilling life with a smile they can be proud of.</p>
                <p>Our lab utilizes the latest in dental technology and materials to craft dentures that are not only aesthetically pleasing but also functional and comfortable.</p>
            </section>

            <section>
                <h2>Types of Work We Do</h2>
                <ul>
                    <li><strong>Full Dentures:</strong> Complete sets of prosthetic teeth to replace all natural teeth on either jaw.</li>
                    <li><strong>Partial Dentures:</strong> Designed to fill gaps, blending seamlessly with existing teeth, available in metal and flexible materials.</li>
                    <li><strong>Customization and Adjustments:</strong> Tailored dentures to meet your needs, with precise adjustments for comfort.</li>
                    <li><strong>Repairs and Maintenance:</strong> We offer prompt repair services and regular maintenance to extend the lifespan of your dentures.</li>
                </ul>
            </section>
        </div>
    </main>
    <footer>
        <p>Contact us at (787)-607-4477 | email: megretdental@gmail.com</p>
    </footer>
</body>
</html>

<?php

$host = "localhost";
$user = "jose.megret";
$pass = "801217986";
$db = "jose.megret";

$conn = new mysqli("localhost", "jose.megret", "801217986", "jose.megret");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>